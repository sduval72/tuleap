<?php
//
// Codendi
// Copyright (c) Xerox Corporation, Codendi Team, 2001-2009. All rights reserved
// http://www.codendi.com
//
// 
//
//	Originally written by Laurent Julliard 2001, 2002, Codendi Team, Xerox
//


/*
  Function that generates hide/show urls to expand/collapse
  sections of the personal page

Input:
  $svc : service name to hide/show (sr, bug, pm...)
  $db_item_id : the item (group, forum, task sub-project,...) from the
     database that we are curently processing and about to display
  $item_id : the item_id as given in the URL and on which the show/hide switch
     is going to apply.
  $hide = hide param as given in the script URL (-1 means no param was given)

Output:
  $hide_url: URL to use in the page to switch from hide to show or vice versa
  $count_diff: difference between the number of items in the list between now and
     the previous last time the section was open (can be negative if items were removed)
  $hide_flag: true if the section must be hidden, false otherwise

*/
function my_hide_url ($svc, $db_item_id, $item_id, $count, $hide) {

    global $Language;

    $pref_name = 'my_hide_'.$svc.$db_item_id;
    $old_hide = $old_count = $old_pref_value = user_get_preference($pref_name);
    if ($old_pref_value) {
        list($old_hide,$old_count) = explode('|', $old_pref_value);
    }
  
    // Make sure they are both 0 if never set before
    if ($old_count == false) { $old_count = 0; }
    if ($old_hide == false) { $old_hide = 0; }

    if ($item_id == $db_item_id) {
		if (isset($hide)) {
		    $pref_value = "$hide|$count";
		} else {
		    $pref_value = "$old_hide|$count";
		    $hide = $old_hide;
		}
    } else {
		if ($old_hide) {
		    // if items are hidden keep the old count and keep pref as is
		    $pref_value = $old_pref_value;
		} else {
		    // only update the item count if the items are visible
		    // if they are hidden keep reporting the old count
		    $pref_value = "$old_hide|$count";
		}
		$hide = $old_hide;
    }

    // Update pref value if needed
    if ($old_pref_value != $pref_value) {
        user_set_preference($pref_name, $pref_value);
    }

    if ($hide) {
		$hide_url= '<a href="?hide_'.$svc.'=0&hide_item_id='.$db_item_id.'"><img src="'.util_get_image_theme("pointer_right.png").'" align="middle" border="0" title="'.$Language->getText('my_utils', 'expand').'" alt="'.$Language->getText('my_utils', 'expand').'"></a>&nbsp;';
		$hide_now = true;
    } else {		
		$hide_url= '<a href="?hide_'.$svc.'=1&hide_item_id='.$db_item_id.'"><img src="'.util_get_image_theme("pointer_down.png").'" align="middle" border="0" title="'.$Language->getText('my_utils', 'collapse').'" alt="'.$Language->getText('my_utils', 'collapse').'"></a>&nbsp;';
		$hide_now = false;
    }

    return array($hide_now, $count-$old_count, $hide_url);
}

function my_hide($svc, $db_item_id, $item_id, $hide) {
    $pref_name = 'my_hide_'.$svc.$db_item_id;
    $old_pref_value = user_get_preference($pref_name);
    list($old_hide,$old_count) = explode('|', $old_pref_value);

    // Make sure they are both 0 if never set before
    if ($old_hide == false) { $old_hide = 0; }
  
    if ($item_id == $db_item_id) {
		if (!isset($hide)) {
		    $hide = $old_hide;
		}
    } else {
		$hide = $old_hide;
    }
    return $hide;
}

/* second case */
function my_format_as_flag2($assignee, $submitter) {
    $AS_flag = '';
    if ($assignee) $AS_flag = 'A';
    
    if ($submitter) $AS_flag .= 'S';

    if ($AS_flag != '') $AS_flag = '[<b>'.$AS_flag.'</b>]';

    return $AS_flag;
}

function my_item_count($total, $new) {
    global $Language;
    return '['.$total.($new ? ", <b>".$Language->getText('my_utils', 'new_items', array($new))."</b>]" : ']');
}


function my_header($params) {
    $request =& HTTPRequest::instance();
    $pv = '';
    if ($request->get('pv') == 2) {
        $pv = '?pv=2';
        $GLOBALS['Response']->pv_header($params);
    } else {
        site_header($params);
    }
    $hp = Codendi_HTMLPurifier::instance();
    echo '<h2>'. $GLOBALS['Language']->getText('my_index', 'title', array( $hp->purify(user_getrealname(user_getid()), CODENDI_PURIFIER_CONVERT_HTML) .' ('.user_getname().')'));
    echo ' ' . help_button('citizen.html#login-and-personal-page');
    echo '</h2>';
}

function my_check_bookmark_URL($bookmark_url, $redirect_url) {
    if (my_has_URL_invalid_content($bookmark_url)) {
        $GLOBALS['Response']->addFeedback(Feedback::ERROR, $GLOBALS['Language']->getText('bookmark_add', 'invalid_uri'));
        $GLOBALS['Response']->redirect($redirect_url);
    }
}

function my_has_URL_invalid_content($bookmark_url) {
    return URL::getScheme($bookmark_url) === 'javascript';
}
