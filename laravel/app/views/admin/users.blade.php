@extends('layouts.admin')

@section('main')
@parent

<h1>Existing Users</h1>

<a href="{{ URL::route('adduser') }}" title="Add a user" class="btn btn-primary">Add User</a>

@if (!empty($users) && $users->count())
    <table class="table table-striped table-bordered">
	<thead>
	    <tr>
		    <th>Full Name</th>
		    <th>Email</th>
		    <th>Username</th>
		    <th>Notes</th>
		    <th>Admin Level</th>
	    </tr>
	</thead>

	<tbody>
	    @foreach($users as $user)
<?php
    if($user->admin_level === "0") $status = 'Superadmin';
    elseif($user->admin_level === "1") $status = 'Moderator';
    else $status = '???';
?>
		<tr>
		    <td>{{{ $user->fullname }}}</td>
		    <td>{{{ $user->email }}}</td>
		    <td>{{{ $user->username }}}</td>
		    <td>{{{ $user->notes }}}</td>
		    <td>{{{ $status }}}</td>
		    <td>
			{{ Form::open(array('route' => 'account')) }}
			    {{ Form::hidden('id', $user->id) }}
			    {{ Form::hidden('edit', 'true') }}
			    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
			{{ Form::close() }}
		    </td>
		    @if($user->id !== "1")
		    <td>
			{{ Form::open(array('route' => 'account')) }}
			    {{ Form::hidden('id', $user->id) }}
			    {{ Form::hidden('delete', 'true') }}
			    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}
		    </td>
		    @endif
		</tr>
	    @endforeach
	</tbody>
    </table>
@else
	There are no users...how did you get back here anyway?
@endif

@stop
