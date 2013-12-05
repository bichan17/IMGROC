@extends('layouts.admin')

@section('main')
@parent

<h1>Provocations in Limbo</h1>

@if (!empty($provocations) && $provocations->count())
    <table class="table table-striped table-bordered">
	<thead>
	    <tr>
		    <th>Title</th>
		    <th>Source URL</th>
		    <th>Image</th>
		    <th>Caption</th>
		    <th>Submitted</th>
	    </tr>
	</thead>

	<tbody>
	    @foreach($provocations as $provocation)
		<tr>
		    <td>{{{ $provocation->title }}}</td>
		    <td>{{{ $provocation->source }}}</td>
		    <td>{{{ ($provocation->img) ? '<img src="'.$provocation->img.'" alt="'.$provocation->title.'" />' : 'No image' }}}</td>
		    <td>{{{ $provocation->caption }}}</td>
		    <td>{{{ $provocation->created_at }}}</td>
		    <td>
			{{ Form::open(array('route' => 'modqueue')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('status', '1') }}
			    {{ Form::submit('Accept', array('class' => 'btn btn-success')) }}
			{{ Form::close() }}
		    </td>
		    <td>
			{{ Form::open(array('route' => 'modqueue')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('status', '2') }}
			    {{ Form::submit('Reject', array('class' => 'btn btn-warning')) }}
			{{ Form::close() }}
		    </td>
		    <td>
			{{ Form::open(array('route' => 'modqueue')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('delete', 'true') }}
			    {{ Form::submit('Trash', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}
		    </td>
		</tr>
	    @endforeach
	</tbody>
    </table>
@else
	There are no provocations in the moderation queue.
@endif

@stop
