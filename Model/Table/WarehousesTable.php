<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Warehouses Model
 *
 * @property \App\Model\Table\UnitsTable|\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\Warehouse get($primaryKey, $options = [])
 * @method \App\Model\Entity\Warehouse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Warehouse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse findOrCreate($search, callable $callback = null, $options = [])
 */
class WarehousesTable extends Table
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

        $this->setTable('warehouses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
//         $this->hasMany('StockMovements', [
//             'foreignKey' => 'from_warehouse_id',
//             'foreignKey' => 'to_warehouse_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
        
//         $this->hasMany('StockTransactions', [
//             'foreignKey' => 'warehouse_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
        
//         $this->hasMany('SalesOrderItems', [
//             'foreignKey' => 'warehouse_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    
    public function beforeSave($event, $entity, $options)
    {
        
        $warehouse_table= TableRegistry::get('Warehouses');
        $warehouse=$warehouse_table->find('list')->where(['name' =>$entity->name])->count();
        if($warehouse > 0)
        {
            return false;
        }
        
        //debug($entity);die();
        
    }
}
