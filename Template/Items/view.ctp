<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">

    <h3><?= h($item->id) ?></h3>
    <table class="vertical-table">
    
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($item->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Unit') ?></th>
            <td><?= $item->pu_name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sell Unit') ?></th>
             <td><?= $item->su_name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usage Unit') ?></th>
            <td><?= $item->us_name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Group Id') ?></th>
              <td><?= $item->ig_name ?></td>
        </tr>
      
    </table>
</div>



