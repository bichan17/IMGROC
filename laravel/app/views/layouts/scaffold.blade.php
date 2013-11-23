<!doctype html>
<html>
	<head>
	        <title>IMG/ROC</title>
		<meta charset="utf-8">
		{{ Asset::styles() }}
	        {{ Asset::scripts() }}
	</head>

	<body>

		<div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
		</div>

	</body>

</html>
