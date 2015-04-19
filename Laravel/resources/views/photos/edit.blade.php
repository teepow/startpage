@extends('app')

@section('content')

@if($images->first())
	<ul class="list-inline">
		@foreach($images as $image)
			<li class="edit-photos-list-items">{!! HTML::image("$image->image", null, ['class' => 'img-responsive']) !!}
				{!! Form::open(['data-remote', 'method' => 'PATCH', 'url' => 'photos/' . $image->id]) !!}

					{!! Form::checkbox("$image->id", "$image->id") !!}
					{!! Form::submit('Remove') !!}

				{!! Form::close() !!}
			</li>
		@endforeach
	</ul>
@endif

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