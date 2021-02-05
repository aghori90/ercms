<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaCardholderTemp $nfsaCardholderTemp
 */
?>
<script type="text/javascript">
	$().ready(function() {

		// validate signup form on keyup and submit
		$("#additional_dtl").validate({
			rules: {

				applicationType: "required",
				applicationType_rule_id: {
					required: "#application_type-2:checked",
					minlength: 1,
				},
				cardtype_id: "required",
				dealer_id: "required",
				disability_status: "required",
				marital_status: "required",
				health_status: "required",
			},
			messages: {
				applicationType: "Please select application type",
				applicationType_rule_id: "Please select at least 1 criteria",
				cardtype_id: "Please select card type",
				dealer_id: "Please select dealer",
				disability_status: "Please select disability status",
				marital_status: "Please select marital status",
				health_status: "Please select health status",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				if (element.is(":radio")) {
					error.appendTo(element.parent().parent());
				} else if (element.is(":checkbox")) {
					error.appendTo(element.parent());
				} else {
					error.insertAfter(element);
				}
			},

		});

	});
</script>
<main id="main">
	<!-- ======= Main Section ======= -->

	<section class="section">
		<div class="container">
			<?php $percentage = round((($nfsaCardholderTemp->application_status) / 6) * 100); ?>
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><span class="text-white" style="font-size:15px"><strong><?= $percentage ?>%</strong></span>
				</div>
			</div>
			<div class="steps clearfix">
				<ul role="tablist">
					<li role="tab" class="first done" aria-disabled="true"><a href="<?= $baseurl ?>NfsaCardholderTemps/personalDetails">
							<div class="title"><span class="number">1</span> <span class="title_text">Personal Details</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>NfsaCardholderTemps/bankDetails"><span class="current-info audible"> </span>
							<div class="title"><span class="number">2</span> <span class="title_text">Bank Details</span> </div>
						</a></li>
					<li role="tab" class="current" aria-disabled="false" aria-selected="false"><a id="signup-form-t-0" href="#" aria-controls="signup-form-p-0">
							<div class="title"><span class="number">3</span> <span class="title_text">Additional Details</span> </div>
						</a></li>
					<li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#" style="cursor: not-allowed;"><span class="current-info audible"> </span>
							<div class="title"><span class="number">4</span> <span class="title_text">Add Family Member</span> </div>
						</a></li>
						<li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#" style="cursor: not-allowed;"><span class="current-info audible"> </span>
							<div class="title"><span class="number">5</span> <span class="title_text">Upload Documents</span> </div>
						</a></li>
					<li role="tab" class="last" aria-disabled="true"><a href="#" style="cursor: not-allowed;">
							<div class="title"><span class="number">6</span> <span class="title_text">Preview</span> </div>
						</a></li>
				</ul>
			</div>
			<br />
			<?= $this->Flash->render() ?>
			<div class="row justify-content-center" data-aos="fade-up">
				<div class="col-lg-12">
					<?php echo $this->Form->create($nfsaCardholderTemp, ['id' => 'additional_dtl']) ?>
					<div class="card">
						<div class="card-body">
							<div class="card-header bg-secondary text-white"> <span class="h4">&#2310;&#2357;&#2375;&#2342;&#2344; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</span> </div>
							<div class="card-body offset-md-2">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2310;&#2357;&#2375;&#2342;&#2344; &#2325;&#2366; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352; : </label>
									<div class="col-sm-6">
										<?php echo  $this->Form->radio("applicationType", [["value" => "1", "text" => " Exclusion", "label" => ["style" => "margin-right:25px;"], "id" => "application_type-1"], ["value" => "2", "text" => " Inclusion", "label" => ["style" => "margin-right:25px;"], "id" => "application_type-2"]]); ?>
										<?php
										if (array_key_exists('applicationType', $nfsaCardholderTemp->getErrors())) {
											foreach ($nfsaCardholderTemp->getErrors()['applicationType'] as $key => $value) {
												echo '<div class="error-message">' . $value . '</div>';
											}
										} ?>
									</div>

								</div>
								<?php if ($nfsaCardholderTemp->applicationType != '' && $nfsaCardholderTemp->applicationType == 1) {
									$disp = '';
								} else {
									$disp = 'none';
								} ?>
								<div class="form-group row" id="exclusion_criteria_div" style="display:<?= $disp ?>">
									<div class="col-sm-6 offset-sm-4">
										<?php $i = 0;
										foreach ($exclusion_criterias as $exclusion) {
											echo $this->Form->checkbox('exclusion_criteria[' . $exclusion->id . '].' . $i, ['value' => $exclusion->id, 'hiddenField' => false, 'disabled' => 'disabled', 'checked' => true]) . ' &nbsp;' . $exclusion->name . '<br /><hr style=" border-top: 2px dashed red;">';
											$i++;
										} ?>
									</div>
								</div>
								<?php if ($nfsaCardholderTemp->applicationType == 2) {
									$disp = '';
								} else {
									$disp = 'none';
								} ?>
								<div class="form-group row" id="inclusion_criteria_div" style="display:<?= $disp ?>">
									<div class="col-sm-6 offset-sm-4">
										<?php $i = 0;
										foreach ($inclusion_criterias as $inclusion) {
											if (($nfsaCardholderTemp->applicationType_rule_id != '') && $nfsaCardholderTemp->applicationType_rule_id == $inclusion->id) {
												$check = 'checked';
											} else {
												$check = '';
											}
											echo $this->Form->checkbox('applicationType_rule_id.'. $inclusion->cardholder_col, ['class' => 'applicationType_rule_id', 'id' => 'applicationType_rule_id', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed red;">';
											$i++;
										}
										if ($nfsaCardholderTemp->getErrors('applicationType_rule_id')) {
											foreach ($nfsaCardholderTemp->getErrors('applicationType_rule_id') as $key => $value) {
												echo '<div class="error-message">' . $value . '</div>';
											}
										} ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2325;&#2366;&#2352;&#2381;&#2337; &#2325;&#2375; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352; : </label>
									<div class="col-sm-6"> <?php echo $this->Form->control("cardtype_id", ["options" => $cardtypes, "label" => false, "class" => "form-control form-control-sm", "empty" => "Select Card Type"]); ?> </div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2337;&#2368;&#2354;&#2352; : </label>
									<div class="col-sm-6"> <?php echo $this->Form->control("dealer_id", ["options" => $dealers, "label" => false, "class" => "form-control form-control-sm", "empty" => "Select Dealer"]); ?> </div>
								</div>
							</div>
							<hr />
							<div class="text-center">
							<?php
								echo  $this->Html->link("Previous", "/NfsaCardholderTemps/bankDetails/", ["class" => "btn btn-warning text-white"]);
								echo '&emsp;' . $this->Form->button(__("Save Draft"), ["class" => "btn btn-success"]);
								if ($nfsaCardholderTemp->application_status >= 4) {
									echo '&emsp;' . $this->Html->link("Next", "/NfsaCardholderTemps/addFamily/", ["class" => "btn btn-info text-white"]);
								}
								echo $this->Form->end();
								?>
							</div>
						</div>
					</div>
	</section>
	<!-- End Contact Section -->
</main>
<!-- End #main -->
<script type="text/javascript">
	$(document).ready(function() {

		$("#application_type-1").click(function() {
			$('#exclusion_criteria_div').show();
			$('#inclusion_criteria_div').hide();
			//$("consumer_no").attr("required",true);
		});

		$("#application_type-2").click(function() {
			$('#exclusion_criteria_div').hide();
			$('#inclusion_criteria_div').show();
			//$("consumer_no").attr("required",true);
		});

		$('.applicationType_rule_id').on('change', function() {
			$('.applicationType_rule_id').not(this).prop('checked', false);
		});

	});
</script>