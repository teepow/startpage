@extends('app')

@section('content')
<div class="col-lg-3">	
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
<div class="col-lg-6">
	<h1 class="page-heading home-heading">Content</h1>
</div>
<div class="col-lg-3">
	<h1 class="page-heading home-heading">Content</h1>
</div>
@stop