<?php
namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;
use Input;
use Illuminate\Http\Request;

class TestController extends FrontController
{
    public function __construct()
    {
        $this->component = $this->context->test
        ->where(['variable' => 'test'])
        ->first();

        parent::__contruct();
    }

    public function initListing()
    {
        $test = $this->context->test
        ->orderBy('id', 'desc')
        ->paginate(25);

        $this->assign = [
          'test' => $test
        ];

        return $this->template('test.list');
    }

    public function initContentCreate($id = null)
    {
        $this->obj = $this->context->test;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $this->assign = [
          'test' => $this->obj
        ];

        return $this->template('test.create');
    }

    public function initContent($url = null)
    {
        $test = $this->context->test->findByURL($url);

        $this->assign = [
          'test' => $test
        ];

        return $this->template('test.view');
    }
}
