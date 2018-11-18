<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrderItem $salesOrderItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Order Item'), ['action' => 'edit', $salesOrderItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Order Item'), ['action' => 'delete', $salesOrderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrderItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Order Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Order Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['controller' => 'SalesOrders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Order'), ['controller' => 'SalesOrders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesOrderItems view large-9 medium-8 columns content">
    <h3><?= h($salesOrderItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sales Order') ?></th>
            <td><?= $salesOrderItem->has('sales_order') ? $this->Html->link($salesOrderItem->sales_order->id, ['controller' => 'SalesOrders', 'action' => 'view', $salesOrderItem->sales_order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $salesOrderItem->has('item') ? $this->Html->link($salesOrderItem->item->item_name, ['controller' => 'Items', 'action' => 'view', $salesOrderItem->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $salesOrderItem->has('unit') ? $this->Html->link($salesOrderItem->unit->unit_name, ['controller' => 'Units', 'action' => 'view', $salesOrderItem->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Warehouse') ?></th>
            <td><?= $salesOrderItem->has('warehouse') ? $this->Html->link($salesOrderItem->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $salesOrderItem->warehouse->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesOrderItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($salesOrderItem->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= $this->Number->format($salesOrderItem->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($salesOrderItem->amount) ?></td>
        </tr>
    </table>
</div>
