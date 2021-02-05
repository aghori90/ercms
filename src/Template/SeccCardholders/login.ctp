<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
 echo $this->Html->script("ration.js");
?>
<script type="text/javascript">
		$( document ).ready( function () {
			$( "#login" ).validate( {
				rules: {
					reg_ration_no: "required",
					password: "required"
				},
				messages: {
					reg_ration_no: "Please enter your Registration No. or Ration No",
					password: "Please enter last 8 digits of Aadhar no."
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `invalid-feedback` class to the error element
					error.addClass( "invalid-feedback" );
					error.insertAfter( element );
					
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
				}
			} );
			
			
		} );
	</script>
<main id="main">

    <!-- ======= Main Section ======= -->
    <section class="section">
      <div class="container">
        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-8">
          <?php echo $this->Flash->render() ?>
			<?php echo $this->Form->create(false,["id"=>"login"]) ?>
			<div class="card">
			<div class="card-header bg-info text-white text-center"><h4>ERCMS Login</h4></div>
	  
			<div class="card-body">
		   <?php //if($this->request->getSession()->check('Auth')) {
        			//$registration_no=$this->request->getSession()->read('Auth.registration_no');
        			//echo '<div class="form-group row"><div class="col-sm-12 alert alert-warning text-center">Your Registration No : '.$registration_no.'<br/>Password : Your Registered Mobile No</div></div>';
        
			//}?> 
       		<div class="form-group row">
			<label class="col-sm-4 col-form-label required offset-sm-1" >Acknowledgement No / Ration No </label>
			<div class="col-sm-6">
			<?php echo $this->Form->control('reg_ration_no',['label'=>false,'class'=>'form-control','required'=>true,"onKeyPress"=>"return isAlphaNumeric(event)","maxlength"=>"13"]);?>
			</div>
			</div>
            
            <div class="form-group row">
			<label class="col-sm-4 col-form-label required  offset-sm-1" for="name">Password  <span style="color: red">(Last 8 digits of Aadhar No of Head of Family)</span></label>
			<div class="col-sm-6">
			<?php echo $this->Form->control('password',['label'=>false,'class'=>'form-control','required'=>true, "onKeyPress"=>"return isNumberKey(event)","maxlength"=>"8"]);?>

			</div>
			</div>
            
			<div class="text-center">
				<?= $this->Form->button(__('Login'),['class'=>'col-sm-offset-2 btn btn-success']) ?>
				<?= $this->Form->end() ?>
			</div>
		</div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
