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
    <td> From date<input type="date" id="created_date" name="created_date" value="<?php echo $results["data"]['created_date'];?>"></td>
    <td> To date<input type="date" id="delivery_date" name="delivary_date" value="<?php echo $results["data"]['delivary_date']; ?>"></td>
    <td><?php echo $this->Form->control('warehouse_id',array('type'=>'select','name'=>'warehouses[]','default'=>$results["data"]['warehouse_id'])); ?></td> 
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','name'=>'items[]','default'=>$results["data"]['item_id'])); ?></td>
    <td><button type="button" value="Submit" id="btn_submit" onclick="check_display()">Submit</button></td>
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
     
        
         <?php 
         foreach ($results["sales_orders"] as $salesorderitem): ?>
            <tr>
                <td><?= $salesorderitem->has('so') ? $this->Html->link($salesorderitem->so['id'], ['controller' => 'SalesOrders', 'action' => 'view', $salesorderitem->so['id']]) : '' ?></td>
                <td><?= $salesorderitem->so['created_date'] ?></td>
                <td><?= $salesorderitem->so['delivary_date'] ?></td>
                <td><?= $salesorderitem->item['item_name'] ?></td>                
                <td><?= $salesorderitem->warehouse['name'] ?></td>
                <td><?= $salesorderitem->quantity ?></td>
                <td><?= $salesorderitem->rate ?></td>
           </tr>
           <?php endforeach; ?>
           
        </table>    
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script>  

function check_display()
{
   var created_date = $("#created_date").val();
   // console.log(created_date.setDate(0));
     
   var delivery_date = $("#delivery_date").val();
     console.log(delivery_date);
   
    var warehouse = document.getElementById("warehouse-id");   
    var selected_value = warehouse.options[warehouse.selectedIndex].value;   
    console.log(selected_value);


     var item = document.getElementById("item-id");   
     var item_selected_value = item.options[item.selectedIndex].value;     
     console.log(item_selected_value);
       
  // window.location.assign("http://192.168.1.6:8765/sales-report?warehouse_id="+selected_value+"&item_id="+item_selected_value+"&created_date="+created_date+"&delivery_date="+delivery_date);

	  var report  = window.location.origin;
	  console.log(report);
	 // window.location.href = report; 
	  window.location.assign(report+"/sales-report?warehouse_id="+selected_value+"&item_id="+item_selected_value+"&created_date="+created_date+"&delivary_date="+delivery_date);
		
} 
    
</script>   
  
  
