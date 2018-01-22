@extends('layouts.app')
@section('content')
  {!! $form->start('configuration-create', 'myForm') !!}
        {!! $form->mdtext([
          'name' => 'ADMIN_EMAIL',
          'label' => t('Admin E-mail'),
          'required' => true,
          'value' => $ADMIN_EMAIL,
          ]) !!}

        {!! $form->mdtext([
          'name' => 'SITE_URL',
          'label' => t('SITE URL'),
          'required' => true,
          'value' => $SITE_URL,
          ]) !!}

          <hr>
        <div class="flex space-between">
          {!! $form->mdradio('SSL', $optionValue, $last_SSL, 'SSL', true)!!}
          {!! $form->mdradio('CACHE', $optionValue, $last_CACHE, 'CACHE', true)!!}
        </div>
        <hr>
        <div class="flex space-between">
          {!! $form->mdradio('MAINTENANCE', $optionValue, $last_MAINTENANCE, 'MAINTENANCE', true)!!}
          {!! $form->mdradio('DEBUG_MODE', $optionValue, $last_DEBUG_MODE, 'DEBUG MODE', true)!!}
        </div>
        <hr>

        {!! $form->button2([
          'type' => 'submit',
          'class' => '',
          'id' => 'save_configuration',
          'text' => 'Save Configuration'
          ]); !!}
  {!! $form->end() !!}
@endsection
