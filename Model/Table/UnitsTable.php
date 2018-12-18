<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Units Model
 *
 * @method \App\Model\Entity\Unit get($primaryKey, $options = [])
 * @method \App\Model\Entity\Unit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Unit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Unit|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Unit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Unit findOrCreate($search, callable $callback = null, $options = [])
 */
class UnitsTable extends Table
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

        $this->setTable('units');
        $this->setDisplayField('unit_name');
        $this->setPrimaryKey('id');
        
//         $this->hasMany('StockMovementItems', [
//             'foreignKey' => 'unit_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
//         $this->hasMany('Items', [
//             'foreignKey' => 'purchase_unit',
//             'foreignKey' => 'sell_unit',
//             'foreignKey' => 'usage_unit',
//             'dependent' => true,
//             'cascadeCallbacks' => true
            
//         ]);
//         $this->hasMany('SalesOrderItems', [
//             'foreignKey' => 'unit_id',
//             'dependent' => true,
//             'cascadeCallbacks' => true
//         ]);
        
//         $this->hasMany('StockTransactions', [
//             'foreignKey' => 'unit_id',
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
            ->scalar('unit_name')
            ->maxLength('unit_name', 255)
            ->requirePresence('unit_name', 'create')
            ->notEmpty('unit_name');

        return $validator;
    }
   
    
    public function beforeSave($event, $entity, $options)
    {
        
        $unit_table= TableRegistry::get('Units');
        $unit=$unit_table->find('list')->where(['unit_name' =>$entity->unit_name])->count();
        if($unit > 0)
        {
            return false;
        }
        
        //debug($entity);die();
        
    } 
}
