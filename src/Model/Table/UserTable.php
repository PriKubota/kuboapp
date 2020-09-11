<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        //　createdやmodifiedに勝手に時間が入る
        $this->addBehavior('Timestamp');
        $this->addBehavior('DelFlg');
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', '必須です')
            ->notEmpty('password', '必須です');
    }
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
 
        return $rules;
    }
}