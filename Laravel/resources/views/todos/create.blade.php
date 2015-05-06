@extends('app')

@section('content')

<section class="edit-todos">
	
	<h1 class="page-heading">Create New Todo</h1>

	{!! Form::open(['action' => 'ToDoController@store']) !!}

		<div class="form-group">
			{!! Form::label('activity', 'Activity:') !!}
			{!! Form::textarea('activity', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Add Activity', ['class' => 'btn btn-primary form-control']) !!}
		</div>

	{!! Form::close() !!}

	@include('errors.list')

</section>

@endsection