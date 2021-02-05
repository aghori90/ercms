<?php

use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
echo $this->Html->script("ration.js");
//echo $this->Html->script('jsapi');
echo $this->Html->css("jquery-ui.css");
echo $this->Html->script('keyboard');
echo $this->Html->css("keyboard");
?>
<!-- <script>
        jQuery(document).ready(function(){
            jQuery("input[name=name_hn]").keyup(function(){
                jQuery("input[name=name_sl]").val(jQuery(this).val());
            });
            jQuery("input[name=fathername_hn]").keyup(function(){
                jQuery("input[name=fathername_sl]").val(jQuery(this).val());
            });
        });
    </script> -->

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
                mobileno: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                // mobileno: {
                //     //required: true,
                //     minlength: {
                //         depends: function(element) {
                //             return ($("#mobileno").val().length > 0);
                //         },
                //         param: 10
                //     },
                //     maxlength: {
                //         depends: function(element) {
                //             return ($("#mobileno").val().length > 0);
                //         },
                //         param: 10
                //     },
                // },
                dob: "required",
                uid: {
                    required: true,
                    minlength: 12,
                    maxlength: 12
                },
                rgi_district_code: "required",
                rgi_block_code: "required",
                panchayat_id: "required",
                rgi_village_code: "required",
                aadhar_doc: "required",
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
                    // required: "Please enter Mobile No",
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
                panchayat_id: "Please select Panchayat.",
                rgi_village_code: "Please select Village.",
                aadhar_doc: "Please upload Aadhar of Head of Family.",
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
	
		getBlocks(<?=$NfsaCardholderTempReg->rgi_district_code?>);
		getPanchayats(<?=$NfsaCardholderTempReg->rgi_block_code?>);
		getVillages(<?=$NfsaCardholderTempReg->rgi_block_code?>);

    });
</script>

