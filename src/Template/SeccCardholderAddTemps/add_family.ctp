<?php

use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholderAddTemp $seccCardholderAddTemp
 */
echo $this->Html->script("ration.js");
echo $this->Html->css("jquery-ui.css");
echo $this->Html->script('keyboard');
echo $this->Html->css("keyboard.css");
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#add_family_members").validate({
			rules: {
				name: {
					required: true,
					minlength: 3
				},
				name_sl: {
					required: true,
					minlength: 3
				},
				fathername: {
					required: true,
					minlength: 3
				},
				fathername_sl: {
					required: true,
					minlength: 3
				},
				mobile: {
					//required: true,
					minlength: {
						depends: function(element) {
							return ($("#mobile").val().length > 0);
						},
						param: 10
					},
					maxlength: {
						depends: function(element) {
							return ($("#mobile").val().length > 0);
						},
						param: 10
					},
				},
				dob: "required",
				uid: {
					required: true,
					minlength: 12,
					maxlength: 12
				},
				gender_id: "required",
				relation_id: "required",
				chkAgree: "required",
				disability_status: "required",
				marital_status: "required",
				health_status: "required",
				aadhar_doc: {
					required: {
						depends: function(element) {
							return ($("#old_aadhar_doc").val().length === 0);
						}
					}
				},

			},
			messages: {
				name: {
					required: "Please enter your Name.",
					minlength: "Name need to be at least 3 characters long"
				},
				name_sl: {
					required: "Please enter your Name.",
					minlength: "Name  in hindi need to be at least 3 characters long"
				},
				fathername: {
					required: "Please enter your Father's Name.",
					minlength: "Father's Name need to be at least 3 characters long"
				},
				fathername_sl: {
					required: "Please enter your Father's Name.",
					minlength: "Father's Name in hindi need to be at least 3 characters long"
				},
				mobile: {
					//required: "Please enter Mobile No",
					minlength: "Minimum length of mobile no should be 10 digits",
					maxlength: "Maximum length of mobile no should be 10 digits"
				},
				dob: "Please enter Date of Birth.",
				uid: {
					required: "Please enter UID No",
					minlength: "Minimum length of UID No should be 12 digits",
					maxlength: "Maximum length of UID No should be 12 digits"
				},
				gender_id: "Please select gender",
				relation_id: "Please select relation",
				chkAgree: "Please agree with the aadhar consent",
				disability_status: "Please select disability status",
				marital_status: "Please select marital status",
				health_status: "Please select health status",
				aadhar_doc: "Please upload Aadhar Card",
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
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			},
			ignore: ":hidden",
		});

	});
</script>
<style>
	.border-primary {
		border-width: 3px !important;
	}
