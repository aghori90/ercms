<?php

use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
echo $this->Html->script("ration.js");
echo $this->Html->css("jquery-ui.css");
echo $this->Html->script('keyboard');
echo $this->Html->css("keyboard");
?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#register").validate({
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
                //panchayat_id: "required",
                rgi_village_code: "required",
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
                //panchayat_id: "Please select Panchayat.",
                rgi_village_code: "Please select Village.",
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.next("label"));
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

<main id="main">
    <!-- ======= Main Section ======= -->
    <section class="section">

        <div class="container">
            <?= $this->Flash->render() ?>
            <div class="row justify-content-center" data-aos="fade-up">

                <div class="col-lg-12">
                    <?php echo $this->Form->create($SeccCardholderAddReg, ["autocomplete" => "off", "id" => "register"]) ?>
                    <div class="card">
                        <div class="card-header bg-secondary text-white text-center">ERCMS Registration</div>

                        <div class="form-group row mt_10">
                            <div class="col-sm-12 text-center ">
                                <h5><b>&#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2375; &#2350;&#2369;&#2326;&#2367;&#2351;&#2366; &#2325;&#2366; &#2357;&#2367;&#2357;&#2352;&#2339;</b></h5>
                                <h6><b><span style="color:#009933">(&#2346;&#2352;&#2367;&#2357;&#2366;&#2352; &#2325;&#2368; &#2350;&#2369;&#2326;&#2367;&#2351;&#2366; &#2350;&#2361;&#2367;&#2354;&#2366; (&#2344;&#2381;&#2351;&#2370;&#2344;&#2340;&#2350; 18 &#2357;&#2352;&#2381;&#2359; &#2313;&#2350;&#2381;&#2352;) &#2361;&#2379; |)</span></b></h6>
                            </div>
                        </div>

                        <div class="card-body offset-sm-2">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">नाम(English)<br>[Name as in Aadhar Card] : </label>
                                <div class="col-sm-6"><?php echo $this->Form->control("name", ["label" => false, "placeholder" => "Enter Your Name", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "style" => "text-transform:capitalize"]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">नाम(हिन्दी) : </label>
                                <div class="col-sm-6"><?php //echo $this->Form->control("name_sl",["label"=>false,"placeholder"=>"Enter Your Name in Hindi","class"=>"form-control","onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100","id"=>"name_sl"]);
                                                        ?>
                                    <script language="javascript">
                                        CreateCustomHindiTextBox("name_sl", "<?php if ($SeccCardholderAddReg->name_sl != '') {
                                                                                    echo $SeccCardholderAddReg->name_sl;
                                                                                } ?>", "form-control", true);
                                    </script>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">पिता / पति का नाम(English) : </label>
                                <div class="col-sm-6"><?php echo $this->Form->control("fathername", ["label" => false, "placeholder" => "Enter Your Father's Name", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "style" => "text-transform:capitalize"]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">पिता / पति का नाम (हिन्दी) : </label>
                                <div class="col-sm-6"><?php //echo $this->Form->control("fathername_sl",["label"=>false,"placeholder"=>"Enter Your Father's Name in Hindi","class"=>"form-control","onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100","id"=>"fathername_sl"]);?>
                                    <script language="javascript">
                                        CreateCustomHindiTextBox("fathername_sl", "<?php if ($SeccCardholderAddReg->fathername_sl != '') {
                                                                                        echo $SeccCardholderAddReg->fathername_sl;
                                                                                    } ?>", "form-control", true);
                                    </script>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">जन्म तिथि : </label>
                                <div class="col-sm-6"><?php echo $this->Form->control("dob", ["type" => "text", "label" => false, "placeholder" => "dd/mm/yyyy", "class" => "form-control form_datetime", "readonly" => true]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">मोबाइल नंबर : </label>
                                <div class="col-sm-6 "><?php echo $this->Form->control("mobileno", ["label" => false, "placeholder" => "Enter your Mobile No", "class" => "form-control", "onKeyPress" => "return isNumberKey(event)", "pattern" => "[6789][0-9]{9}", "maxlength" => "10", "onBlur" => "checkMobile(this); "]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">आधार नंबर : </label>
                                <div class="col-sm-6"><?php echo $this->Form->control("uid", ["label" => false, "placeholder" => "Enter your Aadhar No", "class" => "form-control", "maxlength" => "12", "onkeyup" => "checkUID(this)", "readonly" => true]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">जिला : </label>
                                <div class="col-sm-6"><?php // debug($seccDistricts);
                                                        ?>
                                    <?php echo $this->Form->control("rgi_district_code", ["options" => $seccDistricts, "label" => false, "class" => "form-control", "empty" => "Select District", "id" => "rgi_district_code"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">ब्लॉक / नगर पालिका : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control("rgi_block_code", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Block", "id" => "rgi_block_code"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">गाँव/वार्ड : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control("rgi_village_code", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Village", "id" => "rgi_village_code"]); ?>
                                </div>
                            </div><!-- End Card Body -->
                        </div><!-- End Card -->

                        <div class="text-center">
                            <?php echo $this->Form->button(__("Register"), ["class" => "btn btn-success"]) ?>
                            <?php echo $this->Html->link("Cancel", "/SeccCardholderAddTemps/aadhar/", ["class" => "btn btn-danger"]); ?>
                            <?php echo $this->Form->end() ?>
                        </div>
                        <br />

                    </div><!-- End col-lg-12 -->

                </div><!-- End container -->
    </section><!-- End Contact Section -->

</main><!-- End #main -->

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
        // Start : Get Blocks Based on District Change

        $('#rgi_district_code').change(function() {
            // var url = $(this).attr('rel');
            $('#rgi_block_code').empty();
            $('#rgi_village_code').empty();
            var url = '<?= Router::url(array('controller' => 'App', 'action' => 'getBlocksByDistrict', '_full' => true)) ?>';
            var rgi_district_code = $(this).val();
            var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
            //alert(url + " == " + token);return false;
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    id: rgi_district_code
                }),
                dataType: 'html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus) {
                    $('#rgi_block_code').empty();
                    var result = JSON.parse(response); //alert(result);return false;
                    $.each(result, function(val, text) {
                        $('#rgi_block_code').append(
                            $('<option></option>').val(val).html(text)
                        );
                    });
                    $("select[name=rgi_block_code]").prepend("<option value selected>Select Block</option>");

                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                }
            });
        });
        // End : Get Blocks Based on District Change	

        // Start : Get Villages/Ward Based on Block Change
        $('#rgi_block_code').change(function() {
            $('#rgi_village_code').empty();
            var url = '<?= Router::url(array('controller' => 'App', 'action' => 'getVillagesByBlock', '_full' => true)) ?>';
            var rgi_block_code = $(this).val();
            var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    id: rgi_block_code
                }),
                dataType: 'html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus) {
                    $('#rgi_village_code').empty();
                    var result = JSON.parse(response); //alert(result);return false;
                    $.each(result, function(val, text) {
                        $('#rgi_village_code').append($('<option></option>').val(val).html(text));
                    });
                    $("select[name=rgi_village_code]").prepend("<option value selected>Select Village</option>");
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                }
            });
        });
        // End : Get Villages/Ward Based on Block Change			

    });

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
</script>