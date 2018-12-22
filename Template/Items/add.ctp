 <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="items form large-9 medium-8 columns content">
    <?= $this->Form->create($item,   array('id' => 'myForm')) ?>
    <fieldset>
        <legend><?= __('Add Item') ?></legend>
        <?php
            echo $this->Form->control('item_name');
	        echo $this->Form->input('purchase_unit',array('type'=>'select','options'=>$units));
	        echo $this->Form->control('sell_unit_qty',array('type'=>'number','min'=>'1', 'max'=>'9999999999','value'=>'1'));
            echo $this->Form->control('sell_unit',array('type'=>'select','options'=>$units));
            echo $this->Form->control('usage_unit_qty',array('type'=>'number','min'=>'1', 'max'=>'9999999999','value'=>'1'));
            echo $this->Form->control('usage_unit',array('type'=>'select','options'=>$units));
            echo $this->Form->control('item_group_id',array('type'=>'select','options'=>$itemgroups));

        ?>
       </fieldset>
      <?php ?>
      <input id="btnSubmit" name="btnSubmit" type="button" value="Submit" onclick="validateForm();" />
    
  
</div>

<script>
function validateForm() {
    var sell_unit_qty = document.getElementById('sell-unit-qty');
    var usage_unit_qty = document.getElementById('usage-unit-qty');
    var purchase_unit = document.getElementById('purchase-unit');
    var usage_unit = document.getElementById('usage-unit');
    var sell_unit = document.getElementById('sell-unit');
    
    
            if(sell_unit_qty.value ==""||sell_unit_qty.value <=0){
                window.alert('enter selling unit quantity greater than or equal to one');
                sell_unit_qty.focus(); 
                return false;
               }  
            
            if(usage_unit_qty.value ==""||usage_unit_qty.value <=0){
            window.alert('enter usage unit quantity greater than or equal to one');
            usage_unit_qty.focus(); 
            return false;
           }  
    
            if(purchase_unit.value==usage_unit.value){
                window.alert('purchase unit quantity should not be same as usage unit quantity');
                usage_unit.focus(); 
                return false;
            }
            if(sell_unit.value==usage_unit.value){
                window.alert('sell unit quantity should not be same as usage unit quantity');
                usage_unit.focus(); 
                return false;
            }
        
    document.getElementById("myForm").submit();    
}
</script>