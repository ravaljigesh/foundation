<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Classes\Context;

class AdminController extends Controller
{
    protected $scope = 'admin';

    public $page_title = 'Authority Zone';

    public $context;

    public $css_files = array();

    public $js_files = array();

    public function __construct()
    {
        $this->context = Context::getContext();
        $this->context->core->scope = $this->scope;
        $this->getCSS();
        $this->getJS();
    }

    public function template($view, $data = array())
    {
        View::addLocation(config('settings.admin_theme_abs'));

        $default = [
            'page_title' => $this->page_title,
            'context' => $this->context,
            'css_files' => $this->css_files,
            'js_files' => $this->js_files,
            'css_url' => url(config('settings.admin_css_url')),
            'js_url' => url(config('settings.admin_js_url')),
            'media_url' => url(config('settings.media_url'))
        ];

        $data = array_merge($data, $default);

        return View::make('admin'."/".config('settings.admin_theme')."/templates/".$view, $data);
    }

    public function getCSS()
    {
        $this->addCSS('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css');
        $this->addCSS($this->context->link->getCSSLink('style.css'));

        return $this->css_files;
    }

    public function getJS()
    {
        $this->addJS('//code.jquery.com/jquery-3.2.1.min.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
        $this->addJS('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js');
        $this->addJS($this->context->link->getJSLink('core.js'));

        return $this->js_files;
    }

    public function addCSS($file, $priority = 0)
    {
        return $this->css_files[] = $file;
    }

    public function addJS($file, $priority = 0)
    {
        $this->js_files[] = $file;
    }
}
