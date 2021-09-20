function detectKey(event) {	
    if(event.keyCode === 16){
		d.push([userId, taskL, parseInt(taskOr), "", time, "shift"]);
	}
    else if(event.keyCode === 17){
		d.push([userId, taskL, parseInt(taskOr), "", time, "ctrl"]);
	}
    else if(event.keyCode === 18){
		d.push([userId, taskL, parseInt(taskOr), "", time, "alt"]);
	}	
	else if(event.keyCode === 27){
		d.push([userId, taskL, parseInt(taskOr), "", time, "esc"]);
	}
	else if(event.keyCode === 112){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f1"]);
	}
	else if(event.keyCode === 113){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f2"]);
	}
	else if(event.keyCode === 114){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f3"]);
	}
	else if(event.keyCode === 115){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f4"]);
	}	
	else if(event.keyCode === 116){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f5"]);
	}
	else if(event.keyCode === 117){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f6"]);
	}	
	else if(event.keyCode === 118){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f7"]);
	}
	else if(event.keyCode === 119){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f8"]);
	}	
	else if(event.keyCode === 120){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f9"]);	
	}	
	else if(event.keyCode === 121){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f10"]);	
	}
	else if(event.keyCode === 122){
		var w = window.innerWidth
		|| document.documentElement.clientWidth
		|| document.body.clientWidth;

		var h = window.innerHeight
		|| document.documentElement.clientHeight
		|| document.body.clientHeight;
	
		d.push([userId, taskL, parseInt(taskOr), "", time, "f11", w, h]);				
	}	
	else if(event.keyCode === 123){
		d.push([userId, taskL, parseInt(taskOr), "", time, "f12"]);	
	}		
}
