<?php

use Cake\Core\Configure;

$applicationType = Configure::read('applicationType');
$gender = Configure::read('gender');

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
echo $this->Html->script("ration.js");
echo $this->Html->css("jquery-ui.css");
echo $this->Html->script('keyboard');
echo $this->Html->css("keyboard.css");
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#oppersonal").validate({
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
                //mobileno: "required",
                mobileno: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                dob: "required",
                uid: {
                    required: true,
                    minlength: 12,
                    maxlength: 12
                },
                rgi_district_code: "required",
                rgi_block_code: "required",
                rgi_village_code: "required",
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
                    minlength: {
                        depends: function(element) {
                            return ($("mothername_sl").val() != '');
                        },
                        param: 3
                    }
                },
                marital_status: "required",
                health_status: "required",
                disability_status: "required",
                occupationId: "required",
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
                mobileno: {
                    required: "Please enter Mobile No",
                    minlength: "Minimum length of mobile no should be 10 digits",
                    maxlength: "Maximum length of mobile no should be 10 digits"
                },
                dob: "Please enter Date of Birth.",
                uid: {
                    required: "Please enter UID No",
                    minlength: "Minimum length of UID No should be 12 digits",
                    maxlength: "Maximum length of UID No should be 12 digits"
                },
                rgi_district_code: "Please select District.",
                rgi_block_code: "Please select Block.",
                rgi_village_code: "Please select Village.",
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
                marital_status: "Please select Marital status.",
                health_status: "Please select Health status.",
                disability_status: "Please select Disability status",
                occupationId: "Please select Occupation",
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
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });


    });
</script>

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
<?php echo $this->Form->create($seccCardholderAddTemp, ["autocomplete" => "off", "id" => "oppersonal"]) ?>

