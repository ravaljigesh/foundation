<div class="flex _mc">
  {!! $form->mdtext([
    'name' => 'field[]',
    'label' => t('Field Name'),
    'value' => model($field, 'field_name')
  ]) !!}
  {!! $form->select([
    'label' => 'Field Type',
    'name' => 'field_type[]',
    'wrap_class' => 'form-group myForm-group is-focused',
    'class' => 'form-control',
    'value' => model($field, 'column_type')
  ], $column_types) !!}
  {!! $form->mdtext([
    'name' => 'default[]',
    'label' => t('Default'),
    'value' => model($field, 'default')
  ]) !!}
  {!! $form->select([
    'label' => 'Required',
    'name' => 'required_field[]',
    'wrap_class' => 'form-group myForm-group is-focused',
    'class' => 'form-control',
    'value' => model($field, 'required')
  ], ['No', 'Yes']) !!}
  {!! $form->select([
    'label' => 'Use in Listing',
    'name' => 'use_in_listing[]',
    'wrap_class' => 'form-group myForm-group is-focused',
    'class' => 'form-control',
    'value' => model($field, 'use_in_listing')
  ], ['No', 'Yes']) !!}
  {!! $form->select([
    'label' => 'Fillable',
    'name' => 'fillable[]',
    'wrap_class' => 'form-group myForm-group is-focused',
    'class' => 'form-control',
    'value' => model($field, 'is_fillable')
  ], ['No', 'Yes']) !!}
  {!! $form->mdtext([
    'name' => 'class[]',
    'label' => t('HTML Class'),
    'value' => model($field, 'class')
  ]) !!}
</div>
