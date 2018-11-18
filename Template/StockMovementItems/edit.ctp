<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovementItem $stockMovementItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stockMovementItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovementItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stock Movement Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['controller' => 'StockMovements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock Movement'), ['controller' => 'StockMovements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockMovementItems form large-9 medium-8 columns content">
    <?= $this->Form->create($stockMovementItem) ?>
    <fieldset>
        <legend><?= __('Edit Stock Movement Item') ?></legend>
        <?php
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('stock_movement_id', ['options' => $stockMovements]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('unit_id', ['options' => $units]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
