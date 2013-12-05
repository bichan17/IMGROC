@extends('layouts.scaffold')

@section('main')

@if($provocation->count() > 0)
<div class="provContent" id="content">
    <div class="outer-center">
	<div class="inner-center">
	    <div class="provTypeImage">
		<img src="{{{ $provocation->img }}}" alt="{{{ $provocation->title }}}" class="provImage" />
		<a href="{{{ $provocation->source }}}" class="captionURL"><h4 class="caption">{{{ $provocation->title }}}</h4></a>
		<p class="provCaption">{{{ $provocation->caption }}}</p>
		<cite>Submitted by: {{{ $provocation->submitted_by }}}</cite>
	    </div>
	</div>
    </div>
    <div class="clear"></div>
</div>
@else
    There are no provocations.
@endif
@stop
