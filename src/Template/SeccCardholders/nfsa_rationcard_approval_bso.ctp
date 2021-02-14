<?php
use Cake\Routing\Router;

//echo $activityId; die;
?>
<style type="text/css">
    .rectangle{
        box-shadow: 1.5px 2px 2px #150f0fb0;
        border-radius: 5px;
        /*padding: 9px 0px;*/
        position:relative;
        display: table-cell;
        margin-right: 10px !important;
        vertical-align: middle;
        padding:2px;
        width: 130px;
    }
    .trHead{
        background-color:#12b1a2;
        color: #ffffff;
    }
    #licence{
        color: #19b50e;
        font-weight: bold;
    }
    button.btnBx {
        background-color: none;
        background-color: #fdfdfd00;
        border: none;
        color: blue;
        cursor: pointer;
    }
    .row {
        display: -ms-flexbox;
        display: flex;
        width: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: 0px;
        margin-left: 0px;
        margin-top: 14px;
    }
    label.orTag {
        border: 1px solid red;
        margin-top: 32px;
        margin-right: -20px;
        padding: 4px 8px 5px 7px;
        border-radius: 18px;
        color: red;
        margin-left: 53px;
    }
    .input.text {
        margin-top: -20px;
    }
    .fldDc {
        margin-left: 67px;
    }
    .table {
        width: 95%;
        margin-bottom: 1rem;
        background-color: rgba(0,0,0,0);
        margin-left: 21px;
        border-radius: 23px;
    }
    sub, sup {
        position: relative;
        font-size: 100%;
        line-height: 0;
        vertical-align: baseline;
        color: red;
    }
</style>
<script type='text/javascript'>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    //alert(rationCardNo);
    }
</script>

