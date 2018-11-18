<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $item->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('Edit Item') ?></legend>
        <?php
            echo $this->Form->control('item_name');
            echo $this->Form->input('purchase_unit',array('type'=>'select','options'=>$units));
             echo $this->Form->control('sell_unit_qty');
            echo $this->Form->control('sell_unit',array('type'=>'select','options'=>$units));
             echo $this->Form->control('usage_unit_qty');
            echo $this->Form->control('usage_unit',array('type'=>'select','options'=>$units));
            echo $this->Form->control('item_group_id',array('type'=>'select','options'=>$itemgroups));
           
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
