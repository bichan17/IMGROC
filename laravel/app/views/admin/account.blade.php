@extends('layouts.admin')

@section('main')
@parent

<h1>Your Account</h1>

{{ Form::open(array('route'=>'account', 'class'=>'user-account form-horizontal', 'role'=>'form')) }}
    <div class="form-group">
	{{ Form::label('fullname', 'Full Name *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::text('fullname', $user->fullname, array('class'=>'form-control', 'required' => 'required')) }}</div>
    </div>

    <div class="form-group">
	{{ Form::label('email', 'Email *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::email('email', $user->email, array('class'=>'form-control', 'required' => 'required')) }}</div>
    </div>

    <div class="form-group">
	{{ Form::label('username', 'Username *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::text('username', $user->username, array('class'=>'form-control', 'readonly'=>'readonly')) }}</div>
    </div>

    <div class="form-group">
	{{ Form::label('password', 'New Password', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Enter a new password...')) }}</div>
    </div>

    <div class="form-group">
	{{ Form::label('password_confirmation', 'Confirm New Password', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Repeat that password...')) }}</div>
    </div>

    <div class="form-group">
	{{ Form::label('notes', 'Notes', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::textarea('notes', $user->notes, array('class' => 'form-control', 'rows' => '3')) }}</div>
    </div>

    @if(User::find($user->id)->admin()) 
    <div class="form-group">
	{{ Form::label('admin_level', 'Admin Level *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::select('admin_level', array('0'=>'Superadmin', '1'=>'Moderator'), $user->admin_level, array('class' => 'form-control', 'required' => 'required')) }}</div>
    </div>
    @endif

    {{ Form::hidden('id', $user->id) }}
    {{ Form::submit('Save', array('class'=>'col-xs-offset-4 btn btn-primary')) }}
{{ Form::close() }}

@stop
