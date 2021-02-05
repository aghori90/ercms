<?php

use Cake\Core\Configure;

$applicationType = Configure::read('applicationType');
$gender = Configure::read('gender');
$disability_status = Configure::read('disability_status');
$health_status = Configure::read('health_status');
$marital_status = Configure::read('marital_status');
$lpg_connection = Configure::read('lpg_connection');
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaCardholderTemp $nfsaCardholderTemp
 */
?>

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
					<li role="tab" class="done" aria-disabled="false" aria-selected="false"><a href="<?= $baseurl ?>NfsaCardholderTemps/additionalDetails">
							<div class="title"><span class="number">3</span> <span class="title_text">Additional Details</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>NfsaCardholderTemps/addFamily">
							<span class="current-info audible"> </span>
							<div class="title"><span class="number">4</span> <span class="title_text">Add Family Member</span> </div>
						</a></li>
					<li role="tab" class="current last" aria-disabled="true"><a href="#" style="cursor: not-allowed;">
							<div class="title"><span class="number">5</span> <span class="title_text">Preview</span> </div>
						</a></li>
				</ul>
			</div>
			<br />
			<?= $this->Flash->render() ?>
			<div class="row justify-content-center" data-aos="fade-up">
				<div class="col-lg-12">
					<?php echo $this->Form->create(false, ['id' => 'add_ration']) ?>
					<div class="card">
						<div class="card-body">
							<div class="card-header bg-secondary text-white text-center font-weight-bold">Preview Application </div>
							<div class="card-body">

								<div class="card-body" id="printDiv">
									<div class="form-group row">
										<div class="col-sm-12 text-center">
											<h4><strong>Acknowledgement No : </strong><span style="color:#009933"><?= $nfsaCardholderTemp->ack_no ?></span></h4>

										</div>

									</div>

									<div class="form-group bg-info text-center text-white">
										<b>&#2350;&#2369;&#2326;&#2367;&#2351;&#2366; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</b></p>
									</div>

									<div class="table-responsive">
										<table class="table table-bordered">

											<tbody>
												<tr>
													<td style="width:15%;text-align:left"> &#2344;&#2366;&#2350; : </td>
													<td style="width:35%;text-align:left"> <b><?php echo $nfsaCardholderTemp->name_sl; ?> </b> </td>

													<td style="width:15%;text-align:left"> &#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350; : </td>
													<td style="width:35%;text-align:left"> <b><?php echo  $nfsaCardholderTemp->fathername_sl; ?></b> </td>
												</tr>

												<tr>
													<td style="width:15%;text-align:left">&#2332;&#2367;&#2354;&#2366; : </td>
													<td style="width:35%;text-align:left"><b><?php echo $nfsaCardholderTemp->secc_district->name; ?></b></td>

													<td style="width:15%;text-align:left">&#2346;&#2381;&#2352;&#2326;&#2339;&#2381;&#2337; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $nfsaCardholderTemp->secc_block->name; ?></b></td>


												</tr>

												<tr>
													<td style="width:15%;text-align:left">&#2346;&#2306;&#2330;&#2366;&#2351;&#2340; :</td>
													<td style="width:35%;text-align:left"><b><?php if ($nfsaCardholderTemp->panchayat_id != '') {
																									echo  $nfsaCardholderTemp->panchayat->name;
																								} else {
																									echo 'NA';
																								} ?></b></td>
													<td style="width:15%;text-align:left">&#2327;&#2381;&#2352;&#2366;&#2350; :</td>
													<td style="width:35%;text-align:left"><b><?php //echo  $nfsaCardholderTemp->secc_village_ward->name; 
																								?></b></td>

												</tr>
												<tr>
													<td style="width:15%;text-align:left">&#2357;&#2367;&#2340;&#2352;&#2325; &#2325;&#2366; &#2344;&#2366;&#2350; :
													</td>
													<td style="width:35%;text-align:left"><b><?php echo  $nfsaCardholderTemp->dealer->name;  ?></b></td>
													<td style="width:15%;text-align:left">&#2350;&#2379;&#2348;&#2366;&#2311;&#2354; &#2344;&#2306;&#2406; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $nfsaCardholderTemp->mobileno; ?></b></td>
												</tr>

												<tr>
													<td style="width:15%;text-align:left"> &#2337;&#2368;&#2354;&#2352; &#2354;&#2366;&#2311;&#2360;&#2375;&#2306;&#2360; &#2344;&#2306;&#2406; :</td>
													<td style="width:35%;text-align:left"><b><?php echo $nfsaCardholderTemp->dealer->License_no; ?> </b> </td>
													<td style="width:15%;text-align:left">&#2325;&#2366;&#2352;&#2381;&#2337; &#2325;&#2366; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352; :</td>
													<td style="text-align:left"><b><?php echo $nfsaCardholderTemp->cardtype->name; ?></b></td>

												</tr>
												<!-- <tr>
													<td colspan="4">
														<label class="col-sm-10 col-form-label required font-weight-bold" for="name">निम्नवर्णित समावेशन मानक के आधार पर मैं एक सुपात्र आवेदक हूँ (प्रासंगिक कोष्ठक में लगाएं ) : </label><br>
														<?php $i = 0;
														//debug($inclusion_criterias);
														foreach ($inclusion_criterias as $inclusion) {
															$key = $inclusion->cardholder_col;
															if (($nfsaCardholderTemp->applicationType_rule_id != '') && $nfsaCardholderTemp->applicationType_rule_id == '1') {
																$check = 'checked';
															} else {
																$check = '';
															}
															echo $this->Form->checkbox('inclusion_criteria.' . $inclusion->cardholder_col, ['class' => 'inclusion_criteria', 'id' => 'inclusion_criteria', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
															$i++;
														}
														?>
													</td>
												</tr>
												<tr> -->
												<td colspan="4">
													<?php if ($nfsaCardholderTemp->applicationType != '' && $nfsaCardholderTemp->applicationType == 1) { ?>
													<?php $i = 0;
														foreach ($exclusion_criterias as $exclusion) {
															echo $this->Form->checkbox('exclusion_criteria[' . $exclusion->id . '].' . $i, ['value' => $exclusion->id, 'hiddenField' => false, 'disabled' => 'disabled', 'checked' => true]) . ' ' . $exclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
															$i++;
														}
													} else {
														$i = 0;
														foreach ($inclusion_criterias as $inclusion) {
															if (($nfsaCardholderTemp->applicationType_rule_id != '') && $nfsaCardholderTemp->applicationType_rule_id == $inclusion->id) {
																$check = 'checked';
															} else {
																$check = '';
															}
															echo $this->Form->checkbox('applicationType_rule_id', ['class' => 'applicationType_rule_id', 'id' => 'applicationType_rule_id', 'value' => $inclusion->id, 'hiddenField' => false, "disabled" => "disabled", "checked" => $check]) . ' ' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
															$i++;
														}
													} ?>
												</td>
												</tr>
												<!-- <tr>
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
												</tr> -->
											</tbody>
										</table>
									</div>


									<div class="form-group bg-info text-center text-white">
										<b>LPG Connection and Bank Details</b></p>
									</div>
									<div class="table-responsive">
										<table class="table table-bordered">
											<tr>
												<td>एलपीजी कनेक्शन</td>
												<td><?= ($nfsaCardholderTemp->is_lpg == 1) ? $lpg_connection[$nfsaCardholderTemp->lpg_company] : 'NA'; ?></td>
											</tr>
											<tr>
												<td>उपभोक्ता संख्या .</td>
												<td><?= ($nfsaCardholderTemp->is_lpg == 1) ? $nfsaCardholderTemp->lpg_consumer_no : 'NA'; ?></td>
											</tr>
											<tr>
												<td>खाता संख्या.</td>
												<td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->bank_account_no : 'NA'; ?></td>
											</tr>
											<tr>
												<td>बैंक का नाम</td>
												<td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->bank_master->name : 'NA'; ?></td>
											</tr>
											<tr>
												<td>लोकेशन</td>
												<td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->branch_master->name : 'NA'; ?></td>
											</tr>
											<tr>
												<td>बैंक IFSC कोड.</td>
												<td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->bank_ifsc_code : 'NA'; ?></td>
											</tr>

											<tbody>
											</tbody>
										</table>
									</div>

									<?php if (!empty($nfsaFamilyMember)) { ?>

										<div class="form-group bg-info text-center text-white">
											<b>&#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2375; &#2360;&#2342;&#2360;&#2381;&#2351;&#2379;&#2306; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</b></p>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th style="width:10%;text-align:left">क्र० सं०</th>
														<th width="20%">परिवार के सदस्य का नाम</th>
														<th width="10%">लिंग</th>
														<th width="10%">उम्र</th>
														<th width="20%">पिता / पति का नाम</th>
														<th width="10%">मुखिया के साथ सम्बंध</th>
														<th width="10%">आधार सं०</th>
														<th width="10%">मोबाइल सं०</th>
													</tr>

												</thead>

												<?php

												$x = 1;
												//debug($seccCardholderAddTemp->secc_family_add_temps);
												foreach ($nfsaFamilyMember as $families) :
												?>
													<tbody>
														<tr>
															<td style="width:10%;text-align:left"> <?php echo $x++;  ?> </td>
															<td><?php echo $families->name_sl; ?> </td>
															<td><?php if ($families->gender_id != '') {
																	echo $gender[$families->gender_id];
																} else {
																	echo 'NA';
																} ?> </td>
															<td><?php //$today = date('Y-m-d');
																$from = new DateTime($families->dob);
																$to   = new DateTime('today');
																echo $from->diff($to)->y;
																//echo  $today - $families->dob; 
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
														</tr>
													</tbody>
												<?php endforeach; ?>
											</table>
										</div>
									<?php } ?>
									<hr />
									<div class="form-group row">
										<div class="col-sm-12 "> <span class="float-left text-danger font-weight-bold">
												फार्म जमा करने के लिए कृपया चेकबॉक्स पर क्लिक करें |</span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 "> <span class="float-left ">
												<?php echo $this->Form->checkbox('chkAgree', ['onclick' => 'proceed(this.value)', 'id' => 'chkAgree', 'hiddenField' => false]); ?>&nbsp;&nbsp; मैं यह घोषित करता हूँ / करती हूँ कि मेरे द्वारा दी गई सभी सूचनाएं मेरे संज्ञान से सत्य एवं पूर्ण सही हैं | अगर दी गई सूचना गलत अथवा असत्य पाया जाता है तो मेरे ऊपर कानूनी कारवाई की जा सकती है |.</span>
										</div>
									</div>

									<div class="text-center">
										<?= $this->Form->button(__("Final Submit"), ["class" => "btn btn-success", "disabled" => true, "id" => "final_submit"]) ?>
										<?php //echo $this->Form->button(__("Final Submit"),["class"=>"btn btn-success","id"=>"savenext","value"=>"savenext","name"=>"Submit"]) 
										?>
										<?php //echo $this->Html->link("Final Submit","/SeccCardholders/ercmsRequest/",["class"=>"btn btn-success text-white"]);
										?>
										<?= $this->Form->end() ?>
									</div>



								</div><!-- End Card Body -->
							</div><!-- End Card -->
						</div><!-- End divcol-lg-12 -->
					</div><!-- End row justify-content-center -->
	</section><!-- End Section -->

</main><!-- End #main -->

<script type="text/javascript">
	function proceed(value) {
		if (document.getElementById("chkAgree").checked == true) {
			$('#final_submit').removeAttr("disabled", false);
		} else {
			$("#final_submit").attr("disabled", true);
			//document.getElementById('sendBtn'+value).style.backgroundColor = "#DDDF95";
		}
	}
</script>