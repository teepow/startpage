@extends('app')

@section('content')

@if($favorites->first())
	<ul class="list-inline">
		@foreach($favorites as $favorite)
			<li class="edit-favorites-list-items">
				<a href="{!! $favorite->link !!}">{!! $favorite->name !!}</a>
				{!! Form::open(['data-remote', 'method' => 'PATCH', 'url' => 'favorites/' . $favorite->id]) !!}

					{!! Form::checkbox("$favorite->id", "$favorite->id") !!}
					{!! Form::submit('Remove') !!}

				{!! Form::close() !!}
			</li>
		@endforeach
	</ul>
@endif

	<h1 class="page-heading">Add New Favorite</h1>

	{!! Form::open(['action' => 'FavoritesController@store']) !!}

		<div class="form-group">
			{!! Form::label('link', 'Enter the Name of Your Favorite Website') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('link', 'Enter the Link to Your Favorite Website') !!}
			{!! Form::text('link', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Add Favorite', ['class' => 'btn btn-primary form-control']) !!}
		</div>

	{!! Form::close() !!}

	@include('errors.list')

@endsection