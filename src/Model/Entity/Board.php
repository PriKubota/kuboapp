<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Board extends Entity {
    protected $_accessible = [
        'id' => true,
        'name' => true,
        'contents' => true,
        'created' => true,
        'modified' => true
    ];
}