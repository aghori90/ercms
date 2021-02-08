<?php use Cake\Routing\Router;

$this->Html->script('injection.js')
?>
<style>
    span.headDeco {
        /*display: inline-block;*/
        /*width: 100%;*/
        /*text-align: center;*/
        /*font-weight: 900;*/
        margin-left: 4px;
        color: lime;
        /*border-bottom: 1px green solid;*/
    }

    legend {
        font-size: .88rem;
        font-weight: bold;
        font-size: x-large;
        color: green;
    }

    tbody.headClr {
        background-color: #678435;
        color: white;
        font-family: auto;
        font-size: medium;
    }

    .input.text {
        margin-top: -21px;
    }

    sub, sup {
        position: relative;
        font-size: 100%;
        line-height: 0;
        vertical-align: baseline;
        color: red;
    }

    .row {
        background-color: white;
    }

    .approveDet {
        margin-top: 14px;
    }

    .table-bordered {
        border: 1px solid #e9ecef;
        margin: 5px 5px 5px 5px;
    }

    .modal {
        /*position: absolute;*/
        top: 62px;
        left: 126px;
        /*z-index: 1050;*/
        /*display: none;*/
        /*width: 100%;*/
        /*height: 100%;*/
        /*overflow: hidden;*/
        /*outline: 0;*/
    }
</style>

