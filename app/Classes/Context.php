<?php

namespace App\Classes;

use App\Classes\Core;
use App\Classes\Form;
use App\Classes\Link;
use App\Objects\AdminUser;

class Context
{
    protected static $instance;

    public $core;

    public $form;

    public $link;

    public $admin_user;

    public function __construct()
    {
        $this->core = new Core;
        $this->form = new Form;
        $this->link = new Link;
        $this->admin_user = new AdminUser;
    }

    public static function getContext()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
