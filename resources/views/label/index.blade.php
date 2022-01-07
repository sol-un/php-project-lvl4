@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('label.labels')}}</h1>
@auth
<a href="{{ route('labels.create') }}" class="btn btn-primary">
  {{__('label.create')}}
</a>
@endauth
<table class="table mt-2">
  <thead>
    <tr>
      <th>{{__('label.id')}}</th>
      <th>{{__('label.name')}}</th>
      <th>{{__('label.description')}}</th>
      <th>{{__('label.created_at')}}</th>
      @auth
      <th>{{__('label.actions')}}</th>
      @endauth
    </tr>
  </thead>
  @foreach($labels as $label)
  <tr>
    <td>{{ $label->id }}</td>
    <td>{{ $label->name }}</td>
    <td>{{ $label->description }}</td>
    <td>{{ $label->created_at }}</td>
    @auth
    <td>
      <a class="text-danger text-decoration-none" href="{{ route('labels.destroy', $label) }}" data-confirm="Вы уверены?" data-method="delete">
        {{__('label.delete')}}
      </a>
      <a class="text-decoration-none" href="{{ route('labels.edit', $label) }}">
        {{__('label.edit')}}
      </a>
    </td>
    @endauth
  </tr>
  @endforeach
</table>
@endsection