<?php $customScripts = array("/scripts/loader.js"); $title = "Imag(in)ing Rochester Admin - Edit Provocation"; include("header.php"); ?>

<div class="formDiv" id="editForm">
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