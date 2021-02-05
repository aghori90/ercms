<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JsfssDistrictReport $jsfssDistrictReport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Jsfss District Reports'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="jsfssDistrictReports form large-9 medium-8 columns content">
    <?= $this->Form->create($jsfssDistrictReport) ?>
    <fieldset>
        <legend><?= __('Add Jsfss District Report') ?></legend>
        <?php
            echo $this->Form->control('rgi_district_code');
            echo $this->Form->control('districtName');
            echo $this->Form->control('greenCardHeadCount');
            echo $this->Form->control('greenCardMemberCount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
