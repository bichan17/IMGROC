@extends('layouts.scaffold')

@section('main')

<h1>Create Provocation</h1>

{{ Form::open(array('route' => 'submit', 'class' => 'form-horizontal submit-provocation', 'files' => true)) }}
    <div class="form-group">
            {{ Form::label('title', 'Title *', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
            {{ Form::text('title','',array('class' => 'form-control')) }}
	</div>
    </div>

    <div class="form-group">
            {{ Form::label('source', 'Source', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
            {{ Form::text('source', '', array('class' => 'form-control')) }}
	</div>
    </div>

    <div class="form-group">
            {{ Form::label('img', 'Img', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
	    {{ Form::file('img', array('class' => 'form-control')) }}
	</div>
    </div>

    <div class="form-group">
            {{ Form::label('caption', 'Caption', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
            {{ Form::textarea('caption','',array('class' => 'form-control')) }}
	</div>
    </div>

    {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
{{ Form::close() }}

@stop
