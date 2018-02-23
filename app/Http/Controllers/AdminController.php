<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Input;
use App\Classes\Context;

class AdminController extends Controller
{
    public $context;

    public $section = 'Authority Zone';

    public $css_files = array();

    public $js_files = array();

<<<<<<< HEAD
    public $flash = array();

    public $page = array();

    protected $meta = array();

    public $assign = array();

    protected $request;

=======
    public $page = array();

>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
    public function __construct()
    {
        config('app.scope', 'admin');
        $this->page['title'] = 'AdLara';
        $this->page['panel'] = 'enable';
        $this->page['meta_title'] = 'Admin Zone';
        $this->page['meta_description'] = 'Admin description';
        $this->page['meta_keywords'] = '';
        $this->page['head'] = 'Default Page';
        $this->meta['title'] = 'Adlara' ;
        $this->page['body_class'] = 'body';
        $this->context = Context::getContext();
<<<<<<< HEAD
        View::addLocation(config('settings.admin_theme_abs'));
=======
        $this->context->core->scope = $this->scope;
        $this->page['title'] = 'Admin Zone';
        $this->page['panel'] = 'enable';
        $this->page['meta_title'] = 'Admin Zone';
        $this->page['meta_description'] = 'Admin description';
        $this->page['meta_keywords'] = '';
        $this->page['head'] = 'Default Page';
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
    }

