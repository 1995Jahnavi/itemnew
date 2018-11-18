<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Warehouse $warehouse
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Warehouse'), ['action' => 'edit', $warehouse->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Warehouse'), ['action' => 'delete', $warehouse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouse->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="warehouses view large-9 medium-8 columns content">
    <h3><?= h($warehouse->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($warehouse->name) ?></td>
        </tr>
       
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($warehouse->id) ?></td>
        </tr>
        
    </table>
</div>
