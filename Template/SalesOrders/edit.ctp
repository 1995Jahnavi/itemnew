<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesOrder $salesOrder
 */
?>
<div class="message success success-message" onclick="this.classList.add('hidden')">The purchase order has been saved.</div>
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
    <?= $this->Form->create($salesOrder , array('id' => 'myForm')) ?>
    <fieldset>
        <legend><?= __('Edit Sales Order') ?></legend>
        <?php
            echo $this->Form->control('customer_id',array('type'=>'select','options'=>$customers));
            //$this->Form->templates(
             // ['dateWidget' => '{{day}}{{month}}{{year}}']
           // );
            //echo $this->Form->control('created_date',array('id'=>'created_date'));
            //echo $this->Form->control('delivary_date',array('id'=>'delivary_date'));
        ?>
        created date<input type="date" id="created_date" name="created_date" value="<?php echo date("Y-m-d", strtotime($salesOrder->created_date)) ?>">
        delivery date<input type="date" id="delivery_date"  name="delivary_date" value="<?php echo date("Y-m-d", strtotime($salesOrder->delivary_date)) ?>" onchange="check_date()">
        
    </fieldset>
    <table id="salesOrderTable">
    <?php
    $index = 1;
    foreach($salesOrder->sales_order_items as $salesOrderItems)
    {
    $itemid = 'item_id'.$index;
    $unitid = 'unit_id'.$index;
    $quantity = 'quantity_id'.$index;
    $rate= 'rate_id'.$index;
    $warehouse='warehouse_id'.$index;
    $amount='amount'.$index;
    ?>
    <tr>
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>$salesOrderItems->id)); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]','id'=>$itemid,'default'=>$salesOrderItems->item_id,'onchange'=>'change(this.id)','disabled'=>true)); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'hidden','options'=>$items, 'name'=>'items[]','id'=>$itemid,'default'=>$salesOrderItems->item_id,'onchange'=>'change(this.id)')); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]','id'=>$unitid,'default'=>$salesOrderItems->unit_id)); ?></td>
    <td><?php echo $this->Form->control('quantity', array('type'=>'number','name'=>'qty[]','id'=>$quantity,'required' => true,'onchange'=>'calculate_amount(this.id)','default'=>$salesOrderItems->quantity)); ?></td>
    <td><?php echo $this->Form->control('rate', array('type'=>'number','name'=>'rte[]','id'=>$rate,'required' => true,'onchange'=>'calculate_amount(this.id)','default'=>$salesOrderItems->rate)); ?></td>
    <td><span id="<?php echo $amount ;?>"></span></td>
    <td><?php echo $this->Form->control('warehouse',array('type'=>'select','options'=>$warehouses, 'name'=>'warehouses[]','id'=>$warehouse,'default'=>$salesOrderItems->warehouse)); ?></td>
    </tr>
    <?php
    $index++;
    }
    ?>
    <input type= "button" onclick= "add_row();hide_submit()"  value= "Add row"> 
    <input type="button" id="delsmbutton" value="Delete" onclick="changeCheck()" >
    </table>
    <button type="submit" value="Submit" id="btn_submit">Submit</button>
        <?= $this->Form->end() ?>
</div>
 <script src="/js/jquery-3.3.1.min.js"></script>

<script>
    function do_onload(){
    console.log('afasfasf111111');
    var item_select_box = document.getElementById('item_id');
    console.log("1212121212",item_select_box); 
    var smCount = $('#salesOrderTable tr').length;
    console.log('afasfasf111111 ',smCount);  
    
    for(var i=1; i<=smCount; i++)
        {
          //console.log(i, smCount);
            //console.log("iiiiii ", $('#item_id'+i).attr('id'));
            var item_id = $('#item_id'+i).attr('id');
            console.log("item_id",item_id);
            change(item_id);
            //it should keep the selected unit-id for that item from database as selected
        }
    }
    window.onload = do_onload();
  
    
    function add_row() {
    var table = document.getElementById("salesOrderTable");
    var smCount = $('#salesOrderTable tr').length;
    var no_of_rows = $('#salesOrderTable tr').length;
    console.log("no_of_rows ", no_of_rows);
    var units= <?php echo json_encode($units); ?>;
    var unit_options = "";
    for(var k in units){
         unit_options +="<option value='" +k+ "'>" +units[k]+ "</option>"; 
         }
    var items= <?php echo json_encode($items); ?>;
    var item_options = "";//
    for(var k in items){
         item_options +="<option value='" +k+ "'>" +items[k]+ "</option>"; 
         }
    var warehouses= <?php echo json_encode($warehouses); ?>;
    var warehouse_options = "";
    for(var k in warehouses){
         warehouse_options +="<option value='" +k+ "'>" +warehouses[k]+ "</option>"; 
         }
         
    var row = table.insertRow().innerHTML ='<tr> \
    <td><input type="checkbox" name="chk[]" id=chk'+(smCount+1)+'></td> \
    <td><select name ="items[]" onchange="change(this.id)" id=item_id'+(no_of_rows+1)+'>'+item_options+'</select></td> \
    <td></td> \
    <td><select name ="units[]" id=unit_id'+(no_of_rows+1)+'>'+unit_options+'</select></td> \
    <td><input type="number" name ="qty[]" id=quantity_id'+(no_of_rows+1)+' onchange="calculate_amount(this.id)" required="true"></td> \
    <td><input type="number" name ="rte[]" id=rate_id'+(no_of_rows+1)+' onchange="calculate_amount(this.id)" required="true"></td> \
    <td><span id=amount'+(no_of_rows+1)+'></span></td> \
    <td><select name ="warehouses[]" id=warehouse_id'+(no_of_rows+1)+'>'+warehouse_options+'</select></td> \
    </tr>';
    var item_select_box = document.getElementById('item_id'+(no_of_rows+1));
    console.log("1111qqqqqqq",item_select_box);
    change(item_select_box.id);
     
}
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById("salesOrderTable").deleteRow(i);
}

