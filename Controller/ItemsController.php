<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**use Cake\ORM\RulesChecker;
 *use Cake\ORM\Rule\IsUnique;

 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
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
    {
         $this->paginate($this->Items);
         $this->paginate['order'] = ['id' => 'DESC'];        
         $items = $this->paginate($this->Items);
        
        
    	foreach($items as $item){
    		$units = TableRegistry::get('Units');
    		$itemgroups = TableRegistry::get('ItemGroups');
    
    		$pu = $units->get($item->purchase_unit);
    		$item->pu_name = $pu->unit_name;
    
                    $su = $units->get($item->sell_unit);
    		$item->su_name = $su->unit_name;
    
                    $us = $units->get($item->usage_unit);
    		$item->us_name = $us->unit_name;
    		
                    $ig = $itemgroups->get($item->item_group_id);
    		$item->ig_name = $ig->name;
    	}

        
        $this->set('items', $this->paginate($this->Items));
         $this->set('_serialize', ['items']);  
         $this->set(compact('items'));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       $item = $this->Items->get($id, [
            'contain' => []
        ]);
      //  debug($item);die();
         //$items = $this->paginate($this->Items);
         // $units = $this->paginate($this->Items);

	
	    $units = TableRegistry::get('Units');
		$itemgroups = TableRegistry::get('ItemGroups');

		$pu = $units->get($item->purchase_unit);
		$item->pu_name = $pu->unit_name;

                $su = $units->get($item->sell_unit);
		$item->su_name = $su->unit_name;

                $us = $units->get($item->usage_unit);
		$item->us_name = $us->unit_name;
		
                $ig = $itemgroups->get($item->item_group_id);
		$item->ig_name = $ig->name;
	
	
        $this->set('item', $item);
         $this->set('_serialize', ['item']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       
        $item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //debug('units');die();
            
            $this->Units = TableRegistry::get('Units');
	        $this->set('units',$this->Units->find('list'));		
	        $this->Units = TableRegistry::get('ItemGroups');
	        $this->set('itemgroups',$this->Units->find('list'));
	        $this->Flash->error(__('The item could not be saved. Please, try again.'));
        } 
            else if($this->request->is('get')){
//        	debug('get');die();
              $this->Units = TableRegistry::get('Units');
	          $this->set('units',$this->Units->find('list'));		
	          $this->Units = TableRegistry::get('ItemGroups');
              $this->set('itemgroups',$this->Units->find('list'));
	    } 
	
        $this->set(compact('item'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //debug(Units);die();
            
            $this->Units = TableRegistry::get('Units');
            $this->set('units',$this->Units->find('list'));
            $this->Units = TableRegistry::get('ItemGroups');
            $this->set('itemgroups',$this->Units->find('list'));
           
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        else if($this->request->is('get')){
            
	    $this->Units = TableRegistry::get('Units');
	    $this->set('units',$this->Units->find('list'));
	    
	    $this->Units = TableRegistry::get('ItemGroups');
	    $this->set('itemgroups',$this->Units->find('list'));
	} 
        $this->set(compact('item'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}