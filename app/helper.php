<?php
/**
 * Check array our object output
 * @param  [type]  $array Array
 * @param  boolean $exit  true or false
 * @return [type]         print
 */
function pre($array, $exit = true)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if ($exit) {
      exit();
    }
}

/**
 * output value if found in object or array
 * @param  [object/array] $model             Eloquent model, object or array
 * @param  [string] $key
 * @param  [boolean] $alternative_value
 * @return [type]
 */
function model($model, $key, $alternative_value = null, $type = 'object')
{
    if ($type == 'object') {
        if (isset($model->$key)) {
            return $model->$key;
        }
    }

    if ($type == 'array') {
        if (isset($model[$key]) && $model[$key]) {
            return $model[$key];
        }
    }

    return $alternative_value;
}

/**
 * getView of template
 * @param  [string] $view      Filename
 * @param  [string] $view_type Admin or Front
 */

function getView($view, $view_type = null)
{
    if (!$view_type) {
        $view_type = 'front';
    }

    if ($view_type == 'front') {
        return 'front/' . config('settings.front_theme') . '/templates/' . $view;
    }

    return 'admin/' . config('settings.admin_theme') . '/templates/' . $view;
}
