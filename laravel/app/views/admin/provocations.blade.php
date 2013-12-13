@extends('layouts.admin')

@section('main')
@parent

<?php $trash = (isset($trash)) ? $trash : false; ?>

<h1>{{ ($trash) ? 'Trashed' : 'All' }} Provocations</h1>

@if (!empty($provocations) && $provocations->count())
	<table class="table table-striped table-bordered table-provs">
		<thead>
			<tr>
				<th>Title</th>
				<th>Source URL</th>
				<th>Image</th>
				<th>Caption</th>
				<th>Submitted</th>
				{{ ($trash) ? '<th>Deleted</th>' : '' }}
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($provocations as $provocation)
<?php
    unset($class);
    if($provocation->mod_status === "0") {
	$status = 'Awaiting moderation';
	$class = 'warning';
    } elseif($provocation->mod_status === "1") $status = 'Approved';
    elseif($provocation->mod_status === "2") {
	$status = 'Rejected';
	$class = 'danger';
    } else $status = '???';
?>
				<tr {{ (isset($class)) ? 'class="'.$class.'"' : '' }}>
					<td>{{{ $provocation->title }}}</td>
					<td>{{{ $provocation->source }}}</td>
					<td>{{ ($provocation->img) ? '<img src="'.$provocation->img.'" alt="'.$provocation->title.'" />' : 'No image' }}</td>
					<td>{{{ $provocation->caption }}}</td>
					<td>{{{ $provocation->created_at }}}</td>
					{{ ($trash) ? '<td>'.$provocation->deleted_at.'</td>' : '' }}
					<td>{{{ $status }}}</td>
@if($trash)
    <td>
	<table>
	    <tr class="center">
                    <td>
                        {{ Form::open(array('route' => 'allprovs')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('restore', 'true') }}
                            {{ Form::submit('Restore', array('class' => 'btn btn-info')) }}
                        {{ Form::close() }}
                    </td>
	    </tr>
	    <tr class="center">
                    <td>
                        {{ Form::open(array('route' => 'allprovs')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('destroy', 'true') }}
                            {{ Form::submit('Delete Forever', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
	    </tr>
	</table>
    </td>
@else
    <td>
	<table>
	    @if($provocation->mod_status != "1")
		<tr class="center">
		    <td>
			{{ Form::open(array('route' => 'modqueue')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('status', '1') }}
			    {{ Form::submit('Accept', array('class' => 'btn btn-success')) }}
			{{ Form::close() }}
		    </td>
		</tr>
	    @endif
	    @if($provocation->mod_status != "2")
		<tr class="center">
		    <td>
			{{ Form::open(array('route' => 'modqueue')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('status', '2') }}
			    {{ Form::submit('Reject', array('class' => 'btn btn-warning')) }}
			{{ Form::close() }}
		    </td>
		</tr>
	    @endif
	    <tr class="center">
		<td>
		    {{ Form::open(array('route' => 'allprovs')) }}
			{{ Form::hidden('provocation', $provocation->id) }}
			{{ Form::hidden('delete', 'true') }}
			{{ Form::submit('Trash', array('class' => 'btn btn-danger')) }}
		    {{ Form::close() }}
		</td>
	    </tr>
	</table>
    </td>
@endif
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	{{ ($trash) ? 'You have' : 'There are' }} no {{ ($trash) ? 'trashed ' : '' }}provocations.
@endif

@stop