function change(id){ 
    console.log("element in change ", id);
    var item_select_box = document.getElementById(id);
    console.log("item_select_box ",item_select_box);    
    //this will give selected dropdown value, that is item_id
    var selected_value = item_select_box.options[item_select_box.selectedIndex].value;
    //var selectedValue = item_select_box.value();
    console.log("emlement id",id);
    
   // console.log(selected_value);
    var element_id= id.replace(/[^0-9]/g, '');
    console.log("121212121 ",element_id);
          
          if(element_id >=1){
          var unit_box=$('#unit_id'+element_id);
          console.log("unit111111 ",unit_box);
          unit_box.empty();
            }
            
    $.ajax({
        type: 'get',
        url: '/sales-orders/getunits',
        async: false,
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
             //   console.log("response ",response);
               
                if (response) {
                if(element_id >= 1)
                      {
                        for(var k in response)
                        {
                        $("#unit_id"+element_id).append("<option value='" +k+ "'>" +response[k]+ "</option>"); 
                          }
                              console.log("ddddddddddd","#unit-id"+element_id);
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
   // console.log(checkids);   
    $.ajax({type:"POST",
                async: true,
                cache: false,
                url: '/sales-orders/getitems',
                data: { 
                   sales_order_item_id:checkids
                },
           dataType: 'json',
                beforeSend: function(xhr) {
                    //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                
               success: function(response) {
                if (response.error) {
                    $('.success-message').hide();
                    $('.error-message').show();
                    $('.error-message').html("The sales order could not be deleted. Please, try again.");
                    $('.error-message').fadeIn();
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
                   // console.log(entry);
                    var chkbox = $('#'+entry);
                    chkbox.closest("tr").remove();
                    $('.success-message').show();
                    $('.error-message').hide();
                    $('.success-message').html("The sales order has been deleted");
                    $('.success-message').fadeIn();
                });  
                      hide_submit();      
                 }  
                
           }
        });
        }
            alert("selected row is deleted"); 
        
      }
    function calculate_amount(id){     
    console.log("id ",id);
    var input_box = document.getElementById(id);
    console.log("element ",input_box);
    var element_id=id.replace(/[^0-9]/g, '');
    console.log("calculate amount ",element_id);
    if(element_id == 1 || element_id == 1){
    if(element_id==1){
            var rate_box = document.getElementById("rate_id"+element_id);
            var amount = input_box.value * rate_box.value;
            console.log("rrrrrrr ",rate_box.value);
            }
            else{
            var qty_box = document.getElementById("quantity_id"+element_id);
            var amount = input_box.value * qty_box.value;
            console.log("123123123 ",qty_box);          
            } 
            $('#amount'+element_id).html(amount);   
    }else{
         var element_id=id.replace(/[^0-9]/g, '');
         var qty_box = document.getElementById("quantity_id"+element_id);
        var rate_box = document.getElementById("rate_id"+element_id);
        var amount = qty_box.value * rate_box.value;
        console.log(amount);
        $('#amount'+element_id).html(amount);
    }        
        
    }
    function hide_submit(){
         var no_of_rows = $('#salesOrderTable tr').length;
   //      console.log("no of row in hide_submit function",no_of_rows);
         if(no_of_rows == 0){
         var sub_btn=$('#btn_submit');
         sub_btn.hide();
         }
         else{
         var sub_btn=$('#btn_submit');
         sub_btn.show();
         }
     }
      window.onload = hide_submit();
    
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
