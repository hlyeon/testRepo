<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\ORM\Locator\TableLocator;


/**
 * Journals Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Journal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Journal newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Journal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Journal|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Journal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Journal[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Journal findOrCreate($search, callable $callback = null, $options = [])
 */
class JournalsTable extends Table
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

        $this->setTable('journals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);


        $this->addBehavior('Timestamp');

        if($this->behaviors()->has('Timestamp')) {
          $this->behaviors()->get('Timestamp')->config([
            'events' => [
              'Users.login' => [
                'loginT' => 'always',
              ],
              'Users.logout' => [
                'logoutT' => 'always',
              ],
              'Journals.open' => [
                'openT' => 'always',
              ],
              'Journals.close' => [
                'closeT' => 'always',
              ],
            ]
          ]);
        }






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
            ->date('date')
            ->requirePresence('date', 'create')
            // ->notEmpty('date');
            ->allowEmpty('date');

        $validator
            ->time('loginT')
            ->allowEmpty('loginT');

        $validator
            ->time('openT')
            ->allowEmpty('openT');

        $validator
            ->time('closeT')
            ->allowEmpty('closeT');

        $validator
            ->time('logoutT')
            ->allowEmpty('logoutT');

        $validator
            ->scalar('content')
            ->allowEmpty('content');

        $validator
            ->scalar('comment')
            ->allowEmpty('comment');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
