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

<div class="main-card mb-3 card">
    <div class="card">
        <div class="card-body">
            <div class="card-header bg-secondary text-white text-center font-weight-bold">Acknowledgement Receipt</div>
            <br />
            <!-- Start : Print Div -->
            <div id="printDiv">
                <div style="background-color: #ffffff; border: dashed; 1px; padding: 20px;">

                <div class="form-group row h-100">
                                        <div class="col-sm-3 text-left"><b>निःशुल्क</b></div>
                                        <div class="col-sm-6 justify-content-center align-self-center text-center"> <span><?php echo $this->Html->image('jh_logo.png', ['alt' => 'PDS', 'border' => '0']); ?></span>
                                            <br />
                                            <span>
                                                <h5 class="jsfss">झारखण्ड राज्य खाद्य सुरक्षा योजना के अंतर्गत आच्छादन हेतु स्वघोषणा पत्र सह पारिवारिक विवरणी </h5>
                                            </span>
                                        </div>
                                        <div class="col-sm-3 text-right"><b>आवेदन प्रपत्र</b></div>
                                    </div>
                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <h4><strong>Acknowledgement No : </strong><span style="color:#009933"><?= $seccCardholderAddTemp->ack_no ?></span></h4>
                        </div>
                    </div>

                    <div class="card border-1 card-body">
                        <div class="form-group row">
                            <span class="col-sm-1">मैं </span>
                            <div class="text-left col-sm-11" style="border-bottom-style: dotted;"><?php echo $seccCardholderAddTemp->name_sl ?></div>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-2">पिता / पति :-</span>
                            <div class="text-left col-sm-10" style="border-bottom-style: dotted;"><?php echo $seccCardholderAddTemp->fathername_sl ?></div>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-1">पता :-</span>
                            <div class="text-left col-sm-11" style="border-bottom-style: dotted;"><?php echo $seccCardholderAddTemp->res_address ?></div>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-12"> श्रेणी-सामान्य /पिछड़ा वर्ग /अत्यंत पिछड़ा वर्ग /अनुसूिचत जाती / अनुसूिचत जनजाती/ PVTG,
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-1">आयु </span>
                            <div class="text-left" style="border-bottom-style: dotted; width:200px"><?php if ($hof_age->dob != '') {
                                                                                                        $from = new DateTime($hof_age->dob);
                                                                                                        $to   = new DateTime('today');
                                                                                                        echo $from->diff($to)->y;
                                                                                                        //echo date('d-m-Y', strtotime($hof_age->dob));
                                                                                                    } else {
                                                                                                        echo 'NA';
                                                                                                    }  ?></div>
                        </div>
                        <div class="form-group">
                            <p> पूर्ण सत्यनिष्ठा के साथ घोषणा करता /करती हूँ की निम्नवर्णित समावेशन मानक ( <b>Inclusion Criteria </b>) के आधार पर मैं एक सुपात्र आवेदक हूँ ( प्रासंगिक कोष्ठक में &#10004; लगाएँ )-</p>
                        </div>
                        <div class="form-group">
                            <p>
                                <?php $i = 0;
                                //debug($inclusion_criterias);
                                foreach ($inclusion_criterias as $inclusion) {
                                    $key = $inclusion->cardholder_col;
                                    if (($seccCardholderAddTemp->$key != '') && $seccCardholderAddTemp->$key == '1') {
                                        $check = 'checked';
                                    } else {
                                        $check = '';
                                    }
                                    echo $this->Form->checkbox('inclusion_criteria.' . $inclusion->cardholder_col, ['class' => 'inclusion_criteria', 'id' => 'inclusion_criteria', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $check]) . ' &nbsp;' . $inclusion->name . '<br /><hr style="border-top: 2px dashed grey;">';
                                    $i++;
                                }
                                ?>
                            </p>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label font-weight-bold">उपर्युक्त क्रम में निम्नवर्णित समावेशन मानक ( Exclusion Criteria ) के आधार पर पूर्ण सत्यनिष्ठान के साथ घोषणा करता/करती हूँ कि - </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 ">
                                1. मैं और मेरे परिवार का कोई भी सदस्य , भारत सरकार /राज्य सरकार /केंद्र शासित प्रदेश या इनके परिषद /उधम/प्रक्रम /उपक्रम/अन्य स्वयत निकाय जैसे विश्वविद्यालय इत्यादि/नगर निगम/नगर पषर्द/नगरपालिका/न्यास इत्यादि में नियोजित/सेवानिवृत नहीं है,
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                            <div class="col-sm-12 ">
                                2. मैं और मेरे परिवार का कोई भी सदस्य, आयकर/सेवा कर/व्यावसायिक कर/GST नहीं देता है,
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                            <div class="col-sm-12 ">
                                3. मैं और मेरे परिवार के पास पांच एकड़ से अधीक सिंचित भूमी अथवा दस एकड़ से असिंचित भूमी नहीं है,
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                            <div class="col-sm-12 ">
                                4. मैं और मेरे परिवार का किसी सदस्य के नाम से चार पहिया मोटर वाहन ( four wheeler ) अथवा इससे अधिक पहिया के वाहन नहीं है,
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                            <div class="col-sm-12 ">
                                5. मैं और मेरे परिवार का कोई भी सदस्य सरकार द्वारा पंजीकृत उधम का स्वामी या संचालक नहीं है,
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                            <div class="col-sm-12 ">
                                6. मैं और मेरे परिवार के पास पक्की दीवारों तथा छत्त के साथ तीन या इससे अधिक कमरों का पक्का मकान नहीं है, जो प्रधानमंत्री आवास योजना से अनाच्छादित है,
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                            <div class="col-sm-12 ">
                                7. मैं और मेरे परिवार के पास 5 लाख या इससे अधिक लागत ला मशीन चालित चार पहिये वाले कृषि उपकरण ( ट्रैक्टर, थ्रेसर इत्यादि ) नहीं है |
                                <hr style="border-top: 2px dashed grey;">
                            </div>
                        </div>
                        <div class="form-group">

                            मैं घोषणा करता / करती हूँ कि मेरी आयु 18 वर्ष या इससे अधिक है तथा मेरे द्वारा दिए गये उपरोक्त सभी तथ्य तथा संलग्न परिवार की सूची मेरे ज्ञान पर आधारित है व सत्य है तथा इसमें कुछ भी छुपाया नहीं गया है |

                        </div>
                        <div class="form-group ">
                            <p>
                                यदि मेरे द्वारा दिए गये उपरोक्त्त तथ्य गलत / मिथ्या पाये जाते हैं तो इसके लिए क़ानूनी तौर पर मैं खुद जिम्मेदार रहूँगा / रहूँगी |
                            </p>
                        </div>
                        <div class="form-group ">
                            <p>
                                साथ ही मैं सरकार से अनुचित रूप से ली गई सहायता ( खाधान्न इत्यादि ) का बाजार मूल्य व इस पर सक्षम अधिकारी द्वारा निर्धारित किये गये जुर्माने/ब्याज सहित राशी वापस लौटाने का उत्तरदायी रहूँगा / रहूँगी |
                            </p>
                        </div>
                        <div class="form-group ">
                            <p>
                                भविष्य मैं यदि मैं या मेरा परिवार, निर्धारित मापदंडों की सीमा से बाहर हो जाते है तो में इसकी सुचना ग्राम पंचायत/शहरी निकाय को दूँगा/दूँगी व इस योजना के अंतर्गत आगे लाभ नहीं लूँगा/लूँगी |
                            </p>
                        </div>

                        <div class="form-group row">
                            <label class="col col-sm-1">स्थान </label>
                            <p></p>
                            <div class="col col-sm-4" style="border-bottom: 2px dotted grey; padding: 20px;"></div>
                            <label class="col col-sm-1 offset-sm-1">हस्ताक्षर </label>
                            <div class="col col-sm-4" style="border-bottom: 2px dotted grey; padding: 20px;"></div>
                        </div>
                        <div class="form-group row">
                            <label class="col col-sm-1">दिनांक </label>
                            <div class="col col-sm-4" style="border-bottom: 2px dotted grey;"></div>
                            <label class="col col-sm-1 offset-sm-1">नाम </label>
                            <div class="col col-sm-4" style="border-bottom: 2px dotted grey;"></div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <table class="table table-bordered">
                            <tr>
                                <td width="455" style="height:100%;">
                                    <table style="border:hidden">
                                        <tr>
                                            <td class="text-center"><u>पता</u></td>
                                        </tr>
                                        <tr>
                                            <td>ग्राम : <?php if ($seccCardholderAddTemp->location_id == 2) {
                                                            echo  $seccCardholderAddTemp->secc_village_ward->name;
                                                        } else {
                                                            echo 'NA';
                                                        } ?></td>
                                        </tr>
                                        <tr>
                                            <td>वार्ड संख्यां (शहरी क्षेत्र के लिए) : <?php if ($seccCardholderAddTemp->location_id == 1) {
                                                                                            echo  $seccCardholderAddTemp->secc_village_ward->name;
                                                                                        } else {
                                                                                            echo 'NA';
                                                                                        } ?></td>
                                        </tr>
                                        <tr>
                                            <td>पंचायत : <?php if ($seccCardholderAddTemp->panchayat_id != '') {
                                                                echo  $seccCardholderAddTemp->panchayat->name;
                                                            } else {
                                                                echo 'NA';
                                                            } ?></td>
                                        </tr>
                                        <tr>
                                            <td>प्रखंड : <?php echo $seccCardholderAddTemp->secc_block->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td>जिला : <?php echo $seccCardholderAddTemp->secc_district->name; ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="461">
                                    <table style="border:hidden">
                                        <tr>
                                            <td class="text-center">प्राथमिकता सूचि हेतु अधिमानता मानक</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($seccCardholderAddTemp->caste_id == 7) {
                                                    $pvtg_check = "checked";
                                                } else {
                                                    $pvtg_check = "";
                                                }
                                                if ($seccCardholderAddTemp->caste_id == 4) {
                                                    $sc_check = "checked";
                                                } else {
                                                    $sc_check = "";
                                                }
                                                if ($seccCardholderAddTemp->caste_id == 3) {
                                                    $st_check = "checked";
                                                } else {
                                                    $st_check = "";
                                                }
                                                if ($seccCardholderAddTemp->health_status == 1) {
                                                    $health_check = "checked";
                                                } else {
                                                    $health_check = "";
                                                }
                                                if ($seccCardholderAddTemp->disability_status == 1) {
                                                    $disability_check = "checked";
                                                } else {
                                                    $disability_check = "";
                                                }
                                                if ($seccCardholderAddTemp->marital_status == 1) {
                                                    $marital_check = "checked";
                                                } else {
                                                    $marital_check = "";
                                                }
                                                if ($seccCardholderAddTemp->old_alone == 1) {
                                                    $old_alone_check = "checked";
                                                } else {
                                                    $old_alone_check = "";
                                                }
                                                if ($pvtg_check == '' && $sc_check == '' && $st_check == ""  && $health_check == "" && $disability_check == "" && $marital_check == "" && $old_alone_check == "") {
                                                    $other_check = 'checked';
                                                } else {
                                                    $other_check = '';
                                                }
                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $pvtg_check]) . ' &nbsp;आदिम जनजाति परिवार (PVTG)<br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $marital_check]) . ' &nbsp;विधवा / परित्यकता/ (Transagender) <br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $disability_check]) . ' &nbsp;निःशक्त (40 प्रतिशत या इससे अधिक) <br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $health_check]) . ' &nbsp;कैंसर/ एड्स/ कुष्ठ/ अन्य असाध्य रोगों से ग्रसित व्यक्ति <br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $old_alone_check]) . ' &nbsp;अकेले रहने वाला वृद्ध/बुजुर्ग व्यक्ति/एकल परिवार <br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $st_check]) . ' &nbsp;अनुसूचित जनजाति <br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $sc_check]) . ' &nbsp;अनुसूचित जाती <br />';

                                                echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => $other_check]) . ' &nbsp;अन्यान्य  <br />'; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="487">
                                    <table>
                                        <tr>
                                            <td class="text-center" style="border:hidden"><u>बैंक खाता विवरणी </u></td>
                                        </tr>
                                        <tr>
                                            <td style="border:hidden">आवेदक मुखिया का नाम : <?php echo $seccCardholderAddTemp->name_sl; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border:hidden">बैंक का नाम : <?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_master->name : 'NA'; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border:hidden">बैंक शाखा का नाम : <?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->branch_master->name : 'NA'; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border-left:hidden;border-right:hidden">बैंक खाता संख्या : <?= ($seccCardholderAddTemp->is_bank == 1) ? $seccCardholderAddTemp->bank_account_no : 'NA'; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="border:solid;1px;">&#8226; आवेदक के साथ आवश्यक कागजात यथा - आधार कार्ड, बैंक खता विवरणी तथा प्राथमिकता सूचि में स्थान पाने हेतु अधिमान्यता मानक
                                                के लिए जाती प्रमाण पत्र तथा निःशक्ता /असाध्य रोगो से सम्बंधित प्रमाण पत्र इत्यादि संलग्न करना अनिवार्य है </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <!-- Start : Details of family members -->
                    <?php if (!empty($seccCardholderAddTemp->secc_family_add_temps)) { ?>

                        <div class="">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:10%;text-align:left">क्र० सं०</th>
                                    <th width="20%">आवेदक मुखिया/ सदस्य (नाम)</th>
                                    <th width="10%">लिंग(M/F/Other)</th>
                                    <th width="20%">पिता / पति</th>
                                    <th width="10%">जन्म तिथि </th>
                                    <th width="10%">मुखिया से रिश्ता </th>
                                    <th width="10%">आधार संख्यां</th>
                                    <th width="10%">मोबाइल नंबर </th>
                                </tr>
                                <?php $x = 1;
                                foreach ($seccCardholderAddTemp->secc_family_add_temps as $families) :  ?>
                                    <tr>
                                        <td style="text-align:left"> <?php echo $x++;  ?> </td>
                                        <td><?php echo $families->name_sl; ?> </td>
                                        <td><?php if ($families->gender_id != '') {
                                                echo $gender[$families->gender_id];
                                            } else {
                                                echo 'NA';
                                            } ?>
                                        </td>
                                        <td><?php echo $families->fathername_sl; ?> </td>
                                        <td><?php //$today = date('Y-m-d');
                                            if ($families->dob != '') {
                                                echo date('d-m-Y', strtotime($families->dob));
                                            } else {
                                                echo 'NA';
                                            } ?>
                                        </td>
                                        <td><?php if ($families->relation_id) {
                                                echo $families->relation->name;
                                            } else if ($families->hof == 1) {
                                                echo 'स्वयं ';
                                            } ?>
                                        </td>
                                        <td><?php if (!empty($families->uid)) {
                                                echo h($families->uid);
                                            } else {
                                                echo 'N/A';
                                            } ?>
                                        </td>
                                        <td> <?php if (!empty($families->mobile)) {
                                                    echo h($families->mobile);
                                                } else {
                                                    echo 'N/A';
                                                } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php } ?>
                    <!-- End : Details of family members -->
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr style="border-bottom: hidden">
                                    <td width="50%" class="font-weight-bold">मेरे आवेदन में वर्णित उपर्युक्त विवरणी को मैंने स्वयं जांच की है तथा इसमें कोई व् त्रुटि नहीं है। </td>
                                    <td style="text-align:left"><b>आवेदक के द्वारा समर्पि आवेदन में वर्णित तथ्यों को जांचोपरांत मैंने सही पाया / निम्नवर्णित कारण से सही नहीं पाया :-</b>
                                        <br>
                                        <?php echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => '']) . ' &nbsp;आवेदक समावेशन मानक (कंडिका संख्यां )-.................के आधार पर सुपात्र नहीं है।  <br />';
                                        echo  $this->Form->checkbox('priority', ['class' => 'priority', 'id' => 'priority', 'disabled' => 'disabled', 'value' => $inclusion->id, 'hiddenField' => false, "checked" => '']) . ' &nbsp;आवेदक अपवर्जन  मानक (कंडिका संख्यां )-.................के आधार पर सुपात्र नहीं है। <br />'; ?>
                                    </td>
                                </tr>
                                <tr class="text-right font-weight-bold" style="margin-top:3%; height:100px;  ">
                                    <td width="50%" style="vertical-align:bottom;">आवेदक मुखिया का हस्ताक्षर </td>
                                    <td style="vertical-align:bottom;">सत्यापनकर्त्ता का हस्ताक्षर नाम एवं पदनाम </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="text-center mt_10">
                <?php echo $this->Form->button(__("Print"), ["type" => "button", "class" => "btn btn-success", "id" => "final_submit", "onclick" => "printDiv();return false;"]);
                echo '&emsp;'.$this->Html->link("Back", "/SeccCardholderAddTemps/checkAcknowledgement/", ["class" => "btn btn-danger"]);  ?>
            </div>

        </div><!-- End Card Body -->
    </div><!-- End Card -->
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