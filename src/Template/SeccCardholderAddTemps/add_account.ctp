<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LadliCandidate $ladliCandidate
 */
?>
<?php echo $this->Html->css('ladli/loading'); ?>

<style type="text/css">
    #FileError {
        color: #ff0000;
    }

    #ferror_error_message {
        font-style: italic;
        color: red;
    }

    .btn {
        margin-top: 0px;
    }

</style>


<!-- Start : new design -->
<div id="loading" class="loading" style="display:none; text-align:center"></div>
<main id="main">
	<!-- ======= Main Section ======= -->

	<section class="section">
		<div class="container">
        <div class="card-body">
							<div class="card-header bg-secondary text-white"> <span class="h4">Bank Details & LPG Connection Details</span> </div>
							<div class="card-body offset-md-2">
			<?= $this->Flash->render() ?>
			<div class="row justify-content-center" data-aos="fade-up">
				<div class="col-lg-12">
            <div id="ladli-form1" style="border:1px solid; padding:0px 20px 10px 20px ;">
                <fieldset style="width:100%">
                    <legend style="width:40%">Add Account Number</legend>
                </fieldset>


                <?php echo $this->Form->create('false', ['action' => 'AccountSave', 'class' => 'form-horizontal ladliFormAdjust', 'id' => 'addacc0ount', 'type' => 'file', 'onsubmit' => 'return validateform();']) ?>
                <div id="FileError"></div>
                <div class="row" id="control-row">


                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--Registration Number-->
                            Registration Number
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <b><?php //echo strtoupper($ladlicandidate['registration_no']); ?></b>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            Candidate Name-->
                            &#2309;&#2349;&#2381;&#2351;&#2352;&#2381;&#2341;&#2368; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['name']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            Date of Birth-->
                            &#2332;&#2344;&#2381;&#2350; &#2340;&#2367;&#2341;&#2367;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['date_of_birth']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            Mother Name-->
                            &#2350;&#2366;&#2305; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['mother_name']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            Father Name-->
                            &#2346;&#2367;&#2340;&#2366; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['father_name']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            District Name-->
                            &#2332;&#2367;&#2354;&#2366; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['districtName']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            Block Name-->
                            &#2348;&#2381;&#2354;&#2377;&#2325; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['blockName']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--Aangan Badi Name-->
                            &#2310;&#2306;&#2327;&#2344;&#2348;&#2366;&#2396;&#2368; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class=" col-sm-7" style="text-align: left;">
                            <?php //echo strtoupper($ladlicandidate['aangan_badi']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" style="text-align: left;">
                            <!--                            Village Name-->
                            &#2327;&#2366;&#2305;&#2357; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class="col-sm-7" style="text-align: left;">
                            <?php echo strtoupper($ladlicandidate['villageName']); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class=" col-sm-5">
                            <!-- बैंक IFSC कोड -->
                            &#2348;&#2376;&#2306;&#2325; IFSC &#2325;&#2379;&#2337;
                            <br>
                            <br>
                            <span id="searchifsc" style="cursor:pointer; color:red;">Search Ifsc Code</span>
                        </div>
                        <br />
                        <div class="col-sm-7">
                            <?php
echo $this->Form->control('ifsc_code', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'pattern' => '[a-zA-Z0-9]{11}', 'id' => 'ifsc_code', 'onblur' => 'getbankdetail();', 'maxlength' => '11','onkeypress'=>'return nosymboll(this)']);
?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" for="bank_name">
                            <!-- बैंक का नाम  -->
                            &#2348;&#2376;&#2306;&#2325; &#2325;&#2366; &#2344;&#2366;&#2350;
                        </div>
                        <div class="col-sm-7">
                            <?php
echo $this->Form->control('bank_name', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'pattern' => '[a-zA-Z]+', 'id' => 'bank_name', 'options' => $banks, 'empty' => '--Select Bank Name--']);
?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" for="bank_name">
                            <!-- बैंक ब्रांच  का नाम  -->
                            &#2348;&#2376;&#2306;&#2325; &#2348;&#2381;&#2352;&#2366;&#2306;&#2330; &#2325;&#2366;
                            &#2344;&#2366;&#2350;
                        </div>
                        <div class="col-sm-7">
                            <?php
