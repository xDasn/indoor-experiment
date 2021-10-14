var taskOr = getParameterByName('taskOr');
var taskCount = getParameterByName('taskCount');
var userId = getParameterByName('userId');

var responsesFile = userId + '_responses.csv';
var interactionFile = userId + '_interaction.csv';

var interaction = []; // virtual movement = rotation
var responses = []; // click
var scene = "";

window.addEventListener("load", event => {
var image = document.querySelector('img');
if (image.complete && image.naturalHeight !== 0) {
	scene = document.getElementById('sky').getAttribute('src');
	scene = scene.substring(7,21);
	if (training == true) {
		scene = "tr_" + scene;
	};
}
});

var time = 0;
var myVar = setInterval(counter, 10);

setInterval(function() {
	time = time + 10;			
}, 10);

function counter (){
	timerValue = timerValue - 10;
	var sceneEl = document.querySelector('a-scene');
	if (timerValue > 0 ) {
		sceneEl.querySelector("#timer").setAttribute('text', {width: 1.5, height: 1.5, align: 'center', color: 'red', value: '' + (timerValue/1000).toFixed(2) + ' s'}, true);
	}
	else  {
		sceneEl.querySelector("#timer").setAttribute('text', {width: 1.5, height: 1.5, align: 'center', color: 'red', value: '0.00 s'}, true);
		clearInterval(myVar);
		responses.push([scene, userId, null, null, null, null, null]);
		saveDataToExistingFile(responsesFile, arrayToCSV(responses));
		saveDataToExistingFile(interactionFile, arrayToCSV(interaction));
		setTimeout(function() {
			if (training == true) {
				window.open(nextPage + "?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
			}
			else if (training == false && taskCount < 36) {
				taskCount = Number(taskCount) + 1;
				window.open("task.php?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
			}
			else {
				window.open("010_questionnaire.html?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
			}
			}, 250);
	}
};

	/*	
  AFRAME.registerComponent('timer', {
	schema: {
		TimeOutTime : {type:'int', default:5 }
	},
	init: function () {
		this.gotonext = true;
		var data = this.data;
		var sceneEl = document.querySelector('a-scene');
		var date= new Date();
    	this.TargetTime = date.getTime() + data.TimeOutTime*1000;
		sceneEl.querySelector("#timer").setAttribute('text', {width: 1.5, height: 1.5, align: 'center', color: 'red', value: '' + toString(data.TimeOutTime)}, true);
	},
	TimeLeft:function(){
        let CurrentDate = new Date();
		CurrentDate = CurrentDate.getTime();
		this.wholeTimeRemaining = this.TargetTime - CurrentDate;
		let timeRemaining = this.TargetTime - CurrentDate;
		if (timeRemaining >= 0) {	
			this.seconda = parseInt(timeRemaining / 1000);
			timeRemaining = (timeRemaining % 1000);
			this.miliseconda = parseInt(timeRemaining);
    	};
    },
	tick: function () {
		if (this.wholeTimeRemaining > 0 || this.wholeTimeRemaining == undefined) {
		    this.TimeLeft();
			var sceneEl = document.querySelector('a-scene');
			sceneEl.querySelector("#timer").setAttribute('text', {width: 1.5, height: 1.5, align: 'center', color: 'red', value: msToTime(this.wholeTimeRemaining)}, true);
		} else {
			if (this.gotonext == true) {
				responses.push([scene, userId, null, null, null, null, null]);
				saveDataToExistingFile(responsesFile, arrayToCSV(responses));
				saveDataToExistingFile(interactionFile, arrayToCSV(interaction));
				setTimeout(function() {
				if (training == true) {
					window.open(nextPage + "?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
				}
				else if (training == false && taskCount < 36) {
					taskCount = Number(taskCount) + 1;
					window.open("task.php?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
				}
				else {
					window.open("010_questionnaire.html?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
				}
				}, 250);
			}
			this.gotonext = false; //prevent from loading nextPage each frame
			}
		}
  });*/

AFRAME.registerComponent('clickhandler', {
	schema: {
	  txt: {default:'default'}
	},
	init: function () {
	  var data = this.data;
	  var el = this.el;
	  el.addEventListener('click', function (evt) {
		responses.push([scene, userId, time, data.txt, evt.detail.intersection.point.x, evt.detail.intersection.point.y, evt.detail.intersection.point.z]);
		if ((data.txt == "corridor_left") || (data.txt == "corridor_right")) {
			saveDataToExistingFile(responsesFile, arrayToCSV(responses));
			saveDataToExistingFile(interactionFile, arrayToCSV(interaction));
			setTimeout(function() {
				if (training == true) {
					window.open(nextPage + "?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
				}
				else if (taskCount < 36) {
					taskCount = Number(taskCount) + 1;
					window.open("task.php?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
				} else {
					window.open("010_questionnaire.html?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
				}
			}, 250);
		}
	  });
	}
});

AFRAME.registerComponent('rotation-reader', {
	tick: function () {
		interaction.push([scene, userId, time, "rotate", this.el.object3D.rotation.x, this.el.object3D.rotation.y]);
	}
});
