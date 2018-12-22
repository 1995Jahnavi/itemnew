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
        $salesOrdersItems_table = TableRegistry::get('SalesOrderItems');
        
        //debug($sales_orders);die();
        $warehouse_table = TableRegistry::get('Warehouses');
        $warehouses = $warehouse_table->find('list');
        $this->set('warehouses', $warehouses);
        
        $items_table = TableRegistry::get('Items');
        $item = $items_table->find('list');
        $this->set('items', $item);
        
        $data = $this->request->query();
        //debug($data);die();
        $sales_orders = $salesOrdersItems_table->find('all', array(
            'fields' => array(
                'so.id',
                'so.created_date',
                'so.delivary_date',
                'warehouse_id',
                'item_id',
                'quantity',
                'rate',
                'Warehouses.name',
                'Items.item_name'
            )
        ))
        ->join([
            'so' => [
                'table' => 'sales_orders',
                'type' => 'INNER',
                'conditions' => 'SalesOrderItems.sales_order_id = so.id'
            ]
        ])
        ->contain([
            'Items',
            'Units',
            'Warehouses'
        ]);
        
        
        if (!empty($data)) {
            
            $conditions = array();
            if (isset($data['warehouse_id']) && !is_null($data['warehouse_id'])) {
                array_push($conditions, array(
                    'warehouse_id' => $data['warehouse_id']
                ));
            }
            
            if (isset($data['item_id']) && !is_null($data['item_id'])) {
                array_push($conditions, array(
                    'item_id' => $data['item_id']
                ));
            }
            
            if (isset($data['created_date']) && !is_null($data['created_date'])) {
                array_push($conditions, array(
                    'created_date >=' => $data['created_date']
                ));
            }
            
            
            if (isset($data['delivary_date']) && !is_null($data['delivary_date'])) {
                array_push($conditions, array(
                    'delivary_date <=' => $data['delivary_date']
                ));
            }
            // debug(($data['delivary_date']));die();
            
            if (!empty($conditions)) {
                $sales_orders = $sales_orders->where($conditions);
            }
            
        }
//         $this->set('sales_orders',$sales_orders);
      //  $query_date = '2018-11-04';
        
        $from_date=date('Y-m-01'); 
        $to_date= date('Y-m-t');
        
        $this->set('from_date',$from_date);
        $this->set('to_date',$to_date);
        
        //         debug($warehouses);die();
        if(empty($data)){
            $data["warehouse_id"] = "";//$warehouses->first();
            $data["created_date"] = $from_date;
            $data["delivary_date"] = $to_date;
            $data["item_id"] = "";//$item;
        }
//         debug($data);die();
    
        $this->response->header('Access-Control-Allow-Origin', '*');
        
        $results = array();
        $results["sales_orders"] = $sales_orders;
        $results["data"] = $data;
              //  debug($warehouses);die();
        
        $results["warehouses"] = $warehouses;
        $results["items"] = $item;
        $this->set('results', $results);
        $this->set('_serialize', ['results']);
      
    }
      
    
    public function stocks()
    {
        $stockTransactions_table = TableRegistry::get('StockTransactions');
        
        $warehouse_table = TableRegistry::get('Warehouses');
        $warehouse = $warehouse_table->find('all',array('order' => array('Warehouses.name' => 'ASC')));
        //,array('order' => array('Warehouses.name' => 'ASC'))
        $this->set('warehouses', $warehouse);
        
        //,array('order' => array('Warehouses.name' => 'ASC'))
        $items_table = TableRegistry::get('Items');
        $item = $items_table->find('all',array('order' => array('Items.item_name' => 'ASC')));
        $this->set('items', $item);
        
        $units_table = TableRegistry::get('Units');
        $unit = $units_table->find('list');
        $this->set('units', $unit);
        
        $sales_table = TableRegistry::get('SalesOrders');
        $sales = $sales_table->find('list');
        $this->set('salesOrders', $sales);
        
        $data = $this->request->query();
        
        if (!empty($data)) {
            
            $conditions = array();
            if (isset($data['warehouse_id']) && !is_null($data['warehouse_id'])) {
                array_push($conditions, array(
                    'warehouse_id' => $data['warehouse_id']
                ));
            }
           // debug($data['warehouse_id']);die();
            
            if (isset($data['item_id']) && !is_null($data['item_id'])) {
                array_push($conditions, array(
                    'item_id' => $data['item_id']
                ));
            }
            
            if (isset($data['created_date']) && !is_null($data['created_date'])) {
                array_push($conditions, array(
                    'transaction_date >=' => $data['created_date']
                ));
            }
            
//           //  debug($data['$sales->created_date']);die();
            
            if (isset($data['delivary_date']) && !is_null($data['delivary_date'])) {
                array_push($conditions, array(
                    'transaction_date <=' => $data['delivary_date']
                ));
            }
            
//           
            
            if(!empty($conditions))
            {
                $stock_transactions = $stockTransactions_table->find('all',array('id','warehouse_id','items_id','unit_id','type',
                    'transaction_date','quantity','balance','Items.item_name','Warehouses.name','Units.unit_name',
                    'order'=>'transaction_date ASC'))->contain(['Items','Warehouses','Units'])->where($conditions);
            }
            
            else{
                $stock_transactions = $stockTransactions_table->find('all');
            }
         }
       
        
            $item_array=array();
           
            foreach($stock_transactions as $stock_transaction)
            {
                $item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id]=0;
            }
            
            //debug("2222222222222222",$item_array);die();
            
            foreach($stock_transactions as $stock_transaction)
                
            {
               // debug("3333222222222",$stock_transaction);die();
                
                if($stock_transaction->type==1)
                {
                    
                    $stock_transaction->transaction_date=date("d-m-Y", strtotime($stock_transaction->transaction_date));
                    
                    $st_item =$items_table->get($stock_transaction->item_id);
                    if($stock_transaction->unit_id==$st_item->purchase_unit)
                    {
                        $stock_transaction->quantity *= $st_item->sell_unit_qty;
                        $item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id] -= $stock_transaction->quantity;
                        $stock_transaction->balance=$item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id];  
                    }
                    else{
                        $item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id] -= $stock_transaction->quantity;
                        $stock_transaction->balance=$item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id]; 
                    }
                    
                }
  
                
                if($stock_transaction->type==2)
                {
                    
                    $stock_transaction->transaction_date=date("d-m-Y", strtotime($stock_transaction->transaction_date));
                    
                    $st_item =$items_table->get($stock_transaction->item_id);
                    if($stock_transaction->unit_id==$st_item->purchase_unit)
                    {
                        $stock_transaction->quantity *= $st_item->sell_unit_qty;
                        $item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id] += $stock_transaction->quantity;
                        $stock_transaction->balance=$item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id];
                    }
                    else{
                        $item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id] += $stock_transaction->quantity;
                        $stock_transaction->balance=$item_array[$stock_transaction->item_id.$stock_transaction->warehouse_id];
                    }
                    
                }
                    
            }
            
            

//        debug($item);die();


        $this->response->header('Access-Control-Allow-Origin', '*');
        
        $results = array();
        $results["stock_transactions"]=$stock_transactions;
        $results["warehouses"]=$warehouse;
        $results["items"]=$item;
        $results["units"]=$unit;
        $this->set('results', $results);
        $this->set('_serialize',['results']);
        
        
    }
   
}