echo $this->Form->control('branch_name', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'pattern' => '[a-zA-Z]+', 'id' => 'branch_name', 'options' => $branchs, 'empty' => '--Select Branch Name--']);
?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5" for="account_no">
                            <!-- बैंक अकाउंट नंबर   -->
                            &#2348;&#2376;&#2306;&#2325; &#2309;&#2325;&#2366;&#2313;&#2306;&#2335;
                            &#2344;&#2306;&#2348;&#2352;
                        </div>
                        <div class="col-sm-7">
                            <?php
echo $this->Form->control('account_no', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'id' => 'account_no', 'readonly' => 'readonly', 'onkeypress' => 'return numonly(event)']);
?>
                        </div>
                    </div>

                    <?php echo $this->Form->hidden('enc_regno', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'id' => 'enc_regno', 'value' => $enc_regno]); ?>

                    <?php echo $this->Html->link(__('Cancel'), ['controller'=>'ladliCandidates', 'action'=> 'getCandidateDetails',$enc_regno],['style'=>'float:right; width:80px;','class'=>'btn btn-md btn-danger']) ?>

                    <?php echo $this->Form->button(__('Save'), array('label'=>'','class'=>'btn btn-md btn-success','id'=>'submitladli1','style'=>'width:80px;')) ?>
                    <?php echo $this->Form->end() ?>
                </div>

            </div>
        </div>
        <div class="col-md-2 col-lg-2"></div>
    </div>
</div>


<div id="modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #7c88dc; color: white;height: 60px;">
                <div class="col-sm-11">
                    <h5 class="modal-title" style=" font-size:20px;">Search Ifse Code</h5>
                </div>

                <div class="col-sm-1 btn btn-danger" style="float: right;">
                    <button type="button" class="close closebtn out" aria-label="Close" style="width:20px;height:20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>

            <div class="modal-body">
                <div class=row>
                    <div class="col-sm-12">
                        <table style="width:100%">
                            <tr>
                                <td>
                                    <label class="control-label" for="bank_name">
                                        <!-- बैंक का नाम  -->
                                        &#2348;&#2376;&#2306;&#2325; &#2325;&#2366; &#2344;&#2366;&#2350;
                                    </label>
                                </td>

                                <td>
                                    <div class="col-sm-9">
                                        <?php
echo $this->Form->control('bankid2', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'pattern' => '[a-zA-Z]+', 'id'=>'bankid2', 'options' => $bankdata, 'empty' => '--Select Bank Name--', 'onchange'=>'return bankbranchmodalcall();']);
?>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="control-label" for="bank_name">
                                        <!-- लोकेशन  -->
                                        &#2354;&#2379;&#2325;&#2375;&#2358;&#2344;
                                    </label>
                                </td>

                                <td>
                                    <div class="col-sm-9">
                                        <?php
echo $this->Form->control('branchid2', ['class' => 'form-control', 'label' => '', 'required' => 'required', 'pattern' => '[a-zA-Z]+', 'id'=>'branchid2', 'options' => $branchs, 'empty' => '--Select Branch Name--']);
?>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label class="control-label" for="bank_name">
                                        <!-- Ifsc Code  -->
                                        Ifsc Code
                                    </label>
                                </td>

                                <td>
                                    <div class="col-sm-9">
                                        <?php
echo $this->Form->control('ifsc2', ['class' => 'form-control', 'label' => '', 'required' => 'required','id'=>'ifsc2','readonly'=>'readonly','disabled'=>'disabled']);
?>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" style="float:right;margin-left:5px;" data-dismiss="modal" class="btn btn-danger closebtn">Close</button>
                <button id="copyifsc" type="button" style="float:right" data-dismiss="modal" class="btn btn-success closebtn">Copy</button>
                <button type="button" onclick="return searchifsc();" id="search" class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</div>

