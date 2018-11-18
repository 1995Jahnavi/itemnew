<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrderItem[]|\Cake\Collection\CollectionInterface $salesOrderItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Order Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['controller' => 'SalesOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Order'), ['controller' => 'SalesOrders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesOrderItems index large-9 medium-8 columns content">
    <h3><?= __('Sales Order Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('units_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('warehouse_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesOrderItems as $salesOrderItem): ?>
            <tr>
                <td><?= $this->Number->format($salesOrderItem->id) ?></td>
                <td><?= $salesOrderItem->has('sales_order') ? $this->Html->link($salesOrderItem->sales_order->id, ['controller' => 'SalesOrders', 'action' => 'view', $salesOrderItem->sales_order->id]) : '' ?></td>
                <td><?= $salesOrderItem->has('item') ? $this->Html->link($salesOrderItem->item->item_name, ['controller' => 'Items', 'action' => 'view', $salesOrderItem->item->id]) : '' ?></td>
                <td><?= $salesOrderItem->has('unit') ? $this->Html->link($salesOrderItem->unit->unit_name, ['controller' => 'Units', 'action' => 'view', $salesOrderItem->unit->id]) : '' ?></td>
                <td><?= $this->Number->format($salesOrderItem->quantity) ?></td>
                <td><?= $this->Number->format($salesOrderItem->rate) ?></td>
                <td><?= $this->Number->format($salesOrderItem->amount) ?></td>
                <td><?= $salesOrderItem->has('warehouse') ? $this->Html->link($salesOrderItem->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $salesOrderItem->warehouse->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salesOrderItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesOrderItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salesOrderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrderItem->id)]) ?>
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
