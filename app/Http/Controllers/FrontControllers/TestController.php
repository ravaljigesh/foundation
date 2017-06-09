<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;

class TestController extends FrontController
{
    public function initContent()
    {
        return $this->template('test');
    }
}
