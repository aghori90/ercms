<?php
    use Cake\Routing\Router;
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
 echo $this->Html->script("ration.js");
 echo $this->Html->script('jsapi');
 echo $this->Html->css("jquery-ui.css");
?>
<style>
#dealerid{
display:none;
}
#village{
display:none;
}

#p1{
display:none;

}
#d1{
display:none;

}
</style>
    
<main id="main">
    <!-- ======= Main Section ======= -->
    <section class="section">
   
      <div class="container">
		<?= $this->Flash->render() ?>
        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-12">
			<?php echo $this->Form->create(null,["action"=>'viewRationcardDetailResult',"autocomplete"=>"off"]) ?>
			<div class="card">
            <div class="card-header bg-secondary text-white text-center">Search Ration</div>
            
        
	  
			<div class="card-body offset-sm-2">            
			
            <div class="form-group row">
            <label class="col-sm-4 col-form-label required font-weight-bold" for="name">District : </label>
            <div class="col-sm-6">
                <?php echo $districtName;?>
             </div>
            </div>
            
            <div class="form-group row">
            <label class="col-sm-4 col-form-label required font-weight-bold" for="name">Block : </label>
            <div class="col-sm-6">
           <?php  echo $this->Form->select(
                    'rgi_block_code',
                    $SeccBlocks,
                    ['empty' => '(choose one)',"class"=>"form-control",'id'=>'rgi_block_code']
                );?>
                            
            </div>
            </div>
            
            <div class="form-group row">
            <div class="col-sm-4 font-weight-bold">Select Search Option</div>
            <div class="col-sm-6 font-weight-bold"><input type="radio" name="r1" value="dealer" id="dealer" onclick="fun1(this.value)" />&nbsp;Dealer
            <br/>
            <input type="radio"  name="r1" id="panchayat" value="panchayat" onclick="fun1(this.value)" />&nbsp;Village/ward
        </div>
            </div>
            
            <div class="form-group row" id="p1">
            <label class="col-sm-4 col-form-label required font-weight-bold" for="name">Dealer </label>
            <div class="col-sm-6 font-weight-bold">
            <?php  echo $this->Form->select(
                    'dealer_id',
                    [],
                    ['empty' =>false,"class"=>"form-control","id"=>"dealer_id"]
                );?>
            </div>
            </div>

            <div class="form-group row" id="d1">
            <label class="col-sm-4 col-form-label required font-weight-bold" for="name">Village Wards: </label>
            <div class="col-sm-6">
				<?php echo $this->Form->control("rgi_village_code",["options"=>[],"label"=>false,"class"=>"form-control","empty"=>"Select Village","id"=>"rgi_village_code"]);?>
			</div>
            </div>
            
            <div class="form-group row">
            <label class="col-sm-4 col-form-label required font-weight-bold">Cardtype : </label>
            <div class="col-sm-6">
            <?php  echo $this->Form->select(
                    'cardtype_id',
                    ['1'=>'Green card'],
                    ['empty' =>false,"class"=>"form-control"]
                );?>
            
            </div>
            </div>
        

            <div class="form-group row">
                 <div class="col-sm-12" style="color:red;font-size:18px;text-align: center;"><u>OR</u></div>
            </div> 


            <div class="form-group row">
            <label class="col-sm-4 col-form-label required font-weight-bold">Rationcard No : </label>
            <div class="col-sm-6 "><?php echo $this->Form->control("rationcard_no",["label"=>false,"class"=>"form-control","onKeyPress"=>"return isNumberKey(event)",'size'=>'12','maxlength'=>'12']);?></div>
            </div> 
        
          
            
          
           
            
           
            <!-- End Card Body --> 
            </div><!-- End Card -->

            <div class="text-center">
                <?php echo $this->Form->button(__("Search"),["class"=>"btn btn-success"]) ?>
                
                <?php echo $this->Form->end() ?>
            </div>
           <br />
         
		</div><!-- End col-lg-12 -->
		
      </div><!-- End container -->
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

<?php echo $this->Html->script("jquery-ui.js")?>
<script type="text/javascript">
function fun1(val)
{
    if(document.getElementById('rgi_block_code').value=='')
    {
        var ele = document.getElementsByName("r1");
        for(var i=0;i<ele.length;i++)
        ele[i].checked = false;
                alert('Select Block');
                return false;
            
    }
if(val=="panchayat")
{
   	document.getElementById('d1').style.display='block';
	document.getElementById('p1').style.display='none';
    $(function(){  
          
            var url = '<?=Router::url(array('controller'=>'App','action'=>'getVillagesByBlock','_full' =>true))?>';
            var rgi_block_code = $('#rgi_block_code').val();
         
            var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
            $.ajax({
                type: 'POST',
                url: url,
                async:true,
                data: ({id : rgi_block_code}),
                dataType:'html',
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus)
                {
                   
                    var result = JSON.parse(response); //alert(result);return false;
                    $.each(result, function(val, text) {
                        $('#rgi_village_code').append($('<option></option>').val(val).html(text));
                    });
                    $("select[name=rgi_village_code]").prepend("<option value selected>Select Village</option>");
                },
                error: function(e)
                {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                }
            });
        });
        

}
else
{
   	document.getElementById('p1').style.display='block';
   	document.getElementById('d1').style.display='none';
       $(function(){  
           
            var url = '<?=Router::url(array('controller'=>'App','action'=>'getDealersByBlock','_full' =>true))?>';
            var rgi_block_code = $('#rgi_block_code').val();
            
            var token = '<?php echo $this->request->getParam('_csrfToken'); ?>';
            $.ajax({
                type: 'POST',
                url: url,
                async:true,
                data: ({id : rgi_block_code}),
                dataType:'html',
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-CSRF-Token', token);
                },
                success: function(response, textStatus)
                {
              
                    var result = JSON.parse(response); //alert(result);return false;
                    $.each(result, function(val, text) {
                        $('#dealer_id').append($('<option></option>').val(val).html(text));
                    });
                    $("select[name=dealer_id]").prepend("<option value selected>Select Dealer</option>");
                },
                error: function(e)
                {
                    alert("An error occurred: " + e.responseText.message);
                    console.log(e);
                }
            });
        });
}


}




</script>

