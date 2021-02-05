<?php echo $this->Form->create(false) ?>
<div class="card">

	<div class="card-body">
		<div class="form-group row">
			
			<div class="col-md-3 col-sm-6 col-12">
				<div class="info-box bg-danger text-white ">
					<span class="info-box-icon"><i class="far fa-bookmark"></i></span>

					<div class="info-box-content">
						<?php echo $this->Html->link("New Ration Card Application", $baseurl."SeccCardholders/applicationList/".base64_encode(1), ["class" => "text-white"]); ?>
					</div>
					<!-- /.box-content -->
				</div>
				<!-- /.box -->
			</div>

		</div>

		<div class="text-center">
			<?php //echo $this->Form->button(__('Submit'),['class'=>'col-sm-offset-2 btn btn-success']) 
			?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>