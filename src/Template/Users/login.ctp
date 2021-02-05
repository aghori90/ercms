<?php echo $this->Html->script('sha1'); ?>

<script>
    function pass() {
        var random_no = Math.floor(Math.random() * 90000) + 10000;
        var pass1 = sha1(document.getElementById("password").value);
        document.getElementById("password").value = sha1(pass1 + random_no);
        document.getElementById("random").value = random_no;
    }
    // creating captcha
    function createCaptcha() {
        //clear the contents of captcha div first
        document.getElementById('captcha').innerHTML = "";
        // alert('captcha');
        var charsArray = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
        var lengthOtp = 1;
        var captcha = [];
        for (var i = 0; i < lengthOtp; i++) {
            //below code will not allow Repetition of Characters
            var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
            if (captcha.indexOf(charsArray[index]) == -1)
                captcha.push(charsArray[index]);
            else i--;
        }
        var canv = document.createElement("canvas");
        canv.id = "captcha";
        canv.width = 100;
        canv.height = 50;
        var ctx = canv.getContext("2d");
        ctx.font = "25px Georgia";
        ctx.strokeText(captcha.join(""), 0, 30);
        //storing captcha so that can validate you can save it somewhere else according to your specific requirements
        code = captcha.join("");
        document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
    }

    function validateCaptcha() {
        //event.preventDefault();
        //debugger
        if (document.getElementById("cpatchaTextBox").value == code) {
            //alert("Valid Captcha")
            return true;
        } else {
            alert("Invalid Captcha.try Again");
            createCaptcha();
            return false;
        }
    }

    function validCapt() {
        // alert ('Aghori');
        var user = document.getElementById("username").value;
        var pswd = document.getElementById("password").value;
        var cap = document.getElementById("cpatchaTextBox").value;
        if (user == "") {
            alert("username Is Required.");
            return false;
            window.location.reload();
        }
        if (pswd == "") {
            alert("Password Is Required.");
            return false;
            window.location.reload();
        }
        if (cap == "") {
            alert("captcha Is Required.");
            return false;
            window.location.reload(true);
        }
        return true;
    }
</script>

<main id="main">
    <!-- ======= Main Section ======= -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">

                <div class="col-lg-6">
                    <?php echo $this->Flash->render() ?>
                    <?php echo $this->Form->create(false, ["id" => "login"]) ?>
                    <div class="card">
                        <div class="card-header bg-info text-white text-center">
                            <h4>Login</h4>
                        </div>

                        <div class="card-body">
                            <?php //if($this->request->getSession()->check('Auth')) {
                            //$registration_no=$this->request->getSession()->read('Auth.registration_no');
                            //echo '<div class="form-group row"><div class="col-sm-12 alert alert-warning text-center">Your Registration No : '.$registration_no.'<br/>Password : Your Registered Mobile No</div></div>';

                            //}
                            ?>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required " for="name">Username </label>
                                <div class="col-sm-8">
                                    <?php echo $this->Form->control('username', ['label' => false, "class" => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Username']) ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label required" for="name">Password </label>
                                <div class="col-sm-8">
                                    <?php echo $this->Form->control('password', ['label' => false, "class" => "form-control", 'size' => 40, 'autocomplete' => 'off', 'onBlur' => 'return pass();', 'onfocus' => 'this.setAttribute("type","password")', 'placeholder' => 'Password']) ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-form-label" id="captcha"></div>
                                <div class="col-sm-8">
                                <?php echo $this->Form->control('captcha', ['templates' => ['inputContainer' => '<div class="input-group">{{content}} <div  class="input-group-append">
                <span class="input-group-text" id="basic-addon1" style="padding: 0.20rem 0.50rem;">'.$this->Form->button($this->Html->image('refresh.png'), ['type' => 'button', 'label' => false, 'onClick' => 'return createCaptcha()', "style" => "border: none;padding: 0;background: none;"]).'</span>
                </div></div>'], 'placeholder' => 'Enter Captcha', 'class' => 'form-control', 'label' => false,"autocomplete"=>"off", 'required' => true, 'aria-describedby' => 'basic-addon2']); ?>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <div class="col-sm-4 col-form-label" id="captcha"></div>
                                <div class="col-sm-7">
                                    <?= $this->Form->control('captcha', ['label' => false, "class" => "form-control", 'type' => 'text', 'placeholder' => 'Enter Captcha', 'id' => 'cpatchaTextBox', 'onchange' => 'validateCaptcha()', 'maxlength' => '6']) ?>
                                </div>
                                <div class="col-sm-1">
                                    <?php //echo $this->Form->button('Refresh', ['label' => false, 'onClick' => 'return createCaptcha()', 'style' => 'border-radius: 5px; padding: 12px 32px 12px 29px;'])
                                    ?>
                                    <?php echo $this->Form->button($this->Html->image('refresh.png'), ['type' => 'button', 'label' => false, 'onClick' => 'return createCaptcha()', "style" => "border: none;padding: 0;background: none;"]) ?>
                                </div>
                            </div> -->
                            <hr>
                            <div class="text-center">
                                <?= $this->Form->button('Login', ['label' => false, 'class' => 'btn btn-info', 'onclick' => 'return validCapt();']) ?>
                            </div>
                            <div class="text-right">
                                <?= $this->Form->hidden('random', array('id' => 'random')); ?>
                                <u><?php //echo $this->Html->link(__('Forget Password'), ['controller' => 'Users', 'action' => 'forgetpass']) ?></u>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>

                </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
<script>
    $(document).ready(function() {
        createCaptcha();
    });
</script>
