<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\JsfssDistrictReport $jsfssDistrictReport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Jsfss District Report'), ['action' => 'edit', $jsfssDistrictReport->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Jsfss District Report'), ['action' => 'delete', $jsfssDistrictReport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $jsfssDistrictReport->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Jsfss District Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Jsfss District Report'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="jsfssDistrictReports view large-9 medium-8 columns content">
    <h3><?= h($jsfssDistrictReport->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rgi District Code') ?></th>
            <td><?= h($jsfssDistrictReport->rgi_district_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DistrictName') ?></th>
            <td><?= h($jsfssDistrictReport->districtName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($jsfssDistrictReport->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('GreenCardHeadCount') ?></th>
            <td><?= $this->Number->format($jsfssDistrictReport->greenCardHeadCount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('GreenCardMemberCount') ?></th>
            <td><?= $this->Number->format($jsfssDistrictReport->greenCardMemberCount) ?></td>
        </tr>
    </table>
</div>
