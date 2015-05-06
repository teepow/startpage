@extends('app')

@section('content')

<section class="edit-favorites">

	<h1 class="page-heading">Remove Favorite</h1>

	@if($favorites->first())
		<ul class="list-inline">
			@foreach($favorites as $favorite)
				<li class="edit-favorites-list-items">
					<a href="{!! $favorite->link !!}">{!! $favorite->name !!}</a>
					{!! Form::open(['data-remote', 'method' => 'PATCH', 'url' => 'favorites/' . $favorite->id]) !!}
					
						{!! Form::submit('Remove') !!}

					{!! Form::close() !!}
				</li>
			@endforeach
		</ul>
	@else 
		<p>You have no favorites to show</p>
	@endif
		

</section>

<section class="favorites-form">

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

</section>

@endsection