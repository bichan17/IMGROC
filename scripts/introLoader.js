var app = {}; //global var

//wait until main document is loaded
window.addEventListener("load",function(){
	//start dynamic loading
	Modernizr.load([{
		//load all libraries and scripts
		load: ["//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js","scripts/main.js"],

		//called when all files have finished loading and executing
		complete: function(){
			console.log("into files loaded!");

			//run init
			app.intro.init();

		}
	}
	]); //end Modernizer.load
}); //end addEventListener