<?php

namespace App\Objects;
use IDB;

class Lang extends IDB
{
    public $locale = 'en';

    protected $table = 'language';
}
