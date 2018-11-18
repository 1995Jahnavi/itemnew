<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrderItem $salesOrderItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesOrderItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrderItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Order Items'), ['action' => 'index']) ?></li>
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
<div class="salesOrderItems form large-9 medium-8 columns content">
    <?= $this->Form->create($salesOrderItem) ?>
    <fieldset>
        <legend><?= __('Edit Sales Order Item') ?></legend>
        <?php
            echo $this->Form->control('sales_order_id', ['options' => $salesOrders]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('units_id', ['options' => $units]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate');
            echo $this->Form->control('amount');
            echo $this->Form->control('warehouse_id', ['options' => $warehouses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
