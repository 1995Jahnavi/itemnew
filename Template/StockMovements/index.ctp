<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovement[]|\Cake\Collection\CollectionInterface $stockMovements
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stock Movement'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockMovements index large-9 medium-8 columns content">
    <h3><?= __('Stock Movements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from_warehouse_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to_warehouse_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <th scope="col"><?= $this->Paginator->sort('posting_date') ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockMovements as $stockMovement): ?>
            <tr>
                <td><?= $this->Number->format($stockMovement->id) ?></td>
               
              
                 
                   <td><?= $stockMovement->has('warehouse') ? $this->Html->link($stockMovement->fw_name, ['controller' => 'Warehouses', 'action' => 'view', $stockMovement->warehouse->id]) : '' ?></td>
                 
                  <td><?= $stockMovement->has('warehouse') ? $this->Html->link($stockMovement->tw_name, ['controller' => 'Warehouses', 'action' => 'view', $stockMovement->warehouse->id]) : '' ?></td>
                 
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockMovement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockMovement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockMovement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovement->id)]) ?>
                </td>
                 <td><?= $stockMovement->posting_date->i18nFormat('dd-MM-YYYY')?></td>
                 
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
