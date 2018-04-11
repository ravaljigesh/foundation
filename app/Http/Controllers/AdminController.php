<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function template($view)
    {
        $this->default_assigned_variables();
        $data = array_merge($this->assign, $this->$assign_default);
        return view($view, $data);
    }

    private function default_assigned_variables()
    {
        $this->default_assign = [
          'context' => []  
        ];
    }
}
