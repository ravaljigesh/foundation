@extends('layouts.app')
@section('content')
  {!! $form->start('admin-user-create', 'myForm') !!}
    {!! $form->mdtext([
      'name' => 'name',
      'label' => t('Component Name'),
      'required' => true,
      'value' => model($component, 'name'),
    ]) !!}

    {!! $form->mdtext([
      'name' => 'table',
      'label' => t('Table'),
      'value' => model($component, 'table'),
      ]) !!}

    {!! $form->mdtext([
      'name' => 'variable',
      'label' => t('Variable'),
      'value' => model($component, 'variable'),
      ]) !!}

    {!! $form->mdtext([
      'name' => 'slug',
      'label' => t('Slug'),
      'value' => model($component, 'slug'),
    ]) !!}

    {!! $form->select([
      'label' => 'Controller',
      'name' => 'controller',
      'wrap_class' => 'form-group myForm-group is-focused',
      'class' => 'form-control',
      'show_label_as_option' => false,
      'value' => model($component, 'controller')
    ], ['none' => 'None', 'front' => 'Front', 'admin' => 'Admin', 'both' => 'Both']) !!}

    <hr>
    <h2>Fields</h2>
    @if (c($component) && count($component->fields))
      @foreach ($component->fields as $field)
        @include('templates.component._partials.fields')
      @endforeach
    @else
      @include('templates.component._partials.fields', ['field' => ''])
    @endif
    <div class="flex _mc"></div>
    <div class="new-column"></div>

    <hr>
    <h2>Other Config</h2>
    <div class="flex space-between">
      {!! $form->mdradio('is_login_needed', ['1' => 'Yes', '0' => 'No'], model($component, 'is_login_needed'), 'Is route need login?', true)!!}
    </div>
    <hr>
    <div class="flex space-between">
      {!! $form->mdradio('is_admin_create', $optionValue, model($component, 'is_admin_create'), 'Is Admin Create?', true) !!}
      {!! $form->mdradio('is_admin_list', $optionValue, model($component, 'is_admin_list'), 'Is Admin List?', true)!!}
      {!! $form->mdradio('is_admin_delete', $optionValue, model($component, 'is_admin_delete'), 'Is Admin Delete?', true)!!}
    </div>
    <hr>
    <div class="flex space-between">
      {!! $form->mdradio('is_front_create', $optionValue, model($component, 'is_front_create'), 'Is Front Create?', true)!!}
      {!! $form->mdradio('is_front_list', $optionValue, model($component, 'is_front_list'), 'Is Front List?', true)!!}
      {!! $form->mdradio('is_front_view', $optionValue, model($component, 'is_front_view'), 'Is Front View?', true)!!}
    </div>
    <hr>
    {!! $form->button2([
      'type' => 'submit',
      'class' => '',
      'id' => 'save_component',
      'text' => 'Save Componenet'
      ]) !!}

  {!! $form->end() !!}
@endsection
