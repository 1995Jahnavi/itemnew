<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrder $salesOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Order'), ['action' => 'edit', $salesOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Order'), ['action' => 'delete', $salesOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Order'), ['action' => 'add']) ?> </li>
     </ul>
</nav>
<div class="salesOrders view large-9 medium-8 columns content">
    <button type="submit" value="Submit" id="pdf_submit" onclick="print_pdf()" target="">Print Pdf</button>
    <input type="hidden" name="soid" id="soid" value="<?php echo $salesOrder->id ?>">
    <h3><?= h($salesOrder->id) ?></h3>

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer Name') ?></th>
            <td><?= $salesOrder->customer_name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($salesOrder->created_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delivary Date') ?></th>
            <td><?= h($salesOrder->delivary_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sales Order Items') ?></h4>
        <?php if (!empty($salesOrder->sales_order_items)): ?>
        <table cellpadding="0" cellspacing="0" id="viewTable">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Id') ?></th>
                <th scope="col"><?= __('Units Id') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Rate') ?></th>
                <th scope="col"><?= __('Warehouse Id') ?></th>
            </tr>
            <?php 
			$index = 1;    			
			foreach ($salesOrder->sales_order_items as $salesOrderItems): 
			$quantity = 'quantity_id'.$index;
			$rate = 'rate_id'.$index;
            $amount='amount_id'.$index;			
			?>
            <tr>
                <td><?= h($salesOrderItems->id) ?></td>
                <td><?= h($salesOrderItems->item_name) ?></td>
                <td><?= h($salesOrderItems->unit_name) ?></td>
                <td id="<?php echo $quantity; ?>"><?= h($salesOrderItems->quantity) ?></td>
                <td id="<?php echo $rate; ?>"><?= h($salesOrderItems->rate) ?></td>
                <td><?= h($salesOrderItems->warehouse_name) ?></td>
            </tr>
			 <?php
              $index++;
              
             ?>
			 
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script>
 
 
		function do_onload(){
        var smCount = $('#viewTable tr').length;
        console.log('afasfasf111111 ', smCount);        
        for(var i=1; i<smCount;i++){
            console.log("iiiiii ", $('#quantity'+i));
            var qty = $('#quantity_id'+i).text();
			var rate = $('#rate_id'+i).text();
			var amount = parseFloat(qty) * parseFloat(rate);
			//var amt=amount.toPrecision(4);
			$('#amount_id'+i).text(amount);
            console.log(amount,qty,rate);            
		}
		}
		
		window.onload = do_onload();

    function print_pdf(){
    
    var ppdf=document.getElementById("pdf_submit");
    var soid = $("#soid").val();
    console.log("2355555555551344444444444444444444444444444444444",soid);
        //window.location.href = "http://localhost:8765/sales-orders/generatepdf?id="+$("#soid").val();
        window.open("http://localhost:8765/sales-orders/generatepdf?id="+soid);
    }
   
   </script> 