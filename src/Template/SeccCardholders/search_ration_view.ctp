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

</style>

<div class="app-main__outer">
<div class="app-main__inner">

   <div class="main-card mb-3 card">
     <div class="card-body">
	<?= $this->Form->button(__("Print"), ["type" => "button", "class" => "btn btn-success", "id" => "printDiv"]) ?>						
		<div class="wrapper">
		<div class="table">
		<table class="table table-bordered">
		<!-- first phase -->
		<tr>
		<!-- 1st -->
		<td class="adjst" valign=top>
				<table class="table centered border">
		
		<thead>
		<p class="rcnbk"> Ration Card No. / राशन कार्ड संख्या : <?php echo $rationcard_no; ?> </p>
		<tr>
		<th width="10%"> क्र० </th>
		<th width="25%"> पूरा नाम </th>
		<th width="15%"> लिंग </th>
		<th width="20%"> उम्र  </th>
		<th width="25%"> संबंध </th>
		</tr>
		</thead>
		<tbody>
		<?php 
		$sno=0;
		foreach ($JsfssSeccFamilies as $val)
		{?>		
			<tr>
			<td><?php echo ++$sno;?></td>
			<td><?php echo $val['name_sl']; ?> </td>
			<td> <?php echo $Genders[$val['gender_id']]; ?> </td>
			<td>
				<?php
												$from = new DateTime($val['dob']);
												$to   = new DateTime('today');
												echo $from->diff($to)->y;
												?> 
			</td>

			<td> <?php echo $Relations[$val['relation_id']]; ?> </td>
			
			</tr>
	<?php }?>
		</tbody>
		
		</table>
		
		<table class="table table-bordered">
		<tr>
		<td >कुल व्यक्तियों की संख्या : : <?php echo $JsfssSeccCardholders['family_count']; ?> </td>
		</tr>
		<tr>
		<td> कार्डधारी का हस्ताक्षर : :  <?php echo ""; ?> </td>
		</tr>
		
		</table>
		
		
		<span class="rcnftr" >
		Help Line No :- 18003456598 <br />
		IT SUPPORT BY NATIONAL INFORMATICS CENTRE ( NIC )
		</span>
		
		
		</td>
		<!-- close 1st -->
		
		<!-- 2nd -->
		<td class="adjstmid">
		
		</td>
		<!-- close 2nd -->
		
		<!-- 3rd -->
		<td class="adjst">
		
		<div class="centered padd" style="text-align:center;">
		<h2> <strong> ग्रीन राशन कार्ड </strong> </h2>
		<p> <h6 class="text-center"><strong> खाद्य,  सार्वजानिक वितरण एवं उपभोक्ता मामले विभाग </strong> </h6></p>
		<?php echo $this->Html->image('logobk.png', ['alt' => 'PDS','style'=>'margin:0px auto;', 'border' => '0']); ?>
		</div>
		<p class="text-center"> <strong> झारखण्ड राज्य खाद्य सुरक्षा योजना <br /> जिला :- <span class="line"> <?php echo $districtName; ?> </span> </strong> </p>
		<p class="rcn"> Ration Card No. / राशन कार्ड संख्या : <?php echo $rationcard_no; ?> </p>
		<p> <h4 class="text-center"><strong> कार्डधारी का  नाम  :<?php echo $JsfssSeccCardholders['name_sl']; ?> </strong> </h4></p>
		<?php echo $this->Html->image('barcode.png', ['alt' => 'PDS','style'=>'margin:0px auto;display:block;', 'border' => '0']); ?>
		
		</td>
		<!-- close 3rd -->
		
		</tr>
		<!-- close first Phase -->
		
		
		<tr style="height: 10px;"></tr>
		
		
		<!-- second Phase -->
	    <tr>
		<!-- 1st -->
		<td class="adjst">
		
		<table class="table centered table-bordered">
		
		<thead>
		<p class="rcnbk"> Ration Card No. / राशन कार्ड संख्या : <?php echo $rationcard_no; ?> </p>
		
		<ol>
		<li> <span> कार्डधारी का नाम :  <?php echo $JsfssSeccCardholders['name_sl']; ?> </span> </li>
		<li> <span> Cardholder Name :  <?php echo $JsfssSeccCardholders['name']; ?>  </span>
		<span> 18 वर्ष या उससे अधिक उम्र की विवाहित / विधवा / परित्यक्ता महिला सदस्य परिवार की मुखिया होंगी | परिवार में इनके ना होने की स्थिति में सबसे अधिक आयु के पुरुष या सदस्य परिवार के मुखिया होंगे किन्तु  परिवार में 18 वर्ष या उससे अधिक उम्र की विवाहित / विधवा / परित्यक्ता महिला आ जाने की स्थिति में महिला सदस्य परिवार की मुखिया होंगे | </span></li>
		<li> <span> पिता / पति का नाम : <?php echo $JsfssSeccCardholders['fathername_sl']; ?> </span> </li>
		<li> <span> आवासीय पता : 
		<br>
			<span> गाँव वार्ड  :  <span class="line"> <?php echo $villName; ?> </span> </span>
			<br>
			<span> प्रखण्ड/नगर पालिका : <span class="line"> <?php echo $blockName; ?> </span> </span>
			<br>
			<span> जिला का नाम  : <span class="line"> <?php echo $districtName; ?> </span> </span>
		
		</span> </li>
		<li> <span>लक्षित जन वितरण प्रणाली के दूकानदार का नाम पता : <br />
		
			<span> वितरक का नाम : <span class="line"> <?php echo $Dealers['name']; ?> </span> </span>
			<br />
	        <span> वितरक का पता  : <span class="line"> <?php echo $Dealers['address_hn']; ?> </span> </span>
						
		</span>
		</li>
		</ol>
		</thead>
		<tbody>
		<div class="row ds">
		<div class="col-md-6 date"> <span> निर्गत करने की तिथि :  <?php echo $JsfssSeccCardholders['created']; ?> </span>  </div>
		<div class="col-md-6 sign"> 
		<span>	जिला आपूर्ति पदाधिकारी द्वारा
			<br />
			पाधिकृत अधिकारी का हस्ताक्षर
			</span></div>
		</div>
		 
		
           
		</tbody>
		</table>
		
		</td>
		<!-- close 1st -->
		
		<!-- 2nd -->
		<td class="adjstmid">
		
		</td>
		<!-- close 2nd -->
		
		<!-- 3rd -->
		<td class="adjst">
		
		<table class="table centered table-bordered">
		
		<thead>
		<p class="rcnbk"> कार्डधारियों  के लिए आवश्यक सूचनाएँ  </p>
		</thead>
		</table>
		<ol>
		<li> <span>  यह राशन कार्ड कार्डधारी को निजी रूप से दिया गया है | इसे कार्डधारी के अलावा कोई और व्यवहार में नहीं ला सकता है | कार्ड को सुरक्षित रखना कार्डधारी की निजी जिम्मेदारी है | </span> </li>
		<li> <span> प्राधिकृत उचित मूल्य के दूकान से राशन लेने के समय कार्ड में राशन की मात्रा अवश्य अंकित करा लें | अपने कार्ड को दूकान में किसी भी हालत में नहीं छोड़ना चाहिये | </span> </li>
		<li> <span>  किसी माह का राशन अगर उसी माह में नहीं प्राप्त किया जाये तो वह राशन अगले माह में भी मिल सकता है |  </span> </li>
		<li> <span> उचित मूल्य के दुकानदारो के विरुद्ध यदि कोई शिकायत हो तो उसकी सूचना उपायुक्त / अनुमंडल पदाधिकारी / जिला आपूर्ति पदाधिकारी / पणन पदाधिकारी / प्रखण्ड आपूर्ति पदाधिकारी / आपूर्ति निरीक्षक को भेजी जा सकती है | </span> </li>
		<li> <span> यह कार्ड निःशुल्क है | इसके खो जाने या अन्य कारणो से दूसरे कार्ड की आवश्यकता पड़ने पर इसकी आपूर्ति निर्धारित राशि प्राप्त होने के उपरांत, उचित जाँच के बाद जिला आपूर्ति पदाधिकारी / प्रखण्ड आपूर्ति पदाधिकारी  के कार्यालय से प्राप्त की जा सकेगी | </span> </li>
		<li> <span> कार्डधारी अगर अपने निवास स्थान को बदले तो इसकी सूचना जिला आपूर्ति पदाधिकारी / प्रखण्ड आपूर्ति पदाधिकारी आपूर्ति निरीक्षक को तुरंत दे और अपने नये निवास के वार्ड की दुकान में अपना कार्ड स्थानांतरित करवा ले | </span> </li>
		<li> <span> जब कार्डधारी का अपने  राशनिंग क्षेत्र / अपने क्षेत्र के बाहर जाना निश्चित हो जाय तब इस राशन कार्ड को तुरंत आपूर्ति कार्यालय में समर्पित कर एक प्रमाणपत्र ले लेना आवश्यक होगा अन्यथा अन्य स्थान में नया कार्ड नहीं बन सकेगा | </span> </li>
		<li> <span>  राशन वितरण के संबंध में किसी भी प्रकार की अन्य जानकारी विभागीय वेबसाइट - https://aahar.jharkhand.gov.in से प्राप्त की जा सकती है | </span> </li>
		<li> <span> आपूर्ति सम्बंधित कोई भी शिकायत होने पर टाल-फ्री हेल्पलाईन नंबर -1967 एवं 1800 212 5512 पर अपनी शिकायत दर्ज करा सकते है |
			</span> </li>
		</ol>
		
		</td>
		<!-- close 3rd -->
		</tr>
		<!-- close second Phase -->
		

		
		</table>
		
		<div class="breakpage"></div>
		
		<table>
				
		<!-- third Phase -->
	    <tr>
		<!-- 1st -->
		<td class="adjst" style="background-color: #fff;">
		
		<p> वर्ष :-  <span class="line"> <?php echo ""; ?> </span> </p>
		<table class="table centered table-bordered">
		
		<thead>

		<tr>
		<th width="25%"> माह </th>
		<th width="20%"> चावल </th>
		<th width="20%"> अन्य  </th>
		<th width="35%"> दुकानदार का हस्ताक्षर एवं तिथि  </th>
		
		</tr>
		</thead>
		<tbody>
		<tr>
		<td> अप्रैल</td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
	    <tr>
		<td> मई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जून </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जुलाई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अगस्त </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> सितम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अक्टूबर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> नवम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> दिसम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जनवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> फ़रवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> मार्च </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
			
		</tbody>
		
		</table>
		
		</td>
		<!-- close 1st -->
		
		<!-- 2nd -->
		<td class="adjstmid">
		
		</td>
		<!-- close 2nd -->
		
		<!-- 3rd -->
		<td class="adjst" style="background-color: #fff;">
		<p> वर्ष :-  <span class="line"> <?php echo ""; ?> </span> </p>
		<table class="table centered table-bordered">
		
		<thead>

		<tr>
		<th width="25%"> माह </th>
		<th width="20%"> चावल </th>
		<th width="20%"> अन्य  </th>
		<th width="35%"> दुकानदार का हस्ताक्षर एवं तिथि  </th>
		
		</tr>
		</thead>
		<tbody>
		<tr>
		<td> अप्रैल</td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
	    <tr>
		<td> मई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जून </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जुलाई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अगस्त </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> सितम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अक्टूबर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> नवम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> दिसम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जनवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> फ़रवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> मार्च </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
			
		</tbody>
		
		</table>
		
		</td>
		<!-- close 3rd -->
		</tr>
		
		<tr style="height: 10px;"></tr>
		
		
		<!-- close third Phase -->
		
		<!-- forth phase -->
			    <tr>
		<!-- 1st -->
		<td class="adjst" style="background-color: #fff;">
		
		<p> वर्ष :-  <span class="line"> <?php echo ""; ?> </span> </p>
		<table class="table centered table-bordered">
		
		<thead>

		<tr>
		<th width="25%"> माह </th>
		<th width="20%"> चावल </th>
		<th width="20%"> अन्य  </th>
		<th width="35%"> दुकानदार का हस्ताक्षर एवं तिथि  </th>
		
		</tr>
		</thead>
		<tbody>
		<tr>
		<td> अप्रैल</td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
	    <tr>
		<td> मई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जून </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जुलाई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अगस्त </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> सितम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अक्टूबर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> नवम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> दिसम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जनवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> फ़रवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> मार्च </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
			
		</tbody>
		
		</table>
		
		</td>
		<!-- close 1st -->
		
		<!-- 2nd -->
		<td class="adjstmid">
		
		</td>
		<!-- close 2nd -->
		
		<!-- 3rd -->
		<td class="adjst" style="background-color: #fff;">
		<p> वर्ष :-  <span class="line"> <?php echo ""; ?> </span> </p>
		<table class="table centered table-bordered">
		
		<thead>

		<tr>
		<th width="25%"> माह </th>
		<th width="20%"> चावल </th>
		<th width="20%"> अन्य  </th>
		<th width="35%"> दुकानदार का हस्ताक्षर एवं तिथि  </th>
		
		</tr>
		</thead>
		<tbody>
		<tr>
		<td> अप्रैल</td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
	    <tr>
		<td> मई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जून </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जुलाई </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अगस्त </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> सितम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> अक्टूबर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> नवम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> दिसम्बर </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> जनवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> फ़रवरी </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
		
		<tr>
		<td> मार्च </td>
		<td> </td>
		<td> </td>
		<td> </td>

		</tr>
			
		</tbody>
		
		</table>
		
		</td>
		<!-- close 3rd -->
		</tr>
		<!-- close forth phase -->
		
		</table>
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
