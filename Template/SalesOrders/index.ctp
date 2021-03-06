<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrder[]|\Cake\Collection\CollectionInterface $salesOrders
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Order'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesOrders index large-9 medium-8 columns content">
    <h3><?= __('Sales Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delivary_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach ($salesOrders as $salesOrder): ?>
            <tr>
                <td><?= $this->Number->format($salesOrder->id) ?></td>
                <td><?= $salesOrder->customer_name ?></td>
                <td><?= h($salesOrder->created_date->i18nFormat('dd-MM-YYYY')) ?> </td>
                <td><?= h($salesOrder->delivary_date->i18nFormat('dd-MM-YYYY')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salesOrder->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesOrder->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salesOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrder->id)]) ?>
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
