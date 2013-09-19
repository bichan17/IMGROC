<?php $title = "Imag(in)ing Rochester - View All Provocations"; include("header.php"); ?>


<table id="provocationsTable">
<tr>
	<th>Provocation</th>
	<th>Type</th>
	<th>Author</th>
</tr>
<?php 
	$provocations = listProvocations(); 
	
	for ($i = 0; $i < count($provocations); $i++)
	{
		//print_r($provocations[$i]);
		if ($provocations[$i][1] == "NO_TITLE")
			$provTitle = "Provocation #{$provocations[$i][0]}";
		
		// TYPES:
		// 0 = link
		// 1 = image
		// 2 = text
		switch($provocations[$i][2])
		{
			case 0:
				$type = "Link";
				break;
			case 1:
				$type = "Image";
				break;
			case 2:
				$type = "Text";
				break;
		}
		echo "<tr>\n";
		echo "\t<td><a href='provocation/{$provocations[$i][0]}' class='provTableLink'>{$provTitle}</a></td><td>{$type}</td><td>{$provocations[$i][3]}</td>\n";
		echo "</tr>\n";
	}
?>	
</table>



<?php include("footer.php"); ?>