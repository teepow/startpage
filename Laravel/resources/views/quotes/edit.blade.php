@extends('app')

@section('content')

	{!! Form::open(['action' => 'QuotesController@store']) !!}

		<div class="form-group">
			{!! Form::label('quote', 'Add or Change Quote') !!}
			{!! Form::textarea('quote', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('author', 'Add or Change Author') !!}
			{!! Form::text('author', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::checkbox('random') !!}
			{!! Form::label('Use random quote (Unix fortune)') !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Add Quote', ['class' => 'btn btn-primary form-control']) !!}
		</div>

	{!! Form::close() !!}



@endsection