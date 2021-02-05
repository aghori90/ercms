<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaCardholderTemp $nfsaCardholderTemp
 */
echo $this->Html->script("ration.js");
?>

<script type="text/javascript">
	$(document).ready(function() {

		$("#document_dtl1").validate({
			rules: {
				aadhar_doc: "required",
			},
			messages: {
				aadhar_doc: "Please upload your Aadhar Card",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});


		$("#document_dtl2").validate({
			rules: {
				caste_certificate: "required",
			},
			messages: {
				caste_certificate: "Please upload your Address Proof.",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});


		$("#document_dtl3").validate({
			rules: {
				bank_passbook: "required",
			},
			messages: {
				bank_passbook: "Please upload your Bank Passbook.",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});

		$("#document_dtl4").validate({
			rules: {
				disability_certificate: "required",
			},
			messages: {
				disability_certificate: "Please upload your Disability Cerificate.",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});

		$("#document_dtl5").validate({
			rules: {
				health_certificate: "required",
			},
			messages: {
				health_certificate: "Please upload your Health Cerificate.",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});

		$("#document_dtl6").validate({
			rules: {
				death_certificate: "required",
			},
			messages: {
				death_certificate: "Please upload your Health Cerificate.",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});


		$('#upload_aadhar').click(function() {
			$("#document_dtl1").valid();

		});
		$('#upload_caste').click(function() {
			$("#document_dtl2").valid();

		});
		$('#upload_passbook1').click(function() {
			$("#document_dtl3").valid();

		});
		$('#upload_disability').click(function() {
			$("#document_dtl4").valid();

		});
		$('#upload_health').click(function() {
			$("#document_dtl5").valid();

		});
		$('#upload_death').click(function() {
			$("#document_dtl6").valid();

		});


	});
</script>
<main id="main">

	<!-- ======= Main Section ======= -->
	<section class="section">
		<div class="container">
			<?php $percentage = round((($nfsaCardholderTemp->application_status) / 7) * 100); ?>
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><span class="text-white" style="font-size:15px"><strong><?= $percentage ?>%</strong></span>
				</div>
			</div>
			<div class="steps clearfix">
				<ul role="tablist">
					<li role="tab" class="first done" aria-disabled="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/personalDetails">
							<div class="title"><span class="number">1</span> <span class="title_text">Personal Details</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/bankDetails"><span class="current-info audible"> </span>
							<div class="title"><span class="number">2</span> <span class="title_text">Bank Details</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="false"><a href="<?= $baseurl ?>SeccCardholderAddTemps/additionalDetails">
							<div class="title"><span class="number">3</span> <span class="title_text">Additional Details</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/addFamily">
							<span class="current-info audible"> </span>
							<div class="title"><span class="number">4</span> <span class="title_text">Add Family Member</span> </div>
						</a></li>
					<li role="tab" class="current" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/documentDetails"><span class="current-info audible"> </span>
							<div class="title"><span class="number">5</span> <span class="title_text">Upload Documents</span> </div>
						</a></li>
					<li role="tab" class="disabled last" aria-disabled="true"><a href="#" style="cursor: not-allowed;">
							<div class="title"><span class="number">6</span> <span class="title_text">Preview</span> </div>
						</a></li>
				</ul>
			</div>
			<br />
			<?= $this->Flash->render() ?>
			<div class="row justify-content-center" data-aos="fade-up">
				<div class="col-lg-12">

					<div class="card">
						<div class="card-body">
							<div class="card-header bg-secondary text-white"> <span class="h4">Document Details</span> </div>
							<div class="card-body offset-md-1">

								<div class="form-group row">
									<span style="font-style:italic; font-weight:bold; color: #D40830" class="col-sm-11 pull-left alert alert-warning">&emsp;Note* : 1. Document should be in '.jpg'/'.png' format only.<br /> &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;2. Document size should not exceed 500 KB. </span></div>

								<?php //echo $this->Form->create($nfsaFamilyDocument, ['id' => 'document_dtl1', 'enctype' => 'multipart/form-data']) ?>
								<!-- <div class="form-group row">
									<label class="col-sm-3 col-form-label required font-weight-bold" for="name">Adhaar Card : </label>

									<div class="col-sm-4">
										<?php echo $this->Form->control('aadhar_doc', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"aadhar_errorspan")']); ?><span id="aadhar_errorspan" style="font-weight:bold; color: red;"></span>
									</div>
									<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning bg-maroon", "type" => "submit", "id" => "upload_aadhar", "value" => "upload_aadhar", "name" => "upload"]); ?></div>

									<?php if (array_key_exists("18", $NfsaFamilyDocuments)) { 
										$document_path = DOC_ABS_PATH . $nfsaCardholderTemp->rgi_district_code . DS . $nfsaCardholderTemp->ack_no. DS . h($NfsaFamilyDocuments['18']);
										if (!file_exists($document_path)) {
											$document_path = "img/fnf.jpg";	
										}?>
										<div class="col-sm-2">
											<a href="" id="view_aadhar" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
										</div>
									<?php } ?>
								</div> -->
								<?php //echo $this->Form->end() ?>

								<?php if ($nfsaCardholderTemp->is_bank == '1') { ?>

									<?php echo $this->Form->create($nfsaFamilyDocument, ['id' => 'document_dtl3', 'enctype' => 'multipart/form-data']) ?>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bold " for="name">Bank Passbook : </label>
										<div class="col-sm-4">
											<?php echo $this->Form->control('bank_passbook', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"passbook_errorspan")']); ?><span id="passbook_errorspan" style="font-weight:bold; color: red;"></span>
										</div>
										<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_passbook", "value" => "upload_passbook", "name" => "upload"]); ?></div>
										<?php if (array_key_exists("13", $NfsaFamilyDocuments)) { 
											$document_path = DOC_ABS_PATH . $nfsaCardholderTemp->rgi_district_code . DS . $nfsaCardholderTemp->ack_no. DS . h($NfsaFamilyDocuments['13']);
											if (!file_exists($document_path)) {
												$document_path = "img/fnf.jpg";	
											}?>
											<div class="col-sm-2">
												<a href="" id="view_passbook" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
											</div>
										<?php } ?>
									</div>
									<?= $this->Form->end() ?>
								<?php } ?>
								<?php if ($nfsaCardholderTemp->caste_id == 3 || $nfsaCardholderTemp->caste_id == 4 || $nfsaCardholderTemp->caste_id == 7) {
									echo $this->Form->create($nfsaFamilyDocument, ['id' => 'document_dtl2', 'enctype' => 'multipart/form-data']); ?>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bold " for="name">Caste Certificate : </label>
										<div class="col-sm-4">
											<?php echo $this->Form->control('caste_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"caste_errorspan")']); ?><span id="caste_errorspan" style="font-weight:bold; color: red;"></span>
										</div>
										<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_caste", "value" => "upload_caste", "name" => "upload"]); ?></div>
										<?php if (array_key_exists("14", $NfsaFamilyDocuments)) { 
											$document_path = DOC_ABS_PATH . $nfsaCardholderTemp->rgi_district_code . DS . $nfsaCardholderTemp->ack_no. DS . h($NfsaFamilyDocuments['14']);
											if (!file_exists($document_path)) {
												$document_path = "img/fnf.jpg";	
											}?>
											<div class="col-sm-2">
												<a href="" id="view_caste" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
											</div>
										<?php } ?>
									</div>
								<?php echo  $this->Form->end();
								} ?>

								<?php if ($nfsaCardholderTemp->disability_status == 1) {
									echo $this->Form->create($nfsaFamilyDocument, ['id' => 'document_dtl4', 'enctype' => 'multipart/form-data']); ?>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bold " for="name">Disability Certificate : </label>
										<div class="col-sm-4">
											<?php echo $this->Form->control('disability_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"disability_errorspan")']); ?><span id="disability_errorspan" style="font-weight:bold; color: red;"></span>
										</div>
										<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_caste", "value" => "upload_disability", "name" => "upload"]); ?></div>
										<?php if (array_key_exists("16", $NfsaFamilyDocuments)) { 
											$document_path = DOC_ABS_PATH . $nfsaCardholderTemp->rgi_district_code . DS . $nfsaCardholderTemp->ack_no. DS . h($NfsaFamilyDocuments['16']);
											if (!file_exists($document_path)) {
												$document_path = "img/fnf.jpg";	
											}?>
											<div class="col-sm-2">
												<a href="" id="view_disability" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
											</div>
										<?php } ?>
									</div>
								<?php echo  $this->Form->end();
								} ?>

								<?php if ($nfsaCardholderTemp->health_status == 1) {
									echo $this->Form->create($nfsaFamilyDocument, ['id' => 'document_dtl5', 'enctype' => 'multipart/form-data']); ?>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bold " for="name">Health Certificate : </label>
										<div class="col-sm-4">
											<?php echo $this->Form->control('health_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"health_errorspan")']); ?><span id="health_errorspan" style="font-weight:bold; color: red;"></span>
										</div>
										<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_caste", "value" => "upload_health", "name" => "upload"]); ?></div>
										<?php if (array_key_exists("15", $NfsaFamilyDocuments)) { 
											$document_path = DOC_ABS_PATH . $nfsaCardholderTemp->rgi_district_code . DS . $nfsaCardholderTemp->ack_no. DS . h($NfsaFamilyDocuments['15']);
											if (!file_exists($document_path)) {
												$document_path = "img/fnf.jpg";	
											}?>
											<div class="col-sm-2">
												<a href="" id="view_health" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
											</div>
										<?php } ?>
									</div>
								<?php echo  $this->Form->end();
								} ?>
							<?php if ($nfsaCardholderTemp->marital_status == 1) {
									echo $this->Form->create($nfsaFamilyDocument, ['id' => 'document_dtl6', 'enctype' => 'multipart/form-data']); ?>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label font-weight-bold " for="name">Death Certificate : </label>
										<div class="col-sm-4">
											<?php echo $this->Form->control('death_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"death_errorspan")']); ?><span id="death_errorspan" style="font-weight:bold; color: red;"></span>
										</div>
										<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit",  "value" => "upload_death", "name" => "upload"]); ?></div>
										<?php if (array_key_exists("17", $NfsaFamilyDocuments)) {
											$document_path = DOC_ABS_PATH . $nfsaCardholderTemp->rgi_district_code . DS . $nfsaCardholderTemp->ack_no. DS . h($NfsaFamilyDocuments['17']);
											if (!file_exists($document_path)) {
												$document_path = "img/fnf.jpg";	
											} ?>
											<div class="col-sm-2">
												<a href="" id="view_death" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
											</div>
										<?php } ?>
									</div>
								<?php echo  $this->Form->end();
								} ?>

							</div>
							<hr />

							<div class="text-center">
								<?php echo $this->Form->create($nfsaFamilyDocument, ['enctype' => 'multipart/form-data']) ?>
								<?php
								echo  $this->Html->link("Previous", "/NfsaCardholderTemps/bankDetails/", ["class" => "btn btn-warning text-white"]);
								echo '&emsp;' . $this->Form->button(__("Save Draft"), ["class" => "btn btn-success", "name" => "submit", "value" => "Save & Next", "onClick" => "return checkdoc()"]);
								if ($nfsaCardholderTemp->application_status >= 6) {
									echo '&emsp;' . $this->Html->link("Next", "/NfsaCardholderTemps/preview/", ["class" => "btn btn-info text-white"]);
								} ?>

								<?= $this->Form->end() ?>
							</div>

						</div>

					</div>
				</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->
<script type="text/javascript">
	function validateFile(component, errorspan) {
		validateFileExtension(component, errorspan, "Please provide document in  .jpg/.png format only!!!.", new Array("jpg", "jpeg", "png"));
		validateFileSize(component, errorspan, "File size should not be greater than 500 KB!!!.", "500000"); //2097152 Byte = 2MB; 500000 Byte = 500 Kb
	}
	
</script>