<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\SalesReportForm;
use Cake\ORM\TableRegistry;

class SalesReportController extends AppController
{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
    }
    
    public function index()
    {  
       
//         debug($this->request);die();
            $salesOrders_table = TableRegistry::get('SalesOrders');
            
            $salesOrdersItems_table = TableRegistry::get('SalesOrderItems');
           // $sales_orders = $salesOrders_table->find('all');
//             debug($sales_orders->first());die();
            
          $sales_orders = $salesOrders_table->find('all')->contain(['SalesOrderItems', 'SalesOrderItems.Items', 'SalesOrderItems.Units', 'SalesOrderItems.Warehouses']);

            $warehouse_table = TableRegistry::get('Warehouses');
            $warehouse =$warehouse_table->find('list');
            $this->set('warehouses',$warehouse);
            
            $items_table = TableRegistry::get('Items');
            $item =$items_table->find('list');
            $this->set('items',$item);
            
            
            $data = $this->request->query();
          //  $options = array();
//             $conditions = array();
           
            //debug(array('id'=>$data['warehouse_id']));
         //debug(empty($data));die();
            if(!empty($data)){

//                             

                $conditions = array();
                if(!is_null($data['warehouse_id'])){
                    array_push($conditions, array('warehouse_id'=>$data['warehouse_id']));
                }
                if(!is_null($data['item_id'])){
                    array_push($conditions, array('item_id'=>$data['item_id']));
                }
//                if(!is_null($data['created_date'])){
//                      array_push($conditions, array('created_date'=>$data['created_date']));
//                }
//                  if(!is_null($data['delivery_date'])){
//                      array_push($conditions, array('delivary_date'=>$data['delivery_date']));
//                  }
              
//             debug($data['created_date']);
//             debug($data['delivery_date']);
//             debug($data['warehouse_id']);
//             debug($data['item_id']);
//             die();
               
         //      $sales_orders = $salesOrdersItems_table->find('all')->where($conditions)->contain(['Items', 'Warehouses','Units','SalesOrders']);
        
            //    debug($sales_orders);die();
            
 $sales_orders = $salesOrdersItems_table->find('all',array('fields'=> array('so.id','so.created_date','so.delivary_date','warehouse_id','item_id','quantity','rate','Warehouses.name','Items.item_name')))->join([
 'so'=>[
    'table' => 'sales_orders',
    'type' => 'INNER',
    'conditions' => 'SalesOrderItems.sales_order_id = so.id'
    ]])->contain(['Items', 'Units', 'Warehouses'])->where($conditions);

// debug($conditions);die();
//   debug($sales_orders = $salesOrdersItems_table);die();
//debug($sales_orders = $salesOrdersItems_table->find('all',array('fields'=> array('so.id','so.created_date','so.delivary_date'))));die();
//     debug($sales_orders = $salesOrdersItems_table->find('all',array('fields'=> array('so.id','so.created_date','so.delivary_date','warehouse_id','item_id','quantity','rate','Warehouses.name','Items.item_name')))->join([
//         'so'=>[
//             'table' => 'sales_orders',
//             'type' => 'INNER',
//             'conditions' => 'SalesOrderItems.sales_order_id = so.id'
//         ]])->contain(['Items', 'Units', 'Warehouses'])->where($conditions));die();          

    
  

//                 $pos = $poi_table->find('all', array('fields' => array('po.id', 'po.transaction_date', 'po.required_date', 'warehouse_id', 'item_id', 'quantity', 'rate', 'Items.item_name', 'Warehouses.name')))->join([
//                     'po' => [
//                         'table' => 'purchase_orders',
//                         'type' => 'INNER',
//                         'conditions' => 'PurchaseOrderItems.purchase_order_id = po.id'
//                     ]])->contain(['Items', 'Units', 'Warehouses'])->where($conditions);
//                     debug($pos->first());die();
                        
          
 //   debug($sales_orders);die();
                // debug($query);die();
                 //debug($data);die();
               //debug($conditions);die();

               // debug($sales_orders->sql());die();

    
            }else{
                $sales_orders = $salesOrders_table->find('all')->contain(['SalesOrderItems', 'SalesOrderItems.Items', 'SalesOrderItems.Units', 'SalesOrderItems.Warehouses']); 
               //debug($sales_orders);die();
            }
           // debug($sales_orders);die();
        $this->set('sales_orders',$sales_orders); 
           }
    }
