<?php
use Cake\Routing\Router;
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
    <?php echo $this->Form->create('nfsaRationcardApprovalFrm',['name'=>'nfsaRationcardApprovalFrm','id'=>'nfsaRationcardApprovalFrm','url'=>['controller'=>'SeccCardholders','action'=>'nfsaRationcardApproval']]); ?>
    <?php echo $this->Flash->render(); ?>
    <table width="60%" style="margin:auto;margin-top: 2%;"  class="table-condensed">
        <tr>
            <td>District</td>
            <td>
                <?php echo $this->Form->hidden(' ',['label'=>'','name'=>'rgi_district_code','id'=>'rgi_district_code','class'=>'form-control','value'=>$rgi_district_code,'readonly'=>'readonly']);
                    echo $this->Form->control(' ',['label'=>'','name'=>'districtName','id'=>'districtName','class'=>'form-control','value'=>$districtName,'readonly'=>'readonly']);
                    ?>
            </td>
        </tr>
        <tr>
            <td>Block<span style="color: red;">*</span></td>
            <td><?php echo $this->Form->select('rgi_block_code',$SeccBlocks,['id'=>'rgi_block_code','class'=>'form-control','empty'=>'--Select Block--']); ?></td>
        </tr>
        <tr>
            <td>Village</td>
            <td><?php echo $this->Form->select('rgi_village_code',$villages,['id'=>'rgi_village_code','class'=>'form-control','empty'=>'--Select Village--']); ?></td>
        </tr>
        <tr>
            <td>Application type</td>
            <td><?php echo $this->Form->select('activity_type_id',$activityType,['class'=>'form-control','empty'=>'--Select Activity Type--']); ?></td>
        </tr>
        <tr>
            <td>Application status</td>
            <td><?php
                $activity_flag=['0'=>'Pending','3'=>'Approved','4'=>'Rejected'];
                echo $this->Form->select('activity_flag',$activity_flag,['class'=>'form-control','empty'=>'--Select Activity Status--']); ?></td>
        </tr>
        <tr>
            <td colspan="6" align="center">
                <?= $this->Form->button(__('Search'), ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
            </td>
        </tr>
    </table>
    <?php echo $this->Form->end(); ?>
    <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="border:none;">
        <div class="flashMessage">
            <?php echo $this->Flash->render();?>
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
            <tr class="trHead">
                <th scope="col">Sl No</th>
                <th scope="col">Rationcard No</th>
                <th scope="col">Acknoklwdgment No</th>
                <th scope="col">Cardtype</th>
                <th scope="col">Cardholder Name</th>
                <th scope="col">Father Name</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($nfsaRationcards)) {
                $SlNo = 1;
                foreach ($nfsaRationcards as $key => $value) {
                    //echo "<pre>"; print_r($value); die();
                    ?>
                    <tr>
                        <td><?php echo $SlNo;?></td>
                        <td><?php echo $value['rationcard_no'];?></td>
                        <td>
                            <?php echo $this->Form->create('regNo',['controller'=>'SeccCardholders', 'action'=>'nfsaRationCardData']);?>
                            <?php echo $this->Form->hidden('ackNo',['value'=> $value['ack_no']]); ?>
                            <button class="btnBx"><?php echo $value['ack_no']; ?></button>
                            <?php echo $this->Form->end();?>
                        </td>
                        <td><?php echo $value['cardtype_id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['fathername'];?></td>
                    </tr>
                    <?php
                    $SlNo++;
                }
            }else{
                ?>
                <tr>
                    <td colspan="5">Sorry ! No Records Found.</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
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
    });
</script>
