@extends('app')

@section('content')

<section class="favorites">

	@if($favorites->first())
		<ul class="list-inline">
			@foreach($favorites as $favorite)
				<li>
					<a href="{!! $favorite->link !!}">{!! $favorite->name !!}</a>
				</li>
			@endforeach
		</ul>
	@else 
		<p>You have no favorites to show</p>
	@endif

</section>

<section class="row">

	@include('partials.images')

	<div class="col-lg-3 todos">	
		<h1 class="page-heading">Todo List</h1>
		@if(count($todos))
			<ul class="list-group">
			 	@foreach($todos as $todo)
					<li class="list-group-item">
						{{ $todo->activity }}
						{!! Form::open(['data-remote', 'method' => 'PATCH', 'url' => 'todos/' . $todo->id]) !!}
						{!! Form::checkbox('content_removed', $todo->content_removed, $todo->content_removed, ['data-click-submits-form']) !!}
						{!! Form::close() !!}
					</li>
			 	 @endforeach
		 	</ul>
		 	{!! Form::button('Remove', ['class' => 'btn btn-default btn-lg', 'onClick' => 'window.location.reload()']) !!}
		 @endif
		 <a href="/todos/create" class="btn btn-default btn-lg">Add</a>
	</div>

	<div class="col-lg-6 quote">
		<h1 class="page-heading">Quote</h1>
		<blockquote>
			@foreach($quote as $line)
				{{ $line }}  <br>
				@if($author)
					<cite>{{ '-' . $author }}</cite>
				@endif
			@endforeach
		</blockquote>
	</div>

	<div class="col-lg-3 facebook">
		<h1 class="page-heading">Facebook Posts</h1>
		<a href="{{ url($loginUrl) }}">Update</a>

		@if(($facebooks))
			<ul class="list-group">
				@if(!is_object($facebooks))
					{{ $facebooks }}
				@else
					@foreach($facebooks as $facebook)
						<li class="list-group-item">
							{{ $facebook->post }}
						</li>
					@endforeach
				@endif
			</ul>
		@endif
		
	</div>

</section>

@stop