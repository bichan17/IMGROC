@extends('layouts.scaffold')

@section('main')

@if(isset($provocation) && $provocation->count() > 0)
<div class="provContent" id="content">
    <div class="outer-center">
	<div class="inner-center">
	    <div class="provTypeImage">
		@if(!empty($provocation->img))
		<a href="{{{ $provocation->img }}}" title="Click for full size"><img src="{{{ $provocation->img }}}" alt="{{{ $provocation->title }}}" class="provImage" /></a>
		@endif
		@if(!empty($provocation->source))
		<a href="{{{ $provocation->source }}}" class="captionURL"><h4 class="caption">{{{ $provocation->title }}}</h4></a>
		@else
		<h4 class="caption">{{{ $provocation->title }}}</h4>
		@endif
		<p class="provCaption">{{{ $provocation->caption }}}</p>
	    </div>
	</div>
    </div>
    <div class="clear"></div>
</div>
@else
    There are no provocations.
@endif
@stop
