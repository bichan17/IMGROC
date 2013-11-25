<?php $customScripts = array("/scripts/provocationLoader.js"); $title = "IMG/ROC"; include("header.php"); ?>

		<div id="topButtons">
			<span id="next">
				<a href="#" id="seeNext"><span class="icon" id="refreshIcon"></span>Next</a>
			</span>
		</div>
		<div id="sideButtons">
			<a href="#intro" id="introLink" class="fancybox" data-fancybox-width="800" data-fancybox-height="232">Introduction</a>
			<a href="/index.php/submit"><!-- <span class="icon" id="submitIcon"></span> -->Submit</a>
			<a href="#about" id="aboutLink" class="fancybox" data-fancybox-width="800" data-fancybox-height="600">About</a>

			<!-- <a href="#" id="share">Share<span class="icon" id="shareIcon"></span>Share<span id="copyNotice"><br><br>URL copied to clipboard!</span></a> -->
			<!-- <a href="/index.php/viewall"><span class="icon" id="viewIcon"></span>View all</a> -->
			
			<!-- <a href="/index.php/provocation/">Provocations</a> -->
			<!-- <a href="/index.php/manifesto/">Our Manifesto</a> -->


		</div>
		<div id="intro" class="overlay">
			<H2>Welcome</H2>
			<p>
				We challenge ourselves to experience our environment, not in the way it has been presented to and packaged for us, but in a way that allows for our own experiences, with nuance, wonder, and a critical eye.<br>
				<br>
				And now we want to challenge you.
			</p>
		</div>
		<div id="about" class="overlay">			
				<h2>About this project</h2>
				<p>
					IMG/ROC is a multimedia project that challenges people to interact with their environment in unique and unconventional ways. This project specifically addresses the city of Rochester and the Rochester Institute of Technology as sites of complex structures of relationships between people, place, politics, and visual encounters.
				</p>
				<p>
					Our goal is twofold: 1) to critically examine the sites, spaces, and experiences of
					environments that come pre-packaged to our perception, and 2) to empower individuals and
					communities to form their own experiences, images, and maps.
				</p>
				<p>
					This project began when we found ourselves deeply moved by what we were learning in the
					classroom. Unlike the traditional world of Academia, which often came delivered to us in
					a dry and irrelevant manner, this theory seemed to contain within it a radical call to action.
					It summoned us to rethink our lives and the way that we experience, navigate, and interact
					with our environments. We wholeheartedly embrace taking theory to and deriving it from the
					streets.
				</p>
				<p>
					We’re a collective of individuals stemming from many disciplines——as varied as
					Information Technology, Game Design, Visual Culture, Fine Art, Sociology, and Gender
					Studies——within the RIT community.
				</p>
				<p>
					This project grew (and continues to grow) from the fertile soil of City-As-Text-based
					pedagogy and models of interactive and experiential learning. Walker Percy’s “Loss of the
					Creature” (1975), Frederick Turner’s “Cultivating the American Garden: Towards a Secular
					View of Nature” (1985), and Michel DeCerteau’s “Walking in the City” (1985) form the
					primary building blocks of our manifesto.
				</p>
				<p>
					This continually evolving project seeks to create a collection of provocative objects
					embodied online, in print, and through events. But this is just the beginning. YOU ARE THE
					NEXT ITERATION OF THIS PROJECT.
				</p>
				<p>
					If you're interested in collaborating with us or have questions, comments, or suggestions, send
				us an email at <a href="mailto:imgroc@gmail.com">imgroc@gmail.com</a>.
				</p>
				<h2>Our Manifesto</h2>
				<p>
					Our interactions with place are highly complex, formed by our personal histories and layers of politics, cultural norms, and deep-seated generational belief systems. Add to that an increasingly digital/virtual world, in which our devices both facilitate and inhibit our capacity for interaction——We are never really interacting with a “pure” environment and having “untouched” experiences. How we move through a given environment is guided by structures. These structures are physical——sidewalks, bike paths, roads——and intangible——socio-economic, ethnic, gender-specific. We are further mediated by maps and images, all of which follow specific agendas. We are in constant negotiation between formal and informal structures of power, but we form habits, we carry rhythms on our tongues and in our footsteps.
				</p>
				<p>
					Our goal is to unravel these patterns, to deconstruct these layers, and become critically aware of their presence in shaping our experiences. To empower individuals and communities, to reawaken a sense of wonder and play, to creatively upset boundaries and hierarchies, we will deliberately form our own paths, maps, and images. Our resistance may be quiet or it may be loud and reverberate in the streets. We will seek fresh ways to build connections and engage in unconventional interactions.
				</p>
				<p>
					This is only a provocation. The rest is up to you.
				</p>
		</div>
		<div id="provContainer">
			
			<div class="provContent" id="content">
				<?php
						$specifier = $URI_split[2];
						//echo "specifier: {$specifier}";
						$data = null;
						
						if ($specifier == NULL)
						{
							$data = loadRandomProvocation();
							//echo "<h1>{$data['title']}</h1>\n";
							// print_r(htmlspecialchars($data['data']));
							echo "<div class='outer-center'><div class='inner-center'>";
							echo "{$data['data']}\n";
							echo "</div></div><div class='clear'></div>";
							// echo "<p id='provInfo'>By {$data['author']}<br>Added " . date('F d, Y', $data['timestamp']) . "</p>\n";
						}else{
							$data = loadProvocation($specifier);
							//echo "<h1>{$data['title']}</h1>\n";
							//echo "<h3>Added by {$data['author']} at " . date('F d, Y', $data['timestamp']) . "</h3>\n";
							echo "{$data['data']}\n";
						}
				?>
				
			</div>
			
			
		</div>
		
		<!-- <div class="push"></div> -->
		
<?php include("footer.php"); ?>