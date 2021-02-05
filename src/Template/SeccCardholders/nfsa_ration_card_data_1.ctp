<?php use Cake\Routing\Router; ?>
<style>
    span.headDeco {
        display: inline-block;
        width: 100%;
        text-align: center;
        font-weight: 900;
        margin-top: 4px;
        color: green;
        border-bottom: 1px green solid;
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
</style>

<!--Ration Card Details-->
<div class="container-fluid table border rounded border border-primary">
    <span class="headDeco">Request For: New Application Ration Card</span>
    <fieldset>
        <legend><?= __('Ration Card Details:') ?></legend>
        <div class="row">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td scope="col"><b>Acknowledgement No. :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['ack_no'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['ack_no'];
                        }
                        ?>
                    </td>
                    <td scope="col"><b>Name :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['name'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['name'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td scope="col"><b>Father Name :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['fathername'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['fathername'];
                        }
                        ?>
                    </td>
                    <td scope="col"><b>Mother Name :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['mothername'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['mothername'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td scope="col"><b>Card Type :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['cardtype_id'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['cardtype_id'];
                        }
                        ?>
                    </td>
                    <td scope="col"><b>District Name :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['rgi_district_code'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['rgi_district_code'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td scope="col"><b>Block Name :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['rgi_block_code'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['rgi_block_code'];
                        }
                        ?>
                    </td>
                    <td scope="col"><b>Village Name :</b></td>
                    <td>
                        <?php
                        if ($nfsaRationcardsDetaild[0]['rgi_village_code'] == ''){
                            echo "NA";
                        }else{
                            echo $nfsaRationcardsDetaild[0]['rgi_village_code'];
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
<div class="container-fluid table border rounded border border-primary">
    <fieldset>
        <legend><?= __('Family Details:') ?></legend>
        <div class="row">
            <table class="table table-bordered">
                <tbody class="headClr">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Name (HI)</td>
                    <td>Father Name</td>
                    <td>Father Name(HI)</td>
                    <td>Relation With Family Head</td>
                    <td>Mobile</td>
                    <td>AAdhaar</td>
                    <td>Bank</td>
                    <td>Branch</td>
                    <td>Account</td>
                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>





