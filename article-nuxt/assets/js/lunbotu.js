
	var timer = setInterval(function(){
		for(var j =0 ;j<li.length; j++){
			li[j].className = "active2";
		};
		i++;
		if(i>6){
			i = 0;
			li[i].className = "active";
		}else{	
			li[i].className = "active";
		}
	},2000)
	
	
	
	var i =0;
	var li = document.getElementById("lunbotu").getElementsByTagName("li");
	document.getElementById("prev").onclick = function(){
		for(var j =0 ;j<li.length; j++){
			li[j].className = "active2";
		};
		i--;
		if(i<0){
			i = 6;
			li[i].className = "active";
		}else{	
			li[i].className = "active";
		}
	};
	
	document.getElementById("next").onclick = function(){
		for(var j =0 ;j<li.length; j++){
			li[j].className = "active2";
		};
		i++;
		if(i>6){
			i = 0;
			li[i].className = "active";
		}else{	
			li[i].className = "active";
		}
	};
	
	document.getElementById("lunbotu").onmouseenter = function(){
		clearInterval(timer);
	};
	document.getElementById("lunbotu").onmouseleave = function(){
		timer = setInterval(function(){
		for(var j =0 ;j<li.length; j++){
			li[j].className = "active2";
		};
		i++;
		if(i>6){
			i = 0;
			li[i].className = "active";
		}else{	
			li[i].className = "active";
		}
	},2000)
	}