</style>
<main id="main">

	<!-- ======= Main Section ======= -->
	<section class="section">
		<div class="container">
			<?php $percentage = round((($seccCardholderAddTemp->application_status) / 7) * 100); ?>
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
					<li role="tab" class="current" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/addFamily">
							<span class="current-info audible"> </span>
							<div class="title"><span class="number">4</span> <span class="title_text">Add Family Member</span> </div>
						</a></li>
					<li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#" style="cursor: not-allowed;"><span class="current-info audible"> </span>
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
							<div class="card-header bg-secondary text-white"> <span class="h4">Member Details</span> </div>
							<div class="card-body">
								<?php if ($seccFamilyMemberCount >= 10) : ?>
									<div class="form-group row">
										<div class="col-sm-12 text-right">
											<div class="alert bg-warning text-center"><strong>You have added maximum limit of 10 family members under one ration Card.<br /> To avail ration for more members apply for a new ration card.</strong></div>
										</div>
									</div>
								<?php else : ?>
									<div class="form-group row">
										<div class="col-sm-12 text-right">
											<?php echo $this->Form->button(__('Add Member'), ['id' => 'addMember', 'type' => 'reset', 'class' => 'btn btn-green btn-md', 'value' => 'Add', 'style' => 'margin-right:10px']); ?>
										</div>
									</div>
								<?php endif;
								if ($seccFamilyAddTemp->hasErrors() == true) : $disp = '';
								else : $disp = 'none';
								endif; ?>

								<div id="member" style="display:<?= $disp ?>">

									<div class="card">
										<div class="card-header bg-secondary text-white">
											<div class="card-title">Add Member</div>
										</div>
										<?php echo $this->Form->create($seccFamilyAddTemp, ['id' => 'add_family_members', 'enctype' => 'multipart/form-data']) ?>

										<div class="card-body offset-md-2">

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2360;&#2342;&#2360;&#2381;&#2351; &#2325;&#2366; &#2344;&#2366;&#2350; (English) : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control("name", ["class" => "form-control form-control-sm", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "style" => "text-transform:capitalize"]); ?>
													<?php echo $this->Form->hidden("member_id", ["class" => "form-control form-control-sm", "id" => "member_id"]); ?>
												</div>
											</div>


											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2360;&#2342;&#2360;&#2381;&#2351; &#2325;&#2366; &#2344;&#2366;&#2350;(&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;) : </label>
												<div class="col-sm-6">
													<?php //echo $this->Form->control("name_sl", ["class" => "form-control form-control-sm", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "id" => "name_sl"]); 
													?>
													<script language="javascript">
														CreateCustomHindiTextBox("name_sl", "<?php if ($seccFamilyAddTemp->name_sl != '') {
																										echo $seccFamilyAddTemp->name_sl;
																									} ?>", "form-control form-control-sm", true);
													</script>
												</div>
											</div>


											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350;(English) : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control("fathername", ["class" => "form-control form-control-sm", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "style" => "text-transform:capitalize"]); ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350; (&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;) : </label>
												<div class="col-sm-6">
													<?php //echo $this->Form->control("fathername_sl", ["class" => "form-control form-control-sm", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "id" => "fathername_sl"]); ?>
													<script language="javascript">
														CreateCustomHindiTextBox("fathername_sl", "<?php if ($seccFamilyAddTemp->fathername_sl != '') {
																										echo $seccFamilyAddTemp->fathername_sl;
																									} ?>", "form-control form-control-sm", true);
													</script>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2354;&#2367;&#2306;&#2327; : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control("gender_id", ["options" => $genders, "class" => "form-control form-control-sm", "label" => false, "empty" => "Select Gender"]); ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">DOB : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control("dob", ["class" => "form-control form-control-sm form_datetime", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off"]); ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">Relationship with Card Holder : </label>
												<div class="col-sm-6">

													<?php echo $this->Form->control("relation_id", ["options" => $relations, "label" => false, "class" => "form-control", "empty" => "Select Relation"]); ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label font-weight-bold" for="name">Mobile No : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control("mobile", ["label" => false, "placeholder" => "Enter your Mobile No", "class" => "form-control", "onKeyPress" => "return isNumberKey(event)", "pattern" => "[6789][0-9]{9}", "maxlength" => "10", "onBlur" => "checkMobile(this);"]); ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold">Is Disabled ? : </label>
												<div class="col-sm-6">
													<?php echo  $this->Form->radio("disability_status", [["value" => "1", "text" => " Yes", "label" => ["style" => "margin-right:25px;"], "id" => "disability_status-1"], ["value" => "0", "text" => " No", "label" => ["style" => "margin-right:25px;"], "id" => "disability_status-0"]]); ?>
													<?php
													if (array_key_exists('disability_status', $seccCardholderAddTemp->getErrors())) {
														foreach ($seccCardholderAddTemp->getErrors()['disability_status'] as $key => $value) {
															echo '<div class="error-message">' . $value . '</div>';
														}
													} ?>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold">Marital Status ? : </label>
												<div class="col-sm-6">
													<?php echo  $this->Form->radio("marital_status", [["value" => "1", "text" => " Unmarried", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-1"], ["value" => "2", "text" => " Married", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-2"], ["value" => "3", "text" => " Widow", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-3"], ["value" => "4", "text" => " Widower", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-4"]]); ?>
													<?php
													if (array_key_exists('marital_status', $seccCardholderAddTemp->getErrors())) {
														foreach ($seccCardholderAddTemp->getErrors()['marital_status'] as $key => $value) {
															echo '<div class="error-message">' . $value . '</div>';
														}
													} ?>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold">Suffering from Cancer/Aids/ other Incurable disease? : </label>
												<div class="col-sm-6">
													<?php echo  $this->Form->radio("health_status", [["value" => "1", "text" => " Yes", "label" => ["style" => "margin-right:25px;"], "id" => "health_status-1"], ["value" => "0", "text" => " No", "label" => ["style" => "margin-right:25px;"], "id" => "health_status-0"]]); ?>
													<?php
													if (array_key_exists('health_status', $seccCardholderAddTemp->getErrors())) {
														foreach ($seccCardholderAddTemp->getErrors()['health_status'] as $key => $value) {
															echo '<div class="error-message">' . $value . '</div>';
														}
													} ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">Aadhar No : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control("uid", ["label" => false, "placeholder" => "Enter your Aadhar No", "class" => "form-control", "maxlength" => "12", "onkeyup" => "checkUID(this); ", "autocomplete" => "off"]); ?>
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label required font-weight-bold" for="name">Upload Aadhar Card : </label>
												<div class="col-sm-6">
													<?php echo $this->Form->control('aadhar_doc', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"document_errorspan")']);
													echo $this->Form->control('old_aadhar_doc', ['type' => 'hidden', 'label' => false, 'class' => 'form-control', 'required' => true, 'id' => 'old_aadhar_doc']);
													echo $this->Form->control('old_aadhar_doc_id', ['type' => 'hidden', 'label' => false, 'class' => 'form-control', 'required' => true, 'id' => 'old_aadhar_doc_id']); ?>
													<span id="document_errorspan" style="font-weight:bold; color: red;"></span>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-sm-12"> <span class="float-left">
														<?php echo $this->Form->checkbox('chkAgree', ['onclick' => 'proceed(this.value)', 'id' => 'chkAgree', 'hiddenField' => false]); ?> मैं इस आवेदन के लिए अपनी सहमति से अपना आधार न० आवेदक के रूप में भर रहा/रही हूँ |</span>
												</div>
											</div>

											<div class="text-center">
												<?= $this->Form->button(__("Submit"), ["class" => "btn btn-success", "value" => "savemember", "disabled" => true, "name" => "Submit", "id" => "submit"]) ?>
												<?= $this->Form->button(__("Cancel"), ["class" => "btn btn-danger", "type" => "reset", "id" => "cancel"]) ?>
											</div>

										</div>
									</div>

								</div>
								<br />
								<?php

								$sl = 0;
								foreach ($seccFamilyMember as $member) {
									$sl++; ?>
									<div class="card">
										<div class="card-body border-left border-primary">

											<div class="form-group row">
												<label class="col-sm-2  font-weight-bold" for="name">&#2344;&#2366;&#2350; : </label>
												<div class="col-sm-4"><?php echo $member->name; ?></div>
												<label class="col-sm-2  font-weight-bold" for="name">लिंग : </label>
												<div class="col-sm-4"><?php echo $member->Genders['name']; ?>
													<?php if ($member->hof != 1) {
														echo $this->Form->button('Edit', ['class' => 'btn btn-warning float-right editMember', 'type' => 'button', 'id' => 'editMember', 'value' => $member->id]);
													} ?></div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2  font-weight-bold" for="name">मोबाइल नंबर : </label>
												<div class="col-sm-4"><?php if ($member->mobile != '') {
																			echo $member->mobile;
																		} else {
																			echo 'NA';
																		} ?></div>
												<label class="col-sm-2  font-weight-bold" for="name">जन्म तिथि : </label>
												<div class="col-sm-4"><?php echo date('d-m-Y', strtotime(h($member->dob))); ?></div>
											</div>

											<div class="form-group row">
												<label class="col-sm-2  font-weight-bold" for="name">आधार नंबर : </label>
												<div class="col-sm-4"><?php echo h($member->uid); ?></div>
												<label class="col-sm-2  font-weight-bold" for="name">Relation : </label>
												<div class="col-sm-4"><?php if ($member->hof == 1) {
																			echo 'Head of Family';
																		} else {
																			echo h($member->Relations['name']);
																		} ?></div>
											</div>
											<div class="form-group row">
												<label class="col-sm-2  font-weight-bold" for="name">Marital Status : </label>
												<div class="col-sm-4"><?php if ($member->marital_status == 1) {
																			echo 'Unmarried';
																		} else if ($member->marital_status == 2) {
																			echo 'Married';
																		} else if ($member->marital_status == 3) {
																			echo 'Widow';
																		} else if ($member->marital_status == 4) {
																			echo 'Widower';
																		} else {
																			echo 'NA';
																		}
																		?></div>
												<label class="col-sm-2  font-weight-bold" for="name">Disability Status : </label>
												<div class="col-sm-4"><?php if ($member->disability_status == 0) {
																			echo 'No';
																		} else if ($member->disability_status == 1) {
																			echo 'Yes';
																		} else {
																			echo 'NA';
																		}
																		?>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-2  font-weight-bold" for="name">Health Status : </label>
												<div class="col-sm-4"><?php if ($member->health_status == 1) {
																			echo 'Cancer';
																		} else if ($member->health_status == 2) {
																			echo 'Aids';
																		} else if ($member->health_status == 0) {
																			echo 'None';
																		} else {
																			echo 'NA';
																		}
																		?></div>
											</div>
											<?php
											foreach ($member->secc_family_document_add_temps as $doc) {
												$document_path = DOC_ABS_PATH . $member->rgi_district_code . DS . $member->ack_no_ercms . DS . h($doc['document']);
												if (!file_exists($document_path)) {
													$document_path = "img/fnf.jpg";
												}
											?>
												<a href="" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info"><?= h($doc->document_type->name_hn) ?></a>
											<?php } ?>

										</div>
									</div>

									<br />
								<?php } ?>

								<br />

								<div class="text-center">
									<?php
									echo  $this->Html->link("Previous", "/SeccCardholderAddTemps/additionalDetails/", ["class" => "btn btn-warning text-white"]);
									echo '&emsp;' . $this->Form->button(__("Save Draft"), ["class" => "btn btn-success", "id" => "savenext", "value" => "savenext", "name" => "Submit"]);
									if ($seccCardholderAddTemp->application_status >= 5) {
										echo '&emsp;' . $this->Html->link("Next", "/SeccCardholderAddTemps/documentDetails/", ["class" => "btn btn-info text-white"]);
									} ?>
									<?= $this->Form->end() ?>
								</div>
							</div>
						</div>

					</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->