<!--Ration Card Details-->
<div class="container-fluid table ">
    <div class="card-header bg-primary text-white">Ration Card Details For: <span
            class="headDeco"><?php echo $activityType[$activityTypeId]; ?></span></div>
    <!--    <span class="headDeco">Request For: --><?php //echo $activityType[$activityTypeId]; ?><!--</span>-->
    <!--    <fieldset>-->
    <!--        <legend>--><? //= __('Ration Card Details:') ?><!--</legend>-->
    <div class="row">
        <?php
        //  todo: for new applied card---------------------------------------------------------------
        if ($activityTypeId == 1) { ?>
        <table class="table table-hover">
            <tbody>
            <tr>
                <td scope="col"><b>Acknowledgement No :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['ack_no'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['ack_no'];
                    }
                    ?>
                </td>
                <td scope="col"><b>Name :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['name'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['name'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td scope="col"><b>Father Name :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['fathername'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['fathername'];
                    }
                    ?>
                </td>
                <td scope="col"><b>Mother Name :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['mothername'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['mothername'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td scope="col"><b>Card Type :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['cardtype_id'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['cardtype_id'];
                    }
                    ?>
                </td>
                <td scope="col"><b>District Name :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['rgi_district_code'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['rgi_district_code'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td scope="col"><b>Block Name :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['rgi_block_code'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['rgi_block_code'];
                    }
                    ?>
                </td>
                <td scope="col"><b>Village Name :</b></td>
                <td>
                    <?php
                    if ($nfsaAppliedRationcardsDetails[0]['rgi_village_code'] == '') {
                        echo "NA";
                    } else {
                        echo $nfsaAppliedRationcardsDetails[0]['rgi_village_code'];
                    }
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--    </fieldset>-->
</div>
<!-- Family Details-->
    <div class="container-fluid table">
        <div class="card-header bg-primary text-white">Family Details</div>
        <!--        <fieldset>-->
        <!--            <legend>--><?//= __('Family Details:') ?><!--</legend>-->
        <div class="row">
            <table class="table table-bordered">
                <tbody class="headClr">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <!-- <td>Name (HI)</td>-->
                    <td>Father Name</td>
                    <!--<td>Father Name(HI)</td>-->
                    <td>Relation With Family Head</td>
                    <td>Mobile</td>
                    <td>UID</td>
                    <td>Bank</td>
                    <td>Branch</td>
                    <td>Account</td>
                </tr>
                </tbody>
                <?php
                if (!empty($seccFamiliesDetails)) {
                    $SlNo = 1;
                    foreach ($seccFamiliesDetails as $key => $value) {
                        //echo "<pre>"; print_r($value); die();
                        ?>
                        <tr>
                            <td><?php echo $SlNo; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['fathername']; ?></td>
                            <td><?php echo $value['relation_id']; ?></td>
                            <td><?php echo $value['mobile']; ?></td>
                            <td><?php echo $value['uid']; ?></td>
                            <!--<td><?php /*echo $value['bank_master_id'];*/ ?></td>-->
                            <td>
                                <?php
                                if ($value['bank_master_id'] == '0' || $value['bank_master_id'] == '') {
                                    echo "NA";
                                } else {
                                    echo $value['bank_master_id'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($value['branch_master_id'] == '0' || $value['branch_master_id'] == '') {
                                    echo "NA";
                                } else {
                                    echo $value['branch_master_id'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($value['accountNo'] == '0' || $value['accountNo'] == '') {
                                    echo "NA";
                                } else {
                                    echo $value['accountNo'];
                                }

                                ?>
                            </td>
                        </tr>
                        <?php
                        $SlNo++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">Sorry ! No Records Found.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <!--        </fieldset>-->
    </div>
<!--todo: Activity Details-->
    <div class="container-fluid table ">
        <div class="card-header bg-primary text-white">Approve Details</div>
        <?php echo $this->Form->create('nfsaApprove', ['url' => ['controller' => 'SeccCardholders', 'action' => 'approveDetails']]); ?>
        <?php echo $this->Flash->render(); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 approveDet">
                <label>Status <sup class="superscr_star">*</sup> </label>
                <?php
                $activity_flag = ['1' => 'Approved', '2' => 'Rejected'];
                echo $this->Form->select('activity_flag', $activity_flag, ['class' => 'form-control', 'empty' => '--Select Activity Status--']); ?>
                <span class="frm_error" id="dlrEntryErrMsg" style="display:none;"></span>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 approveDet">
                <label>Remarks </label>
                <?php echo $this->Form->control(' ', ['label' => '', 'name' => 'remarks', 'id' => 'remarks', 'Placeholder' => 'Enter Remarks', 'class' => 'form-control txtOnly', 'onkeypress' => 'return isalphabet(event,this);']); ?>
                <span class="frm_error" id="dlrEntryErrMsg" style="display:none;"></span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="margin-top: 18px;">
                    <?php echo $this->Form->hidden('ackNo', ['value' => $nfsaAppliedRationcardsDetails[0]['ack_no']]); ?>
                    <?php //echo $this->Form->hidden('activityId', ['value' => $nfsaAppliedRationcardsDetails[0]['activity_type_id']]); ?>
                    <?php echo $this->Form->button('Submit', ['id' => 'btnSubmit', 'class' => 'btn btn-outline-info submitt', 'style' => 'float:right; margin-bottom: 17px;']); ?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <!--        </fieldset>-->
    </div>
<!--todo: for mobile change -->
<?php
}
elseif ($activityTypeId == 6) { ?>
    <table class="table table-hover">
        <tbody>
        <tr>
            <td scope="col"><b>Acknowledgement No :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['ack_no'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['ack_no'];
                }
                ?>
            </td>
            <td scope="col"><b>Name :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['name'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['name'];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td scope="col"><b>Father Name :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['fathername'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['fathername'];
                }
                ?>
            </td>
            <td scope="col"><b>Mother Name :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['mothername'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['mothername'];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td scope="col"><b>Card Type :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['cardtype_id'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['cardtype_id'];
                }
                ?>
            </td>
            <td scope="col"><b>District Name :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['rgi_district_code'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['rgi_district_code'];
                }
                ?>
            </td>
        </tr>
        <tr>
            <td scope="col"><b>Block Name :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['rgi_block_code'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['rgi_block_code'];
                }
                ?>
            </td>
            <td scope="col"><b>Village Name :</b></td>
            <td>
                <?php
                if ($nfsaAppliedRationcardsDetails[0]['rgi_village_code'] == '') {
                    echo "NA";
                } else {
                    echo $nfsaAppliedRationcardsDetails[0]['rgi_village_code'];
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    </fieldset>
    </div>
    <!-- Family Details-->
    <div class="container-fluid table ">
        <div class="card-header bg-primary text-white">Family Details</div>
        <!--        <fieldset>-->
        <!--            <legend>--><? //= __('Family Details:') ?><!--</legend>-->
        <div class="row">
            <table class="table table-bordered">
                <tbody class="headClr">
                <tr align="center">
                    <td>#</td>
                    <!--                    <td>Ration Card No</td>-->
                    <td>Name</td>
                    <td>Father Name</td>
                    <td>Existing Mobile No</td>
                    <td>Applied Mobile No</td>
                    <td>Action</td>

                </tr>
                </tbody>
                <?php
                if (!empty($seccFamiliesDetails)) {
                    $SlNo = 1;
                    foreach ($seccFamiliesDetails as $key => $value) {

//                        echo "<pre>"; print_r($seccFamiliesDetails); "<pre>"; die;
                        ?>
                        <tr align="center">
                            <td><?php echo $SlNo; ?></td>
                            <!--                            <td>-->
                            <?php //echo $value['rationcard_no'];?><!--</td>-->
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['fathername']; ?></td>
                            <td><?php echo $currMobile; ?></td>
                            <td><?php echo $value['mobile']; ?></td>
                            <td>
                                <?php echo $this->Form->create('mobApproval', ['url' => ['controller' => 'SeccCardholders', 'action' => 'approveDetails']]); ?>
                                <?php echo $this->Form->hidden('id', ['value' => $value['id']]); ?>
                                <?php echo $this->Form->hidden('rationCardNo', ['value' => $value['rationcard_no']]); ?>
                                <?php echo $this->Form->hidden('mobile', ['value' => $value['mobile']]); ?>
                                <?php echo $this->Form->hidden('activityFlag', ['id'=>'activityFlag']); ?>
                                <button type="submit" class="btn btn-outline-success verify" <?php echo $value['id']; ?> > Verify </button>

                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-outline-danger reject" data-toggle="modal"
                                        data-target="#myModal">Reject
                                </button>
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                                <h4 class="modal-title">Rejection Reason</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo $this->Form->control('rejectReason', ['label' => '', 'class' => 'form-control txtOnly', 'placeholder' => 'Enter Reason For Rejection']); ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                                                <button type="submit" class="btn btn-outline-danger" <?php echo $value['id']; ?> > Submit </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </td>
                        </tr>
                        <?php
                        $SlNo++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">Sorry ! No Records Found.</td>
                    </tr>
                <?php }
                //                <?php } ?>
            </table>
        </div>
        <!--        </fieldset>-->
    </div>

<?php } ?>


<script type="text/javascript">

    // todo: consent on submit button
    function confirmFormSubmission() {
        var message = confirm("Are you sure to proceed with provided information ?");
        if (message == true) {
            return true;
        } else {
            return false;
        }
    }

    jQuery(document).ready(function () {

        $('.verify').click(function(){
            $('#activityFlag').val('1');
            // alert($('#activityFlag').val());
            // return false
        });

        $('.reject').click(function(){
            $('#activityFlag').val('2');
            // alert($('#activityFlag').val());
            // return false
        });
        // todo: submit button check
        var flag = 0;
        $(".submitt").attr("disabled", "disabled");
        $(".submitt").click(function () {
            if (document.getElementsByName("activity_flag").selectedIndex == 0) {
                alert('Please select atleast one activity');
                var flag = 1;
            }
            if (flag == 1) {
                return false;
            }
        });
        $('select[name="activity_flag"]').change(function () {
            if (jQuery(this).parent().find("option:selected").val() && jQuery('select[name="activity_flag"] option:selected').val()) {
                $(".submitt").removeAttr("disabled");
            } else {
                $(".submitt").attr("disabled", "disabled");
            }
        });

        // todo: only number validation
        $(".numonly").keypress(function (e) {
            var key = e.keyCode;
            var id = $(this).attr('id');
            if (key >= 31 && key <= 46 || key >= 58 && key <= 126) {
                $('#' + id).val('');
                $('#' + id).css('border-color', 'red');
                $('#' + id).attr('placeholder', 'Invalid value, Only integer accepted !.');
                e.preventDefault();
            }
        });

        // todo: only alphadet validation
        $(".txtOnly").keypress(function (e) {
            var key = e.keyCode;
            var id = $(this).attr('id');
            if (key >= 33 && key <= 64) {
                $('#' + id).val('');
                $('#' + id).css('border-color', 'red');
                $('#' + id).attr('placeholder', 'Invalid value, Only character accepted !.');
                e.preventDefault();
            }
        });
    });
</script>
