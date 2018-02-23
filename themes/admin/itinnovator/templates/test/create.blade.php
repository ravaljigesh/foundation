@extends('layouts.app')
@section('content')
<h2>{{ $component }}</h2>
@if (count($fields))
  {!! $form->start($obj . '-create-form', 'myForm') !!}
  @foreach ($fields as $key => $field)
    <?php
    $column = str_slug($field);
    $column = str_replace('-', '_', $field);
    ?>
    @if ($fillable[$key] == 1)
      @if ($field_type[$key] == 'string')
        {!! $form->mdtext([
          'label' => $field,
          'type' => 'text',
          'name' => $column,
          'value' => model($obj, $column),
          'required' => ($required[$key] ? 'true' : 'false')
        ]) !!}
      @elseif ($field_type[$key] == 'integer')
        {!! $form->radio([
          'name' => $column,
          'label' => $field,
          'value' => model($obj, $column),
          'required' => ($required[$key] ? 'true' : 'false')
        ]) !!}
      @elseif ($field_type[$key] == 'longText')
        {!! $form->mdtextarea([
          'name' => $column,
          'label' => $field,
          'value' => model($obj, $column),
          'required' => ($required[$key] ? 'true' : 'false')
        ]) !!}
      @endif
    @endif
  @endforeach
  <button type="submit" class="btn btn-primary" name="button">Create</button>
  {!! $form->end() !!}
@endif
@endsection