<div class="card">
    <div class="card-header bg-primary text-white">Dealer Approval </div>
    <?php echo $this->Form->create('nfsaRationcardApprovalFrm',['name'=>'nfsaRationcardApprovalFrm','id'=>'nfsaRationcardApprovalFrm']); ?>
    <?php echo $this->Flash->render(); ?>
    <div class="container-fluid">
        <fieldset>
            <div class="row">
                <!--For Village-->
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="village"><b>Village :</b></label>
                        <?php echo $this->Form->select('rgi_village_code', $villages, ['id' => 'rgi_village_code', 'class' => 'form-control', 'empty' => '--Select Village--']); ?>
                    </div>
                </div>
                <!--For Application Type-->
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="applicationType"><b>Application Type<sup class="superscr_star">*</sup> :</b></label>
                        <?php echo $this->Form->select('activity_type_id', $activityType, ['class' => 'form-control', 'empty' => '--Select Activity Type--']); ?>
                    </div>
                </div>
                <!--OR tag-->
                <div>
                    <label for="" class="orTag"><b>OR</b></label>
                </div>
                <!--For RationCard No.-->
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 fldDc">
                    <div class="form-group">
                        <label for="rationcard"><b>Ration Card No. :</b></label>
                        <?php
                        echo $this->Form->control('rationcard', ['label'=>'','class' => 'form-control', 'empty' => 'Enter Ration Card No.']); ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <!--For Application Status-->
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 bxDeck">
                    <div class="form-group">
                        <label for="applicationStatus"><b>Application Status<sup class="superscr_star">*</sup> :</b></label>
                        <?php
                        $activity_flag = ['0' => 'Pending', '1' => 'Approved', '2' => 'Rejected'];
                        echo $this->Form->select('activity_flag', $activity_flag, ['class' => 'form-control', 'empty' => '--Select Activity Status--']); ?>
                    </div>
                </div>
            </div>
            <div style="float: right; margin-right: 16px; margin-bottom: 15px;">

                <button type="submit" class="btn btn-outline-info submitt" >Search</button>
            </div>
        </fieldset>
    </div>
    <?php echo $this->Form->end(); ?>
    <?php
    if ($this->getRequest()->is('post')) {
//      todo: from jsfss_secc_cardholders table================================================================
        if (($activity_type_id == 3) ||($activity_type_id == 4) || ($activity_type_id == 5) || ($activity_type_id == 7) || ($activity_type_id == 11)) { ?>
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="border:none;">
                <div class="flashMessage">
                    <?php echo $this->Flash->render(); ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr class="trHead">
                        <th scope="col">#</th>
                        <th scope="col">Rationcard No</th>
                        <th scope="col">Acknoklwdgment No</th>
                        <th scope="col">Cardholder Name</th>
                        <th scope="col">Father Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($nfsaRationcards)) {
                        $SlNo = 1;
                        foreach ($nfsaRationcards as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $SlNo; ?></td>
                                <td><?php echo $value['rationcard_no']; ?></td>
                                <td>
                                    <?php echo $this->Form->create('regNo', ['controller' => 'SeccCardholders', 'action' => 'nfsaRationCardDataBso']); ?>
                                    <?php echo $this->Form->hidden('ackNo', ['value' => $value['ack_no']]); ?>
                                    <?php echo $this->Form->hidden('rationNo', ['value' => $value['rationcard_no']]); ?>
                                    <button class="btnBx" aria-hidden="true" data-toggle="tooltip"
                                            data-placement="right"
                                            title="click to view Details"><?php echo $value['ack_no']; ?></button>
                                    <?php echo $this->Form->end(); ?>
                                </td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['fathername']; ?></td>
                            </tr>
                            <?php
                            $SlNo++;
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6">Sorry ! No Records Found.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php }
//      todo: from jsfss_secc_families table=================================================================
        elseif (($activity_type_id == 1) || ($activity_type_id == 2) || ($activity_type_id == 6) || ($activity_type_id == 8) || ($activity_type_id == 9) || ($activity_type_id == 10)) { ?>
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="border:none;">
                <div class="flashMessage">
                    <?php echo $this->Flash->render(); ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr class="trHead">
                        <th scope="col">#</th>
                        <th scope="col">Rationcard No</th>
                        <th scope="col">Acknoklwdgment No</th>
                        <th scope="col">Cardholder Name</th>
                        <th scope="col">Father Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($nfsaRationcards)) {
                        $SlNo = 1;
                        foreach ($nfsaRationcards as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $SlNo; ?></td>
                                <td><?php echo $value['rationcard_no']; ?></td>
                                <td>
                                    <?php echo $this->Form->create('regNo', ['controller' => 'SeccCardholders', 'action' => 'nfsaRationCardDataBso']); ?>
                                    <?php echo $this->Form->hidden('ackNo', ['value' => $value['ack_no_ercms']]); ?>
                                    <?php echo $this->Form->hidden('rationNo', ['value' => $value['rationcard_no']]); ?>
                                    <button class="btnBx" aria-hidden="true" data-toggle="tooltip"
                                            data-placement="right"
                                            title="click to view Details"><?php echo $value['ack_no_ercms']; ?></button>
                                    <?php echo $this->Form->end(); ?>
                                </td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['fathername']; ?></td>
                            </tr>
                            <?php
                            $SlNo++;
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6">Sorry ! No Records Found.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php }
    } ?>
</div>
<!--Scripts Start Here-->
<?php echo $this->Html->script("jquery-ui.js")?>
<script type="text/javascript">
    $(function(){
        $('#rgi_block_code').change(function(){
            //$('#rgi_village_code').empty();
            var url = '<?=Router::url(array('controller'=>'App','action'=>'getVillagesByBlock','_full' =>true))?>';
            var rgi_block_code = $(this).val();
            var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
            $.ajax({
                type: 'POST',
                url: url,
                async:true,
                data: ({id : rgi_block_code}),
                dataType:'html',
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus)
                {
                    $('#rgi_village_code').empty();
                    var result = JSON.parse(response); //alert(result);return false;
                    $.each(result, function(val, text) {
                        $('#rgi_village_code').append($('<option></option>').val(val).html(text));
                    });
                    $("select[name=rgi_village_code]").prepend("<option value selected>Select Village</option>");
                },
                error: function(e)
                {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                }
            });
        });

        //for tooltip
        $('[data-toggle="tooltip"]').tooltip();
    });

    //  todo: script for submit button
    jQuery(document).ready(function () {
        var flag = 0;
        $(".submitt").attr("disabled","disabled");
        $(".submitt").click(function(){
            if(document.getElementsByName("activity_type_id").selectedIndex == 0){
                alert('Please select atleast one Checkbox');
                var flag = 1;
            }
            if(document.getElementsByName("activity_flag").selectedIndex == 0){
                alert('Please select atleast one Checkbox');
                var flag = 1;
            }
            if(flag == 1){
                return false;
            }
        });
        $('select[name="activity_type_id"]').change(function(){
            if( jQuery(this).parent().find("option:selected").val() && jQuery('select[name="activity_flag"] option:selected').val() ){
                $(".submitt").removeAttr("disabled");
            }else{
                $(".submitt").attr("disabled","disabled");
            }
        });
        $('select[name="activity_flag"]').change(function(){
            if( jQuery('select[name="activity_type_id"] option:selected').val() && jQuery(this).parent().find("option:selected").val() ){
                $(".submitt").removeAttr("disabled");
            }else{
                $(".submitt").attr("disabled","disabled");
            }
        });

        // todo: consent on submit button
        /*function confirmFormSubmission(){
            var message = confirm("Are you sure to proceed with provided information ?");
            if(message == true){
                return true;
            }else{
                return false;
            }
        }*/
    });

</script>
