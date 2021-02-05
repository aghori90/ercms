<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="utf-8">
	<meta http-equiv="" content="IE=edge">
	<meta http-equiv="Content-Language" content="en">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>E-PDS.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
	<meta name="description" content="xyz">

	<!-- Disable tap highlight on IE -->
	<meta name="PDS" content="no">
	<?= $this->Html->meta('icon') ?>


	<?php echo $this->Html->css("main.css") ?>
	<?php echo $this->Html->css("ration.css") ?>
	<?php echo $this->Html->css("font-awesome.min.css") ?>
	<?php echo $this->Html->script("jquery.min.js") ?>
	<?php echo $this->Html->script("jquery.validate.min.js") ?>
	<style>
		.app-wrapper-footer .app-footer .app-footer__inner {
			border-left: #e9ecef solid 1px;
			background-color: #49959b45;

		}

		.app-theme-white .app-header {
			/*background:#cab7b7;*/
			background-image: url(<?= $baseurl ?>img/images/bg-noise.png);
			height: 60px;
			/*background: linear-gradient(360deg, rgba(2,149,109,0.9360119047619048) 0%, rgba(21,199,179,1) 72%);*/
		}

		.app-main__inner {
			background: #a1a1a014;
			/*#88ff8d54*/
			;
			/*background: linear-gradient(360deg, rgba(2,149,109,0.9360119047619048) 0%, rgba(21,199,179,1) 72%);*/
		}

		.app-theme-white .app-page-title {
			/*background: rgb(194 241 196 / 25%);*/
			background: #fdf6f6;
			/*#88ff8d54*/
			;
			border-bottom: 1px solid #b5d2b0;
		}

		.app-theme-white .app-sidebar {
			/* background:#f3eaea;*/
			background-image: url(<?= $baseurl ?>img/images/bg-noise2.png);
			border-right: 2px solid #8491b142;
		}

		.header-dots .icon-wrapper-alt {
			background-color: #f7f2eb;
		}

		.card {
			/* box-shadow: 0 0.46875rem 2.1875rem rgba(4,9,20,0.03), 0 0.9375rem 1.40625rem rgba(4,9,20,0.03), 0 0.25rem 0.53125rem rgba(4,9,20,0.05), 0 0.125rem 0.1875rem rgba(4,9,20,0.03); */
			border-width: 0;
			transition: all .2s;
			box-shadow: 1px 2px 9px #74ad7a;
		}

		.search-wrapper .input-holder .search-icon {

			background: rgb(229 228 233);
		}

		.ml-3,
		.mx-3 {
			color: #fdfdfb;
		}
	</style>

</head>
<?php
$loggeduser = $this->request->getSession()->check('Auth.User');
$loggedFlag = false;
if (!empty($loggeduser))
	$loggedFlag = true;
?>