    public function template($view, $data = array())
    {
<<<<<<< HEAD
        if (!isset($this->page['action_links'])) {
            $this->page['action_links'] = [];
        }
        $media = '';
        if (Input::get('id_media')) {
            $media = $this->context->media->find(Input::get('id_media'));
        }

        $default = [
=======
      View::addLocation(config('settings.admin_theme_abs'));

        if (!isset($this->page['action_links'])) {
          $this->page['action_links'] = [];
        }

        $default = [
            'page_title' => $this->page_title,
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
            'page' => $this->page,
            'action_links' => $this->page['action_links'],
            'context' => $this->context,
            'css_files' => $this->getCSS(),
            'js_files' => $this->getJS(),
            'css_url' => url(config('settings.admin_css_url')),
            'js_url' => url(config('settings.admin_js_url')),
            'sidebar_menu' => $this->getAdminMenu(),
            'media_url' => url(config('settings.media_url')),
<<<<<<< HEAD
            'media_item' => $media,
            'form' => $this->context->form,
            'component' => $this->component,
            'obj' => $this->obj
=======
            'section' => $this->section,
            'form' => $this->context->form,
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        ];

        $data = array_merge($this->assign, $default);

        return View::make('admin'."/".config('settings.admin_theme')."/templates/".$view, $data);
    }

    public function getCSS()
    {
        $this->addCSS($this->context->link->getCSSLink('vendors.bundle.css'));
        $this->addCSS($this->context->link->getCSSLink('style.bundle.css'));
        $this->addCSS($this->context->link->getCSSLink('tagsinput.css', true));
<<<<<<< HEAD
        $this->addCSS($this->context->link->getCSSLink('media.css', true));
        $this->addCSS($this->context->link->getCSSLink('progress.css', true));
        $this->addCSS($this->context->link->getCSSLink('core.css', true));
=======
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        $this->addCSS($this->context->link->getCSSLink('style.css'));

        return $this->css_files;
    }

    public function getJS()
    {
        $this->addJS($this->context->link->getJSLink('vendors.bundle.js'));
        $this->addJS($this->context->link->getJSLink('scripts.bundle.js'));
<<<<<<< HEAD
        $this->addJS($this->context->link->getJSLink('cropper.min.js', true));
        $this->addJS($this->context->link->getJSLink('uploader.js', true));
        $this->addJS($this->context->link->getJSLink('media.js', true));
        $this->addJS($this->context->link->getJSLink('tagsinput.min.js', true));
        $this->addJS($this->context->link->getJSLink('progress.js', true));
        $this->addJS($this->context->link->getJSLink('main.js', true));
=======
        $this->addJS($this->context->link->getJSLink('tagsinput.min.js', true));
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        $this->addJS($this->context->link->getJSLink('dashboard.js'));
        $this->addJS($this->context->link->getJSLink('core.js'));

        return $this->js_files;
    }

    public function getAdminMenu()
    {
<<<<<<< HEAD
        $co['base'] = [
=======
      $co['base'] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        'text' => 'Base',
        'icon' => '<i class="m-menu__link-icon flaticon-layers"></i>'
        ];

<<<<<<< HEAD
        $co['base']['child'][] = [
=======
          $co['base']['child'][] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
            'slug' => 'components/base/state.html',
            'text' => 'State Colors'
          ];

<<<<<<< HEAD
        $co['table'] = [
        'text' => 'Table',
        'icon' => '<i class="m-menu__link-icon flaticon-layers"></i>'
        ];

        $co['table']['child'][] = [
            'slug' => 'component/create',
            'text' => 'Create'
          ];

        $co['table']['child'][] = [
            'slug' => 'component/list',
            'text' => 'List'
          ];

        $tl['tools'] = [
=======
      $tl['tools'] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        'text' => 'Tools',
        'icon' => '<i class="m-menu__link-icon flaticon-interface-3"></i>'
        ];

<<<<<<< HEAD
        $tl['tools']['child'][] = [
=======
          $tl['tools']['child'][] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
            'slug' => 'configuration',
            'text' => 'Configuration'
          ];

<<<<<<< HEAD
        $tl['employee'] = [
=======
      $tl['employee'] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        'text' => 'Employees',
        'icon' => '<i class="m-menu__link-icon flaticon-users"></i>'
        ];

<<<<<<< HEAD
        $tl['employee']['child'][] = [
=======
          $tl['employee']['child'][] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
            'slug' => 'employee/list',
            'text' => 'Employees'
          ];

<<<<<<< HEAD
        //Main menu defined here
        $menu[] = [
=======
      //Main menu defined here
      $menu[] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        'head' => 'Components',
        'menu' => $co
      ];

<<<<<<< HEAD
        $menu[] = [
=======
      $menu[] = [
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
        'head' => 'Tools',
        'menu' => $tl
      ];

        return $menu;
    }

    public function addCSS($file, $priority = 0)
    {
        return $this->css_files[] = $file;
    }

    public function addJS($file, $priority = 0)
    {
        $this->js_files[] = $file;
    }

    public function changeStatus($id)
    {
        $statusObj = $this->statusObj->find($id);

        $status = 1;
        if (isset($statusObj->status) && $statusObj->status) {
            $status = 0;
<<<<<<< HEAD
        }

        $statusObj->status = $status;
        $statusObj->save();

        return json('success', 'Status Change!');
    }

    public function flashMessages()
    {
        if ($this->request->session()->get('success')) {
            $this->flash = [
            'status' => 'success',
            'message' => $this->request->session()->get('success')
          ];
        }

        if ($this->request->session()->get('warning')) {
            $this->flash = [
            'status' => 'warning',
            'message' => $this->request->session()->get('warning')
          ];
        }

        if ($this->request->session()->get('danger')) {
            $this->flash = [
            'status' => 'danger',
            'message' => $this->request->session()->get('danger')
          ];
        }

        if ($this->request->session()->get('info')) {
            $this->flash = [
            'status' => 'info',
            'message' => $this->request->session()->get('info')
          ];
        }

        return $this->flash;
    }

    public function initProcessDelete($id = null)
    {
        if ($id) {
            $data = $this->obj->find($id);
            if (isset($data->id) && $data->id) {
                $id = $data->id;
                $data->delete();
                return json('success', t('Record #'.$id.' deleted successfully'));
            }
        }

        return json('error', t('Record could not found in the database'));
    }

    public function getRequest()
    {
        return $this->request = new \Illuminate\Http\Request;
=======
          }

          $statusObj->status = $status;
          $statusObj->save();

        return json('success','Status Change!');
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
    }
}
