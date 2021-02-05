<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JsfssDistrictReport[]|\Cake\Collection\CollectionInterface $jsfssDistrictReports
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Jsfss District Report'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="jsfssDistrictReports index large-9 medium-8 columns content">
    <h3><?= __('Jsfss District Reports') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rgi_district_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('districtName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('greenCardHeadCount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('greenCardMemberCount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jsfssDistrictReports as $jsfssDistrictReport): ?>
            <tr>
                <td><?= $this->Number->format($jsfssDistrictReport->id) ?></td>
                <td><?= h($jsfssDistrictReport->rgi_district_code) ?></td>
                <td><?= h($jsfssDistrictReport->districtName) ?></td>
                <td><?= $this->Number->format($jsfssDistrictReport->greenCardHeadCount) ?></td>
                <td><?= $this->Number->format($jsfssDistrictReport->greenCardMemberCount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $jsfssDistrictReport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $jsfssDistrictReport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $jsfssDistrictReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jsfssDistrictReport->id)]) ?>
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
