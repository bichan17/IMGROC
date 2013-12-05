@extends('layouts.scaffold')

@section('main')
    <ul id="admin-nav" class="nav nav-tabs" role="navigation">
	<h4>{{ (Auth::user()->admin_level) ? 'MODERATOR' : 'ADMIN' }} MENU</h4>
	<li {{ (Route::currentRouteName() == 'modqueue') ? 'class="active"' : ''}}><a href="{{ URL::route('modqueue') }}">Mod Queue</a></li>
	<li {{ (Route::currentRouteName() == 'allprovs') ? 'class="active"' : ''}}><a href="{{ URL::route('allprovs') }}">Provocations</a></li>
	<li {{ (Route::currentRouteName() == 'trashedprovs') ? 'class="active"' : ''}}><a href="{{ URL::route('trashedprovs') }}">Trash Bin</a></li>
	<li {{ (Route::currentRouteName() == 'account') ? 'class="active"' : ''}}><a href="{{ URL::route('account') }}">Account</a></li>
	@if(Auth::check() && Auth::user()->admin_level == '0')
	<li {{ (Route::currentRouteName() == 'users') ? 'class="active"' : ''}}><a href="{{ URL::route('users') }}">Users</a></li>
	@endif
    </ul>
@stop
