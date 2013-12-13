@extends('layouts.admin')

@section('main')
@parent

<h1>Edit Account</h1>

{{ Form::open(array('route'=>'editaccount', 'class'=>'user-account form-horizontal', 'role'=>'form')) }}
    <div class="form-group">
	{{ Form::label('fullname', 'Full Name *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::text('fullname', $user->fullname, array('class'=>'form-control', 'required' => 'required')) }}</div>
    </div>

    <div class="form-group">
	{{ Form::label('email', 'Email *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::email('email', $user->email, array('class'=>'form-control', 'required' => 'required')) }}</div>
    </div>

    <?php $ro = (!empty($user->username)); ?>
    <div class="form-group">
	{{ Form::label('username', 'Username *', array('class' => 'col-xs-3 control-label')) }}
	@if($ro)
	    <div class="col-xs-5">{{ Form::text('username', $user->username, array('class'=>'form-control', 'readonly'=>'readonly')) }}</div>
	@else
	    <div class="col-xs-5">{{ Form::text('username', $user->username, array('class'=>'form-control')) }}</div>
	@endif
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

    @if(User::find(Auth::user()->id)->admin() && $user["id"] !== "1") 
    <?php if(!isset($user->admin_level)) $user->admin_level = 1; ?>
    <div class="form-group">
	{{ Form::label('admin_level', 'Admin Level *', array('class' => 'col-xs-3 control-label')) }}
	<div class="col-xs-5">{{ Form::select('admin_level', array('0'=>'Superadmin', '1'=>'Moderator'), $user->admin_level, array('class' => 'form-control', 'required' => 'required')) }}</div>
    </div>
    @else
    {{ Session::flash('admin_level', Session::get('admin_level')) }}
    @endif

    {{ Form::hidden('id', $user->id) }}
    {{ Form::submit('Save', array('class'=>'col-xs-offset-3 btn btn-primary account-save-btn')) }}
    @if(Session::get('newUser'))
    {{ Form::submit('Cancel', array('name'=>'cancel','id'=>'cancel','class'=>'btn btn-warning account-cancel-btn')) }}
    {{ Session::flash('newUser', true) }}
    @endif
{{ Form::close() }}

@stop
