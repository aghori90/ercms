<?php

use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaCardholderTemp $nfsaCardholderTemp
 */
echo $this->Html->script("ration.js");
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#bank_dtl").validate({
			rules: {
				is_lpg: "required",
				lpg_consumer_no: {
					required: {
						depends: function(element) {
							return ($("#is-lpg-1").val() == 1);
						}
					}
				},
				lpg_company: {
					required: {
						depends: function(element) {
							return ($("#is-lpg-1").val() == 1);
						}
					}
				},
				is_bank: "required",
				bank_account_no: {
					required: {
						depends: function(element) {
							return ($("#is-bank-1").val() == 1);
						}
					}
				},
				bank_master_id: {
					required: {
						depends: function(element) {
							return ($("#is-bank-1").val() == 1);
						}
					}
				},
				branch_master_id: {
					required: {
						depends: function(element) {
							return ($("#is-bank-1").val() == 1);
						}
					}
				},
				bank_ifsc_code: {
					required: {
						depends: function(element) {
							return ($("#is-bank-1").val() == 1);
						}
					},
				},
			},
			messages: {
				is_lpg: "Please select LPG Connection Details ",
				lpg_company: "Please select LPG Connection",
				lpg_consumer_no: "Please enter LPG Consumer No",
				is_bank: "Please select Bank Account Details",
				bank_account_no: "Please enter bank Account No.",
				bank_master_id: "Please select Bank Name",
				branch_master_id: "Please select Branch Name",
				bank_ifsc_code: "Please enter Bank IFSC Code",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				if (element.is(":radio")) {
					error.prependTo(element.parent());
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
					<li role="tab" class="first done"><a href="<?= $baseurl ?>NfsaCardholderTemps/personalDetails">
							<div class="title"><span class="number">1</span> <span class="title_text">Personal Details</span> </div>
						</a></li>
					<li role="tab" class="current" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>NfsaCardholderTemps/bankDetails" style="pointer-events: none !important;"><span class="current-info audible"> </span>
							<div class="title"><span class="number">2</span> <span class="title_text">Bank Details</span> </div>
						</a></li>
					<li role="tab" class="disabled" aria-disabled="true" aria-selected="false"><a href="#" style="cursor: not-allowed;">
							<div class="title"><span class="number">3</span> <span class="title_text">Additional Details</span> </div>
						</a></li>
						<li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#" style="cursor: not-allowed;"><span class="current-info audible"> </span>
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
					<?php echo $this->Form->create($nfsaCardholderTemp, ['id' => 'bank_dtl']) ?>
					<div class="card">
						<div class="card-body">
							<div class="card-header bg-secondary text-white"> <span class="h4">बैंक विवरण और एलपीजी कनेक्शन विवरण</span> </div>
							<div class="card-body offset-md-2">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">क्या आप अपने एलपीजी कनेक्शन का विवरण देना चाहते हैं ? : </label>
									<div class="col-sm-6">
										<?php echo  $this->Form->radio("is_lpg", [["value" => "1", "text" => " Yes", "label" => ["style" => "margin-right:25px;padding-left:2px"]], ["value" => "0", "text" => " No", "label" => ["style" => "margin-right:25px;"]]]); ?>
									</div>
								</div>

								<?php if ($nfsaCardholderTemp->is_lpg == 1) {
									$lpg_disp = '';
								} else {
									$lpg_disp = 'none';
								} ?>
								<div id="lpg_detail" style="display:<?= $lpg_disp ?>">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label required font-weight-bold" for="name">एलपीजी कनेक्शन : </label>
										<div class="col-sm-6">
											<?php echo $this->Form->control("lpg_company", ["class" => "form-control form-control-sm", "options" => ["1" => "HP Gas (HPCL)", "2" => "BharatGas (BPCL)", "3" => "Indane (IOCL)"], "label" => false, "empty" => "Select LPG Connection"]); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label required font-weight-bold" for="name">उपभोक्ता संख्या : </label>
										<div class="col-sm-6">
											<?php echo  $this->Form->control("lpg_consumer_no", ["class" => "form-control form-control-sm", "label" => false, "autocomplete" => "off", "onkeypress" => "return isAlphaNumeric(event)", "autocomplete" => "off"]); ?>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">क्या आप अपने बैंक खता का विवरण देना चाहते हैं ? : </label>
									<div class="col-sm-6">
										<?php echo  $this->Form->radio("is_bank", [["value" => "1", "text" => " Yes", "label" => ["style" => "margin-right:25px;padding-left:2px"]], ["value" => "0", "text" => " No", "label" => ["style" => "margin-right:25px;"]]]); ?>
									</div>
								</div>

								<?php if ($nfsaCardholderTemp->is_bank == 1) {
									$bank_disp = '';
								} else {
									$bank_disp = 'none';
								} ?>
								<div id="bank_detail" style="display:<?= $bank_disp ?>">
									<div class="form-group row">
										<label class="col-sm-4 col-form-label required font-weight-bold" for="name">बैंक IFSC कोड :</label>
										<div class="col-sm-6">
											<?php echo  $this->Form->control("bank_ifsc_code", ["class" => "form-control form-control-sm", "label" => false, 'onblur' => 'getbankdetail();', 'maxlength' => '11', 'pattern' => '[a-zA-Z0-9]{11}', "onKeyPress" => "return isAlphaNumeric(event)", "autocomplete" => "off", "id" => "bank_ifsc_code"]); ?>
											<button type="button" class="badge badge-pill badge-green" data-toggle="modal" data-target="#ifscModal"> Search IFSC </button>
										</div>
									</div>

									<!-- The Modal -->
									<div class="modal fade" id="ifscModal" role="dialog">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
													<legend class="text text-success" style="border-bottom:0px; margin-bottom:0px">IFSC कोड खोजें</legend>
												</div>

												<div class="modal-body offset-sm-1">
													<div class="form-group row">
														<label class="col-sm-4"><strong>बैंक का नाम</strong></label>
														<div class="col-sm-7"><?php
																				echo $this->Form->control('bank_id', ['class' => 'form-control', 'label' => '', 'id' => 'bank_id', 'options' => $bankNames, "label" => false, 'empty' => 'Select Bank Name']);
																				?></div>
													</div>

													<div class="form-group  row">
														<label class="col-sm-4"><strong>लोकेशन</strong></label>
														<div class="col-sm-7"><?php
																				echo $this->Form->control('branch_id', ['class' => 'form-control', 'label' => '', 'id' => 'branch_id', 'options' => [], "label" => false, 'empty' => 'Select Branch Name']);
																				?></div>
													</div>

													<div class="form-group  row">
														<label class="col-sm-4"><strong>IFSC कोड</strong></label>
														<div class="col-sm-7"><?php
																				echo $this->Form->control('ifsc_code', ['class' => 'form-control', "label" => false, 'id' => 'ifsc_code', 'readonly' => 'readonly', 'disabled' => 'disabled']);
																				?></div>
													</div>

												</div>

												<!-- Modal footer -->
												<div class="modal-footer">
													<button id="copyifsc" type="button" style="float:right" data-dismiss="modal" class="btn  btn-success closebtn">Copy</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal Close -->

									<div class="form-group row">
										<label class="col-sm-4 col-form-label required font-weight-bold" for="name">बैंक का नाम : </label>
										<div class="col-sm-6">
											<?php echo  $this->Form->control("bank_master_id", ["class" => "form-control form-control-sm", 'options' => [], "label" => false, 'id' => 'bank_master_id', "autocomplete" => "off", "empty" => "Select Bank Name"]); ?>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-4 col-form-label required font-weight-bold" for="name">लोकेशन : </label>
										<div class="col-sm-6">
											<?php echo  $this->Form->control("branch_master_id", ["class" => "form-control form-control-sm", 'options' => [], "label" => false, 'id' => 'branch_master_id', "autocomplete" => "off", "empty" => "Select Branch Name"]); ?>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-4 col-form-label required font-weight-bold" for="name">खाता संख्या : </label>
										<div class="col-sm-6">
											<?php echo  $this->Form->control("bank_account_no", ["class" => "form-control form-control-sm", "label" => false, "id" => "bank_account_no", "onKeyPress" => "return isNumberKey(event)", 'readonly' => 'readonly', "autocomplete" => "off"]); ?>
										</div>
									</div>


								</div>
							</div>
							<hr />
							<div class="text-center">
								<?php
								echo  $this->Html->link("Previous", "/NfsaCardholderTemps/personalDetails/", ["class" => "btn btn-warning text-white"]);
								echo '&emsp;' . $this->Form->button(__("Save Draft"), ["class" => "btn btn-success"]);
								if ($nfsaCardholderTemp->application_status >= 3) {
									echo '&emsp;' . $this->Html->link("Next", "/NfsaCardholderTemps/additionalDetails/", ["class" => "btn btn-info text-white"]);
								}
								echo $this->Form->end();
								?>
							</div>

						</div><!-- End Card Body -->
					</div><!-- End Card -->
				</div><!-- End divcol-lg-12 -->
			</div><!-- End row justify-content-center -->
		</div><!-- End container -->
	</section><!-- End Section -->
</main><!-- End #main -->
<script type="text/javascript">
	$(document).ready(function() {
		getbankdetail();
		$("#is-lpg-1").click(function() {
			$('#lpg_detail').show();
		});

		$("#is-lpg-0").click(function() {
			$('#lpg_detail').hide();
		});

		$("#is-bank-1").click(function() {
			$('#bank_detail').show();
		});

		$("#is-bank-0").click(function() {
			$('#bank_detail').hide();
		});

		// Start : Get Branch Name Based on Bank Name Change
		$('#bank_id').change(function() {
			$('#ifsc_code').val('');

			var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
			var url = '<?= Router::url(array('controller' => 'ErcmsValidate', 'action' => 'getBranchByBank', '_full' => true)) ?>';
			var bank_id = $(this).val();
			if (bank_id != '') {
				//$('#loading').css('display', 'block');
				$.ajax({
					type: 'POST',
					url: url,
					async: true,
					data: ({
						bank_id: bank_id
					}),
					dataType: 'html',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('X-CSRF-Token', token);
					},
					success: function(response, textStatus) {
						$('#branch_id').empty();
						var result = JSON.parse(response); //alert(result);return false;
						$.each(result, function(val, text) {
							$('#branch_id').append($('<option></option>').val(val).html(text));
						});
						$("select[name=branch_id]").prepend("<option value selected>Select Branch Name</option>");
						//$('#loading').css('display', 'none');
					},
					error: function(e) {
						alert("An error occurred: " + e.responseText.message);
						console.log(e);
						//$('#loading').css('display', 'none');
					}
				});
			}
		});

		// End : Get Branch Name Based on Bank Name Change

		// Start : Get IFSC Code Based on Bank Name and Branch Name Change
		$('#branch_id').change(function() {
			var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
			var url = '<?= Router::url(array('controller' => 'ErcmsValidate', 'action' => 'getIfscByBankAndBranch', '_full' => true)) ?>';
			var bank_id = $('#bank_id').val();
			var branch_id = $(this).val();
			if (bank_id == '') {
				alert('Select Bank.');
				return false;
			}
			if (branch_id == '') {
				alert('Select Bank Branch.');
				return false;
			}
			if (bank_id != '' && branch_id != '') {
				//$('#loading').css('display', 'block');
				$.ajax({
					type: 'POST',
					url: url,
					async: true,
					data: ({
						bank_id: bank_id,
						branch_id: branch_id
					}),
					dataType: 'html',
					beforeSend: function(xhr) {
						xhr.setRequestHeader('X-CSRF-Token', token);
					},
					success: function(response, textStatus) {
						if (response != "") {
							$('#ifsc_code').val('');
							var result = JSON.parse(response);
							$('#ifsc_code').val(result.ifsc_code);
						} else {
							alert('Sorry Your Branch Not Found. Please Contact Administrator to Add your Bank branch.');
						}
						//$('#loading').css('display', 'none');
					},
					error: function(e) {
						$('#ifsc_code').val('');
						alert("An error occurred: " + e.responseText.message);
						console.log(e);
						// $('#loading').css('display', 'none');
					}
				});
			}
		});

		// End : Get IFSC Code Based on Bank Name and Branch Name Change

		$('#copyifsc').on('click', function() {
			$('#modal').hide('slow');
			var ifsc_code = $('#ifsc_code').val();
			if ($('#bank_ifsc_code').val(ifsc_code)) {
				getbankdetail();
			}
			$("#bank_account_no").val("");
		})

		$('#bank_master_id,#branch_master_id').change(function() {
			var bank_id = $('#bank_master_id').val();
			var branch_id = $('#branch_master_id').val();
			if (bank_id != "" && branch_id != "") {
				$("#bank_account_no").removeAttr("readonly");
			} else {
				$("#bank_account_no").attr("readonly", "readonly");
			}
		});

	});

	function getbankdetail() {
		var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
		var url = '<?= Router::url(array('controller' => 'ErcmsValidate', 'action' => 'getBankBranchDataByIfsc', '_full' => true)) ?>';
		var ifsc_code = $('#bank_ifsc_code').val();
		//if (ifsc_code.length == 11 && ifsc_code != '') {alert(ifsc_code);
		if (ifsc_code != '') {
			// $('#loading').css('display', 'block');
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				data: ({
					ifsc_code: ifsc_code
				}),
				dataType: 'html',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-CSRF-Token', token);
				},
				success: function(response, textStatus) {
					if (response === '***') {
						$('#bank_ifsc_code').val('');
						$('#bank_ifsc_code').removeClass("is-valid");
						//$('#ifsc_error_for_branch').html('Sorry, Please contact ADMIN to add your Bank Branch !');
						alert("Sorry, Please contact ADMIN to add your Bank Branch !");
					} else {
						var result = response.split('***');
						$('#bank_master_id').html(result[0]);
						$('#branch_master_id').html(result[1]);
						$('#bank_ifsc_code').val(ifsc_code);
						$('#bank_ifsc_code').attr('readonly', 'readonly');
					}
					//$('#loading').css('display', 'none');
					getBankAccDigit();
				},
				error: function(e) {
					alert("An error occurred: " + e.responseText.message);
					console.log(e);
					//$('#loading').css('display', 'none');
				}
			});
		}
	}

	function getBankAccDigit() {
		var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
		var url = '<?php echo $this->Url->build(['controller' => 'ErcmsValidate', 'action' => 'getBankAccDigit']); ?>';
		var bank_id = $('#bank_master_id').val();
		var branch_id = $('#branch_master_id').val();
		if (bank_id.length != 0 && branch_id.length != 0) {
			// $('#loading').css('display', 'block');
			$.ajax({
				type: 'POST',
				url: url,
				async: true,
				data: ({
					bank_id: bank_id,
					branch_id: branch_id
				}),
				dataType: 'html',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-CSRF-Token', token);
				},
				success: function(response, textStatus) {
					$('#bank_account_no').attr('maxlength', response);
					$('#bank_account_no').removeAttr('readonly');
					//$('#loading').css('display', 'none');
				},
				error: function(e) {
					alert("An error occurred: " + e.responseText.message);
					console.log(e);
					// $('#loading').css('display', 'none');
				}
			});
		}
	}
</script>