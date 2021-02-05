<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("sidebar"); ?>

<?= $this->Flash->render() ?>
<!--main content start-->
<div class="app-main__outer">
    <div class="app-main__inner">

            <?php echo $this->fetch('content');?>

    </div>
<!--main content end-->

<?php echo $this->element("admin_footer"); ?>
