<?php include("header.php"); ?>



		<div id="topButtons">
			<a href="#" id="seeNext"><span class="icon" id="refreshIcon"></span>Refresh</a>
			<a href="/index.php/submit"><span class="icon" id="submitIcon"></span>Submit</a>
			<!-- <a href="#"><span class="icon" id="shareIcon"></span>Share</a> -->
			<a href="#"><span class="icon" id="viewIcon"></span>View all</a>


		</div>
		<div class="provContent" id="content">
			<?php
					$specifier = $URI_split[2];
					//echo "specifier: {$specifier}";
					$data = null;
					
					if ($specifier == NULL)
					{
						$data = loadRandomProvocation();
						// echo "<h1>{$data['title']}</h1>\n";
						echo "{$data['data']}\n";
						echo "<h3 id='provInfo'>By {$data['author']} <br>Added " . date('F d, Y', $data['timestamp']) . "</h3>\n";

					}else{
						$data = loadProvocation($specifier);
						// echo "<h1>{$data['title']}</h1>\n";
						echo "{$data['data']}\n";
						echo "<h3 id='provInfo'>By {$data['author']} <br>Added " . date('F d, Y', $data['timestamp']) . "</h3>\n";

					}
			?>
		</div>
		<div class="push"></div>

	

<?php include("footer.php") ?>
