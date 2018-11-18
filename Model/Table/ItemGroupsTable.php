<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * ItemGroups Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\HasMany $Items
 *
 * @method \App\Model\Entity\ItemGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemGroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemGroup|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemGroupsTable extends Table
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

        $this->setTable('item_groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'item_group_id'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
   
    public function beforeSave($event, $entity, $options)
    {
        
        $item_group_table= TableRegistry::get('ItemGroups');
        $item_group=$item_group_table->find('list')->where(['name' =>$entity->name])->count();
        if($item_group > 0)
        {
            return false;
        }
        
        //debug($entity);die();
        
    } 
}
