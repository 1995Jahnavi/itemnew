<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Warehouses Controller
 *
 * @property \App\Model\Table\WarehousesTable $Warehouses
 *
 * @method \App\Model\Entity\Warehouse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WarehousesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
       /** $this->paginate = [
            'contain' => ['Units', 'Items']
        ]; */
        $this->paginate['order'] = ['id' => 'DESC'];
        $warehouses = $this->paginate($this->Warehouses);

        $this->set(compact('warehouses'));
    }

    /**
     * View method
     *
     * @param string|null $id Warehouse id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        $warehouse = $this->Warehouses->get($id);

        $this->set('warehouse', $warehouse);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $warehouse = $this->Warehouses->newEntity();
        if ($this->request->is('post')) {
            
            $warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
             
            if ($this->Warehouses->save($warehouse)) {
                $this->Flash->success(__('The warehouse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The warehouse could not be saved. Please, try again.'));
        }
       /** $units = $this->Warehouses->Units->find('list', ['limit' => 200]);
        $items = $this->Warehouses->Items->find('list', ['limit' => 200]);
        $this->set(compact('warehouse', 'units', 'items'));
    */
    }

    /**
     * Edit method
     *
     * @param string|null $id Warehouse id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $warehouse = $this->Warehouses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
            if ($this->Warehouses->save($warehouse)) {
                $this->Flash->success(__('The warehouse has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The warehouse could not be saved. Please, try again.'));
        }
        /**$units = $this->Warehouses->Units->find('list', ['limit' => 200]);
        $items = $this->Warehouses->Items->find('list', ['limit' => 200]); */
        $this->set(compact('warehouse'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Warehouse id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $warehouse = $this->Warehouses->get($id);
        
        try {
            $this->Warehouses->delete($warehouse);
        }
        catch (\PDOException $e) {
            $error = 'The Warehouse you are trying to delete is associated with other records';
            // The exact error message is $e->getMessage();
            $this->set('error', $e);
            $this->Flash->error(__('The Warehouses could not be deleted. Please, try again.'));
        }
        
        
//         if ($this->Warehouses->delete($warehouse)) {
//             $this->Flash->success(__('The warehouse has been deleted.'));
//         } else {
//             $this->Flash->error(__('The warehouse could not be deleted. Please, try again.'));
//         }

        return $this->redirect(['action' => 'index']);
    }
}
