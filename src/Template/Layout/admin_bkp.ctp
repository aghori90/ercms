<?php echo $this->element("admin_header"); ?>
<?php echo $this->element("sidebar"); ?>

<?= $this->Flash->render() ?>
<!--main content start-->
<div class="app-main__outer">
    <div class="app-main__inner">        
        <div class="main-card mb-3 card">
            <?php echo $this->fetch('content');?> 
        </div>
    </div>

<!--main content end-->

<?php echo $this->element("admin_footer"); ?>