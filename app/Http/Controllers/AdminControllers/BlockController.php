<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class BlockController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'block'])
        ->first();
    }

    public function initListing()
    {
        $block = $this->context->block
        ->orderBy('id', 'desc')
        ->paginate(25);

        $this->obj = $block;

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable
        ];

        return $this->template('block.list');
    }

    public function initContentCreate($id = null)
    {
        $this->obj = $this->context->block;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('block.create');
    }
}
