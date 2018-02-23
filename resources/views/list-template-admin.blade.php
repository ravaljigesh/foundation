@extends('layouts.app')
@section('content')
<div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded _tw">
  <div class="_tw_w">
    @if (count($listable))
      <table class="table table-striped">
        <thead class="m-datatable__head">
          <tr class="m-datatable__row">
            @foreach($listable as $list)
              <th class="m-datatable__cell m-datatable__cell--sort">{{ $list->field_name }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody class="m-datatable__body">
          @foreach ($listable as $list)
          <tr class="m-datatable__row">
            <td class="m-datatable__cell"><span>{{ $obj->{makeColumn($list)} }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</div>
@endsection
