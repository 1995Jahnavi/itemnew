<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ItemGroups Controller
 *
 * @property \App\Model\Table\ItemGroupsTable $ItemGroups
 *
 * @method \App\Model\Entity\ItemGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate['order'] = ['id' => 'DESC'];
        $itemGroups = $this->paginate($this->ItemGroups);
        $this->set(compact('itemGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id Item Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemGroup = $this->ItemGroups->get($id, [
            'contain' => ['Items']
        ]);
        foreach($itemGroup->items as $item){
            
        $units = TableRegistry::get('Units');       
        $item->purchase_unit_name=$units->get($item->purchase_unit)->unit_name;
        
        $units = TableRegistry::get('Units');
        $item->sell_unit_name=$units->get($item->sell_unit)->unit_name;
        
        $units = TableRegistry::get('Units');
        $item->usage_unit_name=$units->get($item->usage_unit)->unit_name;
        
       // foreach ($stockMovement->stock_movement_items as $stockMovementItems){
            //$items = TableRegistry::get('Items');
            // $stockMovementItems->item_name=$items->get($stockMovementItems->id)->item_name;
            // }
         $item_groups = TableRegistry::get('ItemGroups');
         $item->item_group_name=$item_groups->get($item->item_group_id)->name;
        }
     
        $this->set('itemGroup', $itemGroup);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemGroup = $this->ItemGroups->newEntity();
        if ($this->request->is('post')) {
            $itemGroup = $this->ItemGroups->patchEntity($itemGroup, $this->request->getData());
            if ($this->ItemGroups->save($itemGroup)) {
                $this->Flash->success(__('The item group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item group could not be saved. Please, try again.'));
        } else if($this->request->is('get')){
        	
         }
        $this->set(compact('itemGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemGroup = $this->ItemGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemGroup = $this->ItemGroups->patchEntity($itemGroup, $this->request->getData());
            if ($this->ItemGroups->save($itemGroup)) {
                $this->Flash->success(__('The item group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item group could not be saved. Please, try again.'));
        }
        $this->set(compact('itemGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemGroup = $this->ItemGroups->get($id);
        
        try {
            $this->ItemGroups->delete($itemGroup);
        }
        catch (\PDOException $e) {
            $error = 'The item group you are trying to delete is associated with other records';
            // The exact error message is $e->getMessage();
            $this->set('error', $e);
            $this->Flash->error(__('The item group could not be deleted. Please, try again.'));
        }
        
//         if ($this->ItemGroups->delete($itemGroup)) {
//             $this->Flash->success(__('The item group has been deleted.'));
//         } else {
//             $this->Flash->error(__('The item group could not be deleted. Please, try again.'));
//         }

        return $this->redirect(['action' => 'index']);
    }
}
