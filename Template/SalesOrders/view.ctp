<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrder $salesOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Order'), ['action' => 'edit', $salesOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Order'), ['action' => 'delete', $salesOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Order Items'), ['controller' => 'SalesOrderItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Order Item'), ['controller' => 'SalesOrderItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesOrders view large-9 medium-8 columns content">
    <h3><?= h($salesOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesOrder->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Name') ?></th>
            <td><?= $salesOrder->customer_name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($salesOrder->created_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delivary Date') ?></th>
            <td><?= h($salesOrder->delivary_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sales Order Items') ?></h4>
        <?php if (!empty($salesOrder->sales_order_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Units Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Warehouse Id') ?></th>
            </tr>
            <?php foreach ($salesOrder->sales_order_items as $salesOrderItems): ?>
            <tr>
                <td><?= h($salesOrderItems->id) ?></td>
                <td><?= h($salesOrderItems->item_name) ?></td>
                <td><?= h($salesOrderItems->unit_name) ?></td>
                <td><?= h($salesOrderItems->quantity) ?></td>
                <td><?= h($salesOrderItems->rate) ?></td>
                <td><?= h($salesOrderItems->amount) ?></td>
                <td><?= h($salesOrderItems->warehouse_name) ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
