<!DOCTYPE html>
<html lang="en">

<head>
	<?= $this->Html->charset() ?>

	<title>Ration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta content="" name="descriptison">
	<meta content="" name="keywords">
	<meta name="author" content="" />


	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<?php echo $this->Html->css("bootstrap.min.css") ?>
	<?php echo $this->Html->css("icofont.min.css") ?>
	<?php echo $this->Html->css("all.min.css") ?>

	<!-- Template Main CSS File -->
	<?php echo $this->Html->css("ration.css") ?>

	<!-- ============== Jquery JS File ===================== -->
	<?php echo $this->Html->script("jquery.min.js") ?>
	<?php echo $this->Html->script("jquery.validate.min.js") ?>


	<?php
	//$loggeduser = $this->request->getSession()->read('Auth.User');
	$loggeduser = $this->request->getSession()->check('Auth.User');
	$loggedFlag = false;
	if (!empty($loggeduser))
		$loggedFlag = true;
	?> </head>

<body>
<div id="preloader"></div>
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top">
		<div class="container hdsection align-items-center">
			<a href="<?= $this->request->getAttribute("webroot") ?>SeccCardholders/index"> <?php echo $this->Html->image('logobk.png', ['alt' => 'PDS', 'class'=>'lm', 'border' => '0']); ?></a>
			<span class="hdep">
			<h1><font color="red"> Ration Card </font> Management System</h1>
			<p> Department of Food, Public Distribution & Consumer Affairs, Jharkhand </p>
			</span>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
			<?php if ($loggeduser) {
				if ($this->request->getSession()->check('Auth.User.ack_no')) { ?>
					<span class="text-green"><h5><b>Acknowledgement No : <?= $this->request->getSession()->read('Auth.User.ack_no') ?></b></h5></span>
				<?php } else if ($this->request->getSession()->check('Auth.User.rationcard_no')) { ?>
					<span class="text-green"><h5><b>Ration Card No : <?= $this->request->getSession()->read('Auth.User.rationcard_no') ?></b></h5></span>
				<?php } ?>
				<div class="header-social-links">
					<!-- <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>-->
					<a href="<?= $this->request->getAttribute("webroot") ?>SeccCardholders/logout"><button class="btn bg-green text-white"><i class="icofont-sign-out"></i>&ensp;Logout </button></a>
					<!--  <a href="<?= $this->request->getAttribute("webroot") ?>Pages/display"><button class="btn bg-green text-white"><i class="icofont-sign-out"></i>&ensp;Logout </button></a> -->
				</div>
			<?php } ?>
		</div>
	</header><!-- End Header -->