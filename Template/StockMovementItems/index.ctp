<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovementItem[]|\Cake\Collection\CollectionInterface $stockMovementItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Movement Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['controller' => 'StockMovements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock Movement'), ['controller' => 'StockMovements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockMovementItems index large-9 medium-8 columns content">
    <h3><?= __('Stock Movement Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_movement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockMovementItems as $stockMovementItem): ?>
            <tr>
                <td><?= $stockMovementItem->has('item') ? $this->Html->link($stockMovementItem->item->item_name, ['controller' => 'Items', 'action' => 'view', $stockMovementItem->item->id]) : '' ?></td>
                <td><?= $stockMovementItem->has('stock_movement') ? $this->Html->link($stockMovementItem->stock_movement->id, ['controller' => 'StockMovements', 'action' => 'view', $stockMovementItem->stock_movement->id]) : '' ?></td>
                <td><?= $this->Number->format($stockMovementItem->quantity) ?></td>
                <td><?= $stockMovementItem->has('unit') ? $this->Html->link($stockMovementItem->unit->unit_name, ['controller' => 'Units', 'action' => 'view', $stockMovementItem->unit->id]) : '' ?></td>
                <td><?= $this->Number->format($stockMovementItem->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockMovementItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockMovementItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockMovementItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovementItem->id)]) ?>
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
