<script type='text/javascript'>


function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        
    return true;
}


function checkRationCardNo(){
	//alert("js");
	
	var ration = document.getElementById('CardholderRationcardNo').value;
	//alert(ration.length);
	if( ration.length == 0 ){
			return true;
	}else{
			//var numericExpression = /^[0-9]+$/;
			if ( ration.length < 12  )
			{
					//alert("Rationcard number must be 12 digit.");
					alert("Please Enter A Valid Ration Card No.");
					return false;
			
			}else	{
					return true;
			}
	}
	
	



//alert(rationCardNo);
}
</script>


<script>
    function send(Id, obj) {
        document.getElementById("application-id").value = Id;
        document.getElementById("submitForm").submit();
    }
</script>

<div class="card">
    <div class="card-header bg-primary text-white">Search Rationcard</div>

<?php echo $this->Flash->render();
echo $this->Form->create('false', ['action' => 'searchRationcardResult']); ?>

<table width="60%" style="margin:auto;margin-top: 2%;"  class="table-condensed">

    <tr>
        <td>District</td>
        <td>
        <label><?php echo $districtName;?></label>
            				
        </td>		
    </tr>

		 		 
	<tr><td colspan="6">&nbsp;</td></tr>
	            	<td>Rationcard No</td>
                       <td colspan="5"><?php echo $this->Form->text('rationcard_no',['class'=>'form-control','onkeypress'=>"return isNumberKey(event)", 'maxlength'=>'12']); ?> </td>
                       
                      <td colspan="4">&nbsp;</td>
                    </tr>

		
	<tr>
       <td colspan="6" align="center">
       <?= $this->Form->button(__('Search'), ['type' => 'submit', 'class' => 'btn btn-primary']) ?>

        </td>
    </tr>
        
</table>
<!---------------------------------------Rationsearch---------------------------------------------------------------->
<div class="card-body">
<?php echo $this->Form->create('SeccFamilies', ['controller'=>'SeccFamilies','action' => 'searchRationcardRes', 'id' => "submitForm"]); ?>

        <?php if (!empty($JsfssSeccCardholders)) { ?>
            <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Rationcard No</th>
                        <th>Name</th>
                        <th>Fathername</th>
                        <th>Caste</th>
                     
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl_no = 1;
                    foreach ($JsfssSeccCardholders as $applicant) { ?>
                        <tr>
                            <td><?= $sl_no ?></td>
                            <td><b><?php echo $applicant['rationcard_no']; ?></b></td>
                            <td><b><?php echo $applicant['name']; ?></b></td>
                            <td><b><?php echo $applicant['fathername']; ?></b></td>
                            <td><b><?php echo $applicant['Castes']['name']; ?></b></td>                     
                            <td>
                            <?php
                       
                                echo $this->Html->link("View", ["action" => "searchRationView",$this->custom->ctpEncryptData($applicant['rationcard_no'])],['type' =>"button","class" => "btn btn-primary"])
                                ?>
                            </td>
                                                                              
                            
                        </tr>
                    <?php $sl_no++;
                    } ?>

                </tbody>
            </table>
            
        <?php echo $this->Form->end();  ?>
        
        <?php 
        
    
    }
                    elseif ($this->request->is(['post']))
                    {
                        echo '<div class="alert alert-danger">Ration Card not available</div>';
                    } ?>
</div>
<!----------------------------------------------------------------------------------------------------------------------->

</div>

