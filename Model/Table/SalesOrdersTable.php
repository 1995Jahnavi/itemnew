<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesOrders Model
 *
 * @property \App\Model\Table\SalesOrderItemsTable|\Cake\ORM\Association\HasMany $SalesOrderItems
 *
 * @method \App\Model\Entity\SalesOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesOrder|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesOrder findOrCreate($search, callable $callback = null, $options = [])
 */
class SalesOrdersTable extends Table
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

        $this->setTable('sales_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
		
		$this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('SalesOrderItems', [
            'foreignKey' => 'sales_order_id',
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);
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
            ->integer('customer_id')
            ->requirePresence('customer_id', 'create')
            ->notEmpty('customer_id');

        $validator
            ->date('created_date')
            ->requirePresence('created_date', 'create')
            ->notEmpty('created_date');

        $validator
            ->date('delivary_date')
            ->requirePresence('delivary_date', 'create')
            ->notEmpty('delivary_date');

        return $validator;
    }
}
