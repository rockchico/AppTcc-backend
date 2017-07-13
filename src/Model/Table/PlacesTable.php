<?php
/**
 * Created by PhpStorm.
 * User: francisco
 * Date: 10/07/17
 * Time: 23:30
 */
namespace App\Model\Table;

use Cake\ORM\Table;

class PlacesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}