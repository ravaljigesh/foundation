<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Classes\Context;

class FrontController extends Controller
{
    public $context;

    public $css_files = array();

    public $js_files = array();

    public $assign = array();

    public $flash = array();

    protected $meta = array();

    protected $assign = array();

    public function __construct()
    {
        $this->context = Context::getContext();
        config('app.scope') = 'front';
        $this->getCSS();
        $this->getJS();
        $this->page['title'] = 'Adlara Front End';
        $this->name = 'page_class';
        $this->meta['title'] = 'Adlara';
    }

    public function template($view)
    {
        View::addLocation(config('settings.front_theme_abs'));

        $default = [
            'page' => $this->page,
            'context' => $this->context,
            'css_files' => $this->css_files,
            'js_files' => $this->js_files,
            'css_url' => url(config('settings.css_url')),
            'js_url' => url(config('settings.js_url')),
            'media_url' => url(config('settings.media_url')),
            'flash' => $this->flash,
            'form' => $this->context->form,
            'flash' => session('flash'),
        ];

        $data = array_merge($this->assign, $default);

        return View::make('front'."/".config('settings.front_theme')."/templates/".$view, $data);
    }

    public function getCSS()
    {
        $this->addCSS('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css');
        $this->addCSS($this->context->link->getCSSLink('tagsinput.css', true));
        $this->addCSS($this->context->link->getJSLink('progress.css', true));
        $this->addCSS($this->context->link->getCSSLink('style.css'));

        return $this->css_files;
    }

    public function getJS()
    {
        $this->addJS('//code.jquery.com/jquery-3.2.1.min.js');
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js');
        $this->addJS('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js');
        $this->addJS($this->context->link->getJSLink('progress.js', true));
        $this->addJS($this->context->link->getJSLink('tagsinput.min.js', true));
        $this->addJS($this->context->link->getJSLink('vue.js', true));
        $this->addJS($this->context->link->getJSLink('main.js', true));
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

    public function flash($status, $message)
    {
        $this->request->session()->flash('flash', [
          'status' => $status,
          'message' => $message
        ]);
    }
}
