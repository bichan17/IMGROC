@extends('layouts.admin')

@section('main')
@parent

<?php $trash = (isset($trash)) ? $trash : false; ?>

<h1>{{ ($trash) ? 'Trashed' : 'All' }} Provocations</h1>

@if (!empty($provocations) && $provocations->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th>Source URL</th>
				<th>Image</th>
				<th>Caption</th>
				<th>Submitted At</th>
				{{ ($trash) ? '<th>Deleted At</th>' : '' }}
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
					<td>{{{ $provocation->created_at }}}</td>
					{{{ ($trash) ? '<td>'.$provocation->deleted_at.'</td>' : '' }}}
					<td>{{{ $status }}}</td>
<?php if($trash) : ?>
                    <td>
                        {{ Form::open(array('route' => 'allprovs')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('restore', 'true') }}
                            {{ Form::submit('Restore', array('class' => 'btn btn-info')) }}
                        {{ Form::close() }}
                    </td>
                    <td>
                        {{ Form::open(array('route' => 'allprovs')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('destroy', 'true') }}
                            {{ Form::submit('Delete Forever', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
<?php else: ?>
                    <td>
                        {{ Form::open(array('route' => 'allprovs')) }}
			    {{ Form::hidden('provocation', $provocation->id) }}
			    {{ Form::hidden('delete', 'true') }}
                            {{ Form::submit('Trash', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
<?php endif; ?>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	{{ ($trash) ? 'You have' : 'There are' }} no {{ ($trash) ? 'trashed ' : '' }}provocations.
@endif

@stop
