<?php

use Cake\Routing\Router;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
echo $this->Html->script("ration.js");
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#aadahar_validate").validate({
            rules: {
                uid: "required",
                reaadhar: {
                    required: true,
                    equalTo: "#uid"
                },
                name: {
                    required: true,
                    minlength: 3
                },
                chkAgree: "required",
            },
            messages: {
                uid: "Please enter your Aadhar No.",
                reaadhar: {
                    required: "Please provide a Aadhar No",
                    equalTo: "Please enter the same Aadhar No as above"
                },
                name: {
                    required: "Please enter your Name.",
                    minlength: "Name need to be at least 3 characters long"
                },
                chkAgree: "Please agree with the aadhar consent",
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");

                if (element.prop("type") === "checkbox") {
                    error.appendTo(element.parent());
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
            onsubmit: true
        });


    });
</script>
<style>
    .card-aadhar {
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 0 20px rgba(90, 70, 87, 0.12);
        background-color: #fff;
        border: 1px solid #dddddd;
        min-height: 200px;
    }

    .card-signin {
        border-radius: 10px;
        padding: 30px 30px 15px 30px;
        border-bottom: 5px solid #1bbd36 !important;
        box-shadow: 0 0 20px rgba(90, 70, 87, 0.12);
        background-color: #fff;
        border: 1px solid #dddddd;
        min-height: 200px;
    }
</style>

<main id="main">
    <!-- ======= Main Section ======= -->
    <section class="section">
        <div class="container">
            
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-lg-6">
                <?= $this->Flash->render() ?>
                    <?php echo $this->Form->create(false, ["url" => ["controller" => "SeccCardholderAddTemps", "action" => "register"], "autocomplete" => "off", "id" => "aadahar_validate"]) ?>
                    <div class="card-aadhar card-signin">
                        <div class="row mt_10 mb_10">
                            <div class="col">
                                <h6 style="color: #555555; font-size: 16px;">
                                    <h6> Applicant Aadhar Number
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('uid', ['templates' => ['inputContainer' => '<div class="input-group">
                        <span class="input-group-text text-center" id="basic-addon1" style="width: 20%; letter-spacing: 0px; border-radius: 6px 0px 0px 6px; pointer-events:none;">' . $this->Html->image('aadhaar_small.png') . '</span>
                        {{content}} </div>'], "label" => false, "class" => "form-control  form-control-lg",  "maxlength" => "12", "minlength" => "12", "autocomplete" => "off", "autofocus" => true, "placeholder" => "____________", "id" => "uid", "style" => "width: 80%; margin-left: 0px;border-radius: 0px 6px 6px 0px;border-left: 0px; letter-spacing: 7px;",  "tabindex" => "1", "type" => "tel", "pattern" => "[1-9]*", "onClick" => "this.select();", "inputmode" => "numeric", "onKeyPress" => "return isNumberKey(event)", "required" => true, "onkeyup" => "checkUID(this); "]); ?>
                        </div>

                        <div class="row mt_10 mb_10">
                            <div class="col">
                                <h6 style="color: #555555; font-size: 16px;">Re-enter Aadhar Number </h6>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('reaadhar', ['templates' => ['inputContainer' => '<div class="input-group">
                        <span class="input-group-text text-center" id="basic-addon1" style="width: 20%; letter-spacing: 0px; border-radius: 6px 0px 0px 6px; pointer-events:none;">' . $this->Html->image('aadhaar_small.png') . '</span>
                        {{content}} </div>'], "label" => false, "class" => "form-control  form-control-lg",  "maxlength" => "12", "minlength" => "12", "autocomplete" => "off", "placeholder" => "____________", "id" => "matchuid", "style" => "width: 80%; margin-left: 0px;border-radius: 0px 6px 6px 0px;border-left: 0px; letter-spacing: 7px;",  "tabindex" => "1", "type" => "tel", "pattern" => "[1-9]*", "onClick" => "this.select();", "inputmode" => "numeric", "onKeyPress" => "return isNumberKey(event)", "required" => true]); ?>
                        </div>

                        <div class="row mt_10 mb_10">
                            <div class="col">
                                <h6 style="color: #555555; font-size: 16px;">Enter Name as in Aadhar Card </h6>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('name', ['templates' => ['inputContainer' => '<div class="input-group">
                        <span class="input-group-text text-center" style="width: 20%; letter-spacing: 0px; border-radius: 6px 0px 0px 6px; pointer-events:none;"><i class="fa fa-user"></i></span>
                        {{content}} </div>'], "label" => false, "class" => "form-control  form-control-lg", "minlength" => "3", "autocomplete" => "off", "style" => "width: 80%; margin-left: 0px;border-radius: 0px 6px 6px 0px;border-left: 0px; letter-spacing: 0px; text-transform:capitalize",  "tabindex" => "1", "onClick" => "this.select();",  "onKeyPress" => "return isAlphabets(event)", "required" => true]); ?>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 "> <span class="float-left text-green font-weight-bold">
                            आगे बढ़ने के लिए कृपया चेकबॉक्स पर क्लिक करें |</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12"> <span class="float-left text-danger">
                                    <b><?php echo $this->Form->checkbox('chkAgree', ['onclick' => 'proceed(this.value)', 'id' => 'chkAgree', 'hiddenField' => false]); ?>&nbsp; मैं इस आवेदन के लिए अपनी सहमति से अपना आधार न० आवेदक के रूप में भर रहा/रही हूँ |</b></span>
                            </div>
                        </div>

                    </div>
                    <!--<button class="btn-sign-up radius_50 float-right mt_10 mb10" name="button">Next</button>-->
                    <?php echo $this->Form->Submit('Next', array('class' => 'btn btn-lg btn-green float-right mt_10 col-sm-3', "disabled" => true, 'id' => 'Next', 'name' => 'Next')); ?>
                    <?php echo $this->Form->end(); ?>

                </div>
            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
<script type="text/javascript">
    function checkAadhar(str) {
        var aadhar = str.value;
        if (str.value.length == 12) {
            var url = '<?= Router::url(array('controller' => 'ErcmsValidate', 'action' => 'checkaadhar', '_full' => true)) ?>';
            var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    aadhar: aadhar
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
                            // console.log("key " + key + " : " + result.data[key]);
                            //console.log("key " + key + " has value " + result.data[key]);
                        }
                        $('#uid-error').remove();
                        $("<em id=\"uid-error\" class=\"error invalid-feedback\">Aadhar Number already exists for " + key + " : " + result.data[key] + ".</em>").insertAfter(str);
                        $(str).addClass("is-invalid").removeClass("is-valid");
                        //$(str).focus()
                        return false;
                    }

                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    str.value = '';
                    $('#uid-error').remove();
                    $("<em id=\"uid-error\" class=\"error invalid-feedback\">Some error Occurred!!!</em>").insertAfter(str);
                    $(str).addClass("is-invalid").removeClass("is-valid");
                    console.log(e);
                    return false;
                }
            });
        } else {
            return false;
        }
    }

    function proceed(value) {
        if (document.getElementById("chkAgree").checked == true) {
            $('#Next').removeAttr("disabled", false);
        } else {
            $("#Next").attr("disabled", true);
        }
    }
</script>