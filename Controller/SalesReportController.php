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
            $options = array();
//             $conditions = array();
           
            //debug(array('id'=>$data['warehouse_id']));
         //debug(empty($data));die();
            if(!empty($data)){

//                             
//                                 if(!is_null($data['created_date'])){
//                                     array_push($conditons, array('created_date'=>$data['created_date']));
//                               }
//                                if(!is_null($data['delivary_date'])){
//                                    array_push($conditons, array('delivary_date'=>$data['delivary_date']));
//                                  }
//                                  if(!is_null($data['warehouse_id'])){
//                                      array_push($conditons, array('warehouse_id'=>$data['warehouse_id']));
//                                  }
//                                  if(!is_null($data['item_id'])){
//                                      array_push($conditons, array('item_id'=>$data['item_id']));
//                                  }
                //debug($conditions);die();
                             
                 // $options['conditions'] = $conditions;            
//                  $sales_orders = $salesOrders_table->find('all')->where($options)->contain(['SalesOrderItems', 'SalesOrderItems.Items', 'SalesOrderItems.Units', 'SalesOrderItems.Warehouses'])->matching('SalesOrderItems', 
//                      function(\Cake\ORM\Query $q) {
//                          $data = $this->request->query();                         
//                          return $q->where(['SalesOrderItems.item_id' => $data['item_id'], 'SalesOrderItems.warehouse_id' => $data['warehouse_id']]);
                        
//                      });

                $conditions = array();
                if(!is_null($data['warehouse_id'])){
                    array_push($conditions, array('warehouse_id'=>$data['warehouse_id']));
                }
                if(!is_null($data['item_id'])){
                    array_push($conditions, array('item_id'=>$data['item_id']));
                }
//                 if(!is_null($data['created_date'])){
//                     array_push($conditions, array('created_date'=>$data['created_date']));
//                 }
//                 if(!is_null($data['delivery_date'])){
//                     array_push($conditions, array('delivary_date'=>$data['delivery_date']));
//                 }
 //               debug($data['delivery_date']);die();
               
                $sales_orders = $salesOrdersItems_table->find('all')->where($conditions)->contain(['Items', 'Warehouses','SalesOrders']);
                        
//                 debug($sales_orders->first());die();
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
