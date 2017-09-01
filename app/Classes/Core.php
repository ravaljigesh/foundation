<?php

namespace App\Classes;

class Core
{
    public $scope;

    public $lang = 'en';

    public function url($url)
    {
        if ($this->scope == 'admin') {
            return url(config('settings.admin_path') . '/' . $url);
        }

        return url($url);
    }
}
