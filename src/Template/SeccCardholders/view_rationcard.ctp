<?php

use Cake\Core\Configure;

$applicationType = Configure::read('applicationType');
$gender = Configure::read('gender');
$disability_status = Configure::read('disability_status');
$health_status = Configure::read('health_status');
$marital_status = Configure::read('marital_status');
$lpg_connection = Configure::read('lpg_connection');
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholderAddTemp $seccCardholderAddTemp
 */
?>
<?php echo $this->Html->script('jquery-2.1.1.min'); ?>
<?php echo $this->Html->css('print.css'); ?>
<style>
.panel-heading {
    background-color: #6c747c;
    display: block;
    text-align: center;
    padding: 6px 0px;
    font-weight: bold;
    color: #fff;
    letter-spacing: 1.5px;
    font-family: calibri;
}
.panel-heading .table-bordered th, .table-bordered td{
border:1px solid #ccc;
}
.table-bordered th {
    border: 1px solid #ccc;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #a5abb1;
}
.dname{
    font-size:22px;
    font-weight: bold;
    letter-spacing: 1.5px;
    font-family: calibri;
    text-align: left;
}
.lg{
	width:20%;
}
.arng{
text-align: center;}
</style>

<div class="row">
<div class="col-sm-12">

   <div class="row">
     <div class="col-sm-12">
	<?= $this->Form->button(__("Print"), ["type" => "button", "class" => "btn btn-success", "id" => "printDiv"]) ?>						
		<div class="wrapper">
		<p class="arng">
		<span class="lg">
		<?php echo $this->Html->image('printlogobk.png', ['alt' => 'PDS','class'=>'img-responsive', 'border' => '0']); ?>
		</span>
		<span class="dname">Department of Food, Public Distribution & Consumer Affairs</span>
		</p>
		<div class="panel panel-default">
		<div class="panel-heading">BASIC DETAILS</div>
		<div class="panel-body">
		<table class="table centered table-bordered">
		<!-- 1st -->
		<tr>
		<td> <strong> Ration Card No. </strong> </td>
		<td> <?php echo $rationcard_no; ?>  </td>
		<td> <strong> Card Type </strong> </td>
		<td> <?php echo $cardName; ?> </td>
		</tr>
		<!-- close 1st -->
		
		<!-- 2nd -->
		<tr>
		<td> <strong> Name </strong> </td>
		<td> <?php echo $JsfssSeccCardholders['name']; ?>  </td>
		<td> <strong> Name ( Hindi ) </strong> </td>
		<td> <?php echo  $JsfssSeccCardholders['name_sl']; ?>  </td>
		</tr>
		<!-- close 2nd -->
		
		<!-- 3rd -->
	
		
		<!-- 4th -->
		<tr>
		<td> <strong> Father/Husband Name </strong> </td>
		<td> <?php echo $JsfssSeccCardholders['fathername']; ?>  </td>
		<td> <strong> Father/Husband Name ( Hindi )</strong> </td>
		<td> <?php echo $JsfssSeccCardholders['fathername_sl']; ?> </td>
		</tr>
		<!-- close 4th -->
		
		<!-- 5th -->
		<tr>
		<td> <strong> District </strong> </td>
		<td> <?php echo $districtName; ?>  </td>
		<td> <strong> Block </strong> </td>
		<td> <?php echo $blockName; ?>  </td>
		</tr>
		<!-- close 5th -->
		
		<!-- 6th -->
		<tr>
		<td> <strong> Village </strong> </td>
		<td> <?php echo  $villName; ?>  </td>
		<td> <strong> Dealer </strong> </td>
		<td> <?php echo  $dealerName;  ?>  </td>
		</tr>
		<!-- close 6th -->
		
		<!-- 7th -->
		<tr>
		<td> <strong> Address </strong> </td>
		<td colspan="3"> <?php echo $JsfssSeccCardholders['res_address']; ?>  </td>

		</tr>
		<!-- close 7th -->
		
		
		</table>
		</div>
		</div>
		
		<!-- second -->
		<div class="panel panel-default">
			<!----------------------Lpg-------------------------------->
			<?php
					if ($JsfssSeccCardholders['is_lpg'] == '1' || $JsfssSeccCardholders['is_bank'] == '1') { ?>
						<div class="form-group bg-info text-center text-white">
							<b>LPG Connection and Bank Details</b></p>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td>Lpg Consumer No.</td>
									<td><?= ($JsfssSeccCardholders['is_lpg'] == 1) ? $JsfssSeccCardholders['lpg_consumer_no'] : 'NA'; ?></td>
								</tr>
								<tr>
									<td>Bank Account No.</td>
									<td><?= ($JsfssSeccCardholders['is_bank'] == 1) ? $JsfssSeccCardholders['bank_account_no'] : 'NA'; ?></td>
								</tr>
								<tr>
									<td>Bank Name</td>
									<td><?= ($JsfssSeccCardholders['is_bank'] == 1) ? $bankName : 'NA'; ?></td>
								</tr>
								<tr>
									<td>Branch Name</td>
									<td><?= ($JsfssSeccCardholders['is_bank'] == 1) ? $branchName : 'NA'; ?></td>
								</tr>
								<tr>
									<td>IFSC Code.</td>
									<td><?= ($JsfssSeccCardholders['is_bank'] == 1) ? $JsfssSeccCardholders['bank_ifsc_code'] : 'NA'; ?></td>
								</tr>

								<tbody>
								</tbody>
							</table>
						</div>
					<?php } ?>
			<!---------------------------------------------------------->
		<div class="panel-heading"> LIST OF FAMILY MEMBERS </div>
		<div class="panel-body">
		<table class="table centered table-bordered">
		<!-- 1st -->
		<thead> 
		<tr>
										<th style="width:10%;text-align:left">Sl No. </th>
										<th width="20%">Member Name</th>
										<th width="10%">Gender</th>
										<th width="10%">Age </th>
										<th width="20%">Father / Husband Name</th>
										<th width="10%">Relation with Head of Family</th>
										<th width="10%">Aadhar No. </th>
										<th width="10%"> Mobile No. </th>
										<th width="10%"> Disability </th>
										<th width="10%"> Marital Status </th>
										
										
									</tr>
		</tr>
		</thead>
		<tbody>
		<?php

