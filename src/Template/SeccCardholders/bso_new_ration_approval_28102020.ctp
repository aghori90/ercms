<?php

use Cake\Core\Configure;

echo $this->Html->script("ration.js");
$applicationType = Configure::read('applicationType');
$gender = Configure::read('gender');
$disability_status = Configure::read('disability_status');
$health_status = Configure::read('health_status');
$marital_status = Configure::read('marital_status');
?><script type="text/javascript">
	$(document).ready(function() {
		$("#application_view").validate({
			rules: {
				action: "required",
				remarks: "required",
			},
			messages: {
				action: "Please select action ",
				remarks: "Please enter Remarks",
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

		$('#upload_caste').click(function() {
			$("#document_dtl2").valid();

		});
		$('#upload_passbook').click(function() {
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
<script>
	function send(Id, obj) {
		document.getElementById("secc-cardholder-add-temp-id").value = Id;
	}
</script>
<style>
#pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display: none;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

#pageloader img
{
  left: 50%;
  margin-left: -32px;
  margin-top: -32px;
  position: absolute;
  top: 50%;
}
</style>
<?= $this->Flash->render() ?>
<div id="pageloader">
   <?php echo $this->Html->image("loader-large.gif", ['alt' => 'processing']);?>
</div>
<div class="main-card mb-3 card">
	<?php echo $this->Form->create(false, ['id' => 'application_view']) ?>
	<?php if (!empty($seccCardholderAddTemp)) { ?>
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
			<div class="text-left col-sm-10">Request For:- New Application for Ration Card </div>
				<div class="col-sm-2 text-right px-4""><?php echo  $this->Html->link("Back", "/SeccCardholders/applicationList/" . base64_encode(1), ["class" => "btn btn-warning text-white"]); ?></div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-sm-12 text-center">
						<h4><strong>Acknowledgement No : </strong><span style="color:#009933"><?= $seccCardholderAddTemp->ack_no ?></span></h4>
					</div>
				</div>
				<div class="form-group bg-info text-center text-white">
					<b>Ration Card Details</b></p>
				</div>
				<div class="">
					<table class="table table-bordered">

						<tbody>
							<tr>
								<td style="width:15%;text-align:left"> &#2344;&#2366;&#2350; : </td>
								<td style="width:35%;text-align:left"> <b><?php echo $seccCardholderAddTemp->name_sl; ?> </b> </td>

								<td style="width:15%;text-align:left"> &#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350; : </td>
								<td style="width:35%;text-align:left"> <b><?php echo  $seccCardholderAddTemp->fathername_sl; ?></b> </td>
							</tr>

							<tr>
								<td style="width:15%;text-align:left">&#2332;&#2367;&#2354;&#2366; : </td>
								<td style="width:35%;text-align:left"><b><?php echo $seccCardholderAddTemp->secc_district->name; ?></b></td>

								<td style="width:15%;text-align:left">&#2346;&#2381;&#2352;&#2326;&#2339;&#2381;&#2337; :</td>
								<td style="width:35%;text-align:left"><b><?php echo $seccCardholderAddTemp->secc_block->name; ?></b></td>


							</tr>

							<tr>
								<td style="width:15%;text-align:left">&#2346;&#2306;&#2330;&#2366;&#2351;&#2340; :</td>
								<td style="width:35%;text-align:left"><b><?php if ($seccCardholderAddTemp->panchayat_id != '') {
																				echo  $seccCardholderAddTemp->panchayat->name;
																			} else {
																				echo 'NA';
																			} ?></b></td>
								<td style="width:15%;text-align:left">&#2327;&#2381;&#2352;&#2366;&#2350; :</td>
								<td style="width:35%;text-align:left"><b><?php echo  $seccCardholderAddTemp->secc_village_ward->name; ?></b></td>

							</tr>
							<tr>
								<td style="width:15%;text-align:left">&#2357;&#2367;&#2340;&#2352;&#2325; &#2325;&#2366; &#2344;&#2366;&#2350; :
								</td>
								<td style="width:35%;text-align:left"><b><?php echo  $seccCardholderAddTemp->dealer->name;  ?></b></td>
								<td style="width:15%;text-align:left">&#2350;&#2379;&#2348;&#2366;&#2311;&#2354; &#2344;&#2306;&#2406; :</td>
								<td style="width:35%;text-align:left"><b><?php echo $seccCardholderAddTemp->mobileno; ?></b></td>
							</tr>

							<tr>
								<td style="width:15%;text-align:left"> &#2337;&#2368;&#2354;&#2352; &#2354;&#2366;&#2311;&#2360;&#2375;&#2306;&#2360; &#2344;&#2306;&#2406; :</td>
								<td style="width:35%;text-align:left"><b><?php echo $seccCardholderAddTemp->dealer->License_no; ?> </b> </td>
								<td style="width:15%;text-align:left">&#2325;&#2366;&#2352;&#2381;&#2337; &#2325;&#2366; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352; :</td>
								<td style="text-align:left"><b><?php echo $seccCardholderAddTemp->cardtype->name; ?></b></td>

							</tr>
							<tr>
								<td colspan="4">
									<label class="col-sm-10 col-form-label required font-weight-bold" for="name">निम्नवर्णित समावेशन मानक के आधार पर मैं एक सुपात्र आवेदक हूँ (प्रासंगिक कोष्ठक में लगाएं ) : </label><br>
									<?php $i = 0;
									//debug($inclusion_criterias);
									foreach ($inclusion_criterias as $inclusion) {
										$key = $inclusion->cardholder_col;
										if (($seccCardholderAddTemp->$key != '') && $seccCardholderAddTemp->$key == '1') {
											$check = 'checked';
										} else {
											if ($hof_gender->gender_id == 3 && $key == 'marital_status') {
												$check = 'checked';
											} else {
												$check = '';
											}
										}
										echo $this->Form->checkbox('inclusion_criteria.' . $inclusion->cardholder_col, ['class' => 'inclusion_criteria', 'id' => 'inclusion_criteria' . $inclusion->id, 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
										$i++;
									}
									if ($seccCardholderAddTemp->getErrors('applicationType_rule_id')) {
										foreach ($seccCardholderAddTemp->getErrors('applicationType_rule_id') as $key => $value) {
											echo '<div class="error-message">' . $value . '</div>';
										}
									} ?>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<div class="form-group row">
										<label class="col-sm-10 col-form-label required font-weight-bold" for="name">उपर्युक्त क्रम में निम्नवर्णित समावेशन मानक ( Exclusion Criteria ) के आधार पर पूर्ण सत्यनिष्ठान के साथ घोषणा करता/करती हूँ कि - </label>
									</div>
									<div class="form-group row">
										<div class="col-sm-10 ">
											1. मैं और मेरे परिवार का कोई भी सदस्य , भारत सरकार /राज्य सरकार /केंद्र शासित प्रदेश या इनके परिषद /उधम/प्रक्रम /उपक्रम/अन्य स्वयत निकाय जैसे विश्वविद्यालय इत्यादि/नगर निगम/नगर पषर्द/नगरपालिका/न्यास इत्यादि में नियोजित/सेवानिवृत नहीं है,
										</div>
									</div>
									<hr style="border-top: 2px dashed grey;">
									<div class="form-group row">
										<div class="col-sm-10 ">
											2. मैं और मेरे परिवार का कोई भी सदस्य, आयकर/सेवा कर/व्यावसायिक कर/GST नहीं देता है,
										</div>
									</div>
									<hr style="border-top: 2px dashed grey;">
									<div class="form-group row">
										<div class="col-sm-10 ">
											3. मैं और मेरे परिवार के पास पांच एकड़ से अधीक सिंचित भूमी अथवा दस एकड़ से असिंचित भूमी नहीं है,
										</div>
									</div>
									<hr style="border-top: 2px dashed grey;">
									<div class="form-group row">
										<div class="col-sm-10 ">
											4. मैं और मेरे परिवार का किसी सदस्य के नाम से चार पहिया मोटर वाहन ( four wheeler ) अथवा इससे अधिक पहिया के वाहन नहीं है,
										</div>
									</div>
									<hr style="border-top: 2px dashed grey;">
									<div class="form-group row">
										<div class="col-sm-10 ">
											5. मैं और मेरे परिवार का कोई भी सदस्य सरकार द्वारा पंजीकृत उधम का स्वामी या संचालक नहीं है,
										</div>
									</div>
									<hr style="border-top: 2px dashed grey;">
									<div class="form-group row">
										<div class="col-sm-10 ">
											6. मैं और मेरे परिवार के पास पक्की दीवारों तथा छत्त के साथ तीन या इससे अधिक कमरों का पक्का मकान नहीं है, जो प्रधानमंत्री आवास योजना से अनाच्छादित है,
										</div>
									</div>
									<hr style="border-top: 2px dashed grey;">
									<div class="form-group row">
										<div class="col-sm-10 ">
											7. मैं और मेरे परिवार के पास 5 लाख या इससे अधिक लागत ला मशीन चालित चार पहिये वाले कृषि उपकरण ( ट्रैक्टर, थ्रेसर इत्यादि ) नहीं है |
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
					<div class="form-group bg-info text-center text-white">
						<b>प्राथमिकता सूचि हेतु अधिमानता मानक </b></p>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td colspan="2">
									<?php
									if ($seccCardholderAddTemp->caste_id == 7) {
										$pvtg_check = "checked";
									} else {
										$pvtg_check = "";
									}
									if ($seccCardholderAddTemp->caste_id == 4) {
										$sc_check = "checked";
									} else {
										$sc_check = "";
									}
									if ($seccCardholderAddTemp->caste_id == 3) {
										$st_check = "checked";
									} else {
										$st_check = "";
									}
									if ($seccCardholderAddTemp->health_status == 1) {
										$health_check = "checked";
									} else {
										$health_check = "";
									}
									if ($seccCardholderAddTemp->disability_status == 1) {
										$disability_check = "checked";
									} else {
										$disability_check = "";
									}
									if ($seccCardholderAddTemp->marital_status == 1) {
										$marital_check = "checked";
									} else {
										$marital_check = "";
									}
									if ($seccCardholderAddTemp->old_alone == 1) {
										$old_alone_check = "checked";
									} else {
										$old_alone_check = "";
									}
									if ($pvtg_check == '' && $sc_check == '' && $st_check == ""  && $health_check == "" && $disability_check == "" && $marital_check == "" && $old_alone_check == "") {
										$other_check = 'checked';
									} else {
										$other_check = '';
									}
									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $pvtg_check]) . ' &nbsp;आदिम जनजाति परिवार (PVTG)<br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $marital_check]) . ' &nbsp;विधवा / परित्यकता/ (Transagender) <br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $disability_check]) . ' &nbsp;निःशक्त (40 प्रतिशत या इससे अधिक) <br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $health_check]) . ' &nbsp;कैंसर/ एड्स/ कुष्ठ/ अन्य असाध्य रोगों से ग्रसित व्यक्ति <br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $old_alone_check]) . ' &nbsp;अकेले रहने वाला वृद्ध/बुजुर्ग व्यक्ति/एकल परिवार <br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $st_check]) . ' &nbsp;अनुसूचित जनजाति <br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $sc_check]) . ' &nbsp;अनुसूचित जाती <br /><hr style="border-top: 2px dashed grey;">';

									echo  $this->Form->checkbox('priority', ['class' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $other_check]) . ' &nbsp;अन्यान्य  <br /><hr style="border-top: 2px dashed grey;">'; ?>
								</td>
							</tr>

							<tbody>
							</tbody>
						</table>
					</div>

				<?php
				//	if ($seccCardholderAddTemp->is_lpg == '1' || $seccCardholderAddTemp->is_bank == '1') { 
				?>
				<div class="form-group bg-info text-center text-white">
					<b>LPG Connection and Bank Details</b></p>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>Lpg Consumer No.</td>
							<td><?= ($seccCardholderAddTemp->is_lpg == 1) ? $seccCardholderAddTemp->lpg_consumer_no : 'NA'; ?></td>
						</tr>
						<tr>
							<td>Bank Account No.</td>
							<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_account_no : 'NA'; ?></td>
						</tr>
						<tr>
							<td>Bank Name</td>
							<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_master->name : 'NA'; ?></td>
						</tr>
						<tr>
							<td>Branch Name</td>
							<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->branch_master->name : 'NA'; ?></td>
						</tr>
						<tr>
							<td>IFSC Code.</td>
							<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_ifsc_code : 'NA'; ?></td>
						</tr>

						<tbody>
						</tbody>
					</table>
				</div>
				<?php
				$document_no = 0;
				$document_uploaded = 0;
				if ($seccCardholderAddTemp->caste_id == 3 || $seccCardholderAddTemp->caste_id == 4 || $seccCardholderAddTemp->caste_id == 7) {
					$caste_id = 1;
				} else {
					$caste_id = 0;
				};
				if ($seccCardholderAddTemp->is_bank == 0) {
					$document_status->bank_doc = 0;
				} else {
					$document_status->bank_doc = 1;
				}
				
				$document_no = $seccCardholderAddTemp->is_bank + $caste_id + $seccCardholderAddTemp->marital_status + $seccCardholderAddTemp->disability_status + $seccCardholderAddTemp->health_status;
				$document_uploaded = $document_status->bank_doc + $document_status->caste_doc + $document_status->disablility_doc + $document_status->health_doc + $document_status->death_doc;
				?>

				<?php if (!empty($seccFamilyAddTemp)) { ?>
					<div class="form-group bg-info text-center text-white">
						<b>&#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2375; &#2360;&#2342;&#2360;&#2381;&#2351;&#2379;&#2306; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</b></p>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width:10%;text-align:left">Sl No. </th>
									<th width="20%">Member Name</th>
									<th width="10%">Gender</th>
									<th width="10%">Age </th>
									<th width="20%">Father / Husband Name</th>
									<th width="10%">Relation with Head of Family</th>
									<th width="10%">Aadhar No. </th>
									<th width="10%"> Mobile No. </th>
									<th width="10%"> Disability </th>
									<th width="10%"> Marital Status </th>
									<th width="10%"> Incurable Disease </th>
									<th>Document</th>
									<?php if ($document_uploaded == $document_no) { ?><th>Verify</th><?php } ?>
								</tr>

							</thead>
							<tbody>
								<?php $x = 1;

								foreach ($seccFamilyAddTemp as $families) : ?>
									<tr>
										<td style="width:10%;text-align:left"> <?php echo $x++;  ?> </td>
										<td><?php echo $families->name_sl; ?> </td>
										<td><?php if ($families->gender_id != '') {
												echo $gender[$families->gender_id];
											} else {
												echo 'NA';
											} ?> </td>
										<td><?php
											$from = new DateTime($families->dob);
											$to   = new DateTime('today');
											echo $from->diff($to)->y;
											?> </td>
										<td><?php echo $families->fathername_sl; ?> </td>
										<td><?php if ($families->relation_id) {
												echo $families->relation->name;
											} else if ($families->hof == 1) {
												echo 'HEAD OF FAMILY';
											} ?>
										</td>
										<td><?php if (!empty($families->uid)) {
												echo h($families->uid);
											} else {
												echo 'N/A';
											} ?>
										</td>
										<td> <?php if (!empty($families->mobile)) {
													echo h($families->mobile);
												} else {
													echo 'N/A';
												} ?>
										</td>
										<td><?php if (isset($families->disability_status)) {
												echo $disability_status[$families->disability_status];
											} else {
												echo 'NA';
											} ?></td>
										<td><?php if (isset($families->marital_status)) {
												echo $marital_status[$families->marital_status];
											} else {
												echo 'NA';
											} ?></td>
										<td><?php if (isset($families->health_status)) {
												echo $health_status[$families->health_status];
											} else {
												echo 'NA';
											} ?></td>
										<td><?php
											foreach ($families->secc_family_document_add_temps as $doc) {
												$document_path = DOC_ABS_PATH . $families->rgi_district_code . DS . $families->ack_no_ercms . DS . h($doc->document);
												if (!file_exists($document_path)) {
													$document_path = "img/fnf.jpg";
												}
												
											?>
												<a href="" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class="badge badge-pill badge-primary"><?= h($doc->document_type->name_hn) ?></a>
											<?php } ?>
										</td>
										<?php if ($document_uploaded == $document_no) { ?>
											<td>
												<?php if ($families->uid_verified == '' || $families->uid_verified == 0) {
													echo $this->Form->button(__('Verify'), ['class' => 'cancel btn btn-info btn-md', 'name' => 'submit', 'value' => 'verify', 'style' => 'margin-right:10px', "onclick" => "javascript:send('" . $families->id . "',this.id)"]);
													$hof_verified ='';
												} else if ($families->uid_verified == 2) {
													if ($families->hof == 1) {
														$hof_verified = $families->uid_verified;
													}
													echo '<span class="badge badge-pill badge-danger">Member Rejected</span>';
												} else {
													echo '<span class="badge badge-pill badge-success">Member Verified</span>';
												} ?>
											</td><?php } ?>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<?php if ($document_uploaded == $document_no) {
						if ($hof_verified == 2) { ?>
							<div class="form-group alert alert-danger text-center">
								The UID for Head of Family is duplicate, therefore the application must be rejected.
							</div>
						<?php } ?>
						<div class="form-group row">
							<label class="col-sm-2">Approve/Reject </label>
							<?php
							if ($member_verified_count->total_uid == $member_verified_count->uid_rejected) {
								$options = ['2' => 'Reject'];
							} else if ($hof_verified == 2) {
								$options = ['2' => 'Reject'];
							} else {
								$options = ['1' => 'Approve', '2' => 'Reject'];
							} ?>
							<div class="col-sm-4"><?php echo $this->Form->select('action', $options, ['class' => 'form-control', 'empty' => '--Select Action--']); ?></div>
							<label class="col-sm-2">Remarks </label>
							<div class="col-sm-4"><?php echo $this->Form->textarea('remarks', ['id' => 'remarks', 'label' => false, 'placeholder' => 'Remarks', 'class' => 'form-control', 'autocomplete' => 'off']); ?></div>
						</div>
						<hr />
						<div class="form-group row">
							<div class="col-sm-12"> <span class="float-left text-danger ">
									<h6>
										<?php echo $this->Form->checkbox('chkAgree', ['id' => 'chkAgree', 'hiddenField' => false, 'checked' => 'checked', 'disabled' => 'disabled']); ?>&nbsp;UID and Beneficiary address details are verified by BSO. </h6>
								</span>
							</div>
						</div>
						<div class="text-center">
							<?php
							if ($group_id == 20) {
								echo $this->Form->button(__('Send Request to DSO'), ['class' => 'btn btn-success btn-md', 'name' => 'submit', 'value' => 'approve_reject', 'style' => 'margin-right:10px', 'id' => 'approve_reject']);
							} elseif ($group_id == 12) {
								echo $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-md', 'name' => 'submit', 'value' => 'approve_reject', 'style' => 'margin-right:10px', 'id' => 'approve_reject']);
							}
							echo  $this->Html->link("Back", "/SeccCardholders/applicationList/" . base64_encode(1), ["class" => "btn btn-warning text-white"]);
							?>
						</div>
					<?php } else {
						echo $this->Form->end(); ?>
						<div class="form-group bg-info text-center text-white">
							<b>Document Upload.</b>
						</div>
						<div class="form-group alert alert-danger text-center">
							Document Upload pending. Please upload complete documents to proceed.
						</div>

						<div class="card-body offset-md-1">

							<div class="form-group row">
								<span style="font-style:italic; font-weight:bold; color: #D40830" class="col-sm-11 pull-left alert alert-warning">&emsp;Note* : 1. Document should be in '.jpg'/'.png' format only.<br /> &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;2. Document size should not exceed 500 KB. </span></div>


							<?php if ($seccCardholderAddTemp->is_bank == 1 && $document_status->bank_doc == 0) { ?>

								<?php echo $this->Form->create($seccFamilyDocument, ['id' => 'document_dtl3', 'enctype' => 'multipart/form-data']);
								echo $this->Form->control('application_id', ['type' => 'hidden']); ?>
								<div class="form-group row">
									<label class="col-sm-3 col-form-label font-weight-bold " for="name">Bank Passbook : </label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('bank_passbook', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"pssbook_errorspan")']); ?><span id="pssbook_errorspan" style="font-weight:bold; color: red;"></span>
									</div>
									<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_passbook", "value" => "upload_passbook", "name" => "upload"]); ?></div>
									<?php if (array_key_exists("13", $SeccFamilyDocuments)) {
										$document_path = DOC_ABS_PATH . $seccCardholderAddTemp->rgi_district_code . DS . $seccCardholderAddTemp->ack_no . DS . h($SeccFamilyDocuments['13']);
										if (!file_exists($document_path)) {
											$document_path = "img/fnf.jpg";
										} ?>
										<div class="col-sm-2">
											<a href="" id="view_passbook" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
										</div>
									<?php } ?>
								</div>
								<?= $this->Form->end() ?>
							<?php } ?>
							<?php if ($seccCardholderAddTemp->caste_id == 3 || $seccCardholderAddTemp->caste_id == 4 || $seccCardholderAddTemp->caste_id == 7) {
								echo $this->Form->create($seccFamilyDocument, ['id' => 'document_dtl2', 'enctype' => 'multipart/form-data']);
								echo $this->Form->control('application_id', ['type' => 'hidden']); ?>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label font-weight-bold " for="name">Caste Certificate : </label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('caste_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"caste_errorspan")']); ?><span id="caste_errorspan" style="font-weight:bold; color: red;"></span>
									</div>
									<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_caste", "value" => "upload_caste", "name" => "upload"]); ?></div>
									<?php if (array_key_exists("14", $SeccFamilyDocuments)) {
										$document_path = DOC_ABS_PATH . $seccCardholderAddTemp->rgi_district_code . DS . $seccCardholderAddTemp->ack_no . DS . h($SeccFamilyDocuments['14']);
										if (!file_exists($document_path)) {
											$document_path = "img/fnf.jpg";
										} ?>
										<div class="col-sm-2">
											<a href="" id="view_caste" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
										</div>
									<?php } ?>
								</div>
							<?php echo  $this->Form->end();
							} ?>

							<?php if ($seccCardholderAddTemp->disability_status == 1 && $document_status->disablility_doc == 0) {
								echo $this->Form->create($seccFamilyDocument, ['id' => 'document_dtl4', 'enctype' => 'multipart/form-data']);
								echo $this->Form->control('application_id', ['type' => 'hidden']); ?>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label font-weight-bold " for="name">Disability Certificate : </label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('disability_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"disability_errorspan")']); ?><span id="disability_errorspan" style="font-weight:bold; color: red;"></span>
									</div>
									<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_disability", "value" => "upload_disability", "name" => "upload"]); ?></div>
									<?php if (array_key_exists("16", $SeccFamilyDocuments)) {
										$document_path = DOC_ABS_PATH . $seccCardholderAddTemp->rgi_district_code . DS . $seccCardholderAddTemp->ack_no . DS . h($SeccFamilyDocuments['16']);
										if (!file_exists($document_path)) {
											$document_path = "img/fnf.jpg";
										} ?>
										<div class="col-sm-2">
											<a href="" id="view_disability" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
										</div>
									<?php } ?>
								</div>
							<?php echo  $this->Form->end();
							} ?>

							<?php if ($seccCardholderAddTemp->health_status == 1 && $document_status->health_doc == 0) {
								echo $this->Form->create($seccFamilyDocument, ['id' => 'document_dtl5', 'enctype' => 'multipart/form-data']);
								echo $this->Form->control('application_id', ['type' => 'hidden']); ?>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label font-weight-bold " for="name">Health Certificate : </label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('health_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"health_errorspan")']); ?><span id="health_errorspan" style="font-weight:bold; color: red;"></span>
									</div>
									<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit", "id" => "upload_caste", "value" => "upload_health", "name" => "upload"]); ?></div>
									<?php if (array_key_exists("15", $SeccFamilyDocuments)) {
										$document_path = DOC_ABS_PATH . $seccCardholderAddTemp->rgi_district_code . DS . $seccCardholderAddTemp->ack_no . DS . h($SeccFamilyDocuments['15']);
										if (!file_exists($document_path)) {
											$document_path = "img/fnf.jpg";
										} ?>
										<div class="col-sm-2">
											<a href="" id="view_health" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class=" btn btn-xs btn-info">View</a>
										</div>
									<?php } ?>
								</div>
							<?php echo  $this->Form->end();
							} ?>
							<?php if ($seccCardholderAddTemp->marital_status == 1 && $document_status->death_doc == 0) {
								echo $this->Form->create($seccFamilyDocument, ['id' => 'document_dtl6', 'enctype' => 'multipart/form-data']);
								echo $this->Form->control('application_id', ['type' => 'hidden']); ?>

								<div class="form-group row">
									<label class="col-sm-3 col-form-label font-weight-bold " for="name">Death Certificate : </label>
									<div class="col-sm-4">
										<?php echo $this->Form->control('death_certificate', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"death_errorspan")']); ?><span id="death_errorspan" style="font-weight:bold; color: red;"></span>
									</div>
									<div class="col-sm-2"><?php echo $this->Form->button("Upload", ["class" => "btn btn-warning", "type" => "submit",  "value" => "upload_death", "name" => "upload"]); ?></div>
									<?php if (array_key_exists("17", $SeccFamilyDocuments)) {
										$document_path = DOC_ABS_PATH . $seccCardholderAddTemp->rgi_district_code . DS . $seccCardholderAddTemp->ack_no . DS . h($SeccFamilyDocuments['17']);
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
							<?php							
							echo  $this->Html->link("Back", "/SeccCardholders/applicationList/" . base64_encode(1), ["class" => "btn btn-warning text-white"]);
							?>
						</div>

					<?php } ?>

					<div class="text-center">
						<?php
						echo $this->Form->control('application_id', ['type' => 'hidden']);
						echo $this->Form->control('secc_cardholder_add_temp_id', ['type' => 'hidden']);
						?>

						<?= $this->Form->end() ?>
					</div>

				<?php } ?>



			</div>
		</div>
	<?php } else {
		echo '<div class="alert alert-danger">Unable to display details of application. Something went wrong!!!</div>';
	} ?>
</div>
<script type="text/javascript">
	function verify_member(action) {
		var secc_cardholder_add_temp_id = $(this).val();
		alert(secc_cardholder_add_temp_id);
		return false;
	}

	function validateFile(component, errorspan) {
		validateFileExtension(component, errorspan, "Please provide document in  .jpg/.png format only!!!.", new Array("jpg", "jpeg", "png"));
		validateFileSize(component, errorspan, "File size should not be greater than 500 KB!!!.", "500000"); //2097152 Byte = 2MB; 500000 Byte = 500 Kb
	}

	function checkdoc() {
		var i = new Array();
		if (!$('#view_aadhar').length) {
			i.push("document_dtl1");
		}
		if (i.length === 0) {
			return true;
		} else {
			$.each(i, function(index, value) {
				$("#" + value + "").valid();
			});
			return false;
		}
		return false;
	}

$(document).ready(function(){
  $('form').on("submit", function(){
    $("#pageloader").fadeIn();
  });//submit
});//document ready
</script>