@extends('app')

@section('content')

<section class="edit-quote">

	<h1 class="page-heading">Edit Quote</h1>

	{!! Form::open(['action' => 'QuotesController@store']) !!}

		<div class="form-group">
			{!! Form::label('quote', 'Add or Change Quote') !!}

			@if (is_object($quotes))
				{!! Form::textarea('quote', "$quotes->quote", ['class' => 'form-control' ]) !!}
			@else
				{!! Form::textarea('quote', null, ['class' => 'form-control']) !!}
			@endif
		</div>

		<div class="form-group">
			{!! Form::label('author', 'Add or Change Author') !!}

			@if (is_object($quotes))
				{!! Form::text('author', "$quotes->author", ['class' => 'form-control' ]) !!}
			@else
				{!! Form::text('author', null, ['class' => 'form-control']) !!}
			@endif
		</div>

		<div class="form-group">
			{!! Form::submit('Add Quote', ['class' => 'btn btn-primary form-control']) !!}
		</div>

	{!! Form::close() !!}

</section>

@endsection