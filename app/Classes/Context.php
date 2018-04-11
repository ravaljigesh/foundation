<?php

namespace App\Classes;

class Context
{
    private static $instance;

    public static function getContext()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

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
}
