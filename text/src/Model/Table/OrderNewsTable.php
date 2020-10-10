<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderNews Model
 *
 * @method \App\Model\Entity\OrderNews get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderNews newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderNews[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderNews|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderNews saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderNews patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderNews[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderNews findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderNewsTable extends Table
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

        $this->setTable('order_news');
        $this->setDisplayField('title');
        $this->setPrimaryKey('order_news_id');

        $this->addBehavior('Timestamp');
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
            ->integer('order_news_id')
            ->allowEmptyString('order_news_id', null, 'create');

        $validator
            ->date('order_news_date')
            ->requirePresence('order_news_date', 'create')
            ->notEmptyDate('order_news_date');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        return $validator;
    }
}