$x = 1;
foreach ($JsfssSeccFamilies as $families) :
?>
	<tbody>
		<tr>
			<td style="width:10%;text-align:left"> <?php echo $x++;  ?> </td>
			<td><?php echo $families->name_sl; ?> </td>
			<td><?php if ($families->gender_id != '')
{
    echo $gender[$families->gender_id];
}
else
{
    echo 'NA';
} ?> </td>
			<td>
				<?php
				$from = new DateTime($families->dob);
				$to   = new DateTime('today');
				echo $from->diff($to)->y;
				?> 
				</td>
			<td><?php echo $families->fathername_sl; ?> </td>
			<td><?php if ($families->relation_id)
				{
				    echo $Relations[$families->relation_id];
				}
				else
				{
				    if ($families->hof == 1)
				    {
				        echo 'HEAD OF FAMILY';
				    }
				} ?>
			</td>
			<td><?php if (!empty($families->uid))
				{
				    echo 'xxxx-'.h(substr($families->uid,8,12));
				}
				else
				{
				    echo 'N/A';
				} ?>
			</td>
			<td> <?php if (!empty($families->mobile))
				{
				    echo 'xxxx-'.h(substr($families->mobile,6,10));
				}
				else
				{
				    echo 'N/A';
				} ?>
			</td>
			<td><?php if (isset($families->disability_status))
				{
				    echo $disability_status[$families->disability_status];
				}
				else
				{
				    echo 'NA';
				} ?></td>
			<td><?php if (isset($families->marital_status))
				{
				    echo $marital_status[$families->marital_status];
				}
				else
				{
				    echo 'NA';
				} ?>
		
			
		</tr>
	</tbody>
<?php endforeach; ?>
		</tbody>
				
		</table>
		</div>
		</div>
		
		</div>
		
	

     </div>
   </div>
   
   
</div>

<script>
$('#printDiv').on('click', function() {
  window.print();
})
</script>