<main id="main">
    <!-- ======= Main Section ======= -->
    <section class="section">

        <div class="container">
            <?= $this->Flash->render() ?>
            <div class="row justify-content-center" data-aos="fade-up">

                <div class="col-lg-12">
                    <?php echo $this->Form->create($NfsaCardholderTempReg, ["autocomplete" => "off", "id" => "register", 'enctype' => 'multipart/form-data']) ?>
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
                                <div class="col-sm-6"><?php //echo $this->Form->control("name_sl", ["label" => false, "placeholder" => "Enter Your Name in Hindi", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "id" => "name_sl",  "onkeypress" => "if (!inputBoxIds[0].isEng){ return processInput(event,inputBoxIds[0]);} else {return true;}","onkeyup" => "changeCursor(this);","onkeydown"=>"positionChange(event,inputBoxIds[0]);","onfocus"=>"changeCursor(this);","onclick"=>"changeCursor(this);"]); 
                                                        // echo $this->Form->hidden('name_sl');
                                                        ?>
                                    <script language="javascript">
                                        CreateCustomHindiTextBox("name_sl", "<?php if ($NfsaCardholderTempReg->name_sl != '') {
                                                                                    echo $NfsaCardholderTempReg->name_sl;
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
                                <div class="col-sm-6"><?php //echo $this->Form->control("fathername_sl", ["label" => false, "placeholder" => "Enter Your Father's Name in Hindi", "class" => "form-control", "onkeypress" => "return isAlphabets(event)", "size" => "100", "maxlength" => "100", "id" => "fathername_sl"]); 
                                                        // echo $this->Form->hidden('fathername_sl');
                                                        ?>
                                    <script language="javascript">
                                        CreateCustomHindiTextBox("fathername_sl", "<?php if ($NfsaCardholderTempReg->fathername_sl != '') {
                                                                                        echo $NfsaCardholderTempReg->fathername_sl;
                                                                                    } ?>", "form-control", true);
                                    </script>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">जन्म तिथि : </label>
                                <div class="col-sm-6"><?php echo $this->Form->control("dob", ["type" => "text", "label" => false, "placeholder" => "dd/mm/yyyy", "class" => "form-control form_datetime", "readonly" => true]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label font-weight-bold">मोबाइल नंबर : </label>
                                <div class="col-sm-6 "><?php echo $this->Form->control("mobileno", ["label" => false, "placeholder" => "Enter your Mobile No", "class" => "form-control", "onKeyPress" => "return isNumberKey(event)", "pattern" => "[6789][0-9]{9}", "maxlength" => "10", "onBlur" => "checkMobile(this); "]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold">आधार नंबर : </label>
                                <div class="col-sm-6"><?php echo $this->Form->control("uid", ["label" => false, "placeholder" => "Enter your Aadhar No", "class" => "form-control", "maxlength" => "12", "onkeyup" => "checkUID(this)", "readonly" => true]); ?></div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">जिला : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control("rgi_district_code", ["options" => $seccDistricts, "label" => false, "class" => "form-control", "empty" => "Select District",  "id" => "rgi_district_code", "onchange" => "getBlocks(this.value)"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">ब्लॉक / नगर पालिका : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control("rgi_block_code", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Block", "default"=>$NfsaCardholderTempReg->rgi_block_code, "id" => "rgi_block_code", "onchange" => "getPanchayats(this.value); getVillages(this.value)"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">पंचायत : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control("panchayat_id", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Panchayat", "id" => "panchayat_id"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">गाँव/वार्ड : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control("rgi_village_code", ["options" => [], "label" => false, "class" => "form-control", "empty" => "Select Village", "id" => "rgi_village_code"]); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required font-weight-bold" for="name">Upload Aadhar Card : </label>
                                <div class="col-sm-6">
                                    <?php echo $this->Form->control('aadhar_doc', ['label' => false, 'class' => 'form-control', 'type' => 'file', 'onChange' => 'validateFile(this,"document_errorspan")']); ?>
                                    <span id="document_errorspan" style="font-weight:bold; color: red;"></span>
                                </div>
                            </div>
                        </div><!-- End Card Body -->
                        <div class="text-center">
                            <?php echo $this->Form->button(__("Register"), ["class" => "btn btn-success"]) ?>
                            <?php echo $this->Html->link("Cancel", "/SeccCardholderAddTemps/aadhar/", ["class" => "btn btn-danger"]); ?>
                            <?php echo $this->Form->end() ?>
                        </div>
                        <br />
                    </div><!-- End Card -->



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

    });

    function getBlocks(district_id) {
       // $('#rgi_block_code').empty();
		$('#rgi_block_code').children().remove().end().append('<option value selected>Select Block</option>') ;
		$('#rgi_village_code').children().remove().end().append('<option value selected>Select Village</option>') ;
		$('#panchayat_id').children().remove().end().append('<option value selected>Select Panchayat</option>') ;
        //$('#panchayat_id').empty();
        //$('#rgi_village_code').empty();
        var url = '<?= Router::url(array('controller' => 'App', 'action' => 'getBlocksByDistrict', '_full' => true)) ?>';
        //var rgi_district_code = $('#rgi_district_code').val();
        var rgi_district_code = district_id;
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
    }

    function getPanchayats(rgi_block_code) {
		$('#rgi_village_code').children().remove().end().append('<option value selected>Select Village</option>') ;
		$('#panchayat_id').children().remove().end().append('<option value selected>Select Panchayat</option>') ;
        var url = '<?= Router::url(array('controller' => 'App', 'action' => 'getPanchayatsByBlock', '_full' => true)) ?>';
        //var rgi_block_code = $('#rgi_block_code').val();
        var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
        //alert(url + " == " + token);return false;
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
                $('#panchayat_id').empty();
                var result = JSON.parse(response); //alert(result);return false;
                $.each(result, function(val, text) {
                    $('#panchayat_id').append(
                        $('<option></option>').val(val).html(text)
                    );
                });
                $("select[name=panchayat_id]").prepend("<option value selected>Select Panchayat</option>");

            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    }

    function getVillages(rgi_block_code) {
		$('#rgi_village_code').children().remove().end().append('<option value selected>Select Village</option>') ;
		$('#panchayat_id').children().remove().end().append('<option value selected>Select Panchayat</option>') ;
        var url = '<?= Router::url(array('controller' => 'App', 'action' => 'getVillagesByBlock', '_full' => true)) ?>';
        //var block_id = $('#rgi_block_code').val();
        var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
        //alert(url + " == " + token);return false;
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
                    $('#rgi_village_code').append(
                        $('<option></option>').val(val).html(text)
                    );
                });
                $("select[name=rgi_village_code]").prepend("<option value selected>Select Village</option>");

            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    }

    function validateFile(component, errorspan) {
		validateFileExtension(component, errorspan, "Please provide document in  .jpg/.png format only!!!.", new Array("jpg", "jpeg", "png"));
		validateFileSize(component, errorspan, "File size should not be greater than 500 KB!!!.", "500000"); //2097152 Byte = 2MB; 500000 Byte = 500 Kb
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
</script>