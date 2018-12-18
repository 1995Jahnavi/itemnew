<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Stmt\Foreach_;
use Setasign\Fpdf;

/**
 * SalesOrders Controller
 *
 * @property \App\Model\Table\SalesOrdersTable $SalesOrders
 *
 * @method \App\Model\Entity\SalesOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesOrdersController extends AppController
{
    
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   $this->paginate['order'] = ['id' => 'DESC'];
        $salesOrders =$this->paginate($this->SalesOrders);
        
		foreach($salesOrders as $salesOrder){
			        //debug($salesOrder->customer_id);die();

		       $customers = TableRegistry::get('Customers');
		       $salesOrder->salesOrder_id=$salesOrder->id;
               $salesOrder->customer_name=$customers->get($salesOrder->customer_id)->name;
				
		} 
	
	  $this->set(compact('salesOrders'));
	  $this->set('_serialize', ['salesOrders']); 
    
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
        $this->set('_serialize', ['salesOrder']); 
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData(); 
       // debug($data);die();
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
                   $status = $soi->save($salesOrderitem);
				   if($status)
				   {
					    $st_table = TableRegistry::get('StockTransactions');
					    $st = $st_table->newEntity();
                        $st->item_id= $item;
                        $st->unit_id= $data['units'][$i];
                        $st->quantity= $data['qty'][$i];
                        $st->warehouse_id= $data['warehouses'][$i];
                        $st->rate= $data['rte'][$i];
						$st->type=1;
						$st->referenceid=$salesOrder->id;
						$st->transaction_date=$salesOrder->created_date;
						//$st->balance=$st->balance;
						$st_table->save($st);					
				         $i++;
                   }
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
       // debug($salesOrder);die();
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $salesOrder = $this->SalesOrders->patchEntity($salesOrder, $this->request->getData());
            if ($this->SalesOrders->save($salesOrder)) {
                $soi_table = TableRegistry::get('SalesOrderItems');
                $st_table = TableRegistry::get('StockTransactions');
                $i = 0;
                foreach($data['items'] as $item)
                {
                    $soitem = $soi_table->find('all')->where(['item_id'=>$item, 'sales_order_id'=>$id])->first();
                    //debug($soitem);die();
                    if(!is_null($soitem)){
                        $soitem->item_id= $item;
                        $soitem->unit_id= $data['units'][$i];
                        $soitem->quantity= $data['qty'][$i];
                        $soitem->warehouse_id= $data['warehouses'][$i];
                        $soitem->rate= $data['rte'][$i];
                        $status = $soi_table->save($soitem);
                        
                     // debug($status); die();
                     if($status)
                     {  
                         //debug($status); die();
                        $stitem = $st_table->find('all')->where(['item_id'=>$item,'referenceid'=>$id])->first();
                        //debug($stitem); die();
                        $stitem->item_id= $item;
                        //debug($stitem); die();
                        $stitem->unit_id= $data['units'][$i];
                        $stitem->quantity= $data['qty'][$i];
                        $stitem->warehouse_id= $data['warehouses'][$i];
                       //debug($stitem); die();
                        $stitem->rate= $data['rte'][$i];
                        $stitem->type=1;
                        //debug($stitem);die();
                        $stitem->referenceid=$salesOrder->id;
                        $stitem->transaction_date=$salesOrder->created_date;
                        $status= $st_table->save($stitem);
                        
                       //debug($status); die();
                    }
                    }
                    
               else{
                        debug("in else");
                        $salesOrderitem = $soi_table->newEntity();
                        $salesOrderitem->sales_order_id= $id;
                        $salesOrderitem->item_id= $item;
                      //  debug($salesOrderitem);die();
                        $salesOrderitem->unit_id= $data['units'][$i];
                        $salesOrderitem->quantity= $data['qty'][$i];
                        $salesOrderitem->warehouse_id= $data['warehouses'][$i];
                        $salesOrderitem->rate= $data['rte'][$i];
                        //debug($salesOrderitem);die();
                        $status=$soi_table->save($salesOrderitem);   
                       // debug($status); die();
                        if($status)
                        {
                           // debug("in if");
                            //$st_table = TableRegistry::get('StockTransactions');
                            $st = $st_table->newEntity();
                            $st->item_id= $item;
                            //debug($st); die();
                            $st->unit_id= $data['units'][$i];
                            //debug($st); die();
                            $st->quantity= $data['qty'][$i];
                            $st->warehouse_id= $data['warehouses'][$i];
                            $st->rate= $data['rte'][$i];
                            $st->type=1;
                            //debug($st); die();
                            $st->referenceid=$salesOrder->id;
                            $st->transaction_date=$salesOrder->created_date;
                            $status=$st_table->save($st);
                            //debug($status); 
                           
                            //die();
                        }
               }
                  
                 
                  $i++;
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
			
        } else if($this->request->is('get')){
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
    }
//$this->set(compact('salesOrder'));
    
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
        
        try {
            $this->SalesOrders->delete($salesOrder);
        }
        catch (\PDOException $e) {
            $error = 'The sales order  you are trying to delete is associated with other records';
            // The exact error message is $e->getMessage();
            $this->set('error', $e);
            $this->Flash->error(__('The sales order  could not be deleted. Please, try again.'));
        }
//         if ($this->SalesOrders->delete($salesOrder)) {
//             $this->Flash->success(__('The sales order has been deleted.'));
//         } else {
//             $this->Flash->error(__('The sales order could not be deleted. Please, try again.'));
//         }
        return $this->redirect(['action' => 'index']);
    }
public function getunits()
{
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');
    $this->autoRender = false ;
     // debug($itemid);die();
    $itemid = $this->request->query();
    
    //debug($itemid);die();
    
    $items_table = TableRegistry::get('Items');
    $item = $items_table->get($itemid['itemid']);
    $units_table = TableRegistry::get('Units');
    
    //         $units = $units_table->find('all',['id IN'=>[$item->purchase_unit, $item->sell_unit, $item->usage_unit]]);
    $units = $units_table->find('list')->where(['id IN' => [$item->purchase_unit, $item->sell_unit]]);
    
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
  // debug($array);die();    //$id= $this->StockMovements->get($id);
   
    $ids=$array['sales_order_item_id'];
    $this->set('ids', $ids);
    debug($ids);die();
    $salesOrderItems_table = TableRegistry::get('SalesOrderItems');
    
    $status = true;
    foreach ($ids as $id){
       $soitem = $salesOrderItems_table->get($id);
       $status = $salesOrderItems_table->delete($soitem);
       if($status){
          $stockTransactions_table = TableRegistry::get('StockTransactions');
          $stoct_transaction = $stockTransactions_table->find('all')->where(['item_id'=>$soitem->item_id, 'referenceid'=>$soitem->sales_order_id])->first();
          $status = $stockTransactions_table->delete($stoct_transaction);
          if($status){
              $status = true;
          }else{
              $status = false;
              break;
          }
       }else{
           $status = false;
           break;
       }
    }
    $this->Flash->success(__('The sales order has been deleted.'));
    
    $this->RequestHandler->renderAs($this, 'json');
        
    $this->response->type('json');
    $this->response->body($status);
    return $this->response;
}


public function generatepdf()
{
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');
    $this->autoRender = false ;
    $id = $this->request->query()['id'];
    $salesOrders_table = TableRegistry::get('SalesOrders');
    $so = $salesOrders_table->get($id, [
        'contain' => ['SalesOrderItems']
    ]);
  
    $width_cell=array(20,35,30,25,20,30,35);
    $width_cell1=array(50,200);
     $pdf = new \FPDF();
     $pdf->AddPage();
     
    // $pdf->Cell(40,10,'Sales Order report',0,2,'zzzzzzz');
     $customers = TableRegistry::get('Customers');
     $custmrs = $customers->get($so->customer_id);
     $so->customer_name = $custmrs->name;
     
     $pdf->SetFont('Arial','B',14);
     
     $pdf->Cell($width_cell1[0],10,'Customer Name:',0,0,'C',false);
     $pdf->Cell($width_cell1[1],10,$so->customer_name,0,1,'C',false);
     
     $pdf->Cell($width_cell1[0],10,' Created date:',0,0,'C',false);
     $pdf->Cell($width_cell1[1],10,$so->created_date,0,1,'C',false);
     
     $pdf->Cell($width_cell1[0],10,'Delivery date:',0,0,'C',false);
     $pdf->Cell($width_cell1[1],10,$so->delivery_date,0,1,'C',false); 
     $pdf->Ln();
     $pdf->SetFont('Arial','B',20);
     $pdf->Cell(120,10,'Related Sales Order Items',0,1,'R');
     $pdf->Ln();
     $pdf->SetFont('Arial','B',15);
     $pdf->Cell($width_cell[0],10,'Id',1,0,'C',false); // First column of row 1
     $pdf->Cell($width_cell[1],10,'Item',1,0,'C',false); // First column of row 1
     $pdf->Cell($width_cell[2],10,'Unit',1,0,'C',false);
     $pdf->Cell($width_cell[6],10,'Warehouse',1,0,'C',false); // First column of row 1 // First column of row 1
     $pdf->Cell($width_cell[3],10,'Quantity',1,0,'C',false); // First column of row 1
     $pdf->Cell($width_cell[4],10,'Rate',1,0,'C',false); // First column of row 1
     $pdf->Cell($width_cell[5],10,'Amount',1,1,'C',false); // First column of row 1
     
     

     $width_cell1=array(20,35,30,25,20,30,35);    
     $i=0;
     foreach ($so->sales_order_items as $salesOrderItem)
     {
       
         $items = TableRegistry::get('Items');
         $salesOrderItem->salesOrder_id=$so->id;
         $salesOrderItem->item_name=$items->get($salesOrderItem->item_id)->item_name;
         
         $units = TableRegistry::get('Units');
         $salesOrderItem->salesOrder_id=$so->id;
         $salesOrderItem->unit_name=$units->get($salesOrderItem->unit_id)->unit_name;
         
         $warehouses = TableRegistry::get('Warehouses');
         $salesOrderItem->salesOrder_id=$so->id;
         $salesOrderItem->warehouse_name=$warehouses->get($salesOrderItem->warehouse_id)->name;
         // debug($salesOrderItem);die();
         $amount = $salesOrderItem->quantity * $salesOrderItem->rate;
         // debug($salesOrderItem->quantity);debug($salesOrderItem->rate);die();
         $pdf->SetFont('Arial','B',14);
         $pdf->Cell($width_cell1[0],10,$salesOrderItem->id,1,0,'C',false); // First column of row 1
         $pdf->Cell($width_cell1[1],10,$salesOrderItem->item_name,1,0,'C',false);
         $pdf->Cell($width_cell1[2],10,$salesOrderItem->unit_name,1,0,'C',false);
         $pdf->Cell($width_cell1[6],10,$salesOrderItem->warehouse_name,1,0,'C',false);
         $pdf->Cell($width_cell1[3],10,$salesOrderItem->quantity,1,0,'C',false);
         $pdf->Cell($width_cell1[4],10,$salesOrderItem->rate,1,0,'C',false);
         $pdf->Cell($width_cell1[5],10,$amount,1,1,'C',false);
         $i++;         
     }
     $pdf->Output();
     
    
   $this->RequestHandler->renderAs($this, 'pdf');
    
//     $resultJ = json_encode($soitem);
//     $this->response->type('json');
//     $this->response->body($resultJ);
//     return $this->response;

//      $this->render('pdf');
}
}