FuF = new function() {
	
  var base = 'http://domaintoad.com/';
  var css = base + "widget.css"
  var json = base + 'widgetAPI.php';
  var id = 'fuf_display';
   function getContent( local ) {
    var scmsj = document.createElement('script');
    
    scmsj.src = json;
    document.getElementsByTagName('head')[0].appendChild(scmsj);
  }
  function getSheet(sheeturl) {
    stylesheet = document.createElement("link");
    stylesheet.rel = "stylesheet";
    stylesheet.type = "text/css";
    stylesheet.href = sheeturl;
    
    document.lastChild.firstChild.appendChild(stylesheet);
  }

	this.init = function() {
	  this.serverResponse = function(data) {
	    if (!data) return;
	    var div = document.getElementById(id);
	    
		var ihtml = "<a href='http://DomainToad.com' style='color:000000;'>DomainToad.com Domain News</a><br/><br/>";
	    for (var i = 0; i < data.length; i++) {
			var title = data[i].title;
			var url = data[i].link;
			var desc = data[i].description;
			ihtml += "<a href='"+url+"'>"+title+"</a></br><p>"+desc+"</p>";
	
	    }
	    div.innerHTML = ihtml; 
	    div.style.display = 'block'; 
	    div.style.visibility = 'visible';
	  }
	
	  getSheet(css);
	  document.write("<div id='" + id + "' style='display: none'></div>");
	  getContent();
	}
}
FuF.init();
