@extends('app')

@section('content')
	<h1 class="page-heading">Create New ToDo</h1>

	{!! Form::open() !!}

		<div class="form-group">
			{!! Form::label('activity', 'Activity:') !!}
			{!! Form::textarea('activity', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('', ['class' => 'btn btn-primary form-control']) !!}
		</div>

	{!! Form::close() !!}
@endsection