<div class="main-card mb-3 card">
    <div class="card">
        <div class="card-header bg-secondary text-white text-center">Personal Details</div>

        <div class="form-group row mt_10">
            <div class="col-sm-12 text-center ">
                <h5><b>&#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2375; &#2350;&#2369;&#2326;&#2367;&#2351;&#2366; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</b></h5>
                <!-- <h6><b><span style="color:#009933">(&#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2368; &#2350;&#2369;&#2326;&#2367;&#2351;&#2366; &#2350;&#2361;&#2367;&#2354;&#2366; (&#2344;&#2381;&#2351;&#2370;&#2344;&#2340;&#2350; 18 &#2357;&#2352;&#2381;&#2359; &#2313;&#2350;&#2381;&#2352;) &#2361;&#2379; |)</span></b></h6> -->
            </div>
        </div>

        <div class="card-body offset-sm-2">
        <div class="form-group row">
                <label class="col-sm-4 required font-weight-bold" for="name">Acknowledgement No : </label>
                <div class="col-sm-6"><?php echo $seccCardholderAddTemp->ack_no; //$this->Form->control("name", ["label" => false, "placeholder" => "Enter Your Name", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "style" => "text-transform:capitalize"]); 
                                        ?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 required font-weight-bold" for="name">नाम(English)<br>[Name as in Aadhar Card] : </label>
                <div class="col-sm-6"><?php //echo $this->Form->control("name", ["label" => false, "placeholder" => "Enter Your Name", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "style" => "text-transform:capitalize"]); 
											if (array_key_exists('name', $seccCardholderAddTemp->getErrors())) {
											echo $seccCardholderAddTemp->invalid('name');
												foreach ($seccCardholderAddTemp->getErrors()['name'] as $key => $value) {
													echo '<div class="error-message">' . $value . '</div>';
												}
											}else{
												echo $seccCardholderAddTemp->name;
											} ?>
                                        </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4  required font-weight-bold" for="name">नाम(हिन्दी) : </label>
                <div class="col-sm-6"><?php //echo $seccCardholderAddTemp->name_sl; //$this->Form->control("name_sl", ["label" => false, "placeholder" => "Enter Your Name in Hindi", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "id" => "name_sl"]); 
                                        
											if (array_key_exists('name_sl', $seccCardholderAddTemp->getErrors())) {
											echo $seccCardholderAddTemp->invalid('name_sl');
												foreach ($seccCardholderAddTemp->getErrors()['name_sl'] as $key => $value) {
													echo '<div class="error-message">' . $value . '</div>';
												}
											}else{
												echo  $seccCardholderAddTemp->name_sl;
											}  ?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 required font-weight-bold">पिता / पति का नाम(English) : </label>
                <div class="col-sm-6"><?php //echo $seccCardholderAddTemp->fathername; //$this->Form->control("fathername", ["label" => false, "placeholder" => "Enter Your Father's Name", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "style" => "text-transform:capitalize"]); 
                                        if (array_key_exists('fathername', $seccCardholderAddTemp->getErrors())) {
											echo $seccCardholderAddTemp->invalid('fathername');
												foreach ($seccCardholderAddTemp->getErrors()['fathername'] as $key => $value) {
													echo '<div class="error-message">' . $value . '</div>';
												}
											}else{
												echo  $seccCardholderAddTemp->fathername;
											}  ?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold">पिता / पति का नाम (हिन्दी) : </label>
                <div class="col-sm-6"><?php //echo $seccCardholderAddTemp->fathername_sl; // $this->Form->control("fathername_sl", ["label" => false, "placeholder" => "Enter Your Father's Name in Hindi", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "id" => "fathername_sl"]); 
                                         if (array_key_exists('fathername_sl', $seccCardholderAddTemp->getErrors())) {
											echo $seccCardholderAddTemp->invalid('fathername_sl');
												foreach ($seccCardholderAddTemp->getErrors()['fathername_sl'] as $key => $value) {
													echo '<div class="error-message">' . $value . '</div>';
												}
											}else{
												echo  $seccCardholderAddTemp->fathername_sl;
											}  ?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold">जन्म तिथि : </label>
                <div class="col-sm-6"><?php //echo date('d-m-Y', strtotime($seccCardholderAddTemp->dob));
				 echo $this->Form->control("dob", ["type" => "text", "label" => false, "placeholder" => "dd/mm/yyyy", "class" => "form-control form_datetime", "readonly" => true]); 
                                        ?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold">मोबाइल नंबर : </label>
                <div class="col-sm-6 "><?php if ($seccCardholderAddTemp->mobileno != '') {
                                            echo $seccCardholderAddTemp->mobileno;
                                        } else {
                                            echo 'NA';
                                        } // $this->Form->control("mobileno", ["label" => false, "placeholder" => "Enter your Mobile No", "class" => "form-control", "onKeyPress" => "return isNumberKey(event)", "pattern" => "[6789][0-9]{9}", "maxlength" => "10", "onBlur" => "checkMobile(this); "]); 
                                        if (array_key_exists('mobileno', $seccCardholderAddTemp->getErrors())) {
											//echo $seccCardholderAddTemp->invalid('mobileno');
												foreach ($seccCardholderAddTemp->getErrors()['mobileno'] as $key => $value) {
													echo '<div class="error-message">' . $value . '</div>';
												}
											}?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold">आधार नंबर : </label>
                <div class="col-sm-6"><?php echo $seccCardholderAddTemp->uid; //$this->Form->control("uid", ["label" => false, "placeholder" => "Enter your Aadhar No", "class" => "form-control", "maxlength" => "12", "onkeyup" => "checkUID(this)"]);                                      
                                        if (array_key_exists('uid', $seccCardholderAddTemp->getErrors())) {
											//echo $seccCardholderAddTemp->invalid('uid');
												foreach ($seccCardholderAddTemp->getErrors()['uid'] as $key => $value) {
													echo '<div class="error-message">' . $value . '</div>';
												}
											}?></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">जिला : </label>
                <div class="col-sm-6">
                    <?php echo $seccCardholderAddTemp->districtName; // $this->Form->control("rgi_district_code", ["options" => $seccDistricts, "label" => false, "class" => "form-control", "empty" => "Select District", "id" => "rgi_district_code"]); 
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">ब्लॉक / नगर पालिका : </label>
                <div class="col-sm-6">
                    <?php echo $seccCardholderAddTemp->blockName; // $this->Form->control("rgi_block_code", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Block", "id" => "rgi_block_code"]); 
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">गाँव/वार्ड : </label>
                <div class="col-sm-6">
                    <?php echo $seccCardholderAddTemp->villageName; // $this->Form->control("rgi_village_code", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Village", "id" => "rgi_village_code"]); 
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2354;&#2367;&#2306;&#2327; : </label>
                <div class="col-sm-6">
                    <?php if ($seccCardholderAddTemp->gender_id != '') {
                        echo $gender[$seccCardholderAddTemp->gender_id];
                    } else {
                        echo 'NA';
                    } // $this->Form->control("gender_id", ["class" => "form-control form-control-sm", "options" => ["1" => "Male", "2" => "Female", "3" => "Other"], "label" => false, "empty" => "Select Gender"]); 
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold" for="name">&#2350;&#2366;&#2305; &#2325;&#2366; &#2344;&#2366;&#2350;(English) : </label>
                <div class="col-sm-6">
                    <?php // echo $seccCardholderAddTemp->mothername; 
					echo $this->Form->control("mothername", ["onkeypress" => "return isAlphabets(event)", "class" => "form-control form-control-sm", "label" => false, "size" => "100", "maxlength" => "100", "autocomplete" => "off", "style" => "text-transform:capitalize"]);   ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label font-weight-bold" for="name">&#2350;&#2366;&#2305; &#2325;&#2366; &#2344;&#2366;&#2350; (&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;) : </label>
                <div class="col-sm-6">
                    <script language="javascript">
							CreateCustomHindiTextBox("mothername_sl", "<?php if($seccCardholderAddTemp->mothername_sl!=''){echo $seccCardholderAddTemp->mothername_sl;}?>", "form-control form-control-sm", true);
					</script>
                </div>
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

            <div class="form-group row">
                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">&#2357;&#2352;&#2381;&#2327; : </label>
                <div class="col-sm-6">
                    <?php echo $this->Form->control("caste_id", ["options" => $castes, "class" => "form-control form-control-sm", "label" => false, "empty" => "Select Category"]); ?>
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
                <div class="col-sm-6"> <?php echo $this->Form->control("occupationId", ["options" => ["1" => "Government Employee", "6" => "भिखारी या गृहविहीन", "7" => "Rag Picker / Sweeper", "8" => "Construction Worker/Mason/Unskilled Labour/Domestic Worker/Coolie and other head load worker/Rickshaw Puller/Thela Puller", "9" => "Street Vendor/Hawker/Peon in Small Establishment/Security Guard/Painter/Welder/Electrician/Mechanic/Tailor/Plumber/Mali/Washermen/cobbler", "0" => "None of these"], "label" => false, "div" => false, "class" => "form-control form-control-sm select", "empty" => "Select Employment"]); ?> </div>
            </div>

        </div><!-- End Card Body -->
        <hr />



        <div class="text-center mb_10">
            <?php
            echo $this->Form->button(__("Save Draft"), ["class" => "btn btn-success"]);
            if ($seccCardholderAddTemp->application_status >= 2) {
                echo '&emsp;' . $this->Html->link("Next", "/SeccCardholderAddTemps/opBankDetails/", ["class" => "btn btn-info text-white"]);
            }
            echo $this->Form->end();
            ?>
            <?php //echo $this->Form->button(__("Save Draft"), ["class" => "btn btn-success"]) 
            ?>
            <?php echo '&emsp;'.$this->Html->link("Cancel", "/SeccCardholderAddTemps/checkAcknowledgement/", ["class" => "btn btn-danger"]); ?>
            <?php echo $this->Form->end() ?>
        </div>

    </div><!-- End Card -->
</div>
<?php echo $this->Html->script("jquery-ui.js") ?>
<script type="text/javascript">
    $(function() {
        $('.form_datetime').datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            maxDate: "D M -18Y",
            yearRange: "-100:-18",
            dateFormat: "yy-mm-dd",
            defaultDate: "-720m",

        });
    });
        </script>