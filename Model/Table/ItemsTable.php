<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\TableRegistry;

/**
 * Items Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ItemGroups
 * @property |\Cake\ORM\Association\HasMany $StockMovementItems
 * @property |\Cake\ORM\Association\HasMany $Warehouses
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('items');
        $this->setDisplayField('item_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ItemGroups', [
            'foreignKey' => 'item_group_id',
            'joinType' => 'INNER'
        ]);
//         $this->hasMany('StockMovementItems', [
//             'foreignKey' => 'item_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
//         $this->hasMany('Warehouses', [
//             'foreignKey' => 'item_id'
            
//         ]);
//         $this->hasMany('SalesOrderItems', [
//             'foreignKey' => 'item_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
        
//         $this->hasMany('StockTransactions', [
//             'foreignKey' => 'item_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('item_name')
            ->maxLength('item_name', 255)
            ->requirePresence('item_name', 'create')
            ->notEmpty('item_name');

        $validator
            ->integer('purchase_unit')
            ->requirePresence('purchase_unit', 'create')
            ->notEmpty('purchase_unit');

        $validator
            ->integer('sell_unit')
            ->requirePresence('sell_unit', 'create')
            ->notEmpty('sell_unit');

        $validator
            ->integer('usage_unit')
            ->requirePresence('usage_unit', 'create')
            ->notEmpty('usage_unit');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['item_group_id'], 'ItemGroups'));

        return $rules;
    }
    
  
    public function beforeSave($event, $entity, $options)
    {
//         debug($entity->id);die();   
        $items_table= TableRegistry::get('Items');
        if(is_null($entity->id)){
            $itemadd=$items_table->find('all')->where(['item_name' =>$entity->item_name])->count();
        }else{
            $itemadd=$items_table->find('all')->where(['item_name' =>$entity->item_name,'id !=' =>$entity->id])->count();
        }
        
        if($itemadd > 0)
        {
            return false;
        }
        //debug($entity);die();
        
    } 
}
