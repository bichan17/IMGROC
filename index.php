<?php
	include ("common.php");
	// Grab the current URI!
	$URI = $_SERVER["REQUEST_URI"];

	// echo "URI: " . $URI;

	// Check for and strip the trailing slash from the URI
	if ($URI[strlen($URI) - 1] == '/')
		$URI = substr($URI, 0, -1);
	
	//echo "URI: " . $URI;
		
	// Get the 3rd section of the URI (should be in format: domain.com/index.php/RELAVENT_BIT) - we want the RELEVANT_BIT
	$URI_split = explode('/', $URI);

	if ($URI_split[0] == NULL) 
		array_splice($URI_split, 0, 1);

	//echo "Segment Count: " . count($URI_split);
	// If the RELEVANT_BIT is there, we'll use that to load in the appropriate controller from the /inc folder
	if (count($URI_split) > 1)
	{
		// echo "<br>";
		// print_r($URI_split);
		// Make sure everything is in lowercase
		$URI_split[1] = strtolower($URI_split[1]);
		// echo "<br>{$URI_split[1]}";

		include("../imgroc/inc/{$URI_split[1]}.php");
		// include("../imgroc/inc/about.php");

	}
	else {
		include("../imgroc/inc/intro.php");
	}
?>