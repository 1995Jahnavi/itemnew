<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\SalesReportForm;
use Cake\ORM\TableRegistry;

class SalesReportController extends AppController
{
    public function index()
    {  
            $salesOrders_table = TableRegistry::get('SalesOrders');
            
            $sales_orders = $salesOrders_table->find('all');
            
            $this->set('sales_orders',$sales_orders);                           
            
            $salesOrderItem_table = TableRegistry::get('SalesOrderItems');
            
            $sales_order_items = $salesOrderItem_table->find('all');
            
            $this->set('sales_order_items',$sales_order_items);            
//             $data = array();
            
//             $conditons = array();
//             if(!is_null($data['warehouse'])){            
//                 array_push($conditons, array('warehouse'=>$data['warehouse']));
//             }
            
//             $sales_orders = $salesOrders_table->find('all')->where($conditons);
    }
}