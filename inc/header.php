   <!DOCTYPE html>
<html>
	<head>
		<?php
			if (isset($title))
				echo "\t<title>{$title}</title>\n";
			else
				echo "\t<title>Imag(in)ing Rochester</title>\n";
		?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<link rel="stylesheet" type="text/css" media="screen" href="/style/style.css" />
		<script type="text/javascript" src="/scripts/modernizr.js"></script>
		<?php
			if (isset($customScripts))
				for ($i = 0; $i < count($customScripts); $i++)
					// echo check here
					echo "<script type=\"text/javascript\" src=\"{$customScripts[$i]}\"></script>\n";		
		?>
		<!-- <script src="/scripts/provocationLoader.js" type="text/javascript"></script> -->
	</head>
	<body>
		<div class="wrapper">
			<div class="header">
				<a href="/index.php"><h1>Imag(in)ing Rochester</h1></a>
			</div>