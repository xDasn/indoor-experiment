<html>
 <head>
        <title>A-Frame 360 Panorama</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<script src="./scripts/aframe.min.js"></script>
		<script src="./scripts/jquery-1.11.2.js"></script>
		<script src="./scripts/save_new_csv.js"></script>
		<script src="./scripts/save_to_existing_csv.js"></script>
		<!--<script src="./scripts/detect_keys.js"></script> -->     
</head>
<body oncontextmenu="return false;"> 

<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
};
?>

<script>
	function getParameterByName(name) {
		var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
		return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
	}
    var taskOr = getParameterByName('taskOr');
	var taskCount = getParameterByName('taskCount');
	var userId = getParameterByName('userId');
	
	var responses_file = userId + 'corridors.csv';
	var interaction_file = userId + 'interaction.csv';

	//document.addEventListener("keydown", detectKey);
	
	//log virtual movement
		var move_type;
		var a = []; // virtual movement = rotation
		//var b = []; // answer
		var c = []; // click
		//var d = []; //detect errors
		var time = 0;
		var numClick = 0;
		
		setInterval(function() {
			time = time + 10;			
		}, 10);

	function saveCSV() {
			a.push([$scene, time, "end"]);
			//b.push([userId, taskL, parseInt(taskOr), history.length, time, "end", numClick]);
			c.push([$scene, time, "end", numClick]);
			//d.push([userId, taskL, parseInt(taskOr), history.length, time, "end", numClick]);
	
			saveDataToNewFile(interaction_file, arrayToCSV(a));
			//saveDataToExistingFile(file_name2, arrayToCSV(b));
			saveDataToNewFile(responses_file, arrayToCSV(c));	
			//saveDataToExistingFile(file_name4, arrayToCSV(d));
	}
	function arrayToCSV(input) {
		var row, cell
		var csv = "";
		for (i = 0; i < input.length; ++i) {
			row = input[i];
			for (j = 0; j < row.length; ++j) {
				cell = input[i][j] + ";";
				csv = csv + cell;
			}
			csv = csv + "\n"; 
		}
		csv = csv.replace(/\./g, ',');
		return csv;
	}
	//log virtual movement - end of function

	//function openNextSlide() {
	//	window.alert("konec2");
		
	//	setTimeout(function() {
			
	//	}, 100);
	//}

	$.ajax({
		type: 'post',
		cache: false,
		url: 'scripts/return_scene.php',
		dataType: 'json',
		data: {
			taskOr: taskOr,
			taskCount: taskCount
		},
		success: function(output) {
			//alert(output);
			setTimeout(function() {
				var scene = output[0];
				var scenepath = output[1];
				var AOIleftposition = output[2];
				var AOIrightposition = output[3];
				var AOIleftwidth = output[4];
				var AOIrightwidth = output[5];
				var AOIleftheight = output[6];
				var AOIrightheight = output[7];
				var AOIopacity = output[8];
				$("#a-frame-scene").attr("src",scenepath);
				$("#corridor-left").attr("position",AOIleftposition);
				$("#corridor-right").attr("position",AOIrightposition);
				$("#corridor-left").attr("width",AOIleftwidth);
				$("#corridor-right").attr("width",AOIrightwidth);
				$("#corridor-left").attr("height",AOIleftheight);
				$("#corridor-right").attr("height",AOIrightheight);
				$("#corridor-left").attr("opacity",AOIopacity);
				$("#corridor-right").attr("opacity",AOIopacity);

				var myVar = setInterval(counter, 10);
				var timerValue = 5000;
				var result;
				function counter () {
					timerValue = timerValue - 10;
					var sceneEl = document.querySelector('a-scene');
					if (timerValue > 0 ) {
						sceneEl.querySelector("#counterText").setAttribute('text', {width: 1.5, height: 1.5, align: 'center', color: 'red', value: '' + (timerValue/1000).toFixed(2) + ' s'}, true);
					}
					else {
						sceneEl.querySelector("#counterText").setAttribute('text', {width: 1.5, height: 1.5, align: 'center', color: 'red', value: '0.00 s'}, true);
						clearInterval(myVar);
					
						setTimeout(function() {
							if (taskCount < 36) {
								taskCount = Number(taskCount) + 1;
								{
								};
								window.open("task.php?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
							}
							else {
								window.open("010_questionnaire.html?taskOr=" + taskOr + "&taskCount=" + taskCount + "&userId=" + userId, "_self");
							}
						}, 250);
						
						saveCSV();

					}
				}
			}, 250);
		}
	});

	AFRAME.registerComponent('clickhandler', {
        schema: {
          txt: {default:'default'}
        },
        init: function () {
          var data = this.data;
          var el = this.el;
          el.addEventListener('click', function (evt) {   //dblclick
			//window.alert(data.txt);
			//window.alert(evt.detail.intersection.point.x);
			numClick = numClick + 1;
			c.push([time, data.txt, evt.detail.intersection.point.x, evt.detail.intersection.point.y, evt.detail.intersection.point.z]);
			if ((data.txt == "corridor_left") || (data.txt == "corridor_right")) {
				saveCSV();
				//openNextSlide();
				
				setTimeout(function() {
					//window.open("./010_questionnaire.html?userId=" + userId, "_self");
                    window.open("task.php?taskOr=" + taskOr + "&testCount=" + testCount + "&userId=" + userId + "", "_self");
				}, 250);
			}
          });
        }
    });
	
	AFRAME.registerComponent('rotation-reader', {
		tick: function () {
			a.push([time, "rotate", this.el.object3D.position.x, this.el.object3D.position.y, this.el.object3D.position.z, this.el.object3D.rotation.x, this.el.object3D.rotation.y, this.el.object3D.rotation.z]);
			//getWorldPosition(position);
			//getWorldQuaternion(...);
		}
	});
	  
	</script>
	<a-scene>
		<a-entity id='rig' position='0 0 0'>
			<a-camera id='camera' look-controls rotation-reader>	
			<a-entity id='counterText' geometry='primitive: plane; height: 0.1; width: 0.5' position='0 -0.7 -1' material='color: white; opacity: 0.5' text='width: 1.5; height: 1.5; align: center; color: red; value: 5.00 s;'></a-entity>
			</a-camera>
		</a-entity>
		<a-sky clickhandler='txt:backgr' id="a-frame-scene" src="" rotation='0 -90 0'></a-sky>
		<a-plane clickhandler='txt:corridor_left' id="corridor-left" position="" rotation='0 40 0' width="" height="" color='#0000ff' transparent='true' opacity=""></a-plane>
		<a-plane clickhandler='txt:corridor_right' id="corridor-right" position="" rotation='0 330 0' width="" height="" color='#ff0000' transparent='true' opacity=""></a-plane>
		<a-entity cursor='rayOrigin:mouse'></a-entity>		  
	</a-scene>
 </body>
</html>



