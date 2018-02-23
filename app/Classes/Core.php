<?php

namespace App\Classes;
use Illuminate\Support\Facades\Input;

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

    public function validateFields(array $datas = array())
    {
        $fields = [];
        if (!count($datas) && Input::get('required')) {
          $required = explode(',', Input::get('required'));
          $required_label = explode(',', Input::get('required_label'));
          foreach ($required as $key => $req) {
            $datas[$req] = $required_label[$key];
          }
        }

        foreach ($datas as $d => $data) {
            if (Input::get($d) == '') {
                return $this->json('error', 'Please supply ' . $data, true, Input::get('element'));
            } else {
                $da = str_replace('-', '_', $d);
                $fields[$da] = Input::get($d);
            }
        }

        return (object) $fields;
    }
<<<<<<< HEAD

    public function getUploadDir($type = 'image')
    {
        $upload = [
          'image' => storage_path('media/image'),
          'video' => storage_path('media/video/'),
          'audio' => storage_path('media/audio/'),
          'pdf' => storage_path('media/pdf/'),
        ];

        return $upload[$type];
    }

    public function prepareHTML($html)
    {
        $this->html[] = $html;
    }

    public function buildHTML()
    {
        $html = '';
        foreach ($this->html as $h) {
          $html .= $h;
        }

        return $html;
    }
=======
>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
}
