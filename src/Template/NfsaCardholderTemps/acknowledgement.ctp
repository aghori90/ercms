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
 * @var \App\Model\Entity\NfsaCardholderTemp $nfsaCardholderTemp
 */
?>

<main id="main">

    <!-- ======= Main Section ======= -->
    <section class="section">
        <div class="container">
            <?= $this->Flash->render() ?>
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-lg-12">
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
                                                <h5><b>झारखण्ड राज्य खाद्य सुरक्षा योजना के अंतर्गत आच्छादन हेतु स्वघोषणा पत्र सह पारिवारिक विवरणी </b></h5>
                                            </span>
                                        </div>
                                        <div class="col-sm-3 text-right"><b>आवेदन प्रपत्र</b></div>
                                    </div>
                                    <hr>

                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <h4><strong>Acknowledgement No : </strong><span style="color:#009933"><?= $nfsaCardholderTemp->ack_no ?></span></h4>
                                        </div>
                                    </div>

                                    <div class="card border-1 card-body">
                                        <div class="form-group row">
                                            <span class="col-sm-1">मैं </span>
                                            <div class="text-left col-sm-11" style="border-bottom-style: dotted;"><?php echo $nfsaCardholderTemp->name_sl ?></div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="col-sm-2">पिता / पति :-</span>
                                            <div class="text-left col-sm-10" style="border-bottom-style: dotted;"><?php echo $nfsaCardholderTemp->fathername_sl ?></div>
                                        </div>
                                        <div class="form-group row">
                                            <span class="col-sm-1">पता :-</span>
                                            <div class="text-left col-sm-11" style="border-bottom-style: dotted;"><?php echo $nfsaCardholderTemp->res_address ?></div>
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
                                                    if (($nfsaCardholderTemp->$key != '') && $nfsaCardholderTemp->$key == '1') {
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

                                        <div class="form-group bg-info text-center text-white">
                                        <b>LPG Connection and Bank Details</b>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>एलपीजी कनेक्शन</td>
                                                <td><?= ($nfsaCardholderTemp->is_lpg == 1) ? $lpg_connection[$nfsaCardholderTemp->lpg_company] : 'NA'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>उपभोक्ता संख्या .</td>
                                                <td><?= ($nfsaCardholderTemp->is_lpg == 1) ? $nfsaCardholderTemp->lpg_consumer_no : 'NA'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>खाता संख्या.</td>
                                                <td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->bank_account_no : 'NA'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>बैंक का नाम</td>
                                                <td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->bank_master->name : 'NA'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>लोकेशन</td>
                                                <td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->branch_master->name : 'NA'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>बैंक IFSC कोड.</td>
                                                <td><?= ($nfsaCardholderTemp->is_bank == 1) ? $nfsaCardholderTemp->bank_ifsc_code : 'NA'; ?></td>
                                            </tr>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Start : Details of family members -->
                                    <?php if (!empty($nfsaFamilyMember)) { ?>

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
                                                foreach ($nfsaFamilyMember as $families) :  ?>
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
                                    
                                    <!-- <div class="form-group text-center">
                                        <p>मैं घोषणा करता/ करती हूँ की मेरे द्वारा दिए गए उपरोक्त सभी तथ्य तथा संगलंग्न परिवार की सूची मेरे ज्ञान पर आधारित है तथा इसमें कुछ व् छुपाया नहीं गया है। यदि मेरे द्वारा दिए गए उपरोक्त तथ्य गलत / मिथ्या पाए जाते है तो इसके लिए कानूनी तौर पर मैं खुद जिम्मेदार रहूँगा/ रहूंगी। साथ ही मैं सर्कार से अनुचित रूप से ली गयी सहायता / अनुदान का बाजार मूल्य व इसपर सक्षम अधिकारी द्वारा निर्धारित किये गए जुरमाना / ब्याज सहित राशि वापस लौटाने का उत्तरदायी रहूँगा/ रहूंगी। भविस्य में यदि मैं या मेरा परिवार निर्धारित मापदंडों की सीमा से बाहर हो जाते हैं तो मैं इसकी सूचना ग्राम पंचायत / शहरी निकाय को दूंगा/ दूंगी व इस योज्य क अंतर्गत आगे लाभ नहीं लूँगा / लूंगी। </p>
                                    </div> -->
<!-- 
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
                                <br> -->
                                <div class="pagebreak"> </div>
                                
                                <div class="form-group text-center">
                                    <p align="center" style='color:#FF0000;font-size:12px'><b>For Check Status Visit "http://www.aahar.jharkhand.gov.in"</b></p>
                                </div>
                            </div>
                        

                        <div class="text-center mt_10">
                            <?= $this->Form->button(__("Print"), ["type" => "button", "class" => "btn btn-success", "id" => "final_submit", "onclick" => "printDiv();return false;"]) ?>
                        </div>
                        </div>

                    </div><!-- End Card Body -->
                </div><!-- End Card -->
            </div><!-- End divcol-lg-12 -->
        </div><!-- End row justify-content-center -->
        </div><!-- End container -->
    </section><!-- End Section -->

</main><!-- End #main -->

<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('printDiv').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>