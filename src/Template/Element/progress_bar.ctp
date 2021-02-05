<!-- Start : Progress Bar -->
<?php 
/***** Calculate percentage for Progress Bar *****/
$percentage = round((($seccCardholderAddTemp->application_status)/7)*100);?>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage?>%"><span class="text-white" style="font-size:15px"><strong>
    <?=$percentage?>
    %</strong></span> </div>
</div>
<!-- End : Progress Bar -->

<!-- Start : Application Steps -->
<?php 
	if($current_step < $seccCardholderAddTemp->application_status)
	{
		$tab	=	array();
		$tab['class']	=	'done';
		$tab['style']	=	'';
		
	}else if($current_step == $seccCardholderAddTemp->application_status)
	{
		$tab	=	array();
		$tab['class']	=	'current';
		$tab['style']	=	'pointer-events: none !important;';
		
	}else if($current_step > $seccCardholderAddTemp->application_status)
	{
		$tab	=	array();
		$tab['class']	=	'disabled';
		$tab['style']	=	'pointer-events: none !important; cursor: not-allowed;';
		
	}?>
<div class="steps clearfix">
  <ul role="tablist">
  
    <li role="tab" class="first <?=$tab['class']?>"><a href="<?=$baseurl?>SeccCardholderAddTemps/personalDetails"  style="<?=$tab['style']?>">
      <div class="title"><span class="number">1</span> <span class="title_text">Personal Details</span> </div>
      </a></li>
    <li role="tab" class="<?=$tab['class']?>"><a href="<?=$baseurl?>SeccCardholderAddTemps/bankDetails"   style="<?=$tab['style']?>">
      <div class="title"><span class="number">2</span> <span class="title_text">Bank Details</span> </div>
      </a></li>
    <li role="tab" class="<?=$tab['class']?>"><a  href="<?=$baseurl?>SeccCardholderAddTemps/additionalDetails"  style="<?=$tab['style']?>">
      <div class="title"><span class="number">3</span> <span class="title_text">Additional Details</span> </div>
      </a></li>
    <li role="tab" class="<?=$tab['class']?>"><a href="<?=$baseurl?>SeccCardholderAddTemps/documentDetails"  style="<?=$tab['style']?>">
      <div class="title"><span class="number">4</span> <span class="title_text">Upload Documents</span> </div>
      </a></li>
    <li role="tab" class="<?=$tab['class']?>"><a href="<?=$baseurl?>SeccFamilyAddTemps/addMember"   style="<?=$tab['style']?>">
      <div class="title"><span class="number">5</span> <span class="title_text">Add Family Member</span> </div>
      </a></li>
    <li role="tab" class="<?=$tab['class']?> last"><a  href="<?=$baseurl?>SeccCardholderAddTemps/preview" style="<?=$tab['style']?>">
      <div class="title"><span class="number">6</span> <span class="title_text">Preview</span> </div>
      </a></li>
  </ul>
</div>
<!-- End : Application Steps -->
<br/>
