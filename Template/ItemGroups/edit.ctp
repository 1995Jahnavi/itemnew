<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemGroup $itemGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemGroup->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemGroup->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Groups'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemGroups form large-9 medium-8 columns content">
    <?= $this->Form->create($itemGroup) ?>
    <fieldset>
        <legend><?= __('Edit Item Group') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