<?php echo $this->Html->script("jquery-ui.js") ?>

<script type="text/javascript">
	$('.form_datetime').datepicker({
		language: "es",
		autoclose: true,
		todayHighlight: true,
		changeMonth: true,
		changeYear: true,
		maxDate: "D M -6Y",
		yearRange: "-100:-6",
		dateFormat: "yy-mm-dd",
		defaultDate: "-720m",
	});

	$(document).ready(function() {
		$("#addMember").click(function() {
			$('#member').show();
			$('#savenext').hide();
			$("#addMember").hide();
		});

		$("#cancel").click(function() {
			$('#member').hide();
			$('#savenext').show();
			$("#addMember").show();
		});

		$(".editMember").click(function() {
			var member_id = $(this).val();
			var url = '<?= Router::url(array('controller' => 'SeccCardholderAddTemps', 'action' => 'getMemberDetails', '_full' => true)) ?>';

			// alert(member_id);
			//var panchayat_id = $('#rgi_block_code').val();
			var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				data: ({
					member_id: member_id
				}),
				dataType: 'html',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-CSRF-Token', token);
				},
				success: function(response) {
					$('#member').show();
					$('#savenext').hide();
					$("#addMember").hide();

					// response.setContentType("application/json;charset=utf-8");
					var result = JSON.parse(response); //alert(result.fathername_sl);
					$('#member_id').val(result.id);
					$('#name').val(result.name);
					$('#name_sl').val(result.name_sl);
					$('#fathername').val(result.fathername);
					$('#fathername_sl').val(result.fathername_sl);
					$('#relation-id').val(result.relation_id);
					$('#gender-id').val(result.gender_id);
					$('#dob').val(result.dob);
					$('#mobile').val(result.mobile);
					$('#marital_status-' + result.marital_status).prop('checked', true);
					$('#disability_status-' + result.disability_status).prop('checked', true);
					$('#health_status-' + result.health_status).prop('checked', true);
					$('#uid').val(result.uid);
					$('#old_aadhar_doc').val(result.old_aadhar_doc);
					$('#old_aadhar_doc_id').val(result.old_aadhar_doc_id);
					$('#aadhar-doc').prop('required', false);
					$('#submit').val("editmember");

				},
				error: function(e) {
					$('#member').hide();
					$('#savenext').show();
					$("#addMember").show();
					alert("An error occurred: " + e.responseText.message);
					console.log(e);
				}
			});
		});

	});

	function validateFile(component, errorspan) {
		validateFileExtension(component, errorspan, "Please provide document in  .jpg/.png format only!!!.", new Array("jpg", "jpeg", "png"));
		validateFileSize(component, errorspan, "File size should not be greater than 500 KB!!!.", "500000"); //2097152 Byte = 2MB; 500000 Byte = 500 Kb
	}

	function checkAadhar(str) {
		var aadhar = str.value;
		if (aadhar.length == 12) {
			var member_id = $('#member_id').val();
			var url = '<?= Router::url(array('controller' => 'ErcmsValidate', 'action' => 'checkaadhar', '_full' => true)) ?>';
			// var aadhar = $(this).val();
			var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				data: ({
					aadhar: aadhar,
					member_id: member_id
				}),
				dataType: 'html',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-CSRF-Token', token);
				},
				success: function(response) {
					var result = JSON.parse(response); //alert(result);return false;
					if (result.valid == true) {
						str.value = '';
						for (var key in result.data) {
							//console.log("key " + key + " : " + result.data[key]);
							//console.log("key " + key + " has value " + result.data[key]);
						}
						$('#uid-error').remove();
						$("<em id=\"uid-error\" class=\"error invalid-feedback\">Aadhar Number already exists for " + key + " : " + result.data[key] + ".</em>").insertAfter(str);
						$(str).addClass("is-invalid").removeClass("is-valid");
						// $(str).focus()
						return false;
					}
				},
				error: function(e) {
					alert("An error occurred: " + e.responseText.message);
					str.value = '';
					$('#uid-error').remove();
					$("<em id=\"uid-error\" class=\"error invalid-feedback\">Some error Occurred!!!</em>").insertAfter(str);
					$(str).addClass("is-invalid").removeClass("is-valid");
					console.log(e);
					return false;
				}
			});
		} else {
			return false;
		}

	}

	function checkDuplicateMobile(str) {
		var mobile = str.value;
		if (mobile.length == 10) {
			var url = '<?= Router::url(array('controller' => 'ErcmsValidate', 'action' => 'checkDuplicateMobile', '_full' => true)) ?>';
			// var aadhar = $(this).val();
			var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				data: ({
					mobile: mobile
				}),
				dataType: 'html',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-CSRF-Token', token);
				},
				success: function(response) {
					var result = JSON.parse(response);
					if (result.valid == true) {
						str.value = '';
						for (var key in result.data) {
							//console.log("key " + key + " : " + result.data[key]);
							//console.log("key " + key + " has value " + result.data[key]);
						}
						$('#mobile-error').remove();
						$("<em id=\"mobile-error\" class=\"error invalid-feedback\">Mobile Number already exists for " + key + " : " + result.data[key] + ".</em>").insertAfter(str);
						$(str).addClass("is-invalid").removeClass("is-valid");
						//$(str).focus()
						return false;
					}
				},
				error: function(e) {
					alert("An error occurred: " + e.responseText.message);
					str.value = '';
					$('#uid-error').remove();
					$("<em id=\"uid-error\" class=\"error invalid-feedback\">Some error occurred!!!</em>").insertAfter(str);
					$(str).addClass("is-invalid").removeClass("is-valid");
					console.log(e);
					return false;
				}
			});
		} else {
			return false;
		}

	}

	function proceed(value) {
		if (document.getElementById("chkAgree").checked == true) {
			$('#submit').removeAttr("disabled", false);
		} else {
			$("#submit").attr("disabled", true);
			//document.getElementById('sendBtn'+value).style.backgroundColor = "#DDDF95";
		}
	}
</script>