<!DOCTYPE html>
<html>
	<head>
		<?php
			if (isset($title))
				echo "\t<title>{$title}</title>\n";
			else
				echo "\t<title>IMGROC</title>\n";
		?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,400italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/scripts/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<link rel="stylesheet" href="/scripts/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<link rel="stylesheet" href="/scripts/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" media="screen" href="/style/style.css" />
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<script type="text/javascript" src="/scripts/modernizr.js"></script>
		<?php
			if (isset($customScripts))
				for ($i = 0; $i < count($customScripts); $i++)
					echo "<script type=\"text/javascript\" src=\"{$customScripts[$i]}\"></script>\n";		
		?>
		<!-- <script src="/scripts/provocationLoader.js" type="text/javascript"></script> -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-45059223-1', 'imgroc.com');
		  ga('send', 'pageview');

		</script>
	</head>
	<body>
		<div class="wrapper">
			<div class="header">
				<a href="/index.php"><img src="/assets/logo.png" alt="IMGROC"></a>
			</div>