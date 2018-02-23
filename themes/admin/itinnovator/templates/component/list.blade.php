@extends('layouts.app')
@section('content')
  <div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
    <table class="table table-striped" id="html_table">
        <thead class="m-datatable__head">
          <tr class="m-datatable__row">
            <td class="m-datatable__cell m-datatable__cell--sort">ID</td>
            <td class="m-datatable__cell m-datatable__cell--sort">Name</td>
            <td class="m-datatable__cell m-datatable__cell--sort">Table</td>
            <td class="m-datatable__cell m-datatable__cell--sort">Variable</td>
            <td class="m-datatable__cell m-datatable__cell--sort">Status</td>
            <td class="m-datatable__cell m-datatable__cell--sort">Action</td>
          </tr>
        </thead>
        <tbody class="m-datatable__body">
          @if (count($components))
            @foreach ($components as $c)
              <tr class="m-datatable__row">
                <td class="m-datatable__cell"><span>{{ $c->id }}</span></td>
                <td class="m-datatable__cell"><span>{{ $c->name }}</span></td>
                <td class="m-datatable__cell"><span>{{ $c->table }}</span></td>
                <td class="m-datatable__cell"><span>{{ $c->variable }}</span></td>
                <td class="m-datatable__cell"><span>9033777859</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_{{ $c->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $c->id }}" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
                      <a class="dropdown-item" href="{{ AdminURL('component/edit/' . $c->id)  }}">
                        Edit
                      </a>
                      <a class="dropdown-item" href="{{ AdminURL('component/edit/' . $c->id)  }}">
                        Delete
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
@endsection
