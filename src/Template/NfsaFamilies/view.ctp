<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaFamily $nfsaFamily
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Nfsa Family'), ['action' => 'edit', $nfsaFamily->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Nfsa Family'), ['action' => 'delete', $nfsaFamily->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nfsaFamily->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Nfsa Families'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nfsa Family'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nfsa Cardholders'), ['controller' => 'NfsaCardholders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nfsa Cardholder'), ['controller' => 'NfsaCardholders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nfsa Family Add Temps'), ['controller' => 'NfsaFamilyAddTemps', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nfsa Family Add Temp'), ['controller' => 'NfsaFamilyAddTemps', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Relations'), ['controller' => 'Relations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Relation'), ['controller' => 'Relations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Genders'), ['controller' => 'Genders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gender'), ['controller' => 'Genders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cardtypes'), ['controller' => 'Cardtypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cardtype'), ['controller' => 'Cardtypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bank Masters'), ['controller' => 'BankMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bank Master'), ['controller' => 'BankMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Branch Masters'), ['controller' => 'BranchMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Branch Master'), ['controller' => 'BranchMasters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Delete Reasons'), ['controller' => 'DeleteReasons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Delete Reason'), ['controller' => 'DeleteReasons', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="nfsaFamilies view large-9 medium-8 columns content">
    <h3><?= h($nfsaFamily->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($nfsaFamily->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rationcard No') ?></th>
            <td><?= h($nfsaFamily->rationcard_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ImpdsRationcard') ?></th>
            <td><?= h($nfsaFamily->impdsRationcard) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ImpdsRationcardMemberId') ?></th>
            <td><?= h($nfsaFamily->impdsRationcardMemberId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ahl Tin') ?></th>
            <td><?= h($nfsaFamily->ahl_tin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hhd Unique No') ?></th>
            <td><?= h($nfsaFamily->hhd_unique_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nfsa Cardholder') ?></th>
            <td><?= $nfsaFamily->has('nfsa_cardholder') ? $this->Html->link($nfsaFamily->nfsa_cardholder->name, ['controller' => 'NfsaCardholders', 'action' => 'view', $nfsaFamily->nfsa_cardholder->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nfsa Family Add Temp') ?></th>
            <td><?= $nfsaFamily->has('nfsa_family_add_temp') ? $this->Html->link($nfsaFamily->nfsa_family_add_temp->name, ['controller' => 'NfsaFamilyAddTemps', 'action' => 'view', $nfsaFamily->nfsa_family_add_temp->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rgi District Code') ?></th>
            <td><?= h($nfsaFamily->rgi_district_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rgi Block Code') ?></th>
            <td><?= h($nfsaFamily->rgi_block_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rgi Village Code') ?></th>
            <td><?= h($nfsaFamily->rgi_village_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($nfsaFamily->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Sl') ?></th>
            <td><?= h($nfsaFamily->name_sl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fathername') ?></th>
            <td><?= h($nfsaFamily->fathername) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fathername Sl') ?></th>
            <td><?= h($nfsaFamily->fathername_sl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mothername') ?></th>
            <td><?= h($nfsaFamily->mothername) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mothername Sl') ?></th>
            <td><?= h($nfsaFamily->mothername_sl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relation') ?></th>
            <td><?= $nfsaFamily->has('relation') ? $this->Html->link($nfsaFamily->relation->name, ['controller' => 'Relations', 'action' => 'view', $nfsaFamily->relation->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relation Sl') ?></th>
            <td><?= h($nfsaFamily->relation_sl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= $nfsaFamily->has('gender') ? $this->Html->link($nfsaFamily->gender->name, ['controller' => 'Genders', 'action' => 'view', $nfsaFamily->gender->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cardtype') ?></th>
            <td><?= $nfsaFamily->has('cardtype') ? $this->Html->link($nfsaFamily->cardtype->name, ['controller' => 'Cardtypes', 'action' => 'view', $nfsaFamily->cardtype->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= h($nfsaFamily->dob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($nfsaFamily->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid') ?></th>
            <td><?= h($nfsaFamily->uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uid Verified') ?></th>
            <td><?= h($nfsaFamily->uid_verified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bank Master') ?></th>
            <td><?= $nfsaFamily->has('bank_master') ? $this->Html->link($nfsaFamily->bank_master->name, ['controller' => 'BankMasters', 'action' => 'view', $nfsaFamily->bank_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Branch Master') ?></th>
            <td><?= $nfsaFamily->has('branch_master') ? $this->Html->link($nfsaFamily->branch_master->name, ['controller' => 'BranchMasters', 'action' => 'view', $nfsaFamily->branch_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AccountNo') ?></th>
            <td><?= h($nfsaFamily->accountNo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bfd1') ?></th>
            <td><?= h($nfsaFamily->bfd1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bfd2') ?></th>
            <td><?= h($nfsaFamily->bfd2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bfd3') ?></th>
            <td><?= h($nfsaFamily->bfd3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PfmsRiceId') ?></th>
            <td><?= h($nfsaFamily->pfmsRiceId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PfmsKoilId') ?></th>
            <td><?= h($nfsaFamily->pfmsKoilId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MaskUid') ?></th>
            <td><?= h($nfsaFamily->maskUid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delete Reason') ?></th>
            <td><?= $nfsaFamily->has('delete_reason') ? $this->Html->link($nfsaFamily->delete_reason->name, ['controller' => 'DeleteReasons', 'action' => 'view', $nfsaFamily->delete_reason->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freeze Status') ?></th>
            <td><?= $this->Number->format($nfsaFamily->freeze_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hof') ?></th>
            <td><?= $this->Number->format($nfsaFamily->hof) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nfsa Head') ?></th>
            <td><?= $this->Number->format($nfsaFamily->nfsa_head) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UidFlag') ?></th>
            <td><?= $this->Number->format($nfsaFamily->uidFlag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($nfsaFamily->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($nfsaFamily->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DbtFlag') ?></th>
            <td><?= $this->Number->format($nfsaFamily->dbtFlag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UidVaultFlag') ?></th>
            <td><?= $this->Number->format($nfsaFamily->uidVaultFlag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('EkycFlag') ?></th>
            <td><?= $this->Number->format($nfsaFamily->ekycFlag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active Inactive') ?></th>
            <td><?= $this->Number->format($nfsaFamily->active_inactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Disability Status') ?></th>
            <td><?= $this->Number->format($nfsaFamily->disability_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Health Status') ?></th>
            <td><?= $this->Number->format($nfsaFamily->health_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marital Status') ?></th>
            <td><?= $this->Number->format($nfsaFamily->marital_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($nfsaFamily->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($nfsaFamily->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UidMobileChangeFlag') ?></th>
            <td><?= h($nfsaFamily->uidMobileChangeFlag) ?></td>
        </tr>
    </table>
</div>
