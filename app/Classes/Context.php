<?php

namespace App\Classes;

use App\Classes\Core;
use App\Classes\Form;
use App\Classes\Link;
use App\Objects\AdminUser;

class Context
{
    protected static $instance;

    protected $core;

    protected $form;

    protected $user;

    protected $link;

    protected $admin_user;

    protected $lang;

<<<<<<< HEAD
    protected $media;

    protected $translate;

    protected $configuration;

    protected $component;

    protected $component_fields;

=======
    protected $configuration;

>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
    public function __get($property)
    {
        $real_property = $property;
        $property = explode('_', $property);
        if (count($property)) {
          $new_property = '';
          foreach ($property as $prop) {
            $new_property .= ucfirst($prop);
          }
          $property = $new_property;
        }
        $method = 'get'.ucfirst($property); // getStatus
        if (method_exists($this, $method)) {
          return $this->$method();
        }

        if (file_exists(base_path('app/Objects/' . ucfirst($property) . '.php'))) {
          $class = '\App\Objects\\' . ucfirst($property);
          return $this->block = new $class;
        }
    }

    public static function getContext()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get the value of Instance
     *
     * @return mixed
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Get the value of Core
     *
     * @return mixed
     */
    public function getCore()
    {
        return $this->core = new \App\Classes\Core;
    }

    /**
     * Get the value of Form
     *
     * @return mixed
     */
    public function getForm()
    {
        return $this->form = new \App\Classes\Form;
    }

    /**
     * Get the value of Link
     *
     * @return mixed
     */
    public function getLink()
    {
        return $this->link = new \App\Classes\Link;
    }

    /**
     * Get the value of Admin User
     *
     * @return mixed
     */
    public function getAdminUser()
    {
        return $this->admin_user = new \App\Objects\AdminUser;
    }


    /**
     * Get the value of Lang
     *
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang = new \App\Objects\Lang;
    }


    /**
     * Get the Users
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user = new \App\Objects\User;
    }

    /**
     * Get the Configuration
     *
     * @return mixed
     */
    public function getConfiguration()
    {
<<<<<<< HEAD
        // $foo = new ;
        return $this->configuration = new \App\Objects\Configuration;
    }

    /**
     * Get the Configuration
     *
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media = new \App\Objects\Media;
    }

    /**
     * Get the Configuration
     *
     * @return mixed
     */
    public function getTranslate()
    {
        return $this->media = new \App\Classes\Translate;
    }

    public function getComponent()
    {
        return $this->component = new \App\Objects\Component;
    }

    public function getComponentFields()
    {
      return $this->component_fields = new \App\Objects\ComponentFields;
    }
=======
        return $this->configuration = new \App\Objects\Configuration;
    }

>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
}
