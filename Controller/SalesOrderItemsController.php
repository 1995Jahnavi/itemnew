<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SalesOrderItems Controller
 *
 * @property \App\Model\Table\SalesOrderItemsTable $SalesOrderItems
 *
 * @method \App\Model\Entity\SalesOrderItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesOrderItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SalesOrders', 'Items', 'Units', 'Warehouses']
        ];
        $salesOrderItems = $this->paginate($this->SalesOrderItems);

        $this->set(compact('salesOrderItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Sales Order Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $salesOrderItem = $this->SalesOrderItems->get($id, [
            'contain' => ['SalesOrders', 'Items', 'Units', 'Warehouses']
        ]);

        $this->set('salesOrderItem', $salesOrderItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $salesOrderItem = $this->SalesOrderItems->newEntity();
        if ($this->request->is('post')) {
            $salesOrderItem = $this->SalesOrderItems->patchEntity($salesOrderItem, $this->request->getData());
            if ($this->SalesOrderItems->save($salesOrderItem)) {
                $this->Flash->success(__('The sales order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales order item could not be saved. Please, try again.'));
        }
        $salesOrders = $this->SalesOrderItems->SalesOrders->find('list', ['limit' => 200]);
        $items = $this->SalesOrderItems->Items->find('list', ['limit' => 200]);
        $units = $this->SalesOrderItems->Units->find('list', ['limit' => 200]);
        $warehouses = $this->SalesOrderItems->Warehouses->find('list', ['limit' => 200]);
        $this->set(compact('salesOrderItem', 'salesOrders', 'items', 'units', 'warehouses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sales Order Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $salesOrderItem = $this->SalesOrderItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $salesOrderItem = $this->SalesOrderItems->patchEntity($salesOrderItem, $this->request->getData());
            if ($this->SalesOrderItems->save($salesOrderItem)) {
                $this->Flash->success(__('The sales order item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sales order item could not be saved. Please, try again.'));
        }
        $salesOrders = $this->SalesOrderItems->SalesOrders->find('list', ['limit' => 200]);
        $items = $this->SalesOrderItems->Items->find('list', ['limit' => 200]);
        $units = $this->SalesOrderItems->Units->find('list', ['limit' => 200]);
        $warehouses = $this->SalesOrderItems->Warehouses->find('list', ['limit' => 200]);
        $this->set(compact('salesOrderItem', 'salesOrders', 'items', 'units', 'warehouses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sales Order Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $salesOrderItem = $this->SalesOrderItems->get($id);
        if ($this->SalesOrderItems->delete($salesOrderItem)) {
            $this->Flash->success(__('The sales order item has been deleted.'));
        } else {
            $this->Flash->error(__('The sales order item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
