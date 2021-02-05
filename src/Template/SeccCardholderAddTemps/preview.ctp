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
 * @var \App\Model\Entity\SeccCardholderAddTemp $seccCardholderAddTemp
 */
?>

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
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/addFamily">
							<span class="current-info audible"> </span>
							<div class="title"><span class="number">4</span> <span class="title_text">Add Family Member</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/documentDetails"><span class="current-info audible"> </span>
							<div class="title"><span class="number">5</span> <span class="title_text">Upload Documents</span> </div>
						</a></li>
					<li role="tab" class="current last" aria-disabled="true"><a href="#" style="cursor: not-allowed;">
							<div class="title"><span class="number">6</span> <span class="title_text">Preview</span> </div>
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
											<h4><strong>Acknowledgement No : </strong><span style="color:#009933"><?= $seccCardholderAddTemp->ack_no ?></span></h4>

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
																$check = '';
															}
															echo $this->Form->checkbox('inclusion_criteria.' . $inclusion->cardholder_col, ['class' => 'inclusion_criteria', 'id' => 'inclusion_criteria', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
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
														if ($seccCardholderAddTemp->disability_check == 1) {
															$disability_check = "checked";
														} else {
															$disability_check = "";
														}
														if ($seccCardholderAddTemp->marital_check == 1) {
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
														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $pvtg_check]) . ' &nbsp;आदिम जनजाति परिवार (PVTG)<br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $marital_check]) . ' &nbsp;विधवा / परित्यकता/ (Transagender) <br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $disability_check]) . ' &nbsp;निःशक्त (40 प्रतिशत या इससे अधिक) <br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $health_check]) . ' &nbsp;कैंसर/ एड्स/ कुष्ठ/ अन्य असाध्य रोगों से ग्रसित व्यक्ति <br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $old_alone_check]) . ' &nbsp;अकेले रहने वाला वृद्ध/बुजुर्ग व्यक्ति/एकल परिवार <br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $st_check]) . ' &nbsp;अनुसूचित जनजाति <br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $sc_check]) . ' &nbsp;अनुसूचित जाती <br /><hr style="border-top: 2px dashed grey;">';

														echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $other_check]) . ' &nbsp;अन्यान्य  <br /><hr style="border-top: 2px dashed grey;">'; ?>
													</td>
												</tr>

												<tbody>
												</tbody>
											</table>
										</div>
									
									<?php
									if ($seccCardholderAddTemp->is_lpg == '1' || $seccCardholderAddTemp->is_bank == '1') { ?>
										<div class="form-group bg-info text-center text-white">
											<b>LPG Connection and Bank Details</b></p>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td>एलपीजी कनेक्शन</td>
													<td><?= ($seccCardholderAddTemp->is_lpg == 1) ? $lpg_connection[$seccCardholderAddTemp->lpg_company] : 'NA'; ?></td>
												</tr>
												<tr>
													<td>उपभोक्ता संख्या .</td>
													<td><?= ($seccCardholderAddTemp->is_lpg == 1) ? $seccCardholderAddTemp->lpg_consumer_no : 'NA'; ?></td>
												</tr>
												<tr>
													<td>खाता संख्या.</td>
													<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_account_no : 'NA'; ?></td>
												</tr>
												<tr>
													<td>बैंक का नाम</td>
													<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_master->name : 'NA'; ?></td>
												</tr>
												<tr>
													<td>लोकेशन</td>
													<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->branch_master->name : 'NA'; ?></td>
												</tr>
												<tr>
													<td>बैंक IFSC कोड.</td>
													<td><?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_ifsc_code : 'NA'; ?></td>
												</tr>

												<tbody>
												</tbody>
											</table>
										</div>
									<?php } ?>

									<?php if (!empty($seccCardholderAddTemp->secc_family_add_temps)) { ?>

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
														<th width="10%"> Disability </th>
														<th width="10%"> Marital Status </th>
														<th width="10%"> Incurable Disease </th>
														<th>Document</th>
													</tr>

												</thead>

												<?php

												$x = 1;
												//debug($seccCardholderAddTemp->secc_family_add_temps);
												foreach ($seccCardholderAddTemp->secc_family_add_temps as $families) :
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
																	$document_path = DOC_ABS_PATH . $families->rgi_district_code . DS . $families->ack_no_ercms. DS . h($doc->document);
																	if (!file_exists($document_path)) {
																		$document_path = "img/fnf.jpg";	
																	}
																	?>
																	<a href="" onclick="window.open('<?= $this->showFile($document_path) ?>','name','width=600,height=600'); return false;" class="badge badge-pill badge-primary"><?= h($doc->document_type->name_hn) ?></a>
																<?php } ?>
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