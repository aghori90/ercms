

<div class="card">
    <div class="card-header bg-primary text-white">Rationcard list</div>
<!---------------------------------------Rationsearch---------------------------------------------------------------->
<div class="card-body">
<?php //echo $this->Form->create('SeccFamilies', ['controller'=>'SeccFamilies', 'id' => "submitForm"]); ?>

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

                            <?= $this->Form->postLink(
                                'View',
                                ['action' => 'viewRationcard'],
                                ['type' =>"button","class" => "btn btn-primary","data" =>['rationcard_no'=>$this->Custom->ctpEncryptData($applicant['rationcard_no'])]])
                            ?>
           
                            </td>
                                                                              
                            
                        </tr>
                    <?php $sl_no++;
                    } ?>

                </tbody>
            </table>
            
        <?php //echo $this->Form->end();  ?>
        
        <?php 
        
    
    }
                    elseif ($this->request->is(['post']))
                    {
                        echo '<div class="alert alert-danger">Ration Card not available</div>';
                    } ?>
</div>
<!----------------------------------------------------------------------------------------------------------------------->

</div>
