<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BoardTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('board');
        $this->displayField('id');
        $this->primaryKey('id');

        // createdやmodifiedに勝手に時間が入る
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('name', '必須です')
            ->notEmpty('contents', '必須です');
    }
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }
}