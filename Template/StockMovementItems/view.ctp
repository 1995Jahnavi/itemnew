<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovementItem $stockMovementItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Movement Item'), ['action' => 'edit', $stockMovementItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Movement Item'), ['action' => 'delete', $stockMovementItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovementItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Movement Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Movement Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['controller' => 'StockMovements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Movement'), ['controller' => 'StockMovements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockMovementItems view large-9 medium-8 columns content">
    <h3><?= h($stockMovementItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item') ?></th>
            <td><?= $stockMovementItem->has('item') ? $this->Html->link($stockMovementItem->item->item_name, ['controller' => 'Items', 'action' => 'view', $stockMovementItem->item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Movement') ?></th>
            <td><?= $stockMovementItem->has('stock_movement') ? $this->Html->link($stockMovementItem->stock_movement->id, ['controller' => 'StockMovements', 'action' => 'view', $stockMovementItem->stock_movement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $stockMovementItem->has('unit') ? $this->Html->link($stockMovementItem->unit->unit_name, ['controller' => 'Units', 'action' => 'view', $stockMovementItem->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($stockMovementItem->quantity) ?></td>
        </tr>
       
    </table>
</div>
