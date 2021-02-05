<?php
    use Cake\Routing\Router;
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholder $seccCardholder
 */
 echo $this->Html->script("ration.js");
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#search_ack").validate({
            rules: {
                ack_no: "required"
            },
            messages: {
                ack_no: "Please enter Acknowledgement No."                
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                    error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            onsubmit: true
        });


    });
</script>
<?php echo $this->Form->create(false,['id'=>'search_ack']) ?>
<div class="card">
<?= $this->Flash->render() ?>
<div class="card-header bg-primary text-white">Search Acknowledgement No.</div>
	<div class="card-body">
		<div class="form-group row">
			<label class="col-md-2 required offset-sm-2 col-form-label">Acknowledgement No</label>
			<div  class="col-md-4"><?php echo $this->Form->control("ack_no",["label"=>false,"placeholder"=>"Enter Acknowledgement No","class"=>"form-control","onkeypress" => "return isNumberKey(event)", "size" => "100", "maxlength" => "100"]);?></div>
			<div class="col-md-2"><?php echo $this->Form->button(__("Search"),["type"=>"submit","class"=>"btn btn-lg btn-success"]) ?></div>
		</div>
		<div class="text-center">
			<?php //echo $this->Form->button(__('Submit'),['class'=>'col-sm-offset-2 btn btn-success']) 
			?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>