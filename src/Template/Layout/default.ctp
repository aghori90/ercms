<?php echo $this->element("header"); ?> 
    <?php echo $this->element("nav"); ?> 
      <?= $this->Flash->render() ?>     
      <!--main content start-->
    
                <?php echo $this->fetch('content') ?>             
      
    <!--main content end-->
    
<?php echo $this->element("footer"); ?>
