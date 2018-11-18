<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * StockMovementItems Controller
 *
 * @property \App\Model\Table\StockMovementItemsTable $StockMovementItems
 *
 * @method \App\Model\Entity\StockMovementItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StockMovementItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Items', 'StockMovements', 'Units']
        ];
       
        $stockMovementItems = $this->paginate($this->StockMovementItems);

        $this->set(compact('stockMovementItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Stock Movement Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockMovementItem = $this->StockMovementItems->get($id, [
            'contain' => ['Items', 'StockMovements', 'Units']
        ]);

        $this->set('stockMovementItem', $stockMovementItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockMovementItem = $this->StockMovementItems->newEntity();
        if ($this->request->is('post')) {
            $stockMovementItem = $this->StockMovementItems->patchEntity($stockMovementItem, $this->request->getData());
            if ($this->StockMovementItems->save($stockMovementItem)) {
                $this->Flash->success(__('The stock movement item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock movement item could not be saved. Please, try again.'));
        }
        $items = $this->StockMovementItems->Items->find('list', ['limit' => 200]);
        $stockMovements = $this->StockMovementItems->StockMovements->find('list', ['limit' => 200]);
        $units = $this->StockMovementItems->Units->find('list', ['limit' => 200]);
        $this->set(compact('stockMovementItem', 'items', 'stockMovements', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock Movement Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockMovementItem = $this->StockMovementItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockMovementItem = $this->StockMovementItems->patchEntity($stockMovementItem, $this->request->getData());
            if ($this->StockMovementItems->save($stockMovementItem)) {
                $this->Flash->success(__('The stock movement item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stock movement item could not be saved. Please, try again.'));
        }
        $items = $this->StockMovementItems->Items->find('list', ['limit' => 200]);
        $stockMovements = $this->StockMovementItems->StockMovements->find('list', ['limit' => 200]);
        $units = $this->StockMovementItems->Units->find('list', ['limit' => 200]);
        $this->set(compact('stockMovementItem', 'items', 'stockMovements', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock Movement Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockMovementItem = $this->StockMovementItems->get($id);
        if ($this->StockMovementItems->delete($stockMovementItem)) {
            $this->Flash->success(__('The stock movement item has been deleted.'));
        } else {
            $this->Flash->error(__('The stock movement item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
}
