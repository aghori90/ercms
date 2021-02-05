<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
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
            <h4>District Wise Green Card Report</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive" id="printDiv">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl. No.</th>
                        <th>District</th>
                        <th>No. of Card</th>
                        <th>No. of Member</th>
                    </tr>
                    <?php $sl = 0;
				$total_app = 0;
				$total_member = 0;
				foreach ($datas as $key => $val) :
					$total_app = $total_app + $val["greenCardHeadCount"];
					$total_member = $total_member + $val["greenCardMemberCount"];
				?>
                    <tr>
                        <td>
                            <?= ++$sl ?>
                        </td>
                        <td>
                            <a href="/ercms/Jsfss-district-reports/BlockWiseReport/<?=$val['rgi_district_code']?>">
                                <?= $val["districtName"] ?>
                            </a>
                        </td>
                        <td>
                            <?= $val["greenCardHeadCount"] ?>
                        </td>
                        <td>
                            <?= $val["greenCardMemberCount"] ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr style="background-color:antiquewhite">
                        <td colspan="2">Total</td>
                        <td>
                            <?= $total_app  ?>
                        </td>
                        <td>
                            <?= $total_member ?>
                        </td>
                    </tr>
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