@extends('app')

@section('content')

	<h1 class="page-heading">Add New Photo</h1>

	{!! Form::open(['action' => 'PhotosController@store',  'files' => true]) !!}

	<div class="form-group">
		{!! Form::label('file', 'Add a Photo') !!}
		{!! Form::file('file') !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Add Photo', ['class' => 'btn btn-primary form-control']) !!}
	</div>

	{!! Form::close() !!}

	@include('errors.list')

@endsection