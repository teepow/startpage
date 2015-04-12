@extends('app')

@section('content')
	@unless(\Auth::user()->todos->first())
	<a href="/todos/create" class="btn btn-default btn-lg">Create a Todo List</a>
	@endunless
		<ul class="list-group">
		 	@foreach(\Auth::user()->todos as $todo)
				<li class="list-group-item">{{ $todo->activity }}</li>
		 	 @endforeach
		 </ul>	
@stop