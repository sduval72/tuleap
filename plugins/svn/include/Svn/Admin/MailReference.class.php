<?php
/**
 * Copyright (c) Enalean, 2016. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */
namespace Tuleap\Svn\Admin;

use Reference;
use SvnPlugin;
use ReferenceManager;
use Tuleap\Svn\Repository\Repository;

class MailReference extends Reference {

    public function __construct($keyword, $revision_id, Repository $repository) {
        $base_id    = 5;
        $visibility = 'P';
        $is_used    = 1;

        parent::__construct(
            $base_id,
            $keyword,
            $GLOBALS['Language']->getText('project_reference','reference_svn_desc_key'),
            "/plugins/svn/?action=detail-revision&rev_id=". $revision_id ."&group_id=". $repository->getProject()->getId()."&repo_id=".$repository->getId(),
            $visibility,
            SvnPlugin::SERVICE_SHORTNAME,
            ReferenceManager::REFERENCE_NATURE_SVNREVISION,
            $is_used,
            $repository->getProject()->getId()
        );
    }

}