<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesReport[]|\Cake\Collection\CollectionInterface $salesReport
 */
?>

<div class="salesReports index large-9 medium-8 columns content">
    <h3><?= __('Sales Orders Report') ?></h3>
    <table>
    <tr>
    <td> From date<input type="date" id="created_date" name="created_date" value="<?php echo date('Y-m-d'); ?>"></td>
    <td> To date<input type="date" id="delivery_date" name="delivary_date" value="<?php echo date('Y-m-d'); ?>"></td>
    <td><?php echo $this->Form->control('warehouse_id',array('type'=>'select','name'=>'warehouses[]')); ?></td> 
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','name'=>'items[]')); ?></td>
    <td><button  class="buttApply" onclick="check_display()">APPLY</button></td>
    </tr>
    </table>
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
     
         <?php foreach ($sales_orders as $salesorderitem): ?>
            <tr>
                <td><?= $salesorderitem->has('sales_order') ? $this->Html->link($salesorderitem->sales_order->id, ['controller' => 'SalesOrders', 'action' => 'view', $salesorderitem->sales_order->id]) : '' ?></td>

                <td><?= $salesorderitem->sales_order->created_date ?></td>
                <td><?= $salesorderitem->sales_order->delivary_date ?></td>
                <td><?= $salesorderitem->item->item_name ?></td>                
                <td><?= $salesorderitem->warehouse->name ?></td>
                <td><?= $salesorderitem->rate ?></td>
                <td><?= $salesorderitem->quantity ?></td>
           </tr>
           <?php endforeach; ?>
           
        </table>    
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script>  

function check_display()
{
   var created_date = $("#created_date").val();
    console.log(created_date);
     
   var delivery_date = $("#delivery_date").val();
     console.log(delivery_date);
   
    var warehouse = document.getElementById("warehouse-id");   
   var selected_value = warehouse.options[warehouse.selectedIndex].value;   
     console.log(selected_value);
     
     var item = document.getElementById("item-id");   
    var item_selected_value = item.options[item.selectedIndex].value;     
     console.log(item_selected_value);
       
   window.location.assign("http://localhost:8765/sales-report?warehouse_id="+selected_value+"&item_id="+item_selected_value+"&created_date="+created_date+"&delivery_date="+delivery_date);

} 
    
</script>     
