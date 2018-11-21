<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * SalesOrders Controller
 *
 * @property \App\Model\Table\SalesOrdersTable $SalesOrders
 *
 * @method \App\Model\Entity\SalesOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesOrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   $this->paginate['order'] = ['id' => 'DESC'];
        $salesOrders = $this->paginate($this->SalesOrders);
        
		foreach($salesOrders as $salesOrder){
			        //debug($salesOrder->customer_id);die();

		        $customers = TableRegistry::get('Customers');
		        $salesOrder->salesOrder_id=$salesOrder->id;
               $salesOrder->customer_name=$customers->get($salesOrder->customer_id)->name;
				
		} 
	
	  $this->set(compact('salesOrders'));
    
    }
    /**
     * View method
     *
     * @param string|null $id Sales Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesOrder = $this->SalesOrders->get($id, [
            'contain' => ['SalesOrderItems']
        ]);
		
		$customers = TableRegistry::get('Customers');
		        $salesOrder->salesOrder_id=$salesOrder->id;
               $salesOrder->customer_name=$customers->get($salesOrder->customer_id)->name;
			   
		foreach ($salesOrder->sales_order_items as $salesOrderItems)
		{
			     $items = TableRegistry::get('Items');
                 $salesOrderItems->salesOrder_id=$salesOrder->id;
                 $salesOrderItems->item_name=$items->get($salesOrderItems->item_id)->item_name;
                
                 $units = TableRegistry::get('Units');
                 $salesOrderItems->salesOrder_id=$salesOrder->id;
                 $salesOrderItems->unit_name=$units->get($salesOrderItems->unit_id)->unit_name;
				 
				 $warehouses = TableRegistry::get('Warehouses');
                 $salesOrderItems->salesOrder_id=$salesOrder->id;
                 $salesOrderItems->warehouse_name=$warehouses->get($salesOrderItems->warehouse_id)->name;
		}
        $this->set('salesOrder', $salesOrder);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();         
        $salesOrder = $this->SalesOrders->newEntity();
        
        if ($this->request->is('post')) {
            $salesOrder = $this->SalesOrders->patchEntity($salesOrder, $this->request->getData());
            if ($this->SalesOrders->save($salesOrder)) {
               
                $soi = TableRegistry::get('SalesOrderItems');
                $i = 0;
                foreach($data['items'] as $item)
                {
                    $salesOrderitem = $soi->newEntity();
                    $salesOrderitem->sales_order_id= $salesOrder->id;
                    $salesOrderitem->item_id= $item;
                    $salesOrderitem->unit_id= $data['units'][$i];
                    $salesOrderitem->quantity= $data['qty'][$i];
                    $salesOrderitem->warehouse_id= $data['warehouses'][$i];
                    $salesOrderitem->rate= $data['rte'][$i];
                    //$salesOrderitem->amount= $data['amt'][$i];
                    $soi->save($salesOrderitem);
                    $i++;
                }
                
                $this->Flash->success(__('The sales order has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $units = TableRegistry::get('Units');
            $this->set('units',$units->find('list'));
            
            $items_table = TableRegistry::get('Items');
            $this->set('items',$items_table->find('list'));
            
            $warehouse_table = TableRegistry::get('Warehouses');
            $this->set('warehouses',$warehouse_table->find('list'));
            
            $this->Flash->error(__('The sales order could not be saved. Please, try again.'));
        }
        else if($this->request->is('get')){
            
            $units_table = TableRegistry::get('Units');
            $this->set('units',$units_table->find('list'));
            
            $items_table = TableRegistry::get('Items');
            $this->set('items',$items_table->find('list'));
            
            $warehouse_table = TableRegistry::get('Warehouses');
            $this->set('warehouses',$warehouse_table->find('list'));
        }
		$customers = $this->SalesOrders->Customers->find('list', ['limit' => 200]);
        $this->set(compact('salesOrder','customers'));
    
    }
    /**
     * Edit method
     *
     * @param string|null $id Sales Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->request->getData();
        $salesOrder = $this->SalesOrders->get($id, [
            'contain' => ['SalesOrderItems']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			//debug($data);
            $salesOrder = $this->SalesOrders->patchEntity($salesOrder, $this->request->getData());
            if ($this->SalesOrders->save($salesOrder)) {
                $soi_table = TableRegistry::get('SalesOrderItems');
				
                $i = 0;
                foreach($data['items'] as $item)
                {
                    $soitem = $soi_table->find('all')->where(['item_id'=>$item, 'sales_order_id'=>$id])->first();
					//debug($soitem);
                    if(!is_null($soitem)){
                        $soitem->item_id= $item;
                        $soitem->unit_id= $data['units'][$i];
                        $soitem->quantity= $data['qty'][$i];
                        $soitem->warehouse_id= $data['warehouses'][$i];
                        $soitem->rate= $data['rte'][$i];
                       // $soitem->amount= $data['amt'][$i];
                        $status = $soi_table->save($soitem);
						//debug($status);//die();    
                    }else{
						//debug("in else");
                        $salesOrderitem = $soi_table->newEntity();
                        $salesOrderitem->sales_order_id= $id;
                        $salesOrderitem->item_id= $item;
                        $salesOrderitem->unit_id= $data['units'][$i];
                        $salesOrderitem->quantity= $data['qty'][$i];
                        $salesOrderitem->warehouse= $data['warehouses'][$i];
                        $salesOrderitem->rate= $data['rte'][$i];
                        //$salesOrderitem->amount= 0; //$data['amt'][$i];
						//debug($salesOrderitem);
                         //$status = 
						 $soi_table->save($salesOrderitem);
						//debug($status);
						//debug("fffffffffffff ".$salesOrderitem->getErrors());die();                        
                         $i++;
					}
                   
                }
				//die();
                $this->Flash->success(__('The sales order has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
				$units = TableRegistry::get('Units');
				$this->set('units',$units->find('list'));
				
			    $items_table = TableRegistry::get('Items');
			    $this->set('items',$items_table->find('list'));
				
			    $warehouse_table = TableRegistry::get('Warehouses');
			    $this->set('warehouses',$warehouse_table->find('list'));
				$this->Flash->error(__('The sales order could not be saved. Please, try again.'));
			
        }else if($this->request->is('get')){
           // debug($salesOrder);die();
            $units_table = TableRegistry::get('Units');
            $this->set('units',$units_table->find('list'));
            
            $items_table = TableRegistry::get('Items');
            $this->set('items',$items_table->find('list'));
            
            $warehouse_table = TableRegistry::get('Warehouses');
            $this->set('warehouses',$warehouse_table->find('list'));
            
     }
		$customers = $this->SalesOrders->Customers->find('list', ['limit' => 200]);
        $this->set(compact('salesOrder','customers'));
 
//$this->set(compact('salesOrder'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Sales Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesOrder = $this->SalesOrders->get($id);
        if ($this->SalesOrders->delete($salesOrder)) {
            $this->Flash->success(__('The sales order has been deleted.'));
        } else {
            $this->Flash->error(__('The sales order could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
public function getunits()
{
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');
    $this->autoRender = false ;
    //  debug($itemid);die();
    $itemid = $this->request->query();
    
    $items_table = TableRegistry::get('Items');
    $item = $items_table->get($itemid['itemid']);
    $units_table = TableRegistry::get('Units');
    
    //         $units = $units_table->find('all',['id IN'=>[$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
    $units = $units_table->find('list')->where(['id IN' => [$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
    
    $this->RequestHandler->renderAs($this, 'json');
    
    $resultJ = json_encode($units);
    $this->response->type('json');
    $this->response->body($resultJ);
    return $this->response;
    
    //    return json_encode($units);
}
public function getitems()
{
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');
    $this->autoRender = false ;
    $array = $this->request->data();
    //     debug($array);die();
    //$id= $this->StockMovements->get($id);
    $ids=$array['salesorderid'];
    //debug($arrays['id']);die();
    
    
    $this->set('ids', $ids);
    $salesOrderItems_table = TableRegistry::get('SalesOrderItems');
    foreach ($ids as $id){
        $soitem = $salesOrderItems_table->get($id);
        $salesOrderItems_table->delete($soitem);
    }
    
    
    $this->RequestHandler->renderAs($this, 'json');
    
    $resultJ = json_encode($soitem);
    $this->response->type('json');
    $this->response->body($resultJ);
    return $this->response;
}
}