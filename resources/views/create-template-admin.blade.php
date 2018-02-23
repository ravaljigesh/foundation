@extends('layouts.app')
@section('content')
@if (count($fillable))
  {!! $form->start($component->variable . '-create-form', 'myForm') !!}
  @foreach ($fillable as $field)
    @if ($field->column_type == 'string')
      {!! $form->mdtext([
        'name' => makeColumn($field->field_name),
        'required' => $field->required,
        'label' => $field->field_name,
        'value' => model($this->obj, makeColumn($field->field_name))
      ]) !!}
    @elseif ($field->column_type == 'longText')
      {!! $form->mdtextarea([
        'name' => makeColumn($field->field_name),
        'required' => $field->required,
        'label' => $field->field_name,
        'value' => model($this->obj, makeColumn($field->field_name))
      ]) !!}
    @endif
  @endforeach
@endif
@endsection
