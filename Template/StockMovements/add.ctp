<?php
/**
 * @var \App\View\AppView $this 
 * @var \App\Model\Entity\StockMovement $stockMovement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockMovements form large-9 medium-8 columns content">
    <?= $this->Form->create($stockMovement,array('id' => 'myForm')) ?>
    <fieldset>
        <legend><?= __('Add Stock Movement') ?></legend>
        <?php
            echo $this->Form->control('from_warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('to_warehouse_id', ['options' => $warehouses]);
            $this->Form->templates(
              ['dateWidget' => '{{day}}{{month}}{{year}}']
            );
            echo $this->Form->input('posting_date', ['type'=>'date']);
        ?>
    </fieldset>

    <table id="stockMovementsTable">
    <tr>
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>'chk')); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]','onchange'=>'change(this)')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('type'=>'number','name'=>'qty[]','required' => true,'min'=>'.01', 'max'=>'9999999999.99','step'=>'.01')); ?></td>        
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]')); ?></td>
    </tr>
    
    <input type= "button" onclick= "add_row()" value= "Add row" > 
    <input type="button" id="delsmbutton" value="Delete" onclick="changeCheck()">
    </table>
    
    <button type="button" value="Submit" id="btn_submit" onclick="change_warehouse()">Submit</button>
    <button type="submit" value="Submit" id="btn_submit1" style="display: none">Submit</button>
    
    <?= $this->Form->end() ?>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <script>
    var item_select_box = document.getElementById('item-id');
    window.onload = change(item_select_box);
    
    function add_row() {
    var table = document.getElementById("stockMovementsTable");
    var smCount = $('#salesOrderTable tr').length;
    var no_of_rows = $('#stockMovementsTable tr').length;
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
    <td><input type="number" name ="qty[]" id=quantity-id'+(no_of_rows)+' required="true"  min=".01" max="9999999999.99" step=".01"></td> \
    <td><select name ="units[]" id=unit-id'+(no_of_rows)+'><option></option>'+unit_options+'</select></td> \
    </tr>'; 
    var item_select_box = document.getElementById('item-id'+no_of_rows);
    change(item_select_box);   
    }
    
    function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById("stockMovementsTable").deleteRow(i);
}
 
      function change(element){     
            var item_select_box = document.getElementById(element.id);
                  console.log("element ",item_select_box);               
            
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
                     }else {
                         for(var k in response) {
                          $("#unit-id"+current_row).append("<option value='" +k+ "'>" +response[k]+ "</option>");
                                     }
                               }      
                         }   
                      }
                
            });
        }


      function changeCheck(){
          var stock_movement_delete = $('#stock-movement-id');
         
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
          
              // console.log(checkid);
	      
	       
	       //return false;
	if(checkids.length > 0){    
	console.log(checkids);   
	$.ajax({
                type:"POST",
                async: true,
                cache: false,
                url: '/stock-movements/getitems',
		        data: { 
					stockmovementid: checkids
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
//			   $(this).closest('tr').remove();
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
  

      function change_warehouse()
		{
			var wh1=$('#from-warehouse-id').val();
			console.log("1234",wh1);
			var wh2=$('#to-warehouse-id').val();
			var new_qty=$('#quantity').val();
			console.log("12345",wh2);
			if(wh1==wh2){
				window.alert("from warehouse and to warehouse cannot be same");
				return false;
			}
// 			if(quantity.value<=0){
// 				window.alert("quantity cannot be zero or less , it should be greater than or equal to 1");
// 				return false;
// 				}
			$('#btn_submit1').click();
			//document.getElementById("myForm").submit();
			
		}
  </script>