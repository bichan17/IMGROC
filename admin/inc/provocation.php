<?php $customScripts = array("/scripts/provocationLoader.js"); $title = "Imag(in)ing Rochester - Provocation"; include("header.php"); ?>


		<div id="sideButtons">
			<a href="/index.php/submit"><span class="icon" id="submitIcon"></span>Submit</a>
			<a href="#" id="share"><span class="icon" id="shareIcon"></span>Share<span id="copyNotice"><br><br>URL copied to clipboard!</span></a>
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
						//echo "<h1>{$data['title']}</h1>\n";
						//print_r(htmlspecialchars($data['data']));
						echo "{$data['data']}\n";
						echo "<h3 id='provInfo'>By {$data['author']}<br>Added " . date('F d, Y', $data['timestamp']) . "</h3>\n";
					}else{
						$data = loadProvocation($specifier);
						//echo "<h1>{$data['title']}</h1>\n";
						//echo "<h3>Added by {$data['author']} at " . date('F d, Y', $data['timestamp']) . "</h3>\n";
						echo "{$data['data']}\n";
					}
			?>
		</div>
		<div id="botButtons">
				<div>
					<a href="#" id="explore"><span class="icon" id="exploreIcon"></span>Explore</a>
					<a href="#" id="seeNext"><span class="icon" id="refreshIcon"></span>Next</a>
				</div>
			</div>
		<div class="push"></div>
		
<?php include("footer.php"); ?>