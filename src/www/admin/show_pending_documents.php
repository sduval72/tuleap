<?php
/**
 * Copyright (c) STMicroelectronics, 2010. All Rights Reserved.
 *
 * This file is a part of Codendi.
 *
 * Codendi is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Codendi is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Codendi; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
require_once('pre.php');
require_once('www/admin/admin_utils.php');
require_once('common/event/EventManager.class.php');

session_require(array('group'=>'1','admin_flags'=>'A'));

$request = HTTPRequest::instance();
$em      = EventManager::instance();
$pm      = ProjectManager::instance();

$vFunc = new Valid_WhiteList('func', array('confirm_restore_frs_file'));
$vFunc->required();
if ($request->valid($vFunc)) {
    $func = $request->get('func');
} else {
    $func = '';
}

// Check if group_id is valid
$vGroupId = new Valid_GroupId();
$vGroupId->required();
if($request->valid($vGroupId)) {
    $group_id = $request->get('group_id');
} else {
    exit_no_group();
}

//if ($request->isPost()) {
switch ($func) {
    case 'confirm_restore_frs_file':
        frs_file_restore_process($request, $group_id);
        break;
}
//}

$focus = $request->get('focus');
if (!$focus) {
    $focus ='frs_file';
}

$idArray   = array();
$nomArray  = array();
$htmlArray = array();

frs_file_restore_view($group_id, &$idArray, &$nomArray, &$htmlArray);

$params = array('group_id' => $group_id,
                'id'       => &$idArray,
                'nom'      => &$nomArray,
                'focus'    => $focus,
                'html'     => &$htmlArray
);
$em->processEvent('show_pending_documents', $params);

site_admin_header(array('title'=>$GLOBALS['Language']->getText('admin_groupedit','title')));
?>
<FORM action="?" method="POST">
<INPUT type="hidden" name="group_id" value="<?php print $group_id; ?>">
<?php 
$project = $pm->getProject($group_id,false,true);
echo '<h3>'.$GLOBALS['Language']->getText('admin_show_pending_documents','pending_doc', array ($group_id, $project->getUnixName())).'</h3>'; 
echo '<p>'.$GLOBALS['Language']->getText('admin_show_pending_documents','delay_info', array($GLOBALS['sys_file_deletion_delay'])).'</p>';
?>
        <div class="systeme_onglets">
            <div class="onglets">
            <?php
            if (isset($params['id']) && $params['id']) {
                $i=0;
            
                foreach($params['id'] as $id){
                    $nom = $params['nom'][$i++];
                    echo '<span class="onglet_0 onglet" id="onglet_'.$id.'">'.$nom.'</span>';
                }
            }
            ?>
            </div>
            <div class="contenu_onglets">
            <?php 
            if (isset($params['html']) && $params['html']) {
                foreach($params['html'] as $html) {
                    echo $html;
                }
            }
            ?>
            </div>
         </div>
</FORM>
<?php

$GLOBALS['HTML']->includeFooterJavascriptSnippet('
                function change_onglet(name)
                {
                        $(\'onglet_\'+anc_onglet).className = \'onglet_0 onglet\';
                        $(\'onglet_\'+name).className = \'onglet_1 onglet\';
                        $(\'contenu_onglet_\'+anc_onglet).style.display = \'none\';
                        $(\'contenu_onglet_\'+name).style.display = \'block\';
                        anc_onglet = name;
                }
                $$(\'.onglet\').each(function (e) {
                    e.observe(\'click\', function () {
                        var id = e.id.sub(\'onglet_\', \'\');
                        change_onglet(id);
                        e.stop();
                    });
                });
                var anc_onglet = \''.$focus.'\';
                change_onglet(anc_onglet);
');

site_admin_footer(array());

/*
 * Functions
 */

function frs_file_restore_view($group_id, $idArray, $nomArray, $htmlArray) {
    $fileFactory = new FRSFileFactory();
    $files       = $fileFactory->listPendingFiles($group_id, 0, 0);

    $html  = '';
    $html .= '<div class="contenu_onglet" id="contenu_onglet_frs_file">';
    $html .= '<p>Note: there might be some delay (max 30 minutes) between the time the file is deleted and time it appears here.<br />When a file is deleted by the user, it appears in this list after SYSTEM_CHECK <a href="/admin/system_events/">system event</a> is processed</p>'.
             '<p>Please note that <strong>actual file restoration</strong> will be done by the <strong>next SYSTEM_CHECK</strong> event. This interface only schedule the restoration.</p>';
    $i     = 1;
    if ($files->rowCount() > 0) {
        $titles = array ('Filename', 'Release name', 'Package name', 'Delete date', 'Forcast purge date', 'Restore');
        $html  .= html_build_list_table_top ($titles);
        foreach ($files as $file) {
            if ($file['release_status'] != FRSRelease::STATUS_DELETED
                && $file['package_status'] != FRSPackage::STATUS_DELETED) {
                $purgeDate = strtotime('+'.$GLOBALS['sys_file_deletion_delay'].' day', $file['delete_date']);
                $html .= '<tr class="'. html_get_alt_row_color($i++) .'">';
                $html .= '<td>'.$file['filename'].'</td>';
                $url   = '/file/showfiles.php?group_id='.$group_id.'#p_'.$file['package_id'].'r_'.$file['release_id'];
                $html .= '<td><a href="'.$url.'">'.$file['release_name'].'</a></td>';
                $url   = '/file/showfiles.php?group_id='.$group_id.'#p_'.$file['package_id'];
                $html .= '<td><a href="'.$url.'">'.$file['package_name'].'</a></td>';
                $html .= '<td>'.html_time_ago($file['delete_date']).'</td>';
                $html .= '<td>'.format_date($GLOBALS['Language']->getText('system', 'datefmt'), $purgeDate).'</td>';
                $html .= '<td align="center"><a href="?group_id='.$group_id.'&func=confirm_restore_frs_file&id='.$file['file_id'].'"><img src="'.util_get_image_theme("trash-x.png").'" onClick="return confirm(\'Confirm restore of this file\')" border="0" height="16" width="16"></a></td></tr>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';
    }
    if ($i == 1) {
        $html .= '<center>No restorable files found</center>';
    }
    $html .= '</div>';

    $idArray[]   = 'frs_file';
    $nomArray[]  = 'File files';
    $htmlArray[] = $html;
}

function frs_file_restore_process($request, $group_id) {
    $fileId = $request->getValidated('id', 'uint', 0);
    if ($fileId > 0) {
        $fileFactory = new FRSFileFactory();
        $file        = $fileFactory->getFRSFileFromDb($fileId);
        $file_name   = $file->getFileName();
        if(!$fileFactory->isFileNameExist($file_name, $group_id)){
            if ($fileFactory->markFileToBeRestored($file)) {
                $GLOBALS['Response']->addFeedback('info', 'File marked to be restored');
            } else {
                $GLOBALS['Response']->addFeedback('error', 'File not restored');
            }
        }else {
            $GLOBALS['Response']->addFeedback('error', 'There is already a file with this filename having an active status');
        }
    } else {
        $GLOBALS['Response']->addFeedback('error', 'Bad file id');
    }
    $GLOBALS['Response']->redirect('?group_id='.$group_id);
}

?>