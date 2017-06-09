<?php

namespace App\Classes;

class Link
{

    public function getCSSLink($css = null)
    {
        if (!$css) {
            $css = '';
        }

        if (Context::getContext()->core->scope == 'front') {
            return url(config('settings.admin_css_url')) . '/' . $css;
        }

        return url(config('settings.admin_css_url')) . '/' . $css;
    }

    public function getJSLink($js = null)
    {
        if (!$js) {
            $js = '';
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