<script>
    function getBankAccDigit() {
        var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
        var url = '<?php echo $this->Url->build(['controller'=>'app','action'=>'getBankAccDigit']); ?>';
        var bank_id = $('#bank_name').val();
        var branch_id = $('#branch_name').val();
        if (bank_id.length != 0 && branch_id.length != 0) {
            $('#loading').css('display', 'block');
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    bank_id: bank_id,
                    branch_id: branch_id
                }),
                dataType: 'html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus) {
                    $('#account_no').attr('maxlength', response);
                    $('#account_no').attr('autocomplete', false);
                    $('#account_no').removeAttr('readonly');
                    $('#loading').css('display', 'none');
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                    $('#loading').css('display', 'none');
                }
            });
        }
    }

    function getbankdetail() {
        var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
        var url = '<?php echo $this->Url->build(['controller'=>'app','action'=>'getBankBranchDataByIfsc']); ?>';
        var ifsc_code = $('#ifsc_code').val();
        if (ifsc_code.length == 11 && ifsc_code != '') {
            $('#loading').css('display', 'block');
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    ifsc_code: ifsc_code
                }),
                dataType: 'html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus) {
                    if (response === '***') {
                        $('#ifsc_error_for_branch').html('Sorry, Please contact ADMIN to add your Bank Branch !');
                        alert("Sorry, Please contact ADMIN to add your Bank Branch !");
                    } else {
                        var result = response.split('***');
                        $('#bank_name').html(result[0]);
                        $('#branch_name').html(result[1]);
                        $('#ifsc_code').val(ifsc_code);
                        $('#ifsc_code').attr('readonly', 'readonly');
                    }
                    $('#loading').css('display', 'none');
                    getBankAccDigit();
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                    $('#loading').css('display', 'none');
                }
            });
        }
    }


    $(document).ready(function() {
        $('#bank_name,#branch_name').change(function() {
            var bank_id = $('#bank_name').val();
            var branch_id = $('#branch_name').val();
            if (bank_id != "" && branch_id != "") {
                $("#account_no").removeAttr("readonly");
            } else {
                $("#account_no").attr("readonly", "readonly");
            }
        });

        $('#searchifsc').on('click', function() {
            $('#modal').show('slow');
        })

        $('#copyifsc').on('click', function() {
            $('#modal').hide('slow');
            var ifsc_code = document.getElementById('ifsc2').value;
            if (document.getElementById('ifsc_code').value = ifsc_code) {
                getbankdetail();
            }
        })

        $('#close,.out').on('click', function() {
            $('#modal').hide('slow');
        })

    });




    function bankbranchmodalcall() {
        var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
        var url = '<?php echo $this->Url->build(['controller'=>'app','action'=>'getBankBranchDataBybankid']); ?>';
        var bankid2 = $('#bankid2').val();
        if (bankid2 != '') {
            $('#loading').css('display', 'block');
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    bankid: bankid2
                }),
                dataType: 'html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus) {
                    if (response != "") {
                        $('#branchid2').empty();
                        $('#branchid2').html(response);
                    } else {
                        $('#branchid2').empty();
                        $('#branchid2').html("<option value='0'>--Select Branch--</option>");
                    }
                    $('#loading').css('display', 'none');
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                    $('#loading').css('display', 'none');
                }
            });
        }
    }

    function searchifsc() {
        var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
        var url = '<?php echo $this->Url->build(['controller'=>'app', 'action'=>'getIfscByBankAndBranch']); ?>';
        var bankid2 = document.getElementById('bankid2').value;
        var branchid2 = document.getElementById('branchid2').value;
        if (bankid2 == '') {
            alert('Select Bank.');
            return false;
        }

        if (branchid2 == 0) {
            alert('Select Bank Branch.');
            return false;
        }

        if (bankid2 != '' && branchid2 != '') {
            $('#loading').css('display', 'block');
            $.ajax({
                type: 'POST',
                url: url,
                async: true,
                data: ({
                    bankid: bankid2,
                    branchid: branchid2
                }),
                dataType: 'html',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus) {
                    if (response != "") {
                        document.getElementById('ifsc2').value = response;
                    } else {
                        alert('Sorry Your Branch Not Found. Please Contact Administrator to Add your Bank branch.');
                    }
                    $('#loading').css('display', 'none');
                },
                error: function(e) {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                    $('#loading').css('display', 'none');
                }
            });
        }
    }


    function numonly(evt) {
        var charCode = event.keyCode;
        if (charCode >= 48 && charCode <= 57) {
            return true;
        } else {
            return false;
        }
    }

    function textonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode >= 48 && charCode <= 57) {
            return false;
        }
        if ((charCode >= 97 && charCode <= 122) || (charCode >= 65 && charCode <= 90) || charCode == 32) {
            return true;
        } else {
            return false;
        }
    }

    function nosymboll(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode >= 48 && charCode <= 57) {
            return true;
        } else if ((charCode >= 97 && charCode <= 122) || (charCode >= 65 && charCode <= 90) || charCode == 32) {
            return true;
        } else {
            return false;
        }
    }

</script>
