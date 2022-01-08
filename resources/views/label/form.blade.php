{{ Form::label('name', __('label.name')) }}
{{ Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : null)]) }}
@error('name')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
<br>
{{ Form::label('description', __('label.description')) }}
{{ Form::textArea('description', null, ['class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : null)]) }}
@error('description')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
<br>