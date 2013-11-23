@extends('layouts.scaffold')

@section('main')

<h1>Edit Provocation</h1>
{{ Form::model($provocation, array('method' => 'PATCH', 'route' => array('provocations.update', $provocation->id))) }}
	<ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('source', 'Source:') }}
            {{ Form::text('source') }}
        </li>

        <li>
            {{ Form::label('img', 'Img:') }}
            {{ Form::text('img') }}
        </li>

        <li>
            {{ Form::label('caption', 'Caption:') }}
            {{ Form::textarea('caption') }}
        </li>

        <li>
            {{ Form::label('submitted_by', 'Submitted_by:') }}
            {{ Form::input('number', 'submitted_by') }}
        </li>

        <li>
            {{ Form::label('mod_status', 'Mod_status:') }}
            {{ Form::input('number', 'mod_status') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('provocations.show', 'Cancel', $provocation->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
