<?php

namespace App\Models;

use App\Core\Model;

class Event extends Model {

    public $tableName = 'events';
    public $primaryKey = 'id';


    public static function __callStatic($name, $arguments)
    {
            $instance = new self();     
            return $instance->$name(...$arguments);
    }




}