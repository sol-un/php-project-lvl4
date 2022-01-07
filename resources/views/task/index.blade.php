@extends('layouts.app')

@section('content')
<h1 class="mb-5">{{__('task.tasks')}}</h1>
@auth
<div class="d-flex mb-3">
    <div>
        {{Form::open(['url' => route('tasks.index'), 'method' => 'GET'])}}
        <div class="row g-1">
            <div class="col">
                {{ Form::select('status_id', $taskStatuses, old('filter.status_id'), ['class' => 'form-select me-2', 'placeholder' => __('task.status'), 'name' => 'filter[status_id]']) }}
            </div>
            <div class="col">
                {{ Form::select('created_by_id', $users, old('filter.created_by_id'), ['class' => 'form-select me-2', 'placeholder' =>  __('task.creator'), 'name' => 'filter[created_by_id]']) }}
            </div>
            <div class="col">
                {{ Form::select('assigned_to_id', $users, old('filter.assigned_to_id'), ['class' => 'form-select me-2', 'placeholder' =>  __('task.owner'), 'name' => 'filter[assigned_to_id]']) }}
            </div>
            <div class="col">
                {{ Form::submit(__('task.filter'), ['class' => 'btn btn-outline-primary me-2']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="ms-auto">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            {{__('task.create')}}
        </a>
    </div>
</div>
@endauth
<table class="table me-2">
    <thead>
        <tr>
            <th>{{__('task.id')}}</th>
            <th>{{__('task.status')}}</th>
            <th>{{__('task.name')}}</th>
            <th>{{__('task.creator')}}</th>
            <th>{{__('task.owner')}}</th>
            <th>{{__('task.created_at')}}</th>
            @auth
            <th>{{__('task.actions')}}</th>
            @endauth
        </tr>
    </thead>
    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->id }}</td>
        <td>{{ $task->status->name }}</td>
        <td>
            <a class="text-decoration-none" href="{{ route('tasks.show', $task) }}">
                {{ $task->name }}
            </a>
        </td>
        <td>{{ $task->creator->name }}</td>
        <td>{{ optional($task->owner)->name }}</td>
        <td>{{ $task->created_at }}</td>
        @auth
        <td>
            @can('delete-task', $task)
            <div>
                <a class="text-danger text-decoration-none" href="{{ route('tasks.destroy', $task) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">
                    {{__('task.delete')}}
                </a>
            </div>
            @endcan
            <a class="text-decoration-none" href="{{ route('tasks.edit', $task) }}">
                {{__('task.edit')}}
            </a>
        </td>
        @endauth
    </tr>
    @endforeach
</table>
@endsection