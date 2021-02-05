<?php

use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
echo $this->Html->script("ration.js");
?>
<script>
	$().ready(function() {

		// validate signup form on keyup and submit
		$("#opadditional_dtl").validate({
			rules: {
				dealer_id: "required",
			},
			messages: {
				dealer_id: "Please select dealer",
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				if (element.is(":radio")) {
					error.appendTo(element.parent().parent());
				} else if (element.is(":checkbox")) {
					error.prependTo(element.parent().parent());
				} else {
					error.insertAfter(element);
				}
			},

		});

	});
</script>

<div class="steps clearfix">
				<ul role="tablist">
					<li role="tab" class="first done" aria-disabled="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/personalDetails">
							<div class="title"><span class="number">1</span> <span class="title_text">Personal Details</span> </div>
						</a></li>
					<li role="tab" class="done" aria-disabled="false" aria-selected="true"><a href="<?= $baseurl ?>SeccCardholderAddTemps/bankDetails"><span class="current-info audible"> </span>
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
<br>
<?= $this->Flash->render() ?>
<?php echo $this->Form->create($seccCardholderAddTemp, ["autocomplete" => "off", "id" => "opadditional_dtl"]) ?>

<div class="main-card mb-3 card">
    <div class="card">
    <div class="card-header bg-secondary text-white"> <span class="h4">&#2310;&#2357;&#2375;&#2342;&#2344; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</span> </div>

    <div class="card-body offset-md-2"> <br />
								<div class="form-group row">
									<label class="col-sm-10 col-form-label required font-weight-bold" for="name">निम्नवर्णित समावेशन मानक के आधार पर मैं एक सुपात्र आवेदक हूँ (प्रासंगिक कोष्ठक में लगाएं ) : </label>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										<?php $i = 0;
										foreach ($inclusion_criterias as $inclusion) {
											$key = $inclusion->cardholder_col;
											if (($seccCardholderAddTemp->$key != '') && ($seccCardholderAddTemp->$key == '1' || $seccCardholderAddTemp->$key == '3')) {
												$check = 'checked';
											} else {
												if ($hof_gender != '') {
													if ($hof_gender->gender_id == 3 && $key == 'marital_status') {
														$check = 'checked';
													} else {
														$check = '';
													}
												}else {
													$check = '';
												}
											}
											echo $this->Form->checkbox('inclusion_criteria.' . $inclusion->cardholder_col, ['class' => 'inclusion_criteria', 'id' => 'inclusion_criteria', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
											$i++;
										}
										?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-10 col-form-label required font-weight-bold" for="name">उपर्युक्त क्रम में निम्नवर्णित समावेशन मानक ( Exclusion Criteria ) के आधार पर पूर्ण सत्यनिष्ठान के साथ घोषणा करता/करती हूँ कि - </label>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										1. मैं और मेरे परिवार का कोई भी सदस्य , भारत सरकार /राज्य सरकार /केंद्र शासित प्रदेश या इनके परिषद /उधम/प्रक्रम /उपक्रम/अन्य स्वयत निकाय जैसे विश्वविद्यालय इत्यादि/नगर निगम/नगर पषर्द/नगरपालिका/न्यास इत्यादि में नियोजित/सेवानिवृत नहीं है,
										<hr style="border-top: 2px dashed grey;">
									</div>

								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										2. मैं और मेरे परिवार का कोई भी सदस्य, आयकर/सेवा कर/व्यावसायिक कर/GST नहीं देता है,
										<hr style="border-top: 2px dashed grey;">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										3. मैं और मेरे परिवार के पास पांच एकड़ से अधीक सिंचित भूमी अथवा दस एकड़ से असिंचित भूमी नहीं है,
										<hr style="border-top: 2px dashed grey;">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										4. मैं और मेरे परिवार का किसी सदस्य के नाम से चार पहिया मोटर वाहन ( four wheeler ) अथवा इससे अधिक पहिया के वाहन नहीं है,
										<hr style="border-top: 2px dashed grey;">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										5. मैं और मेरे परिवार का कोई भी सदस्य सरकार द्वारा पंजीकृत उधम का स्वामी या संचालक नहीं है,
										<hr style="border-top: 2px dashed grey;">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										6. मैं और मेरे परिवार के पास पक्की दीवारों तथा छत्त के साथ तीन या इससे अधिक कमरों का पक्का मकान नहीं है, जो प्रधानमंत्री आवास योजना से अनाच्छादित है,
										<hr style="border-top: 2px dashed grey;">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10 ">
										7. मैं और मेरे परिवार के पास 5 लाख या इससे अधिक लागत ला मशीन चालित चार पहिये वाले कृषि उपकरण ( ट्रैक्टर, थ्रेसर इत्यादि ) नहीं है |
										<hr style="border-top: 2px dashed grey;">
									</div>
								</div>


								<!-- <div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2325;&#2366;&#2352;&#2381;&#2337; &#2325;&#2375; &#2346;&#2381;&#2352;&#2325;&#2366;&#2352; : </label>
									<div class="col-sm-6"> <?php echo $this->Form->control("cardtype_id", ["options" => $cardtypes, "label" => false, "class" => "form-control form-control-sm", "empty" => "Select Card Type"]); ?> </div>
								</div> -->
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2337;&#2368;&#2354;&#2352; : </label>
									<div class="col-sm-6"> <?php echo $this->Form->control("dealer_id", ["options" => $dealers, "label" => false, "class" => "form-control form-control-sm", "empty" => "Select Dealer"]); ?> </div>
								</div>

							</div>
							<hr />
							<div class="text-center mb_10">
								<?php
								echo  $this->Html->link("Previous", "/SeccCardholderAddTemps/opBankDetails/", ["class" => "btn btn-warning text-white"]);
								echo '&emsp;' . $this->Form->button(__("Save Draft"), ["class" => "btn btn-success"]);
								if ($seccCardholderAddTemp->application_status >= 4) {
									echo '&emsp;' . $this->Html->link("Next", "/SeccCardholderAddTemps/opAddFamily/", ["class" => "btn btn-info text-white"]);
                                } 
                                echo '&emsp;' . $this->Html->link("Cancel", "/SeccCardholderAddTemps/checkAcknowledgement/", ["class" => "btn btn-danger"]);?>
								<?= $this->Form->end() ?>
							</div>
       
    </div><!-- End Card -->
</div>
