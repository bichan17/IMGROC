<!doctype html>
<html>
	<head>
	        <title>IMG/ROC</title>
		<meta charset="utf-8">
		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/imgroc.css') }}
	</head>

	<body>
		<div class="container">
		    <div class="header">
			<a href="{{ URL::route('index') }}"><img src="{{ URL::asset('img/logo.png') }}" alt="IMGROC"></a>
			@if (Session::has('message'))
			    <div class="alert alert-warning alert-dismissable">
				<p>{{ Session::get('message') }}</p>
			    </div>
			@elseif (Session::has('error'))
			    <div class="alert alert-danger alert-dismissable">
				<p>{{ Session::get('error') }}</p>
			    </div>
			@elseif (count($errors) > 0)
			    <div class="alert alert-danger alert-dismissable">
				<ul>
				@foreach ($errors->all('<li>:message</li>') as $error)
				    {{ $error }}
				@endforeach
				</ul>
			    </div>
			@endif
		    </div>
		    <div id="topButtons">
			<span id="next">
		    @if(Route::currentRouteName() == 'index')
			    <a href="{{ URL::route('index') }}" id="seeNext"><span class="icon" id="refreshIcon"></span>Next</a>
		    @endif
			</span>
		    </div>
		    <div id="sideButtons">
			<a href="#intro" id="introLink" class="fancybox" data-fancybox-width="800" data-fancybox-height="232">Introduction</a>
			<a href="{{ URL::route('submit') }}">Submit</a>
			<a href="#about" id="aboutLink" class="fancybox" data-fancybox-width="800" data-fancybox-height="600">About</a>
			@if(Auth::check())
			    {{ HTML::link('admin', 'Admin') }}
			    {{ HTML::link('logout', 'Logout') }}
			@endif
		    </div>
		    <div id="provContainer">
			@yield('main')
		    </div>
		</div>
	</body>
</html>
