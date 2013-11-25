<?php $title = "Imag(in)ing Rochester - Admin Panel Home"; include("inc/header.php"); ?>

<div id="adminHome">
	<table id="provocationsTable">
	<tr>
		<th>Provocation</th>
		<th>Type</th>
		<th>Author</th>
	</tr>
		<?php
			// Load in summary of all provocations
			isset($_GET['s']) ? $start = $_GET['s'] : $start = 0;
			isset($_GET['e']) ? $end = $_GET['e'] : $end = 9;
			
			//echo "Start: {$start}, End: {$end}";

			$provocations = listProvocations($start, $end); 
			//print_r($provocations);

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
				echo "\t<td><a href='provocation/{$provocations[$i][0]}' class='provTableLink'>{$provTitle}</a></td><td>{$type}</td><td>{$provocations[$i][3]}</td><td>Edit</td><td>Approve</td><td>Delete</td>\n";
				echo "</tr>\n";
			}
		?>
	</table>
</div>


<?php include("inc/footer.php"); ?>