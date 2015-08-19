@if($images->first())
	<ul class="list-inline images">
		@foreach($images as $image)
			<li>{!! HTML::image("$image->image", null, ['class' => 'img-responsive']) !!}</li>
		@endforeach
	</ul>
@endif