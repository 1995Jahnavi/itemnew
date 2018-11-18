<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockMovements Model
 *
 * @property \App\Model\Table\WarehousesTable|\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\WarehousesTable|\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\StockMovementItemsTable|\Cake\ORM\Association\HasMany $StockMovementItems
 *
 * @method \App\Model\Entity\StockMovement get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockMovement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockMovement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockMovement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockMovement|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockMovement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockMovement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockMovement findOrCreate($search, callable $callback = null, $options = [])
 */
class StockMovementsTable extends Table
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

        $this->setTable('stock_movements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Warehouses', [
            'foreignKey' => 'from_warehouse_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Warehouses', [
            'foreignKey' => 'to_warehouse_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('StockMovementItems', [
            'foreignKey' => 'stock_movement_id',
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
        /**debug($this->Warehouses->save($warehouse));die();*/
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

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
        $rules->add($rules->existsIn(['from_warehouse_id'], 'Warehouses'));
        $rules->add($rules->existsIn(['to_warehouse_id'], 'Warehouses'));

        return $rules;
    }
}
