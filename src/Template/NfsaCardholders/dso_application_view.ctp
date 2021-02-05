<?php

use Cake\Core\Configure;

$applicationType = Configure::read('applicationType');
$gender = Configure::read('gender');
$disability_status = Configure::read('disability_status');
$health_status = Configure::read('health_status');
$marital_status = Configure::read('marital_status');
?><script type="text/javascript">
	$(document).ready(function() {
		$("#dso_application_view").validate({
			rules: {
				action: "required",
				//remarks: "required",
			},
			messages: {
				action: "Please select action ",
				//remarks: "Please enter Remarks",
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

		$('#upload_aadhar').click(function() {
			$("#application_view").valid();

		});

	});
</script>
<script>
    function send(Id, obj) {
        document.getElementById("nfsa-cardholder-add-temp-id").value = Id;
			document.getElementById("submitForm").submit();
    }

</script>
<?= $this->Flash->render() ?>
<?php echo $this->Form->create(null, ['id' => 'dso_application_view']) ?>
<?php if (!empty($seccCardholderAddTemp)) { ?>
	<div class="card">
		<div class="card-body">
			<div class="card-header bg-secondary text-white text-center font-weight-bold">Request For:- New Application for Ration Card </div>
			<div class="card-body">

				<div class="card-body" id="printDiv">
					<div class="form-group row">
						<div class="col-sm-12 text-center">
							<h4><strong>Acknowledgement No : </strong><span style="color:#009933"><?php echo $seccCardholderAddTemp['ack_no']; ?></span></h4>

						</div>

					</div>

					<div class="form-group bg-info text-center text-white">
						<b>Ration Card Details</b></p>
					</div>

					<div class="table-responsive">
						<table class="table table-bordered">

						<tbody>
												<tr>
													<td style="width:15%;text-align:left"> &#2344;&#2366;&#2350; : </td>
													<td style="width:35%;text-align:left"> <b><?php echo $seccCardholderAddTemp['name']; ?> </b> </td>

													<td style="width:15%;text-align:left"> &#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350; : </td>
													<td style="width:35%;text-align:left"> <b><?php echo  $seccCardholderAddTemp['fathername']; ?></b> </td>
												</tr>

												<tr>
													<td style="width:15%;text-align:left">&#2332;&#2367;&#2354;&#2366; : </td>
													<td style="width:35%;text-align:left"><b><?php echo $districtName; ?></b></td>

													<td style="width:15%;text-align:left">&#2346;&#2381;&#2352;&#2326;&#2339;&#2381;&#2337; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $blockName; ?></b></td>


												</tr>

												<tr>
													<td style="width:15%;text-align:left">&#2346;&#2306;&#2330;&#2366;&#2351;&#2340; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $panchayatName;?></b></td>
													<td style="width:15%;text-align:left">&#2327;&#2381;&#2352;&#2366;&#2350; :</td>
													<td style="width:35%;text-align:left"><b><?php echo  $villName; ?></b></td>

												</tr>
												<tr>
													<td style="width:15%;text-align:left">&#2357;&#2367;&#2340;&#2352;&#2325; &#2325;&#2366; &#2344;&#2366;&#2350; :
													</td>
													<td style="width:35%;text-align:left"><b><?php echo  $dealerName;  ?></b></td>
													<td style="width:15%;text-align:left">&#2350;&#2379;&#2348;&#2366;&#2311;&#2354; &#2344;&#2306;&#2406; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $seccCardholderAddTemp['requested_mobile']; ?></b></td>
												</tr>

												<tr>
													<td style="width:15%;text-align:left"> &#2337;&#2368;&#2354;&#2352; &#2354;&#2366;&#2311;&#2360;&#2375;&#2306;&#2360; &#2344;&#2306;&#2406; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $license_no; ?> </b> </td>
													<td style="width:15%;text-align:left">&#2325;&#2366;&#2352;&#2381;&#2337; &#2325;&#2366; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352; :</td>
													<td style="text-align:left"><b><?php echo $cardName; ?></b></td>

												</tr>
										
								
											
					<!------------------------------------------------------------------>
									<tr>
								<td colspan="4">
								<label class="col-sm-10 col-form-label required font-weight-bold" for="name">निम्नवर्णित समावेशन मानक के आधार पर मैं एक सुपात्र आवेदक हूँ: </label><br>
									<?php $i = 0;
								
									foreach ($inclusion_criterias as $inclusion)
									{
									    $key = $inclusion->cardholder_col;
										 
									    // echo $key.'--'.$cardholder->$key;
									    if (($cardholder->$key != '') && $cardholder->$key == '1')
									    {
									        $check = 'checked';
									    }
									    else
									    {
									        if ($hof_gender->gender_id == 3 && $key == 'marital_status')
									        {
									            $check = 'checked';
									        }
									        else
									        {
									            $check = '';
									        }
									    }
									    echo $this->Form->checkbox('inclusion_criteria.' . $inclusion->cardholder_col, ['class' => 'inclusion_criteria', 'id' => 'inclusion_criteria' . $inclusion->id, 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
									    $i++;
									}
									if ($cardholder->getErrors('applicationType_rule_id'))
									{
									    foreach ($cardholder->getErrors('applicationType_rule_id') as $key => $value)
									    {
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
											3. मैं और मेरे परिवार के पास पांच एकड़ से अधीक सिंचित भूमी अथवा दस एकड़ से असिंचित भूमी नहीं है,
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
					<!------------------------------------------------------------------>
							</tbody>
						</table>
					</div>
					<?php
					if ($seccCardholderAddTemp['is_lpg'] == '1' || $seccCardholderAddTemp['is_bank'] == '1') { ?>
						<div class="form-group bg-info text-center text-white">
							<b>LPG Connection and Bank Details</b></p>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td>Lpg Consumer No.</td>
									<td><?= ($seccCardholderAddTemp['is_lpg'] == 1) ? $seccCardholderAddTemp['lpg_consumer_no'] : 'NA'; ?></td>
								</tr>
								<tr>
									<td>Bank Account No.</td>
									<td><?= ($seccCardholderAddTemp['is_bank'] == 1) ? $seccCardholderAddTemp['bank_account_no'] : 'NA'; ?></td>
								</tr>
								<tr>
									<td>Bank Name</td>
									<td><?= ($seccCardholderAddTemp['is_bank'] == 1) ? $bankName : 'NA'; ?></td>
								</tr>
								<tr>
									<td>Branch Name</td>
									<td><?= ($seccCardholderAddTemp['is_bank'] == 1) ? $branchName : 'NA'; ?></td>
								</tr>
								<tr>
									<td>IFSC Code.</td>
									<td><?= ($seccCardholderAddTemp['is_bank'] == 1) ? $seccCardholderAddTemp['bank_ifsc_code'] : 'NA'; ?></td>
								</tr>

								<tbody>
								</tbody>
							</table>
						</div>
					<?php } ?>

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
										<th>Verify</th>
									</tr>

								</thead>

								<?php

								$x = 1;
								//debug($seccCardholderAddTemp->secc_family_add_temps);
								foreach ($seccFamilyAddTemp as $families) :
								?>
									<tbody>
										<tr>
											<td style="width:10%;text-align:left"> <?php echo $x++;  ?> </td>
											<td><?php echo $families->name_sl; ?> </td>
											<td><?php if ($families->gender_id != '')
								{
								    echo $gender[$families->gender_id];
								}
								else
								{
								    echo 'NA';
								} ?> </td>
											<td><?php
												$from = new DateTime($families->dob);
												$to   = new DateTime('today');
												echo $from->diff($to)->y;
												?> </td>
											<td><?php echo $families->fathername_sl; ?> </td>
											<td><?php if ($families->relation_id)
												{
												    echo $Relations[$families->relation_id];
												}
												else
												{
												    if ($families->hof == 1)
												    {
												        echo 'HEAD OF FAMILY';
												    }
												} ?>
											</td>
											<td><?php if (!empty($families->uid))
												{
												    echo h($families->uid);
												}
												else
												{
												    echo 'N/A';
												} ?>
											</td>
											<td> <?php if (!empty($families->mobile))
												{
												    echo h($families->mobile);
												}
												else
												{
												    echo 'N/A';
												} ?>
											</td>
											<td><?php if (isset($families->disability_status))
												{
												    echo $disability_status[$families->disability_status];
												}
												else
												{
												    echo 'NA';
												} ?></td>
											<td><?php if (isset($families->marital_status))
												{
												    echo $marital_status[$families->marital_status];
												}
												else
												{
												    echo 'NA';
												} ?></td>
											<td><?php if (isset($families->health_status))
												{
												    echo $health_status[$families->health_status];
												}
												else
												{
												    echo 'NA';
												} ?></td>
											 <td><?php
													foreach ($SeccFamilyDocumentAddTemps as $doc)
													{
													    if ($families->id==$doc->nfsa_family_add_temp_id)
													    {
													        $document_path = DOC_NFSA_PATH . $rgi_district_code . DS .$ack_no . DS . h($doc->document);
													        if (!file_exists($document_path))
													        {
													            $document_path = "img/fnf.jpg";
													        }
													        else
													        {?>
													<a href="" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class="badge badge-pill badge-primary"><?= h($DocumentTypes[$doc->document_type_id]) ?></a>
													 <?php }
													    } ?>
													   
													
													<?php
													} ?>
													</td>
											<td><?php if ($families->uid_verified != 1)
													{
													    echo $this->Form->button(__('Verify'), ['class' => 'cancel btn btn-info btn-md', 'name' => 'submit', 'value' => 'verify', 'style' => 'margin-right:10px',"onclick" => "javascript:send('" . $families->id . "',this.id)"]);
													}
												else
												{
												    echo '<span class="badge badge-pill badge-success">UID Verified</span>';
												}?></td>
										</tr>
									</tbody>
								<?php endforeach; ?>
							</table>
						</div>
					<?php } if ($seccCardholderAddTemp['activity_flag'] == 1){?>
					<hr>
					<div class="form-group row">
						<label class="col-sm-2">Approve/Reject </label>
						<div class="col-sm-4"><?php echo $this->Form->select('action', ['3' => 'Approve', '4' => 'Reject'], ['class' => 'form-control', 'empty' => '--Select Action--']); ?></div>
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
						echo $this->Form->input('application_id', ['type' => 'hidden']);
						echo $this->Form->input('verify_id', ['type' => 'hidden']);
						echo $this->Form->input('nfsa_cardholder_add_temp_id', ['type' => 'hidden']);
						if ($group_id == 20)
						{
						    echo $this->Form->button(__('Send Request to DSO'), ['class' => 'btn btn-success btn-md', 'name' => 'submit', 'value' => 'approve_reject', 'style' => 'margin-right:10px','id'=>'approve_reject']);
						}
						elseif ($group_id == 12)
						{
						    echo $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-md', 'name' => 'submit', 'value' => 'approve_reject', 'style' => 'margin-right:10px','id'=>'approve_reject']);
						}
						}
						echo  $this->Html->link("Back", "/NfsaCardholders/applicationList/" . base64_encode(1), ["class" => "btn btn-warning text-white"]);
						?>

						<?= $this->Form->end() ?>
					</div>



				</div><!-- End Card Body -->
			</div><!-- End Card -->

		</div><!-- End Card Body -->
	</div><!-- End Card --><?php } ?>

