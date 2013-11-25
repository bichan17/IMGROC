app.intro = (function(){
	function init (){
		console.log("inside intro.init");
		var nextIntro = $('a#nextIntro');
		var c1 = $('.c1');
		var c2 = $('.c2');

		nextIntro.click(function(){
			//c1.fadeOut("fast").delay(600).slideUp(200);
			//c2.slideUp(1000).fadeIn("fast");
			c1.hide();
			c2.show();
		});
	}
	//Public interface
	return{
		init : init
		//someVar : someVar,
		//someFunc : someFunc
	}
})();

app.submit = (function(){
	function init (){
		console.log("inside submit.init");
		var textDiv = $('#textForm');
		var imageDiv = $('#imageForm');
		var linkDiv = $('#linkForm');
		var defaultDiv = $('#default');

		var captionCheck = $("#captionCheck");
		var captionURL = $("#captionURL");

		$("#textButton").click(function(){
			// console.log("text!");
			defaultDiv.hide();
			linkDiv.hide();
			imageDiv.hide();
			textDiv.show("fast");


		});
		$("#imageButton").click(function(){
			// console.log("image!");
			defaultDiv.hide();
			linkDiv.hide();
			textDiv.hide();
			imageDiv.show("fast");


		});
		captionCheck.click(function(){
			if (captionCheck.is(':checked')) {
			    captionURL.prop("disabled", false);
			} else {
			    captionURL.prop("disabled", true);
			} 
		});

		$("#linkButton").click(function(){
			defaultDiv.hide();
			textDiv.hide();
			imageDiv.hide();
			linkDiv.show("fast");


		});
		//console.log("initialized!");
		var editor = new wysihtml5.Editor("textarea", { // id of textarea element
		  toolbar:      "toolbar", // id of toolbar element
		  parserRules:  wysihtml5ParserRules // defined in parser rules set 
		});

		console.log("initialized!");

	}

	//Public interface
	return{
		init : init
		//someVar : someVar,
		//someFunc : someFunc
	}
})();

app.provocation = (function(){
	function closeOverlay(){
		$("div.overlay").fadeOut("fast");
	}
	function showOverlay(overlay){
		$("#"+overlay).fadeIn("fast");

	}

	function getProvocation(){
		$.ajax({
				url: "/common.php?f=random&callback=data",
				success: function(data){
					//console.log(eval(data));
					data = eval(data);
					// console.log(data);
					
					//echo "<h1>{$data['title']}</h1>\n";
					//		echo "<h3>Added by {$data['author']} at " . date('F d, Y', $data['timestamp']) . "</h3>\n";
					//		echo "{$data['data']}\n";
					
					
					var a = new Date(data.timestamp * 1000);
					var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
					
					var html = "";
					// html += "<h1>" + data.title + "</h1>";
					html += "<div class='outer-center'><div class='inner-center'>";
					html += "" + data.data + "";
					html += "</div></div><div class='clear'></div>";
					// html += "<p id='provInfo'>By " + data.author + "<br>Added " + months[a.getMonth()] + " " + a.getDate() + ", " + a.getFullYear() + "</p>";

					
					//console.log($("#content").html());
					$("#content").html(html);
					
					// Update the URL in the address bar
					// window.history.pushState("", "", "" + data.id);
				}
			});

	}
	
	function init(){
		console.log("inside provocation.init!");
		ZeroClipboard.setDefaults( { moviePath: 'http://www.imgroc.com/scripts/ZeroClipboard.swf' } );
		var clip = new ZeroClipboard($("#share"));
		clip.on( 'mousedown', function(client) {

		  clip.setText(""+window.location);
		  $("#copyNotice").show().delay(800).fadeOut(400);
		  // $("#copyNotice").hide("slow");


		} );

		$(".fancybox").fancybox({
			autoSize : false,
			// padding: [25,25,25,25],
			beforeLoad : function() {         
	            this.width  = parseInt(this.element.data('fancybox-width'));  
	            this.height = parseInt(this.element.data('fancybox-height'));
        	}
		});

		$("#introLink").trigger('click');




		// $("span.close").click(function(){
		// 	closeOverlay();
		// });
		// $("span#nextArrow").click(function(){
		// 	closeOverlay();
		// });
		// // $("#introLink").click(function(){
		// // 	showOverlay("intro");
		// // });
		// $("#aboutLink").click(function(){
		// 	showOverlay("about");
		// })
		

		getProvocation();


		



		$("#seeNext").click(function(){
			//console.log("clicked on button");
			getProvocation();
		});
	}
	
	return{
		init : init
	}
})();