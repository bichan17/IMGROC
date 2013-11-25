<?php $customScripts = array("/scripts/loader.js"); $title = "Imag(in)ing Rochester - Submit New Provocation"; include("header.php"); ?>


		<!-- <div id="topButtons">
			<a href="index.html" class="button">See Provications</a>
		</div> -->
		<div id="form">
			<div id ="topButtons">
				<h1>SHARE YOUR STORY / SUBMIT A PROVOCATION</h1>
				<a href="#"id="textButton"><span class="icon" id="textIcon"></span>Text</a>
				<a href="#"id="imageButton"><span class="icon" id="imageIcon"></span>Image</a>
				<a href="#"id="linkButton"><span class="icon" id="linkIcon"></span>Link</a>
			</div>
			<div id="default">
				<p>Please select a submission type.</p>
			</div>

			<div class="formDiv" id="textForm">
				<h2>Text Provocation</h2>
				<form enctype="multipart/form-data" action="../common.php" method="post">
					<!-- Title: <input type="text" name="title"><br> -->
					Author: <input type="text" name="author" placeholder="optional"><br>
				  <div id="toolbar" style="display: none;">
				    <a data-wysihtml5-command="bold" title="CTRL+B">bold</a> |
				    <a data-wysihtml5-command="italic" title="CTRL+I">italic</a> |
				    <a data-wysihtml5-command="createLink">insert link</a> |
				    <a data-wysihtml5-command="insertUnorderedList">insertUnorderedList</a> |
				    <a data-wysihtml5-command="insertOrderedList">insertOrderedList</a>
				    <a data-wysihtml5-action="change_view">switch to html view</a>
				    
				    <div data-wysihtml5-dialog="createLink" style="display: none;">
				      <label>
				        Link:
				        <input data-wysihtml5-dialog-field="href" value="http://">
				      </label>
				      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
				    </div>
				    
				    <div data-wysihtml5-dialog="insertImage" style="display: none;">
				      <label>
				        Image:
				        <input data-wysihtml5-dialog-field="src" value="http://">
				      </label>
				      <label>
				        Align:
				        <select data-wysihtml5-dialog-field="className">
				          <option value="">default</option>
				          <option value="wysiwyg-float-left">left</option>
				          <option value="wysiwyg-float-right">right</option>
				        </select>
				      </label>
				      <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
				    </div>
				  </div>
				  <textarea id="textarea" placeholder="Limited to 500 characters" name="textData"></textarea>
				  <br><input type="reset" value="Reset form">
				  <input type="submit" value="Submit">

				  <input type="hidden" name="type" value="text">
				</form>
				<p>Please note that all submissions are moderated by us and are not guaranteed posting on the site.</p>
			</div>
			<div class="formDiv" id="imageForm">
				<h2>Image Provocation</h2>
				<form enctype="multipart/form-data" action="../common.php" method="post">
					<!-- Title: <input type="text" name="title"><br> -->
					Author: <input type="text" name="author" placeholder="optional"><br>
					
					Image URL: <input type="text" name="fileURL"><br>
					Caption: <input type="text" name="caption" placeholder="optional"><br>
					Is caption a link? <input type="checkbox" id="captionCheck"><br>
					Caption link URL: <input type="text" id="captionURL" name="captionURL" disabled="true" value="http://">


				  <br><input type="reset" value="Reset form">
				  <input type="submit" value="Submit">
				  
				  <input type="hidden" name="type" value="image">
				</form>
				<p>Please note that all submissions are moderated by us and are not guaranteed posting on the site.</p>
			</div>
			<div class="formDiv" id="linkForm">
				<h2>Link Provocation</h2>
				<form enctype="multipart/form-data" action="../common.php" method="post">
					<!-- Title: <input type="text" name="title"><br> -->
					Author: <input type="text" name="author" placeholder="optional"><br>
					Link Text: <input type="text" name="linkText"><br>
					Link URL: <input type="text" name="linkURL" value="http://"><br>
					Caption: <input type="text" name="caption" placeholder="optional"><br>
				  <br><input type="reset" value="Reset form">
				  <input type="submit" value="Submit">
				  
				  <input type="hidden" name="type" value="link">
				</form>
				<p>Please note that all submissions are moderated by us and are not guaranteed posting on the site.</p>
			</div>
			
		</div>
		<div class="push"></div>

		

		<?php include("footer.php"); ?>