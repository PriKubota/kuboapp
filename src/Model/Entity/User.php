<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity {
    protected $_accessible = [
        'id' => true,
        'password' => true,
        'auth' => true,
        'del_flg' => true,
        'created' => true,
        'modified' => true,
        'username' => true,
        'detail_id' => true
    ];
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        //passが一文字以上ならハッシュ化
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}