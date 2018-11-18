<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemGroup $itemGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Group'), ['action' => 'edit', $itemGroup->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Group'), ['action' => 'delete', $itemGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemGroup->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemGroups view large-9 medium-8 columns content">
    <h3><?= h($itemGroup->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($itemGroup->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemGroup->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Items') ?></h4>
        <?php if (!empty($itemGroup->items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Name') ?></th>
                <th scope="col"><?= __('Purchase Unit') ?></th>
                <th scope="col"><?= __('Sell Unit') ?></th>
                <th scope="col"><?= __('Usage Unit') ?></th>
                <th scope="col"><?= __('Item Group Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemGroup->items as $items): ?>
            <tr>
                <td><?= h($items->id) ?></td>
                <td><?= h($items->item_name) ?></td>
                <td><?= h($items->purchase_unit_name) ?></td>
                <td><?= h($items->sell_unit_name) ?></td>
                <td><?= h($items->usage_unit_name) ?></td>
                <td><?= h($items->item_group_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
