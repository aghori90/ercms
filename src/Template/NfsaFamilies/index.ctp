<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NfsaFamily[]|\Cake\Collection\CollectionInterface $nfsaFamilies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Nfsa Family'), ['action' => 'add']) ?></li>
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
<div class="nfsaFamilies index large-9 medium-8 columns content">
    <h3><?= __('Nfsa Families') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rationcard_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('impdsRationcard') ?></th>
                <th scope="col"><?= $this->Paginator->sort('impdsRationcardMemberId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ahl_tin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hhd_unique_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nfsa_cardholder_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nfsa_family_add_temp_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_district_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_block_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_village_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathername') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathername_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothername') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothername_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relation_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relation_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gender_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cardtype_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dob') ?></th>
                <th scope="col"><?= $this->Paginator->sort('freeze_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid_verified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bank_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('branch_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accountNo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hof') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nfsa_head') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uidFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bfd1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bfd2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bfd3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dbtFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pfmsRiceId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pfmsKoilId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uidVaultFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maskUid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ekycFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active_inactive') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_reason_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uidMobileChangeFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('disability_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('health_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('marital_status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nfsaFamilies as $nfsaFamily): ?>
            <tr>
                <td><?= h($nfsaFamily->id) ?></td>
                <td><?= h($nfsaFamily->rationcard_no) ?></td>
                <td><?= h($nfsaFamily->impdsRationcard) ?></td>
                <td><?= h($nfsaFamily->impdsRationcardMemberId) ?></td>
                <td><?= h($nfsaFamily->ahl_tin) ?></td>
                <td><?= h($nfsaFamily->hhd_unique_no) ?></td>
                <td><?= $nfsaFamily->has('nfsa_cardholder') ? $this->Html->link($nfsaFamily->nfsa_cardholder->name, ['controller' => 'NfsaCardholders', 'action' => 'view', $nfsaFamily->nfsa_cardholder->id]) : '' ?></td>
                <td><?= $nfsaFamily->has('nfsa_family_add_temp') ? $this->Html->link($nfsaFamily->nfsa_family_add_temp->name, ['controller' => 'NfsaFamilyAddTemps', 'action' => 'view', $nfsaFamily->nfsa_family_add_temp->id]) : '' ?></td>
                <td><?= h($nfsaFamily->rgi_district_code) ?></td>
                <td><?= h($nfsaFamily->rgi_block_code) ?></td>
                <td><?= h($nfsaFamily->rgi_village_code) ?></td>
                <td><?= h($nfsaFamily->name) ?></td>
                <td><?= h($nfsaFamily->name_sl) ?></td>
                <td><?= h($nfsaFamily->fathername) ?></td>
                <td><?= h($nfsaFamily->fathername_sl) ?></td>
                <td><?= h($nfsaFamily->mothername) ?></td>
                <td><?= h($nfsaFamily->mothername_sl) ?></td>
                <td><?= $nfsaFamily->has('relation') ? $this->Html->link($nfsaFamily->relation->name, ['controller' => 'Relations', 'action' => 'view', $nfsaFamily->relation->id]) : '' ?></td>
                <td><?= h($nfsaFamily->relation_sl) ?></td>
                <td><?= $nfsaFamily->has('gender') ? $this->Html->link($nfsaFamily->gender->name, ['controller' => 'Genders', 'action' => 'view', $nfsaFamily->gender->id]) : '' ?></td>
                <td><?= $nfsaFamily->has('cardtype') ? $this->Html->link($nfsaFamily->cardtype->name, ['controller' => 'Cardtypes', 'action' => 'view', $nfsaFamily->cardtype->id]) : '' ?></td>
                <td><?= h($nfsaFamily->dob) ?></td>
                <td><?= $this->Number->format($nfsaFamily->freeze_status) ?></td>
                <td><?= h($nfsaFamily->mobile) ?></td>
                <td><?= h($nfsaFamily->uid) ?></td>
                <td><?= h($nfsaFamily->uid_verified) ?></td>
                <td><?= $nfsaFamily->has('bank_master') ? $this->Html->link($nfsaFamily->bank_master->name, ['controller' => 'BankMasters', 'action' => 'view', $nfsaFamily->bank_master->id]) : '' ?></td>
                <td><?= $nfsaFamily->has('branch_master') ? $this->Html->link($nfsaFamily->branch_master->name, ['controller' => 'BranchMasters', 'action' => 'view', $nfsaFamily->branch_master->id]) : '' ?></td>
                <td><?= h($nfsaFamily->accountNo) ?></td>
                <td><?= $this->Number->format($nfsaFamily->hof) ?></td>
                <td><?= $this->Number->format($nfsaFamily->nfsa_head) ?></td>
                <td><?= $this->Number->format($nfsaFamily->uidFlag) ?></td>
                <td><?= h($nfsaFamily->created) ?></td>
                <td><?= h($nfsaFamily->modified) ?></td>
                <td><?= $this->Number->format($nfsaFamily->created_by) ?></td>
                <td><?= $this->Number->format($nfsaFamily->modified_by) ?></td>
                <td><?= h($nfsaFamily->bfd1) ?></td>
                <td><?= h($nfsaFamily->bfd2) ?></td>
                <td><?= h($nfsaFamily->bfd3) ?></td>
                <td><?= $this->Number->format($nfsaFamily->dbtFlag) ?></td>
                <td><?= h($nfsaFamily->pfmsRiceId) ?></td>
                <td><?= h($nfsaFamily->pfmsKoilId) ?></td>
                <td><?= $this->Number->format($nfsaFamily->uidVaultFlag) ?></td>
                <td><?= h($nfsaFamily->maskUid) ?></td>
                <td><?= $this->Number->format($nfsaFamily->ekycFlag) ?></td>
                <td><?= $this->Number->format($nfsaFamily->active_inactive) ?></td>
                <td><?= $nfsaFamily->has('delete_reason') ? $this->Html->link($nfsaFamily->delete_reason->name, ['controller' => 'DeleteReasons', 'action' => 'view', $nfsaFamily->delete_reason->id]) : '' ?></td>
                <td><?= h($nfsaFamily->uidMobileChangeFlag) ?></td>
                <td><?= $this->Number->format($nfsaFamily->disability_status) ?></td>
                <td><?= $this->Number->format($nfsaFamily->health_status) ?></td>
                <td><?= $this->Number->format($nfsaFamily->marital_status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $nfsaFamily->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nfsaFamily->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $nfsaFamily->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nfsaFamily->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
