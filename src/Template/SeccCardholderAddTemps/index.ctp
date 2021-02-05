<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SeccCardholderAddTemp[]|\Cake\Collection\CollectionInterface $seccCardholderAddTemps
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Secc Cardholder Add Temp'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Secc Cardholders'), ['controller' => 'SeccCardholders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Secc Cardholder'), ['controller' => 'SeccCardholders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cardtypes'), ['controller' => 'Cardtypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cardtype'), ['controller' => 'Cardtypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Castes'), ['controller' => 'Castes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Caste'), ['controller' => 'Castes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Secc Districts'), ['controller' => 'SeccDistricts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Secc District'), ['controller' => 'SeccDistricts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Secc Blocks'), ['controller' => 'SeccBlocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Secc Block'), ['controller' => 'SeccBlocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Panchayats'), ['controller' => 'Panchayats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Panchayat'), ['controller' => 'Panchayats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Secc Village Wards'), ['controller' => 'SeccVillageWards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Secc Village Ward'), ['controller' => 'SeccVillageWards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dealers'), ['controller' => 'Dealers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dealer'), ['controller' => 'Dealers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity Types'), ['controller' => 'ActivityTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity Type'), ['controller' => 'ActivityTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="seccCardholderAddTemps index large-9 medium-8 columns content">
    <h3><?= __('Secc Cardholder Add Temps') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('secc_cardholder_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rationcard_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cardtype_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathername') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathername_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothername') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothername_sl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('caste_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('secc_district_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('secc_block_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('panchayat_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('secc_village_ward_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_district_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_block_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_village_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('res_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('res_address_hn') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tolla_mohalla') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qtr_plot_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('holding_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dealer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('family_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uid_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('printFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('applicationType') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activities_status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activityFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activityType') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dbtFlag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('liftedCount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('verified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('verified_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('printed_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subsidyMonth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bso_remarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dso_remarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('requested_mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ack_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('requestedBy') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bso_uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dso_uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bso_modifiedDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dso_modifiedDate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($seccCardholderAddTemps as $seccCardholderAddTemp): ?>
            <tr>
                <td><?= h($seccCardholderAddTemp->id) ?></td>
                <td><?= $seccCardholderAddTemp->has('secc_cardholder') ? $this->Html->link($seccCardholderAddTemp->secc_cardholder->name, ['controller' => 'SeccCardholders', 'action' => 'view', $seccCardholderAddTemp->secc_cardholder->id]) : '' ?></td>
                <td><?= h($seccCardholderAddTemp->rationcard_no) ?></td>
                <td><?= h($seccCardholderAddTemp->name) ?></td>
                <td><?= h($seccCardholderAddTemp->name_sl) ?></td>
                <td><?= $seccCardholderAddTemp->has('location') ? $this->Html->link($seccCardholderAddTemp->location->name, ['controller' => 'Locations', 'action' => 'view', $seccCardholderAddTemp->location->id]) : '' ?></td>
                <td><?= $seccCardholderAddTemp->has('cardtype') ? $this->Html->link($seccCardholderAddTemp->cardtype->name, ['controller' => 'Cardtypes', 'action' => 'view', $seccCardholderAddTemp->cardtype->id]) : '' ?></td>
                <td><?= h($seccCardholderAddTemp->fathername) ?></td>
                <td><?= h($seccCardholderAddTemp->fathername_sl) ?></td>
                <td><?= h($seccCardholderAddTemp->mothername) ?></td>
                <td><?= h($seccCardholderAddTemp->mothername_sl) ?></td>
                <td><?= $seccCardholderAddTemp->has('caste') ? $this->Html->link($seccCardholderAddTemp->caste->name, ['controller' => 'Castes', 'action' => 'view', $seccCardholderAddTemp->caste->id]) : '' ?></td>
                <td><?= $seccCardholderAddTemp->has('secc_district') ? $this->Html->link($seccCardholderAddTemp->secc_district->name, ['controller' => 'SeccDistricts', 'action' => 'view', $seccCardholderAddTemp->secc_district->id]) : '' ?></td>
                <td><?= $seccCardholderAddTemp->has('secc_block') ? $this->Html->link($seccCardholderAddTemp->secc_block->name, ['controller' => 'SeccBlocks', 'action' => 'view', $seccCardholderAddTemp->secc_block->id]) : '' ?></td>
                <td><?= $seccCardholderAddTemp->has('panchayat') ? $this->Html->link($seccCardholderAddTemp->panchayat->name, ['controller' => 'Panchayats', 'action' => 'view', $seccCardholderAddTemp->panchayat->id]) : '' ?></td>
                <td><?= $seccCardholderAddTemp->has('secc_village_ward') ? $this->Html->link($seccCardholderAddTemp->secc_village_ward->name, ['controller' => 'SeccVillageWards', 'action' => 'view', $seccCardholderAddTemp->secc_village_ward->id]) : '' ?></td>
                <td><?= h($seccCardholderAddTemp->rgi_district_code) ?></td>
                <td><?= h($seccCardholderAddTemp->rgi_block_code) ?></td>
                <td><?= h($seccCardholderAddTemp->rgi_village_code) ?></td>
                <td><?= h($seccCardholderAddTemp->res_address) ?></td>
                <td><?= h($seccCardholderAddTemp->res_address_hn) ?></td>
                <td><?= h($seccCardholderAddTemp->tolla_mohalla) ?></td>
                <td><?= h($seccCardholderAddTemp->qtr_plot_no) ?></td>
                <td><?= h($seccCardholderAddTemp->holding_no) ?></td>
                <td><?= $seccCardholderAddTemp->has('dealer') ? $this->Html->link($seccCardholderAddTemp->dealer->name, ['controller' => 'Dealers', 'action' => 'view', $seccCardholderAddTemp->dealer->id]) : '' ?></td>
                <td><?= h($seccCardholderAddTemp->status) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->family_count) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->mobile_count) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->uid_count) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->printFlag) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->applicationType) ?></td>
                <td><?= $seccCardholderAddTemp->has('activity_type') ? $this->Html->link($seccCardholderAddTemp->activity_type->name_hi, ['controller' => 'ActivityTypes', 'action' => 'view', $seccCardholderAddTemp->activity_type->id]) : '' ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->activities_status_id) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->activity_flag) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->activityFlag) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->activityType) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->dbtFlag) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->liftedCount) ?></td>
                <td><?= h($seccCardholderAddTemp->created) ?></td>
                <td><?= h($seccCardholderAddTemp->modified) ?></td>
                <td><?= h($seccCardholderAddTemp->verified) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->created_by) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->modified_by) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->verified_by) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->printed_by) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->subsidyMonth) ?></td>
                <td><?= h($seccCardholderAddTemp->remarks) ?></td>
                <td><?= h($seccCardholderAddTemp->bso_remarks) ?></td>
                <td><?= h($seccCardholderAddTemp->dso_remarks) ?></td>
                <td><?= h($seccCardholderAddTemp->requested_mobile) ?></td>
                <td><?= h($seccCardholderAddTemp->ack_no) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->requestedBy) ?></td>
                <td><?= h($seccCardholderAddTemp->bso_uid) ?></td>
                <td><?= h($seccCardholderAddTemp->dso_uid) ?></td>
                <td><?= h($seccCardholderAddTemp->bso_modifiedDate) ?></td>
                <td><?= h($seccCardholderAddTemp->dso_modifiedDate) ?></td>
                <td><?= $this->Number->format($seccCardholderAddTemp->flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $seccCardholderAddTemp->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $seccCardholderAddTemp->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $seccCardholderAddTemp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seccCardholderAddTemp->id)]) ?>
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
