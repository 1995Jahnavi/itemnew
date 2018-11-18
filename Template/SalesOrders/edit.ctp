<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrder $salesOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesOrder->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesOrder->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sales Order Items'), ['controller' => 'SalesOrderItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Order Item'), ['controller' => 'SalesOrderItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($salesOrder) ?>
    <fieldset>
        <legend><?= __('Edit Sales Order') ?></legend>
        <?php
            echo $this->Form->control('customer_name');
            echo $this->Form->control('created_date');
            echo $this->Form->control('delivary_date');
        ?>
    </fieldset>
    <table id="salesOrderTable">
    <?php
    foreach($salesOrder->sales_order_items as $salesOrderItems)
    {
    ?>
    <tr>
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>$salesOrderItems->id)); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]','onchange'=>'change(this)')); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('name'=>'qty[]','required' => true)); ?></td>
    <td><?php echo $this->Form->control('rate', array('name'=>'rte[]','required' => true)); ?></td>        
    <td><?php echo $this->Form->control('amount', array('name'=>'amt[]','required' => true)); ?></td>        
    <td><?php echo $this->Form->control('warehouse',array('type'=>'select','options'=>$warehouses, 'name'=>'warehouses[]')); ?></td>   
    </tr>
    <?php
    }
    ?>
    <input type= "button" onclick= "add_row()" value= "Add row" > 
    <input type="button" id="delsmbutton" value="Delete" onclick="changeCheck()">
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    var item_select_box = document.getElementById('item-id');
    window.onload = change(item_select_box);
    
    function add_row() {
    var table = document.getElementById("salesOrderTable");
    var smCount = $('#salesOrderTable tr').length;
    var no_of_rows = $('#salesOrderTable tr').length;
    var units= <?php echo json_encode($units); ?>;
    var unit_options = "";
    for(var k in units){
         unit_options +="<option value='" +k+ "'>" +units[k]+ "</option>"; 
         }
    var items= <?php echo json_encode($items); ?>;
    var item_options = "";
    for(var k in items){
         item_options +="<option value='" +k+ "'>" +items[k]+ "</option>"; 
         }
    var row = table.insertRow().innerHTML ='<tr> \
    <td><input type="checkbox" name="chk[]" id=chk'+(smCount+1)+'></td> \
    <td><select name ="items[]"  onchange="change(this)" id=item-id'+(no_of_rows)+'>'+item_options+'</select></td> \
    <td><select name ="units[]" id=unit-id'+(no_of_rows)+'><option></option>'+unit_options+'</select></td> \
    <td><?php echo $this->Form->control('', array('name'=>'qty[]','required' => true)); ?></td> \
    <td><?php echo $this->Form->control('', array('name'=>'rte[]','required' => true)); ?></td> \
    <td><?php echo $this->Form->control('', array('name'=>'amt[]','required' => true)); ?></td> \
    <td><?php echo $this->Form->control('',array('type'=>'select','options'=>$warehouses, 'name'=>'warehouses[]')); ?></td> \
    </tr>';
    var item_select_box = document.getElementById('item-id'+no_of_rows);
    change(item_select_box); 
}
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById("salesOrderTable").deleteRow(i);
}
function change(element){ 
    console.log("fhfdh");
    var item_select_box = document.getElementById(element.id);
          console.log("element",item_select_box);               
    
    //this will give selected dropdown value, that is item_id
    
    var selected_value = item_select_box.options[item_select_box.selectedIndex].value;
    console.log(selected_value);   
    
    current_row = element.id[element.id.length -1]
    console.log("current_row ",current_row);          

    
    if(current_row == "d"){
        var unit_box=$('#unit-id');
        unit_box.empty();
        }else{
            var unit_select_box=$('#unit-id'+current_row);
            unit_select_box.empty();        
            }
    
    $.ajax({
        type: 'get',
        url: '/stock-movements/getunits',
        data: { 
        itemid: selected_value
        },
            dataType: 'json',
                beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        },
        success: function(response) 
            {
                if (response.error) {
                alert(response.error);
                console.log(response.error);
                }
                if (response) {   
                if(current_row == "d")
              {
                for(var k in response){
                $("#unit-id").append("<option value='" +k+ "'>" +response[k]+ "</option>"); 
                                        }
              }  else {
                 for(var k in response) {
                  $("#unit-id"+current_row).append("<option value='" +k+ "'>" +response[k]+ "</option>");
                             }
                       }      
                 }   
              }
        
        });
}
        
        function changeCheck(){
          var sales_order_delete = $('#sales_order-id');
         
          var checkboxes = document.getElementsByName("chk[]");
          //console.log(checkboxes);
          
          var checkids = new Array();
         // var checkdelete = new Array();
         
        $("input[name='chk[]']:checked").each(function() {
              if ($(this).is(":checked")) {
                 var chkbox = $('#'+$(this).attr('id'));
                 var isnum = /^\d+$/.test($(this).attr('id'));              
                    if(!isnum)
                    {
                 
                    //console.log(chkbox.closest("tr"));
                    chkbox.closest("tr").remove();
                 }else{
                    checkids.push($(this).attr('id'));
                 }
              }
                 
              });
              if(checkids.length > 0){    
    console.log(checkids);   
    $.ajax({
                type:"POST",
                async: true,
                cache: false,
                url: '/stock-movements/getitems',
                data: { 
                    salesorderid: checkids
                },
           dataType: 'json',
                beforeSend: function(xhr) {
                    //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                
               success: function(response) {                    
                if (response.error) {
                alert(response.error);
                console.log(response.error);
            }
            if (response){
               //location.reload();
               //console.log(response);
//             $(this).closest('tr').remove();
               //location.reload();
               
               //delete the checkbox closest parent tr
               checkids.forEach(function(entry) {
                    console.log(entry);
                    var chkbox = $('#'+entry);
                    chkbox.closest("tr").remove();
                });            
               
               }  
           }
        });
        }
      }
              
  </script>