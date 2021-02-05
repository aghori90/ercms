<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholderAddTemp $seccCardholderAddTemp
 */
echo $this->Html->script("ration.js");
$this->Form->setTemplates([
    'inputContainer' => '<div class="form-group row">{{content}}</div>'
]);
// or remove completely
$this->Form->setTemplates([
    'inputContainer' => '{{content}}'
]);
echo $this->Html->script('keyboard');
echo $this->Html->css("keyboard.css");
?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#personal_details").validate({
            rules: {
                gender_id: "required",
                caste_id: "required",
                res_address: "required",
                res_address_hn: "required",
                tolla_mohalla: "required",
                mothername: {
                    //required: true,
                    minlength: {
						depends: function(element) {
							return ($("mothername").val() != '');
						},
						param: 3
					}
                },
                mothername_sl: {
                   // required: true,
                    minlength: {depends: function(element) {
							return ($("mothername_sl").val() != '');
						},
						param: 3
					}
            },
        },
            messages: {
                gender_id: "Please select gender.",
                caste_id: "Please select caste.",
                res_address: "Please enter Address.",
                res_address_hn: "Please enter Address in hindi.",
                tolla_mohalla: "Please enter Tolla/Mohalla.",
                mothername: {
                    //required: "Please enter your Mother's Name.",
                    minlength: "Mother's Name need to be at least 3 characters long."
                },
                mothername_sl: {
                    //required: "Please enter your Mother's Name in hindi.",
                    minlength: "Mother's Name need to be at least 3 characters long."
                },
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

            ignore: false,
        });
    });
</script>
<style>
	option{
		width: 500px;
	}
</style>

