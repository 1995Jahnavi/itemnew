<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockMovement $stockMovement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stockMovement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stockMovement->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stock Movements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockMovements form large-9 medium-8 columns content">
    <?= $this->Form->create($stockMovement) ?>
    <fieldset>
        <legend><?= __('Edit Stock Movement') ?></legend>
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
    <?php
    $index = 1;    
    foreach($stockMovement->stock_movement_items as $stockMovementItem)
   {
    //$itemid = 'item_id';
   // $unitid = 'unit_id';    
   // if($index > 1){
       $itemid ='item_id'.$index;
       $unitid = 'unit_id'.$index;
       $quantity = 'quantity_id'.$index;
   // }
    ?>
    <tr> 
    <td><?php echo $this->Form->input('checkbox', array('type'=>'checkbox','name'=>'chk[]','id'=>$stockMovementItem->id)); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'default'=>$stockMovementItem->item_id, 'name'=>'items[]', 'id'=>$itemid,'onchange'=>'change(this.id)','disabled'=>true)); ?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'hidden','options'=>$items, 'default'=>$stockMovementItem->item_id, 'name'=>'items[]', 'id'=>$itemid,'onchange'=>'change(this.id)')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('type'=>'number','name'=>'qty[]','id'=>$quantity,'required' => true,'default'=>$stockMovementItem->quantity ,'min'=>'.01', 'max'=>'9999999999.99','step'=>'.01')); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units,'default'=>$stockMovementItem->unit_id, 'name'=>'units[]','id'=>$unitid)); ?></td>
    
    </tr>
    <?php
    $index++;
    }
    ?>
    
    <input type="button" onclick="add_row()" value="Add row" >
    <input type="button" id="delsmbutton" value="Delete" onclick="changeCheck()"> 
   
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
 <script src="/js/jquery-3.3.1.min.js"></script>
  <?php echo $this->Html->script('stock_movements.js'); ?>
  
 <script>
    function do_onload(){
    console.log('afasfasf111111');
    var item_select_box = document.getElementById('item_id');
    console.log(item_select_box); 
    var smCount = $('#stockMovementsTable tr').length;
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
    var table = document.getElementById("stockMovementsTable");
    var smCount = $('#stockMovementsTable tr').length;
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
    <td><select name ="items[]"  onchange="change(this.id)" id=item_id'+(no_of_rows+1)+'>'+item_options+'</select></td> \
    <td></td> \
    <td><input type="number" name ="qty[]" id=quantity_id'+(no_of_rows+1)+' required="true"  min=".01" max="9999999999.99" step=".01"></td> \
    <td><select name ="units[]" id=unit_id'+(no_of_rows+1)+'>'+unit_options+'</select></td> \
    </tr>';
    
    var item_select_box = document.getElementById('item_id'+(no_of_rows+1));
    change(item_select_box.id);
}


</script>