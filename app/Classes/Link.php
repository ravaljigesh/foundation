<?php

namespace App\Classes;

class Link
{

    public function getCSSLink($css = null, $global = false)
    {
        if (!$css) {
            $css = '';
        }

        if ($global) {
          return url(config('settings.global_css_url')) . '/' . $css;
        }

        if (Context::getContext()->core->scope == 'front') {
            return url(config('settings.admin_css_url')) . '/' . $css;
        }

        return url(config('settings.admin_css_url')) . '/' . $css;
    }

    public function getJSLink($js = null, $global = false)
    {
        if (!$js) {
            $js = '';
        }

        if ($global) {
          return url(config('settings.global_js_url')) . '/' . $js;
        }

        if (Context::getContext()->core->scope == 'front') {
            return url(config('settings.js_url')) . '/' . $js;
        }

        return url(config('settings.js_url')) . '/' . $js;
    }

    public function getImageURL($image = null)
    {
        return config('settings.img_url') . '/' . $image;
    }
}