<main id="main">
<!-- ======= Main Section ======= -->
    <section class="section">
    	<div class="container">
			<?php
				$percentage = round((($seccCardholderAddTemp->application_status) / 7) * 100);
			?>
			<div class="progress">
				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%"><span class="text-white" style="font-size:15px"><strong><?= $percentage ?>%</strong></span>
				</div>
			</div>

			<div class="steps clearfix">
				<ul role="tablist">
					<li role="tab" class="current" aria-disabled="true">
						<a id="signup-form-t-2" href="#" aria-controls="signup-form-p-2">
							<div class="title">
								<span class="number">1</span>
								<span class="title_text">Personal Details</span>
							</div>
						</a>
					</li>
					<li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
						<a href="#" style="cursor: not-allowed;">
							<span class="current-info audible"> </span>
							<div class="title">
								<span class="number">2</span>
								<span class="title_text">Bank Details</span>
							</div>
						</a>
					</li>
					<li role="tab" class="disabled" aria-disabled="false" aria-selected="false">
						<a href="#" style="cursor: not-allowed;">
							<div class="title">
								<span class="number">3</span>
								<span class="title_text">Additional Details</span>
							</div>
						</a>
					</li>
					<li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
						<a href="#" style="cursor: not-allowed;">
							<span class="current-info audible"></span>
							<div class="title">
								<span class="number">4</span>
								<span class="title_text">Add Family Member</span>
							</div>
						</a>
					</li>
					<li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
						<a href="#" style="cursor: not-allowed;">
							<span class="current-info audible"> </span>
							<div class="title">
								<span class="number">5</span>
								<span class="title_text">Upload Documents</span>
							</div>
						</a>
					</li>					
					<li role="tab" class="disabled last" aria-disabled="true">
						<a href="#" style="cursor: not-allowed;">
							<div class="title">
								<span class="number">6</span>
								<span class="title_text">Preview</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		<br>
		<?= $this->Flash->render() ?>
			<div class="row justify-content-center" data-aos="fade-up">

				<div class="col-lg-12">
					<?php echo $this->Form->create($seccCardholderAddTemp, ['id' => 'personal_details']) ?>
					<div class="card">
						<div class="card-body">
							<div class="card-header bg-secondary text-white">
								<span class="h4">&#2357;&#2381;&#2351;&#2325;&#2381;&#2340;&#2367;&#2327;&#2340; &#2332;&#2366;&#2344;&#2325;&#2366;&#2352;&#2368; </span>
								<span class="h5 text-white">( &#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2375; &#2350;&#2369;&#2326;&#2367;&#2351;&#2366; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339; *)</span>
							</div>
							<div class="card-body offset-md-2">
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2332;&#2367;&#2354;&#2366; : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->secc_district->name; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2348;&#2381;&#2354;&#2377;&#2325; / &#2344;&#2327;&#2352; &#2346;&#2366;&#2354;&#2367;&#2325;&#2366; : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->secc_block->name; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2327;&#2366;&#2305;&#2357;/&#2357;&#2366;&#2352;&#2381;&#2337; : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->secc_village_ward->name; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2344;&#2366;&#2350;(English) : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->name; ?>
									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2344;&#2366;&#2350;(&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;) : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->name_sl; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350;(English) : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->fathername; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2346;&#2367;&#2340;&#2366; / &#2346;&#2340;&#2367; &#2325;&#2366; &#2344;&#2366;&#2350; (&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;) : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->fathername_sl; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2350;&#2379;&#2348;&#2366;&#2311;&#2354; &#2344;&#2306;&#2348;&#2352; : </label>
									<div class="col-sm-6">
										<?php echo $seccCardholderAddTemp->mobileno; ?>
									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2354;&#2367;&#2306;&#2327; : </label>
									<div class="col-sm-6">
										<?php echo $this->Form->control("gender_id", ["class" => "form-control form-control-sm", "options" => ["1" => "Male", "2" => "Female", "3" => "Other"], "label" => false, "empty" => "Select Gender"]); ?>
									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2357;&#2352;&#2381;&#2327; : </label>
									<div class="col-sm-6">
										<?php echo $this->Form->control("caste_id", ["options" => $castes, "class" => "form-control form-control-sm", "label" => false, "empty" => "Select Category"]); ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold" for="name">&#2350;&#2366;&#2305; &#2325;&#2366; &#2344;&#2366;&#2350;(English) : </label>
									<div class="col-sm-6">
										<?php echo $this->Form->control("mothername", ["onkeypress" => "return isAlphabets(event)", "class" => "form-control form-control-sm", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "style" => "text-transform:capitalize"]); ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label font-weight-bold" for="name">&#2350;&#2366;&#2305; &#2325;&#2366; &#2344;&#2366;&#2350; (&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;) : </label>
									<div class="col-sm-6">
										<?php //echo $this->Form->control("mothername_sl", ["class" => "form-control form-control-sm", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "id" => "mothername_sl"]); ?>
										<script language="javascript">
											CreateCustomHindiTextBox("mothername_sl", "<?php if($seccCardholderAddTemp->mothername_sl!=''){echo $seccCardholderAddTemp->mothername_sl;}?>", "form-control form-control-sm", true);
										</script>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold">क्या आप किसी भी प्रकार की विकलांगता से पीड़ित हैं ? : </label>
									<div class="col-sm-6">
										<?php echo  $this->Form->radio("disability_status", [["value" => "1", "text" => " हाँ", "label" => ["style" => "margin-right:25px;"], "id" => "disability_status-1"], ["value" => "0", "text" => " नहीं", "label" => ["style" => "margin-right:25px;"], "id" => "disability_status-0"]]); ?>
										<?php
										if (array_key_exists('disability_status', $seccCardholderAddTemp->getErrors())) {
											foreach ($seccCardholderAddTemp->getErrors()['disability_status'] as $key => $value) {
												echo '<div class="error-message">' . $value . '</div>';
											}
										} ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold">वैवाहिक स्थिति ? : </label>
									<div class="col-sm-6">
										<?php echo  $this->Form->radio("marital_status", [["value" => "1", "text" => " अविवाहित", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-1"], ["value" => "2", "text" => " विवाहित", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-2"], ["value" => "3", "text" => " विधवा", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-3"], ["value" => "4", "text" => " विधुर", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-4"], ["value" => "5", "text" => " तलाकशुदा", "label" => ["style" => "margin-right:25px;"], "id" => "marital_status-5"]]); ?>
										<?php
										if (array_key_exists('marital_status', $seccCardholderAddTemp->getErrors())) {
											foreach ($seccCardholderAddTemp->getErrors()['marital_status'] as $key => $value) {
												echo '<div class="error-message">' . $value . '</div>';
											}
										} ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold">क्या आप कैंसर / एड्स/ कुष्ठ /अन्य असाध्य रोगों से ग्रसित हैं ? : </label>
									<div class="col-sm-6">
										<?php echo  $this->Form->radio("health_status", [["value" => "1", "text" => " हाँ", "label" => ["style" => "margin-right:25px;"], "id" => "health_status-1"], ["value" => "0", "text" => " नहीं", "label" => ["style" => "margin-right:25px;"], "id" => "health_status-0"]]); ?>
										<?php
										if (array_key_exists('health_status', $seccCardholderAddTemp->getErrors())) {
											foreach ($seccCardholderAddTemp->getErrors()['health_status'] as $key => $value) {
												echo '<div class="error-message">' . $value . '</div>';
											}
										} ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">रोजगार : </label>
									<div class="col-sm-6"> <?php echo $this->Form->control("occupationId", ["options" =>["1"=>"Government Employee","6"=>"भिखारी या गृहविहीन","7"=>"Rag Picker / Sweeper","8"=>"Construction Worker/Mason/Unskilled Labour/Domestic Worker/Coolie and other head load worker/Rickshaw Puller/Thela Puller","9"=>"Street Vendor/Hawker/Peon in Small Establishment/Security Guard/Painter/Welder/Electrician/Mechanic/Tailor/Plumber/Mali/Washermen/cobbler","0"=>"None of these"], "label" => false,"div" => false, "class" => "form-control form-control-sm select", "empty" => "Select Employment"]); ?> </div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2328;&#2352; &#2325;&#2366; &#2346;&#2340;&#2366; : </label>
									<div class="col-sm-6">
										<?php echo $this->Form->control("res_address", ["class" => "form-control form-control-sm", "onkeypress" => "return isAddress(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off"]); ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2335;&#2379;&#2354;&#2366; / &#2350;&#2379;&#2361;&#2354;&#2381;&#2354;&#2366; : </label>
									<div class="col-sm-6">
										<?php echo $this->Form->control("tolla_mohalla", ["class" => "form-control form-control-sm", "onkeypress" => "return isAlphabets(event)", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off"]); ?>
									</div>
								</div>

							</div>
							<hr />

							<div class="text-center">
							<?php 
								echo $this->Form->button(__("Save Draft"), ["class" => "btn btn-success"]);
								if ($seccCardholderAddTemp->application_status >= 2){
									echo '&emsp;'.$this->Html->link("Next","/SeccCardholderAddTemps/bankDetails/",["class"=>"btn btn-info text-white"]);
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
