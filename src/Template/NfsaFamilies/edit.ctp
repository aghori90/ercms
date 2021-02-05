<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaFamily $nfsaFamily
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nfsaFamily->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nfsaFamily->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Nfsa Families'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Nfsa Cardholders'), ['controller' => 'NfsaCardholders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Nfsa Cardholder'), ['controller' => 'NfsaCardholders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Nfsa Family Add Temps'), ['controller' => 'NfsaFamilyAddTemps', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Nfsa Family Add Temp'), ['controller' => 'NfsaFamilyAddTemps', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Relations'), ['controller' => 'Relations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Relation'), ['controller' => 'Relations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cardtypes'), ['controller' => 'Cardtypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cardtype'), ['controller' => 'Cardtypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bank Masters'), ['controller' => 'BankMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bank Master'), ['controller' => 'BankMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Branch Masters'), ['controller' => 'BranchMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Branch Master'), ['controller' => 'BranchMasters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Delete Reasons'), ['controller' => 'DeleteReasons', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Delete Reason'), ['controller' => 'DeleteReasons', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="nfsaFamilies form large-9 medium-8 columns content">
    <?= $this->Form->create($nfsaFamily) ?>
    <fieldset>
        <legend><?= __('Edit Nfsa Family') ?></legend>
        <?php
            echo $this->Form->control('rationcard_no');
            echo $this->Form->control('impdsRationcard');
            echo $this->Form->control('impdsRationcardMemberId');
            echo $this->Form->control('ahl_tin');
            echo $this->Form->control('hhd_unique_no');
            echo $this->Form->control('nfsa_cardholder_id', ['options' => $nfsaCardholders]);
            echo $this->Form->control('nfsa_family_add_temp_id', ['options' => $nfsaFamilyAddTemps]);
            echo $this->Form->control('rgi_district_code');
            echo $this->Form->control('rgi_block_code');
            echo $this->Form->control('rgi_village_code');
            echo $this->Form->control('name');
            echo $this->Form->control('name_sl');
            echo $this->Form->control('fathername');
            echo $this->Form->control('fathername_sl');
            echo $this->Form->control('mothername');
            echo $this->Form->control('mothername_sl');
            echo $this->Form->control('relation_id', ['options' => $relations]);
            echo $this->Form->control('relation_sl');
            echo $this->Form->control('gender_id', ['options' => $genders]);
            echo $this->Form->control('cardtype_id', ['options' => $cardtypes, 'empty' => true]);
            echo $this->Form->control('dob');
            echo $this->Form->control('freeze_status');
            echo $this->Form->control('mobile');
            echo $this->Form->control('uid');
            echo $this->Form->control('uid_verified');
            echo $this->Form->control('bank_master_id', ['options' => $bankMasters, 'empty' => true]);
            echo $this->Form->control('branch_master_id', ['options' => $branchMasters, 'empty' => true]);
            echo $this->Form->control('accountNo');
            echo $this->Form->control('hof');
            echo $this->Form->control('nfsa_head');
            echo $this->Form->control('uidFlag');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
            echo $this->Form->control('bfd1');
            echo $this->Form->control('bfd2');
            echo $this->Form->control('bfd3');
            echo $this->Form->control('dbtFlag');
            echo $this->Form->control('pfmsRiceId');
            echo $this->Form->control('pfmsKoilId');
            echo $this->Form->control('uidVaultFlag');
            echo $this->Form->control('maskUid');
            echo $this->Form->control('ekycFlag');
            echo $this->Form->control('active_inactive');
            echo $this->Form->control('delete_reason_id', ['options' => $deleteReasons, 'empty' => true]);
            echo $this->Form->control('uidMobileChangeFlag', ['empty' => true]);
            echo $this->Form->control('disability_status');
            echo $this->Form->control('health_status');
            echo $this->Form->control('marital_status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
