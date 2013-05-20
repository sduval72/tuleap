<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload73338b8ee5a753d2ab989f112c3db1f1($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'agiledashboard_backlogitem' => '/AgileDashboard/BacklogItem.class.php',
            'agiledashboard_backlogitemdao' => '/AgileDashboard/BacklogItemDao.class.php',
            'agiledashboard_defaultpaneinfo' => '/AgileDashboard/DefaultPaneInfo.class.php',
            'agiledashboard_milestone_pane_contentbacklogstrategy' => '/AgileDashboard/Milestone/Pane/ContentBacklogStrategy.class.php',
            'agiledashboard_milestone_pane_contentdescendantbacklogstrategy' => '/AgileDashboard/Milestone/Pane/ContentDescendantBacklogStrategy.class.php',
            'agiledashboard_milestone_pane_contentpane' => '/AgileDashboard/Milestone/Pane/ContentPane.class.php',
            'agiledashboard_milestone_pane_contentpaneinfo' => '/AgileDashboard/Milestone/Pane/ContentPaneInfo.class.php',
            'agiledashboard_milestone_pane_contentpresenter' => '/AgileDashboard/Milestone/Pane/ContentPresenter.class.php',
            'agiledashboard_milestone_pane_contentpresenterbuilder' => '/AgileDashboard/Milestone/Pane/ContentPresenterBuilder.class.php',
            'agiledashboard_milestone_pane_contentrowpresenter' => '/AgileDashboard/Milestone/Pane/ContentRowPresenter.class.php',
            'agiledashboard_milestone_pane_contentrowpresentercollection' => '/AgileDashboard/Milestone/Pane/ContentRowPresenterCollection.class.php',
            'agiledashboard_milestone_pane_contentselfbacklogstrategy' => '/AgileDashboard/Milestone/Pane/ContentSelfBacklogStrategy.class.php',
            'agiledashboard_milestone_pane_planning_paneinfo' => '/AgileDashboard/Milestone/Pane/Planning/PaneInfo.class.php',
            'agiledashboard_milestone_pane_presenterdata' => '/AgileDashboard/Milestone/Pane/PresenterData.class.php',
            'agiledashboard_milestoneplanningpane' => '/AgileDashboard/MilestonePlanningPane.class.php',
            'agiledashboard_milestoneplanningpaneinfo' => '/AgileDashboard/MilestonePlanningPaneInfo.class.php',
            'agiledashboard_milestoneplanningpresenter' => '/AgileDashboard/MilestonePlanningPresenter.class.php',
            'agiledashboard_milestonepresenter' => '/Planning/MilestonePresenter.class.php',
            'agiledashboard_pane' => '/AgileDashboard/Pane.class.php',
            'agiledashboard_paneinfo' => '/AgileDashboard/PaneInfo.class.php',
            'agiledashboard_xmlcontroller' => '/AgileDashboard/AgileDashboardXMLController.class.php',
            'agiledashboard_xmlexporter' => '/AgileDashboard/XMLExporter.class.php',
            'agiledashboard_xmlexporternodenotvalidexception' => '/AgileDashboard/AgileDashboard_XMLExporterNodeNotValidException.class.php',
            'agiledashboard_xmlexporterunabletogetvalueexception' => '/AgileDashboard/XMLExporterUnableToGetValueException.class.php',
            'agiledashboard_xmlimporter' => '/AgileDashboard/XMLImporter.class.php',
            'agiledashboard_xmlimporterinvalidtrackermappingsexception' => '/AgileDashboard/XMLImporterInvalidTrackerMappingsException.class.php',
            'agiledashboardplugin' => '/agiledashboardPlugin.class.php',
            'agiledashboardplugindescriptor' => '/AgileDashboardPluginDescriptor.class.php',
            'agiledashboardplugininfo' => '/AgileDashboardPluginInfo.class.php',
            'agiledashboardrouter' => '/AgileDashboardRouter.class.php',
            'breadcrumb_agiledashboard' => '/BreadCrumbs/AgileDashboard.class.php',
            'breadcrumb_artifact' => '/BreadCrumbs/Artifact.class.php',
            'breadcrumb_breadcrumbgenerator' => '/BreadCrumbs/BreadCrumbGenerator.class.php',
            'breadcrumb_merger' => '/BreadCrumbs/Merger.class.php',
            'breadcrumb_milestone' => '/BreadCrumbs/Milestone.class.php',
            'breadcrumb_nocrumb' => '/BreadCrumbs/NoCrumb.class.php',
            'breadcrumb_pipe' => '/BreadCrumbs/Pipe.class.php',
            'breadcrumb_planning' => '/BreadCrumbs/Planning.class.php',
            'breadcrumb_planningandartifact' => '/BreadCrumbs/PlanningAndArtifact.class.php',
            'planning' => '/Planning/Planning.class.php',
            'planning_artifactcreationcontroller' => '/Planning/ArtifactCreationController.class.php',
            'planning_artifactlinker' => '/Planning/ArtifactLinker.class.php',
            'planning_artifactmilestone' => '/Planning/ArtifactMilestone.class.php',
            'planning_artifactparentsselector' => '/Planning/ArtifactParentsSelector.class.php',
            'planning_artifactparentsselector_command' => '/Planning/ArtifactParentsSelector/Command.class.php',
            'planning_artifactparentsselector_nearestmilestonewithbacklogtrackercommand' => '/Planning/ArtifactParentsSelector/NearestMilestoneWithBacklogTrackerCommand.class.php',
            'planning_artifactparentsselector_parentinsamehierarchycommand' => '/Planning/ArtifactParentsSelector/ParentInSameHierarchyCommand.class.php',
            'planning_artifactparentsselector_sametrackercommand' => '/Planning/ArtifactParentsSelector/SameTrackerCommand.class.php',
            'planning_artifactparentsselector_subchildrenbelongingtotrackercommand' => '/Planning/ArtifactParentsSelector/SubChildrenBelongingToTrackerCommand.class.php',
            'planning_artifactparentsselectoreventlistener' => '/Planning/ArtifactParentsSelectorEventListener.class.php',
            'planning_backlogactionspresenter' => '/Planning/BacklogActionsPresenter.class.php',
            'planning_backlogitemfiltervisitor' => '/Planning/BacklogItemFilterVisitor.class.php',
            'planning_carddisplaypreferences' => '/Planning/CardDisplayPreferences.class.php',
            'planning_controller' => '/Planning/PlanningController.class.php',
            'planning_formpresenter' => '/Planning/PlanningFormPresenter.class.php',
            'planning_groupbyparentsvisitor' => '/Planning/GroupByParentsVisitor.class.php',
            'planning_indexpresenter' => '/Planning/PlanningIndexPresenter.class.php',
            'planning_item' => '/Planning/Item.class.php',
            'planning_itemcardpresentercallback' => '/Planning/ItemCardPresenterCallback.class.php',
            'planning_itemfieldpresenter' => '/Planning/ItemFieldPresenter.class.php',
            'planning_itempresenter' => '/Planning/ItemPresenter.class.php',
            'planning_listpresenter' => '/Planning/PlanningListPresenter.class.php',
            'planning_milestone' => '/Planning/Milestone.class.php',
            'planning_milestonecontroller' => '/Planning/MilestoneController.class.php',
            'planning_milestonecontrollerfactory' => '/Planning/MilestoneControllerFactory.class.php',
            'planning_milestonefactory' => '/Planning/MilestoneFactory.class.php',
            'planning_milestonelegacyplanningpanefactory' => '/Planning/MilestoneLegacyPlanningPaneFactory.class.php',
            'planning_milestonelinkpresenter' => '/Planning/MilestoneLinkPresenter.class.php',
            'planning_milestonepanefactory' => '/Planning/MilestonePaneFactory.class.php',
            'planning_milestoneplan' => '/Planning/MilestonePlan.class.php',
            'planning_milestoneredirectparameter' => '/Planning/MilestoneRedirectParameter.class.php',
            'planning_milestoneselectorcontroller' => '/Planning/MilestoneSelectorController.class.php',
            'planning_nomilestone' => '/Planning/NoMilestone.class.php',
            'planning_notfoundexception' => '/Planning/NotFoundException.class.php',
            'planning_requestvalidator' => '/Planning/PlanningRequestValidator.class.php',
            'planning_searchcontentview' => '/Planning/SearchContentView.class.php',
            'planning_shortaccess' => '/Planning/ShortAccess.class.php',
            'planning_shortaccessmilestonepresenter' => '/Planning/ShortAccessMilestonePresenter.class.php',
            'planning_trackerpresenter' => '/Planning/TrackerPresenter.class.php',
            'planning_viewbuilder' => '/Planning/ViewBuilder.class.php',
            'planningdao' => '/Planning/PlanningDao.class.php',
            'planningfactory' => '/Planning/PlanningFactory.class.php',
            'planningparameters' => '/Planning/PlanningParameters.class.php',
            'planningpresenter' => '/Planning/PlanningPresenter.class.php',
            'systray_agiledashboardlink' => '/Systray/AgileDashboardLink.class.php',
            'xmlimporterinputnotwellformedexception' => '/AgileDashboard/XMLImporterInputNotWellFormedException.class.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload73338b8ee5a753d2ab989f112c3db1f1');
// @codeCoverageIgnoreEnd