<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesReport[]|\Cake\Collection\CollectionInterface $salesReport
 */
?>

<div class="salesReports index large-9 medium-8 columns content">
    <h3><?= __('Sales Orders Report') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delivary_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('warehouse_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
            </tr>
        </thead>
      <?php echo $sales_orders->count(); ?>
      <?php foreach ($sales_orders as $salesorder): ?>
            <tr>
                <td><?= $this->Number->format($salesorder->id) ?></td>
                <td><?= $salesorder->created_date ?></td>
                <td><?= $salesorder->delivary_date ?></td>
                </tr>
           <?php endforeach; ?>
           <?php echo $sales_order_items->count(); ?>
           <?php foreach ($sales_order_items as $salesorder): ?>
            <td><?= $salesorder->warehouse_id ?></td>
            <td><?= $salesorder->item_id ?></td>
            <td><?= $salesorder->rate ?></td>
            <td><?= $salesorder->quantity ?></td>
            </tr>
            <?php endforeach; ?>
           
           
        </table>    
            