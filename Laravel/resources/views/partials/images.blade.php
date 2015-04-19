@if($images->first())
	<ul class="list-inline">
		@foreach($images as $image)
			<li class="home-list-items">{!! HTML::image("$image->image", null, ['class' => 'img-responsive']) !!}</li>
		@endforeach
	</ul>
@endif