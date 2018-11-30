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
    <td> From date<input type="date" id="created_date" name="created_date"></td>
    <td> To date<input type="date" id="delivery_date" name="delivary_date"></td>
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
     
      <?php foreach ($sales_orders as $salesorder): ?>
         <?php foreach ($salesorder->sales_order_items as $salesorderitem): ?>
            <tr>
                <td><?= $this->Number->format($salesorder->id) ?></td>
                <td><?= $salesorder->created_date ?></td>
                <td><?= $salesorder->delivary_date ?></td>
                <td><?= $salesorderitem->item->item_name ?></td>                
                <td><?= $salesorderitem->warehouse->name ?></td>
                <td><?= $salesorderitem->rate ?></td>
                <td><?= $salesorderitem->quantity ?></td>
           </tr>
           <?php endforeach; ?>
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
       
   window.location.assign("http://localhost:8765/sales-report?warehouse_id="+selected_value+"&item_id="+item_selected_value);

} 
    
</script>     