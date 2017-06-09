<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class DashboardController extends AdminController
{
    public function initContent()
    {
        return $this->template('dashboard');
    }
}
