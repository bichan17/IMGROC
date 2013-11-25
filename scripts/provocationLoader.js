var app = {}; //global var

//wait until main document is loaded
window.addEventListener("load",function(){
	//start dynamic loading
	Modernizr.load([{
		//load all libraries and scripts
		load: ["//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js", "/scripts/ZeroClipboard.min.js", "/scripts/fancybox/jquery.fancybox.pack.js?v=2.1.5", "/scripts/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5", "/scripts/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6", "/scripts/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7", "/scripts/main.js"],

		//called when all files have finished loading and executing
		complete: function(){
			console.log("all files loaded!");

			//run init
			app.provocation.init();

		}
	}
	]); //end Modernizer.load
}); //end addEventListener