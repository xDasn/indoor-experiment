<html>
 <head>
        <title>Please wait, scene is loading</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<script src="./scripts/aframe.min.js"></script>
		<script src="./scripts/jquery-1.11.2.js"></script>
		<script src="./scripts/common.js"></script>
		<script src="./scripts/a-frame-components.js"></script>
        <!--script src="./scripts/custom-look-controls.js"></script-->
        <script src="./scripts/aframe-viewable-component.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="forms-styling.css">
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
	var training = false;

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
		var scene = output[0];
		var scenepath = output[1];
		var AOIleftposition = output[2];
		var AOIrightposition = output[3];
		var AOIleftwidth = output[4];
		var AOIrightwidth = output[5];
		var AOIleftheight = output[6];
		var AOIrightheight = output[7];
		var AOIopacity = output[8];
		$("#sky").attr("src",scenepath);
		$("#corridor-left").attr("position",AOIleftposition);
		$("#corridor-right").attr("position",AOIrightposition);
		$("#corridor-left").attr("width",AOIleftwidth);
		$("#corridor-right").attr("width",AOIrightwidth);
		$("#corridor-left").attr("height",AOIleftheight);
		$("#corridor-right").attr("height",AOIrightheight);
		$("#corridor-left").attr("opacity",AOIopacity);
		$("#corridor-right").attr("opacity",AOIopacity);
	}
});

</script>
<a-scene vr-mode-ui="enabled: false" loading-screen="dotsColor: white; backgroundColor: #1E64C8">
	<a-assets timeout="5000">
		<img id="sky" src="">
	</a-assets>
	<a-sky clickhandler='txt:backgr' id="a-frame-scene" src="#sky" rotation='0 -90 0'></a-sky>
	<a-plane clickhandler='txt:corridor_left' id="corridor-left" position="" rotation='0 90 0' width="" height="" color='#0000ff' transparent='true' opacity=""></a-plane>
	<a-plane clickhandler='txt:corridor_right' id="corridor-right" position="" rotation='0 -90 0' width="" height="" color='#ff0000' transparent='true' opacity=""></a-plane>
	<a-entity cursor='rayOrigin:mouse'></a-entity>
	<a-entity id='rig' position='0 0 0'>
		<a-camera id="camera" look-controls viewable="maxyaw:40;maxpitch:120" rotation-reader>
			<a-entity id="timer" timer geometry='primitive: plane; height: 0.1; width: 0.5' position='0 -0.7 -1' material='color: white; opacity: 0.5' text='width: 1.5; height: 1.5; align: center; color: red; value: 10.00 s;'></a-entity>
		</a-camera>
	</a-entity>
</a-scene>

<div clas="container" id="overlay" style="display: none; width: 100%; height: 100%;">
    <div class="row g-0" style="height: 20%; background-color: #000000; opacity: 0.5;"></div>
    <div class="row g-0" style="height: 60%;">
        <div class="col-md-2" style="background-color: #000000; opacity: 0.5;"></div>
        <div class="col-md-1" style="background-color: #FFFF; height: 100%"></div>
		<form class="text-center col-md-6 justify-content-center d-flex flex-column" style="background-color: #FFFF; margin-bottom: 0px">
            <h2 style="margin-bottom: 35px; margin-top: 15px">How confident you are that the path you have chosen leads to the exit?</h2>
            <fieldset class="form-group">
                <div class="form-check form-check-inline">
                    <input type="radio" id="confident1" name="confident" class="form-check-input" value="1">
                    <label class="form-check-label" for="confident1">very unsure</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="confident2" name="confident" class="form-check-input"  value="2">
                    <label class="form-check-label" for="confident2">unsure</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="confident3" name="confident" class="form-check-input" value="3"> 
                    <label class="form-check-label" for="confident3">neutral</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="confident4" name="confident" class="form-check-input" value="4">
                    <label class="form-check-label" for="confident4">confident</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="confident5" name="confident" class="form-check-input" value="5">
                    <label class="form-check-label" for="confident5">very confident</label>
                </div>
            </fieldset>
            <br>
            <div class="text-center"><button type="button" class="btn btn-dark btn-lg" id="nextTask" onclick="testData();">Next Task</button><span style="color: red;" id="fillAll"></span></div>
        </form>
        <div class="col-md-1" style="background-color: #FFFF;"></div>
        <div class="col-md-2" style="background-color: #000000; opacity: 0.5;"></div>
    </div>
    <div class="row g-0" style="height: 20%; background-color: #000000; opacity: 0.5;"></div>    
</div>

<div clas="container" id="overlayTimeout" style="display: none; width: 100%; height: 100%;">
    <div class="row g-0" style="height: 20%; background-color: #000000; opacity: 0.5;"></div>
    <div class="row g-0" style="height: 60%;">
        <div class="col-md-2" style="background-color: #000000; opacity: 0.5;"></div>
        <div class="col-md-1" style="background-color: #FFFF; height: 100%"></div>
            <div class="form-horizontal col-md-6 col-md-offset-3 justify-content-center d-flex flex-column" style="background-color: #FFFF;">
            <h2 style="margin-bottom: 35px; margin-top: 15px">Oh no! The time run out.</h2>
            <p>You must be quicker next time.</p>
            <br>
                <div class="text-center"><button type="button" class="btn btn-dark btn-lg" id="nextTask" onclick="readData();">Next Task</button>
                </br><span style="color: red;" id="fillAll"></span></div>
            </div>
        <div class="col-md-1" style="background-color: #FFFF;"></div>
        <div class="col-md-2" style="background-color: #000000; opacity: 0.5;"></div>
    </div>
    <div class="row g-0" style="height: 20%; background-color: #000000; opacity: 0.5;"></div>    
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
 </body>
</html>



