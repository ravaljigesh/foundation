<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class DashboardController extends AdminController
{
    public function __construct()
    {
        $this->section = 'Dashboard';
        parent::__construct();
    }

    public function initContent()
    {
        $this->page['head'] = 'Dashboard';
        return $this->template('dashboard');
    }
}
