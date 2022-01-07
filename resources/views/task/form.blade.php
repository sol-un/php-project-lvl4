<div class="form-group mb-3">
  {{ Form::label('name', __('task.name')) }}
  {{ Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : null)]) }}
  @error('name')
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
<div class="form-group mb-3">
  {{ Form::label('description', __('task.description')) }}
  {{ Form::textarea('description', null, ['class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : null)]) }}
  @error('description')
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
<div class="form-group mb-3">
  {{ Form::label('status_id', __('task.status')) }}
  {{ Form::select('status_id', $taskStatuses, null, ['class' => 'form-control ' . ($errors->has('status_id') ? 'is-invalid' : null), 'placeholder' => '----------']) }}
  @error('status_id')
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
<div class="form-group mb-3">
  {{ Form::label('assigned_to_id', __('task.owner')) }}
  {{ Form::select('assigned_to_id', $users, null, ['class' => 'form-control ' . ($errors->has('assigned_to_id') ? 'is-invalid' : null), 'placeholder' => '----------']) }}
  @error('assigned_to_id')
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
<div class="form-group mb-3">
  {{ Form::label('labels', __('task.labels')) }}
  {{ Form::select('labels', $labels, null, ['class' => 'form-control', 'multiple' => true, 'name'=>'labels[]']) }}
</div>