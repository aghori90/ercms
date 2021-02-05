~<?php
$loggeduser = $this->request->getSession()->check('Auth.User');
$loggedFlag = false;
if (!empty($loggeduser))
    $loggedFlag = true;
if ($loggeduser) {
    if ($this->request->getSession()->check('Auth.User.id')) {
        $group_id = $this->request->getSession()->read('Auth.User.group_id');
    }
}
?>
<!--------------------------side bar-- start --------------------------------->
<div class="app-main">
    <div class="app-sidebar">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Menu</li>
                    <?php if ($group_id == 7) { ?>
                       <!-- <li>
                            <a href="<?= $baseurl ?>SeccCardholderAddTemps/checkAcknowledgement">
                                Pending Application Mapping
                            </a>
                        </li> -->
                    <?php }
			else if($group_id == 13)
			 {?>

                <li>
                    <a href="<?= $baseurl ?>JsfssDistrictReports/districtWiseReport">
                        Green Card Count Report
                    </a>
                </li>

			 <?php }
			  else if($group_id == 12) { ?>
                        <li>
                            <a href="<?= $baseurl ?>JsfssDistrictReports/districtWiseReport">
                                Green Card Count Report
                            </a>
                        </li>
			   <li>
                            <a href="<?= $baseurl ?>secc-cardholders/dsoSearchApplication">
                                Pending Application(GreenCard)
                            </a>
                        </li>
                        <li>
                            <a href="<?= $baseurl ?>secc-cardholders/searchRationcard">
                                Print rationcard(GreenCard)
                            </a>
                        </li>
                        <li>
                            <a href="<?= $baseurl ?>secc-cardholders/viewRationcardDetail">
                                Search/view rationcard(GreenCard)
                            </a>
                        </li>
                    <?php } else if($group_id == 20) { ?>
                         <li>
                            <a href="<?= $baseurl ?>SeccCardholderAddTemps/checkAcknowledgement">
                                Pending Application Mapping
                            </a>
                        </li>
                        <li>
                            <a href="<?= $baseurl ?>secc-cardholders/ercmsRequest">
                                Pending Application(GreenCard)
                            </a>
                        </li>
                          <li>
                              <a href="<?= $baseurl ?>secc-cardholders/nfsaRationcardApprovalBso">
                                  Bso Approval
                              </a>
                          </li>
                    <?php } else { ?>
                        <!-- <li>
                            <a href="<?= $baseurl ?>SeccCardholders/ercmsRequest">
                                <i class="metismenu-icon pe-7s-browser"></i>ERCMS
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                        </li> -->
                    <?php } ?>
                    <!-- <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-rocket"></i>Dashboards
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="index-2.html">
                                    <i class="metismenu-icon"></i>1
                                </a>
                            </li>
                            <li>
                                <a href="dashboards-commerce.html">
                                    <i class="metismenu-icon"></i>2
                                </a>
                            </li>
                            <li>
                                <a href="dashboards-sales.html">
                                    <i class="metismenu-icon">
                                    </i>3
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon"></i> 4
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="dashboards-minimal-1.html">
                                            <i class="metismenu-icon"></i>1
                                        </a>
                                    </li>
                                    <li>
                                        <a href="dashboards-minimal-2.html">
                                            <i class="metismenu-icon"></i>2
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="dashboards-crm.html">
                                    <i class="metismenu-icon"></i> 5
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-browser"></i>Pages
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>

                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-plugin"></i>Applications
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>

                    </li>  -->


                </ul>
            </div>
        </div>
    </div>
    <!--------------------------side bar end --------------------------------->
