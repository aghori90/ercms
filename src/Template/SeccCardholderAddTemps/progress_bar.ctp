
	  <?php $percentage = round((($seccCardholderAddTemp->application_status)/7)*100);?>
      <div class="progress">
         <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage?>%"><span class="text-white" style="font-size:15px"><strong><?=$percentage?>%</strong></span>
         </div>
      </div>

		<div class="steps clearfix">
         <ul role="tablist">
            <li role="tab" class="current" aria-disabled="true"><a id="signup-form-t-2" href="#" aria-controls="signup-form-p-2"><div class="title"><span class="number">1</span>
              <span class="title_text">Personal Details</span>
            </div></a></li>  
            <li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#"   style="cursor: not-allowed;"><span class="current-info audible"> </span>
              <div class="title"><span class="number">2</span> <span class="title_text">Bank Details</span> </div>
              </a></li>          
            <li role="tab" class="disabled" aria-disabled="false" aria-selected="false"><a  href="#"  style="cursor: not-allowed;">
              <div class="title"><span class="number">3</span> <span class="title_text">Additional Details</span> </div>
              </a></li>            
            <li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#"  style="cursor: not-allowed;"><span class="current-info audible"> </span>
              <div class="title"><span class="number">4</span> <span class="title_text">Upload Documents</span> </div>
              </a></li>
              <li role="tab" class="disabled" aria-disabled="false" aria-selected="true"><a href="#"   style="cursor: not-allowed;"><span class="current-info audible"> </span>
              <div class="title"><span class="number">5</span> <span class="title_text">Add Family Member</span> </div>
              </a></li>
            <li role="tab" class="disabled last" aria-disabled="true"><a  href="#" style="cursor: not-allowed;">
              <div class="title"><span class="number">6</span> <span class="title_text">Preview</span> </div>
              </a></li>
         </ul>
       </div>
              <br/>  
		
