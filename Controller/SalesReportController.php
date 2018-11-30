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
            $conditions = array();
           
            //debug(array('id'=>$data['warehouse_id']));
         //debug(empty($data));die();
            if(!empty($data)){
                
                            if(!is_null($data['warehouse_id'])){
                                array_push($conditions, array('SalesOrderItems.warehouse_id'=>$data['warehouse_id']));
                              }
                           if(!is_null($data['item_id'])){
                               array_push($conditions, array('SalesOrderItems.item_id'=>$data['item_id']));
                             }
                             
//                                if(!is_null($data['created_date'])){
//                                     array_push($conditons, array('created_date'=>$data['created_date']));
//                               }
//                                if(!is_null($data['delivary_date'])){
//                                    array_push($conditons, array('delivary_date'=>$data['delivary_date']));
//                                 }
//                debug($conditions);die();

                 $sdfsdf = array(
                     array('table' => 'SalesOrderItems', // Table name
                         'alias' => 'SalesOrderItems',
                         'type' => 'INNER',
                         'conditions' => array(
                             'SalesOrderItems.sales_order_id = SalesOrders.id', // Mention join condition here
                         )
                     )
                 );
                             
                             
                 $sales_orders = $salesOrders_table->find('all')->where($conditions)->contain(['SalesOrderItems', 'SalesOrderItems.Items', 'SalesOrderItems.Units', 'SalesOrderItems.Warehouses']);
               //debug($sales_orders->count());die();
               //debug($conditions);die();
            }else{
                $sales_orders = $salesOrders_table->find('all')->contain(['SalesOrderItems', 'SalesOrderItems.Items', 'SalesOrderItems.Units', 'SalesOrderItems.Warehouses']); 
               debug($sales_orders);die();
            }
           // debug($sales_orders);die();
        $this->set('sales_orders',$sales_orders); 
           }
    }
