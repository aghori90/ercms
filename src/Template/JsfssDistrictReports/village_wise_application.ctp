<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
 use Cake\Core\Configure;
$applicationType = Configure::read('applicationType');
$disability_status = Configure::read('disability_status');
$health_status = Configure::read('health_status');
$marital_status = Configure::read('marital_status');
echo $this->Html->script("ration.js");
?>
    <style>
        .mb_10 {
            margin-bottom: 20px;
        }
    </style>
    <?php echo $this->Form->create(false, ["id" => "login"]) ?>
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Village Wise Green Card Application List</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive" id="printDiv">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Acknowledgement No</th>
                        <th>Card</th>
                        <th>Cardholder Name</th>
                        <th>Category</th>
                        <th>Age</th>
                        <th>Member Count</th> 
                        <th>Disability</th>
                        <th>Marital Status</th>
                        <th>Uncurable Disease</th>
                        <th>Applied Date</th>
                        <th>Application Status</th>
                    </tr>
                    <?php $sl = 0;
					
				//$sr_no=$this->request->params['paging']['Plots']['start'];
				foreach ($datas as $applicant) :					
				?>
                    <tr>
                        <td>
                            <?= ++$sl ?>
                        </td>
                            <td><b><?php echo $applicant->ack_no; ?></b></td>
                            <td><?= $applicant->cardtype->name ?></td>
                            <td><?= $applicant->name ?></td>
                            <td><?= $applicant->caste->name ?></td>
                             <td><?php if ($applicant->secc_family_add_temps[0]->dob != '') {
                                    $dob = $applicant->secc_family_add_temps[0]->dob;
                                    $from = new DateTime($dob);
                                    $to   = new DateTime('today');
                                    echo $from->diff($to)->y;
                                } else {
                                    echo 'NA';
                                }
                                ?></td>
                                <td><?php echo $applicant->family_count;?></td>
                                <td><?php if (isset($applicant->secc_family_add_temps[0]->disability_status)) {
                                    echo $disability_status[$applicant->secc_family_add_temps[0]->disability_status];
                                } else {
                                    echo 'NA';
                                } ?></td>
                            <td><?php if (isset($applicant->secc_family_add_temps[0]->marital_status)) {
                                    echo $marital_status[$applicant->secc_family_add_temps[0]->marital_status];
                                } else {
                                    echo 'NA';
                                } ?></td>
                            
                            <td><?php if (isset($applicant->secc_family_add_temps[0]->health_status)) {
                                    echo $health_status[$applicant->secc_family_add_temps[0]->health_status];
                                } else {
                                    echo 'NA';
                                } ?></td>
                                <td><?php echo date('d-m-Y',strtotime($applicant->created))?></td>
                                <td> <?php 
								if($applicant->activity_flag == 0):
									echo 'Pending';
								elseif($applicant->activity_flag == 1):
									echo 'BSO Approved';
								elseif($applicant->activity_flag == 2):
									echo 'BSO Rejected';
								elseif($applicant->activity_flag == 3):
									echo 'DSO Approved';
								elseif($applicant->activity_flag == 4):
									echo 'DSO Rejected';
								endif;
								?></td>
                    </tr>
                    <?php endforeach; ?>
                   
                </table>
            </div>
        </div>
        <div class="text-center mb_10">
            <?= $this->Form->button(__("Print"), ["type" => "button", "class" => "btn btn-success", "onclick" => "printDiv();return false;"]) ?>
        </div>
    </div>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('printDiv').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>