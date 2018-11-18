<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Warehouse $warehouse
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="warehouses form large-9 medium-8 columns content">
    <?= $this->Form->create('warehouse') ?>
    <fieldset>
        <legend><?= __('Add Warehouse') ?></legend>
        <?php
            echo $this->Form->control('name');
           /** echo $this->Form->control('quantity');
            echo $this->Form->control('unit_id', ['options' => $units]);
            echo $this->Form->control('item_id', ['options' => $items]);
       */ ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
