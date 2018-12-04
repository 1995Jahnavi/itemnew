<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrder $salesOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sales Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sales Order Items'), ['controller' => 'SalesOrderItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Order Item'), ['controller' => 'SalesOrderItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($salesOrder, array('id' => 'myForm')) ?>
    <fieldset>
        <legend><?= __('Add Sales Order') ?></legend>
        <?php
            echo $this->Form->control('customer_id',array('type'=>'select','options'=>$customers));
			//$this->Form->templates(
         //     ['dateWidget' => '{{day}}{{month}}{{year}}']
         //   );
           //  echo $this->Form->control('created_date');
           //  echo $this->Form->control('delivary_date');
      //  ?>
        created date<input type="date" id="created_date" name="created_date" value="<?php echo date("Y-m-d", strtotime($salesOrder->created_date)) ?>">
        delivery date<input type="date" id="delivery_date"  name="delivary_date" value="<?php echo date("Y-m-d", strtotime($salesOrder->delivary_date)) ?>" onchange="check_date()">
        
    </fieldset>
    <table id="salesOrderTable">
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>'chk')); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]','onchange'=>'change(this)')); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('type'=>'number','name'=>'qty[]','required' => true,'onchange'=>'calculate_amount(this.id)')); ?></td>
    <td><?php echo $this->Form->control('rate', array('type'=>'number','name'=>'rte[]','required' => true,'onchange'=>'calculate_amount(this.id)')); ?></td>        
    <td><span id='amount' default=true></span></td>     
    <td><?php echo $this->Form->control('warehouse',array('type'=>'select','options'=>$warehouses, 'name'=>'warehouses[]')); ?></td>   
    </tr>
    <input type= "button" onclick= "add_row()" value= "Add row" > 
    <input type="button" id="delsmbutton" value="Delete" onclick="changeCheck()" >
	
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 <script src="/js/jquery-3.3.1.min.js"></script>

<script>
    var item_select_box = document.getElementById('item-id');
    console.log("bwy7ecwil",item_select_box);
    window.onload = change(item_select_box);
    
    function add_row() {
	console.log("sdgsdgsdgwerwer45345");	
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
    <td><input type="number" name ="qty[]" id=quantity-id'+(no_of_rows)+' onchange="calculate_amount(this.id)" required="true"></td> \
    <td><input type="number" name ="rte[]" id=rate-id'+(no_of_rows)+' onchange="calculate_amount(this.id)" required="true"></td> \
    <td><span id=amount'+(no_of_rows)+' > </span> </td> \
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
            var item_select_box = document.getElementById(element.id);
                  console.log("element ",item_select_box);               
            
            //this will give selected dropdown value, that is item_id
            
            var selected_value = item_select_box.options[item_select_box.selectedIndex].value;
            console.log(selected_value);   
            console.log(element.id);
            var element_id= element.id.replace(/[^0-9]/g, '');
            console.log("121212121 ",element_id);
          
          if(element_id == ""){
          var unit_box=$('#unit-id');
                unit_box.empty();
            }
            if(element_id>=1){
                 var unit_select_box=$('#unit-id'+element_id);
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
                        //console.log(response.error);
                }
                if (response) {
                if(element_id == "")
                      {
                        for(var k in response)
                        {
                        $("#unit-id").append("<option value='" +k+ "'>" +response[k]+ "</option>"); 
                          }
                              console.log("ddddddddddd","#unit-id");
                      }
                      if(element_id>=1){
                         for(var k in response) {
                          $("#unit-id"+element_id).append("<option value='" +k+ "'>" +response[k]+ "</option>");
                              }
                           console.log("else","#unit-id"+element_id);
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
    $.ajax({type:"POST",
                async: true,
                cache: false,
                url: '/sales-orders/getitems',
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
      
  function calculate_amount(id){     
    console.log("id ",id);
    
   // var input_box = document.getElementById(id);
  //  console.log("element ",input_box);
    
    var element_id=id.replace(/[^0-9]/g, '');
    console.log("calculate amount ",element_id);
    if(element_id==""){
            var qty_box = document.getElementById("quantity"+element_id);
            
          //  var amount = input_box.value * qty_box.value;
          //  console.log("123123123 ",qty_box.value); 
            
            var rate_box = document.getElementById("rate"+element_id);
           
           // var amount = input_box.value * rate_box.value;
            
             var amount = qty_box.value * rate_box.value;
            
            $('#amount'+element_id).html(amount);   
    }if(element_id>=1){
       
       // var element_id=id.replace(/[^0-9]/g, '');
      //  console.log("1212121121",element_id);
        
        var qty_box = document.getElementById("quantity-id"+element_id);
        var rate_box = document.getElementById("rate-id"+element_id);
        var amount = qty_box.value * rate_box.value;
        console.log(amount);
        $('#amount'+element_id).html(amount);
    }    
        
    }

 function check_date(){
        var created_date = $("#created_date").val();
        var delivery_date = $("#delivery_date").val();
       // var date1 = new Date(01,01,2018);
      //  var date2 = new Date(31,12,2018);
       // console.log("date validation",date2);
        if(delivery_date > created_date)
        {
        window.alert("date entered is valid");
        }
        else{
        //console.log("cbwu2222222222222",date2);
        window.alert("date entered is invalid, delivery date cannot be earlier then created date");
        }
    }


  </script>
     
 