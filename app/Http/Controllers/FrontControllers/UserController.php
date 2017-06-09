<?php

namespace App\Http\Controllers\FrontControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;

class UserController extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function initContent() {
        return $this->template('home');
    }
}
