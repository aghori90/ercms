<?php 
use Cake\Routing\Router;
?>

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
    <div class="card-header bg-primary text-white">Search Application</div>

<?php echo $this->Flash->render();
echo $this->Form->create('false', ['action' =>'dsoApplicationList']); ?>

<table width="60%" style="margin:auto;margin-top: 2%;"  class="table-condensed">

    <tr>
        <td>District</td>
        <td>
        <label><?php echo $districtName;?></label>
            				
        </td>		
    </tr>
		
		
    <tr>
        <td>Block<span style="color: red;">*</span></td>
        <td><?php echo $this->Form->select('rgi_block_code',$SeccBlocks,['id'=>'rgi_block_code','class'=>'form-control','empty'=>'-----select-----']); ?></td>			
    </tr>
    <tr>
        <td>Village</td>
        <td><?php echo $this->Form->select('rgi_village_code',null,['class'=>'form-control','empty'=>'-----select-----']); ?></td>			
    </tr>
    <tr>
        <td>Application type</td>
        <td><?php 
        $activity=['1'=>'New Rationcard Application'];
        echo $this->Form->select('activity_type_id',$activity,['class'=>'form-control']); ?></td>			
    </tr>
    <tr>
        <td>Application status</td>
        <td><?php 
         $activity_flag=['1'=>'Pending','3'=>'Approve','4'=>'rejected'];
        echo $this->Form->select('activity_flag',$activity_flag,['class'=>'form-control']); ?></td>			
    </tr>
		 		 
	<tr><td colspan="6">&nbsp;</td></tr>
	<tr><td colspan="6" align="center">OR</td></tr>
	
	                <tr>
                    	<td>Ack No</td>
                       <td colspan="5"><?php echo $this->Form->text('ack_no',['class'=>'form-control','onkeypress'=>"return isNumberKey(event)", 'maxlength'=>'12']); ?> </td>
                       
                      <td colspan="4">&nbsp;</td>
                    </tr>

		
	<tr>
       <td colspan="6" align="center">
       <?= $this->Form->button(__('Search'), ['type' => 'submit', 'class' => 'btn btn-primary']) ?>

        </td>
    </tr>
        
</table>

</div>
<?php echo $this->Html->script("jquery-ui.js")?>
<script type="text/javascript">
$(function(){  
$('#rgi_block_code').change(function(){
            $('#rgi_village_code').empty();
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
