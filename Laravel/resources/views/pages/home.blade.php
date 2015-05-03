@extends('app')

@section('content')

@include('partials.images')

<div class="col-lg-3 home-content">	
	<h1 class="page-heading home-heading">Todo List</h1>
	@if($todos->first())
		<ul class="list-group">
		 	@foreach($todos as $todo)
				<li class="list-group-item todo-list-items">
					{{ $todo->activity }}
					{!! Form::open(['data-remote', 'method' => 'PATCH', 'url' => 'todos/' . $todo->id, 'class' => 'content-removed-form']) !!}
					{!! Form::checkbox('content_removed', $todo->content_removed, $todo->content_removed, ['data-click-submits-form']) !!}
					{!! Form::close() !!}
				</li>
		 	 @endforeach
	 	</ul>
	 	{!! Form::button('Remove', ['class' => 'btn btn-default btn-lg', 'onClick' => 'window.location.reload()']) !!}
	 @endif
	 <a href="/todos/create" class="btn btn-default btn-lg todo-button">Add</a>
</div>

<div class="col-lg-6 home-content">
	<h1 class="page-heading home-heading">Content</h1>
	<blockquote>
		@foreach($quote as $line)
			{!! $line . '<br>' !!}
			@if($author)
				<cite>{{ '-' . $author }}</cite>
			@endif
		@endforeach
	</blockquote>
</div>

<div class="col-lg-3 home-content">
	<h1 class="page-heading home-heading">Content</h1>
	@if(($facebooks))
		<ul class="list-group">
			@if(!is_object($facebooks))
				{!! $facebooks !!}
			@else
				@foreach($facebooks as $facebook)
					<li class="list-group-item">
						{!! $facebook->post !!}
					</li>
				@endforeach
			@endif
		</ul>
	@endif
	<a href="{{ url($loginUrl) }}">Update</a>
</div>

@if($favorites->first())
	<ul class="list-inline">
		@foreach($favorites as $favorite)
			<li class="edit-favorites-list-items">
				<a href="{!! $favorite->link !!}">{!! $favorite->name !!}</a>
			</li>
		@endforeach
	</ul>
@endif

@stop