<?php

namespace App\Objects;

use App\Objects\IDB;


class Configuration extends IDB
{
    protected $table = 'configuration';

    public $guarded = [];

    public $timestamps = true;

    public function __construct()
    {
        parent::__construct();
    }

    public function get($key)
    {
        $this->primaryKey = 'name';
        $check = $this->find($key);
        if (isset($check->id) && $check->id) {
          return $check->value;
        }
    }
}
