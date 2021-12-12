@extends('layouts.app')

@section('content')
<h1 class="mb-5">Статусы</h1>
<table class="table mt-2">
  <thead>
    <tr>
      <th>ID</th>
      <th>Имя</th>
      <th>Дата создания</th>
    </tr>
  </thead>
  @foreach($statuses as $status)
  <tr>
    <td>{{ $status->id }}</td>
    <td>{{ $status->name }}</td>
    <td>{{ $status->created_at }}</td>
  </tr>
  @endforeach
</table>
@endsection