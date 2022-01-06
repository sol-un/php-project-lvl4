@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('taskStatus.taskStatuses')}}</h1>
@auth
<a href="{{ route('taskStatuses.create') }}" class="btn btn-primary">
  {{__('taskStatus.create')}}
</a>
@endauth
<table class="table mt-2">
  <thead>
    <tr>
      <th>{{__('taskStatus.id')}}</th>
      <th>{{__('taskStatus.name')}}</th>
      <th>{{__('taskStatus.created_at')}}</th>
      @auth
      <th>{{__('taskStatus.actions')}}</th>
      @endauth
    </tr>
  </thead>
  @foreach($taskStatuses as $taskStatus)
  <tr>
    <td>{{ $taskStatus->id }}</td>
    <td>{{ $taskStatus->name }}</td>
    <td>{{ $taskStatus->created_at }}</td>
    @auth
    <td>
      <a class="text-danger text-decoration-none" href="{{ route('taskStatuses.destroy', $taskStatus) }}" data-confirm="Вы уверены?" data-method="delete">
        {{__('taskStatus.delete')}}
      </a>
      <a class="text-decoration-none" href="{{ route('taskStatuses.edit', $taskStatus) }}">
        {{__('taskStatus.edit')}}
      </a>
    </td>
    @endauth
  </tr>
  @endforeach
</table>
@endsection