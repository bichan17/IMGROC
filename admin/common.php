<?php
	// Check the URI for a function variable
	if (isset($_GET['f']) && isset($_GET['callback']) && $_GET['f'] == "random")
		loadRandomProvocationJSON();
	else if (isset($_POST['type']))
		insertProvocation();
	
	function dbInit()
	{
		$mysqli = new mysqli("db.imagine.matt-critelli.com", "asdgfgasd", "imaginerochester", "imaginerochester");
		
		if ($mysqli->connect_errno)
			echo "Failed to connect to database: ({$mysqli->connect_errno}): {$mysqli->connect_error}";
		
		return $mysqli;
	}
		
	
	// Grabs the ID and Title for every provocation in the database
	// $ppLim = optional parameter that specifies how many records to return per page
	function listProvocations($start = 0, $end = 20)
	{
		$mysqli = dbInit();
		
		$resultsArr = array();
		
		$realStart = $start--;
		$diff = $end - $start;
		$diff <= 0 ? $diff = 20 : $diff = $diff;

		if ($stmt = $mysqli->prepare("SELECT id, title, type, author FROM provocations LIMIT ?, ?"))
		{
			// Pull (#diff between start and end) records from $start-1
			// If $start = 10 and $end = 20, records 10 thru 30 (inclusive) will be returned
			$stmt->bind_param('ii', $realStart, $diff);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $title, $type, $author);
			
			while ($stmt->fetch())
			{
				array_push($resultsArr, array($id, $title, $type, $author));
			}
			
			$stmt->free_result();
			$stmt->close();
		}
		
		return $resultsArr;
	}
	
	// TYPES:
	// 0 = link
	// 1 = image
	// 2 = text
	function insertProvocation()
	{		
		$mysqli = dbInit();
		//echo "inside insert";
		
		if ($_POST['type'] == "link")
		{
			//echo "inside link insert";
			if ($_POST['author'] == "" || $_POST['author'] == " ")
				$author = "\"Anonymous\"";
			else 
				$author = "\"{$_POST['author']}\"";
			
			!isset($_POST['linkURL']) ? die() : $linkURL = $_POST['linkURL'];
			$_POST['linkText'] = " " ? $linkText = $_POST['linkText'] : $linkText = false;
			$_POST['caption'] = " " ? $caption = $_POST['caption'] : $caption = false;
			
			$data = "\"";
			
			$data .= "<a href='{$linkURL}' class='provLink'>";
			$linkText ? $data .= "<h3>{$linkText}</h3>" : $data .= "<h3>{$linkURL}</h3>";
			$data .= "</a>";
			
			$caption ? $data .= "<h4>{$caption}</h4>" : $data .= "";
			$data .= "\"";
			
			$timestamp = time();
			
			$query = "INSERT INTO provocations VALUES(DEFAULT, 'NO_TITLE', 'NO_URL_TITLE', {$author}, {$data}, 'NO_TAGS_FOR_YOU', {$timestamp}, 0, 0)";
			//print_r(htmlspecialchars($query));
			
			if ($stmt = $mysqli->prepare($query))
			{
				//echo "inside prepare";
				$stmt->execute();
				$stmt->close();
				movePage(200, "../index.php/submitSuccess");
			}
		}
		else if ($_POST['type'] == "image")
		{
			//print_r($_POST);
			
			if ($_POST['author'] == "" || $_POST['author'] == " ")
				$author = "\"Anonymous\"";
			else 
				$author = "\"{$_POST['author']}\"";
				
			//$_POST['author'] == " " ? $author = "\"Anonymous\"" : $author = "\"{$_POST['author']}\"";
			!isset($_POST['fileURL']) ? die() : $imageURL = $_POST['fileURL'];
			$_POST['caption'] = " " ? $caption = $_POST['caption'] : $caption = false;
			$_POST['captionURL'] = " " ? $captionURL = $_POST['captionURL'] : $captionURL = false;

			$data = "\"<img src={$_POST['fileURL']} class='provImage' />\n";
			if ($caption)
			{
				if ($captionURL) $data .= "<a href='{$captionURL}' class='captionURL'>";
				
				$data .= "<h4 class='caption'>{$caption}</h4>";
				
				if ($captionURL) $data .= "</a>";
			}
			
			$data .= "\""; // make sure we close the quotes
			
			$timestamp = time();
			
			$query = "INSERT INTO provocations VALUES(DEFAULT, 'NO_TITLE', 'NO_URL_TITLE', {$author}, {$data}, 'NO_TAGS_FOR_YOU', {$timestamp}, 1, 0)";
			
			//print_r(htmlspecialchars($query));
			
			if ($stmt = $mysqli->prepare($query))
			{
				$stmt->execute();
				$stmt->close();
				movePage(200, "../index.php/submitSuccess");
			}
		}
		else if ($_POST['type'] == "text")
		{
			if ($_POST['author'] == "" || $_POST['author'] == " ")
				$author = "\"Anonymous\"";
			else 
				$author = "\"{$_POST['author']}\"";
			
			!isset($_POST['textData']) ? die() : $textData = $_POST['textData'];
			
			$data = "\"";
			
			$data .= "<p>{$textData}</p>";
			
			$data .= "\"";
			
			$timestamp = time();
			
			$query = "INSERT INTO provocations VALUES(DEFAULT, 'NO_TITLE', 'NO_URL_TITLE', {$author}, {$data}, 'NO_TAGS_FOR_YOU', {$timestamp}, 2, 0)";
			//print_r(htmlspecialchars($query));
			
			if ($stmt = $mysqli->prepare($query))
			{
				$stmt->execute();
				$stmt->close();
				movePage(200, "../index.php/submitSuccess");
			}
			else
				echo "uh oh, something went wrong";
			} 

		
	}

	// Loads a specific provocation from the DB based upon a single piece of data being passed in
	// This data can either be a number or a string (i.e. an id or a url_title)
	//
	// Returns: array object containing all data for this provocation (single row from the DB)
	function loadProvocation($specifier)
	{
		//echo "Inside function";
		// Connect to the database
		$mysqli = dbInit();
		
		$mysqlCol = (is_numeric($specifier)) ? "id" : "url_title";
		
		$arr = array();
		
		// If we connected successfully, query the DB with the supplied info
		if ($stmt = $mysqli->prepare("SELECT id, title, url_title, author, data, tags, timestamp, type FROM provocations WHERE {$mysqlCol}=? LIMIT 1"))
		{
			//echo "Prepared";
			// If we've got a number, that means we need to search by ID
			if (is_numeric($specifier))
				$stmt->bind_param('i', $specifier);
			else
				$stmt->bind_param('s', $specifier);
			
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $title, $urlTitle, $author, $data, $tags, $timestamp, $type);
			
			// Use an 'if' because there should only be 1 result
			if ($stmt->fetch())
			{
				// Need to add the type-specific div tags before we send the 'data' away
				// TYPES:
				// 0 = link
				// 1 = image
				// 2 = text
				$finishedData = "";
				
				if ($type == 0)
					$finishedData = "<div class=\"provTypeLink\">\n";
				else if ($type == 1)
					$finishedData = "<div class=\"provTypeImage\">\n";
				else if ($type == 2)
					$finishedData = "<div class=\"provTypeText\">\n";
				
				$finishedData .= $data;
				$finishedData .= "</div>";
				
				$arr['id'] = $id;
				$arr['title'] = $title;
				$arr['urlTitle'] = $urlTitle;
				$arr['author'] = $author;
				$arr['data'] = $finishedData;
				$arr['tags'] = $tags;
				$arr['timestamp'] = $timestamp;
				//array_push($arr, $title, $urlTitle, $author, $blob, $tags, $timestamp);
				//echo "Title: {$title}";
			}
			else {
				$arr = null;
			}
			
			$stmt->free_result();
			$stmt->close();
		}
		
		return $arr;
	}

	// Loads a random provocation from the DB
	// Handles generating the number as well as passing back the data
	//
	// Returns: array object containing all data for the provocation (single row from the DB)
	function loadRandomProvocation()
	{
		$mysqli = dbInit();
		
		// Will hold the id numbers
		$idArr = array();
		
		
		// Returns the ID of every valid entry in the provocations table
		// We can't use a count of the rows b/c there might be gaps in the ID numbers
		if ($stmt = $mysqli->prepare("SELECT id FROM provocations WHERE public=1"))
		{
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id);
			
			while ($stmt->fetch())
			{
				// Put all of the id's into an array
				array_push($idArr, $id);
			}
			
			$stmt->free_result();
			$stmt->close();
		}
		
		// Pull a random id from the array
		// Generate a random number between 0 and the array size (inclusive, so -1)
		return loadProvocation($idArr[rand(0, count($idArr) - 1)]);
	}
	
	// Only function that should be exposed to the public
	// Used to load a random provocation w/o refreshing the page
	//
	// Returns: JSON object containing all of the data for a provocation
	function loadRandomProvocationJSON()
	{
		$mysqli = dbInit();
		
		// Will hold the id numbers
		$idArr = array();
		
		
		// Returns the ID of every valid entry in the provocations table
		// We can't use a count of the rows b/c there might be gaps in the ID numbers
		if ($stmt = $mysqli->prepare("SELECT id FROM provocations"))
		{
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id);
			
			while ($stmt->fetch())
			{
				// Put all of the id's into an array
				array_push($idArr, $id);
			}
			
			$stmt->free_result();
			$stmt->close();
		}
		
		// Pull a random id from the array
		// Generate a random number between 0 and the array size (inclusive, so -1)
		$arr = loadProvocation($idArr[rand(0, count($idArr) - 1)]);
		
		//print $_GET['callback'] . '(' . json_encode($arr) . ')';
		print '(' . json_encode($arr) . ')';
	}
	
	function movePage($num,$url){
	   static $http = array (
	       100 => "HTTP/1.1 100 Continue",
	       101 => "HTTP/1.1 101 Switching Protocols",
	       200 => "HTTP/1.1 200 OK",
	       201 => "HTTP/1.1 201 Created",
	       202 => "HTTP/1.1 202 Accepted",
	       203 => "HTTP/1.1 203 Non-Authoritative Information",
	       204 => "HTTP/1.1 204 No Content",
	       205 => "HTTP/1.1 205 Reset Content",
	       206 => "HTTP/1.1 206 Partial Content",
	       300 => "HTTP/1.1 300 Multiple Choices",
	       301 => "HTTP/1.1 301 Moved Permanently",
	       302 => "HTTP/1.1 302 Found",
	       303 => "HTTP/1.1 303 See Other",
	       304 => "HTTP/1.1 304 Not Modified",
	       305 => "HTTP/1.1 305 Use Proxy",
	       307 => "HTTP/1.1 307 Temporary Redirect",
	       400 => "HTTP/1.1 400 Bad Request",
	       401 => "HTTP/1.1 401 Unauthorized",
	       402 => "HTTP/1.1 402 Payment Required",
	       403 => "HTTP/1.1 403 Forbidden",
	       404 => "HTTP/1.1 404 Not Found",
	       405 => "HTTP/1.1 405 Method Not Allowed",
	       406 => "HTTP/1.1 406 Not Acceptable",
	       407 => "HTTP/1.1 407 Proxy Authentication Required",
	       408 => "HTTP/1.1 408 Request Time-out",
	       409 => "HTTP/1.1 409 Conflict",
	       410 => "HTTP/1.1 410 Gone",
	       411 => "HTTP/1.1 411 Length Required",
	       412 => "HTTP/1.1 412 Precondition Failed",
	       413 => "HTTP/1.1 413 Request Entity Too Large",
	       414 => "HTTP/1.1 414 Request-URI Too Large",
	       415 => "HTTP/1.1 415 Unsupported Media Type",
	       416 => "HTTP/1.1 416 Requested range not satisfiable",
	       417 => "HTTP/1.1 417 Expectation Failed",
	       500 => "HTTP/1.1 500 Internal Server Error",
	       501 => "HTTP/1.1 501 Not Implemented",
	       502 => "HTTP/1.1 502 Bad Gateway",
	       503 => "HTTP/1.1 503 Service Unavailable",
	       504 => "HTTP/1.1 504 Gateway Time-out"
	   );
	   header($http[$num]);
	   header ("Location: $url");
	}
?>