<main id="main">
    <!-- ======= Main Section ======= -->

    <section class="section">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-12">
			<?php echo $this->Form->create(false) ?>
			<div class="card">
			<div class="card-header bg-info text-white text-center">ERCMS &#2309;&#2344;&#2369;&#2352;&#2379;&#2343;</div>
	  
			<div class="card-body">
			<div class="form-group row">
            
            <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-green text-white ">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
              <?php echo $this->Html->link("Register","/SeccCardholderAddTemps/aadhar/",["class"=>"text-white"]);?> 
              </div>
              <!-- /.box-content -->
            </div>
            <!-- /.box -->
          </div>
          
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-secondary text-white ">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
               <?php echo $this->Html->link("Already Registered","/SeccCardholders/login/",["class"=>"text-white"]);?>
              </div>
              <!-- /.box-content -->
            </div>
            <!-- /.box -->
          </div>

                     
            
          <!--  <div class="form-group row">
			<label class="col-sm-4 col-form-label required" for="name">ERCMS &#2327;&#2340;&#2367;&#2357;&#2367;&#2343;&#2367; &#2325;&#2366; &#2330;&#2351;&#2344; &#2325;&#2352;&#2375;&#2306; </label>
			<div class="col-sm-8">
			<?php echo $this->Form->control('activity_id',['options'=>$activities,'label'=>false,'class'=>'form-control','required'=>true,'empty'=>'Select Activity']);?>
			</div>
			</div>-->
			<div class="text-center">
				<?php //echo $this->Form->button(__('Submit'),['class'=>'col-sm-offset-2 btn btn-success']) ?>
				<?= $this->Form->end() ?>
			</div>
		</div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
