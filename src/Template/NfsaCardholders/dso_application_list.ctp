<?php
use Cake\Core\Configure;
$applicationType = Configure::read('applicationType');
$disability_status = Configure::read('disability_status');
$health_status = Configure::read('health_status');
$marital_status = Configure::read('marital_status');
?>
<script>
    function send(Id, obj) {
        document.getElementById("application-id").value = Id;
        document.getElementById("submitForm").submit();
    }
</script>
<?php echo $this->Flash->render();
echo $this->Form->create('false', ['action' => 'dsoApplicationView', 'id' => "submitForm"]); ?>
<div class="card">
    <div class="card-header bg-primary text-white">Application List</div>
    <div class="card-body">
        <?php if (!empty($seccCardholderAddTemp)) { ?>
            <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Acknowledgement No</th>
                        <th>Card Type</th>
                        <th>Cardholder Name</th>
                        <th>Age</th>
                        <th>Application Type</th>
                        <th>Caste</th>
                        <th>Disability</th>
                        <th>Marital Status</th>
                        <th>Uncurable Disease</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl_no = 1;
                    foreach ($seccCardholderAddTemp as $applicant) { ?>
                        <tr>
                            <td><?= $sl_no ?></td>
                            <td><b><?php echo $applicant->ack_no; ?></b></td>
                            <td><?php echo $x[$applicant->cardtype_id]; ?></td>
                            <td><?= $applicant->name ?></td>
                            <td><?php if ($applicant->nfsa_family_add_temps[0]->dob != '')
                    {
                        $dob = $applicant->nfsa_family_add_temps[0]->dob;
                        $from = new DateTime($dob);
                        $to   = new DateTime('today');
                        echo $from->diff($to)->y;
                    }
                    else
                    {
                        echo 'NA';
                    }
                                ?></td>
                            <td><?php if ($applicant->applicationType != '')
                                {
                                    echo $applicationType[$applicant->applicationType];
                                }
                                else
                                {
                                    echo 'NA';
                                } ?></td>
                          <td><?= $Castes[$applicant->caste_id] ?></td> 
                            <td><?php if (isset($applicant->nfsa_family_add_temps[0]->disability_status))
                                {
                                    echo $disability_status[$applicant->nfsa_family_add_temps[0]->disability_status];
                                }
                                else
                                {
                                    echo 'NA';
                                } ?></td>
                            <td><?php if (isset($applicant->nfsa_family_add_temps[0]->marital_status))
                                {
                                    echo $marital_status[$applicant->nfsa_family_add_temps[0]->marital_status];
                                }
                                else
                                {
                                    echo 'NA';
                                } ?></td>
                            <td><?php if (isset($applicant->nfsa_family_add_temps[0]->health_status))
                                {
                                    echo $health_status[$applicant->nfsa_family_add_temps[0]->health_status];
                                }
                                else
                                {
                                    echo 'NA';
                                } ?></td>
                            <td>
                            

                                <?php
                                echo $this->Form->submit(__("View"), ["type" => "button", "label" => false, "class" => "btn btn-primary", "id" => "view" . $applicant->id, "onclick" => "javascript:send('" . $applicant->id . "',this.id)"])
                                ?>
                            </td>
                        </tr>
                    <?php $sl_no++;
                    } ?>

                </tbody>
            </table>
        <?php }
                    else
                    {
                        echo '<div class="alert alert-danger">No Pending Request for New Ration Card Application Found</div>';
                    } ?>
        <?php echo $this->Form->input('application_id', ['type' => 'hidden']); ?>
        <?php echo $this->Form->end();  ?>
    </div>
</div>
