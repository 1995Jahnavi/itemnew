<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockMovementItems Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 * @property \App\Model\Table\StockMovementsTable|\Cake\ORM\Association\BelongsTo $StockMovements
 * @property \App\Model\Table\UnitsTable|\Cake\ORM\Association\BelongsTo $Units
 *
 * @method \App\Model\Entity\StockMovementItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\StockMovementItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StockMovementItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StockMovementItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockMovementItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StockMovementItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StockMovementItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StockMovementItem findOrCreate($search, callable $callback = null, $options = [])
 */
class StockMovementItemsTable extends Table
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

        $this->setTable('stock_movement_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('StockMovements', [
            'foreignKey' => 'stock_movement_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
            'joinType' => 'INNER'
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
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

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
        $rules->add($rules->existsIn(['item_id'], 'Items'));
        $rules->add($rules->existsIn(['stock_movement_id'], 'StockMovements'));
        $rules->add($rules->existsIn(['unit_id'], 'Units'));

        return $rules;
    }
}
