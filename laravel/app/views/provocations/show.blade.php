@extends('layouts.scaffold')

@section('main')

<h1>Show Provocation</h1>

<p>{{ link_to_route('provocations.index', 'Return to all provocations') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Title</th>
				<th>Source</th>
				<th>Img</th>
				<th>Caption</th>
				<th>Submitted_by</th>
				<th>Mod_status</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $provocation->title }}}</td>
					<td>{{{ $provocation->source }}}</td>
					<td>{{{ $provocation->img }}}</td>
					<td>{{{ $provocation->caption }}}</td>
					<td>{{{ $provocation->submitted_by }}}</td>
					<td>{{{ $provocation->mod_status }}}</td>
                    <td>{{ link_to_route('provocations.edit', 'Edit', array($provocation->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('provocations.destroy', $provocation->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