<body>

	<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
		<div class="app-header">
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
			<div class="app-header__content">
				<div class="app-header-left">
					<div class="search-wrapper">
						<div class="input-holder">
							<input type="text" class="search-input" placeholder="Type to search">
							<button class="search-icon"><span></span></button>
						</div>
						<button class="close"></button>
					</div>
				</div>
				<div class="app-header-right">
					<div class="header-dots">
						<!-- <div class="dropdown">
							<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
								<span class="icon-wrapper icon-wrapper-alt rounded-circle">
									<span class="icon-wrapper-bg bg-primary"></span>
									<i class="icon text-primary ion-android-apps"></i>
								</span>
							</button>
							<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
								<div class="dropdown-menu-header">
									<div class="dropdown-menu-header-inner bg-plum-plate">
										<div class="menu-header-image" style="background-image: url('<?= $baseurl ?>img/images/dropdown-header/abstract4.jpg');"></div>
										<div class="menu-header-content text-white">
											<h5 class="menu-header-title">All Reports</h5>
											<h6 class="menu-header-subtitle">Select to present.</h6>
										</div>
									</div>
								</div>
								<div class="grid-menu grid-menu-xl grid-menu-3col">
									<div class="no-gutters row">
										<div class="col-sm-6 col-xl-4">
											<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
												<i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i> Reports
											</button>
										</div>
										<div class="col-sm-6 col-xl-4">
											<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
												<i class="pe-7s-piggy icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i> Reports 1
											</button>
										</div>
										<div class="col-sm-6 col-xl-4">
											<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
												<i class="pe-7s-config icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i> Reports 2
											</button>
										</div>
										<div class="col-sm-6 col-xl-4">
											<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
												<i class="pe-7s-browser icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i> Reports 3
											</button>
										</div>
										<div class="col-sm-6 col-xl-4">
											<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
												<i class="pe-7s-hourglass icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i> Reports 4
											</button>
										</div>
										<div class="col-sm-6 col-xl-4">
											<button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
												<i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i> Reports 5
											</button>
										</div>
									</div>
								</div>
								<!-- <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shadow btn btn-primary btn-sm">Follow-ups</button>
                                    </li>
                                </ul>
							</div>
						</div> -->


						<!-- <div class="dropdown">
							<button type="button" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false" class="p-0 btn btn-link dd-chart-btn">
								<span class="icon-wrapper icon-wrapper-alt rounded-circle">
									<span class="icon-wrapper-bg bg-success"></span>
									<i class="icon text-success ion-ios-analytics"></i>
								</span>
							</button>
							<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
								<div class="dropdown-menu-header">
									<div class="dropdown-menu-header-inner bg-premium-dark">
										<div class="menu-header-image" style="background-image: url('assets/images/dropdown-header/abstract4.jpg');"></div>
										<div class="menu-header-content text-white">
											<h5 class="menu-header-title">Total Online</h5>
											<h6 class="menu-header-subtitle">Current Active DSO / BSO </h6>
										</div>
									</div>
								</div>
								<div class="widget-chart">
									<div class="widget-chart-content">
										<div class="icon-wrapper rounded-circle">
											<div class="icon-wrapper-bg opacity-9 bg-focus"></div>
											<i class="lnr-users text-white"></i>
										</div>
										<div class="widget-numbers">
											<span>24</span>
										</div>
										<div class="widget-subheading pt-2">
											Profile views since last login
										</div>
										<div class="widget-description text-danger">
											<span class="pr-1"><span>96%</span></span>
											<i class="fa fa-arrow-left"></i>
										</div>
									</div>

								</div>
								<ul class="nav flex-column">
									<li class="nav-item-divider mt-0 nav-item"></li>
									<li class="nav-item-btn text-center nav-item">
										<button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
											<i class="fa fa-cog fa-spin mr-2"></i>View Details
										</button>
									</li>
								</ul>
							</div>
						</div> -->
					</div>

					<div class="header-btn-lg pr-0">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="btn-group">
										<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
											<img width="42" class="rounded-circle" src="<?= $baseurl ?>img/images/avatars/download.jpg" alt="">
											<i class="fa fa-angle-down fa-2x ml-2 opacity-8 text-white"></i>
										</a>
										<div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
											<div class="dropdown-menu-header">
												<div class="dropdown-menu-header-inner bg-info">
													<div class="menu-header-image opacity-2"></div>
													<div class="menu-header-content text-left">
														<div class="widget-content p-0">
															<div class="widget-content-wrapper">
																<div class="widget-content-left mr-3">
																	<img width="42" class="rounded-circle" src="<?= $baseurl ?>img/images/avatars/download.jpg" alt="">
																</div>
																<div class="widget-content-left">
																	<div class="widget-heading"><?php if ($loggeduser) {
																									echo  $this->request->getSession()->read('Auth.User.username');
																								} ?></div>
																	<div class="widget-subheading opacity-8"><?php if ($loggeduser) {
																													echo  $this->request->getSession()->read('Auth.User.desig');
																												} ?></div>
																</div>
																<div class="widget-content-right mr-2">
																	<a href="<?= $this->request->getAttribute("webroot") ?>SeccCardholders/logout"><button class="btn bg-danger text-white"><i class="icofont-sign-out"></i>&ensp;Logout </button></a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="scroll-area-xs" style="height: 150px;">
												<div class="scrollbar-container ps">
													<ul class="nav flex-column">
														<li class="nav-item-header nav-item">Activity</li>
														<!-- <li class="nav-item"><a href="#" class="nav-link">Change Password</a></li> -->
													</ul>
												</div>
											</div>


										</div>
									</div>
								</div>
								<div class="widget-content-left  ml-3 header-user-info">
									<div class="widget-heading"> <?php if ($loggeduser) {
																		echo  $this->request->getSession()->read('Auth.User.username');
																	} ?>
									</div>
									<div class="widget-subheading"> <?php if ($loggeduser) {
																		echo  $this->request->getSession()->read('Auth.User.desig');
																	} ?></div>
								</div>

							</div>
						</div>
					</div>
					<!-- <div class="header-btn-lg">
                        <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>  -->
				</div>
			</div>
		</div>
