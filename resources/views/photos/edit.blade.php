@extends('app')

@section('content')

<section class="edit-photos">

	<h1 class="page-heading">Remove Photo</h1>

	@if(count($images))
		<ul class="list-inline">
			@foreach($images as $image)
				<li>{!! HTML::image("$image->image", null, ['class' => 'img-responsive']) !!}
					{!! Form::open(['data-remote', 'method' => 'PATCH', 'url' => 'photos/' . $image->id]) !!}

						{!! Form::submit('Remove') !!}

					{!! Form::close() !!}
				</li>
			@endforeach
		</ul>
	@else 
		<p>You have no photos to show</p>
	@endif

</section>

<section class="photos-form">

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

</section>

@endsection