@extends('layouts.scaffold')

@section('main')

<h1>All Provocations</h1>

@if (!empty($provocations) && $provocations->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Source URL</th>
				<th>Image</th>
				<th>Caption</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($provocations as $provocation)
<?php                           
    if($provocation->mod_status === 0) $status = 'Awaiting moderation';
    elseif($provocation->mod_status === 1) $status = 'Approved';
    elseif($provocation->mod_status === 2) $status = 'Rejected';
    else $status = '???';
?>
				<tr>
					<td>{{{ $provocation->title }}}</td>
					<td>{{{ $provocation->source }}}</td>
					<td>{{{ ($provocation->img) ? '<img src="'.$provocation->img.'" alt="'.$provocation->title.'" />' : 'No image' }}}</td>
					<td>{{{ $provocation->caption }}}</td>
					<td>{{{ $status }}}</td>
                    <td>{{ link_to_route('provocations.edit', 'Edit', array($provocation->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('provocations.trash', $provocation->id))) }}
                            {{ Form::submit('Trash', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no provocations.
@endif

@stop
