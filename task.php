<html>
 <head>
        <title>Please wait, scene is loading</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<script src="./scripts/aframe.min.js"></script>
		<script src="./scripts/jquery-1.11.2.js"></script>
		<script src="./scripts/common.js"></script>
		<script src="./scripts/a-frame-components.js"></script>
        <script src="./scripts/custom-look-controls.js"></script>
        <script src="./scripts/aframe-viewable-component.min.js"></script>
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
			<a-entity id="timer" timer geometry='primitive: plane; height: 0.1; width: 0.5' position='0 -0.7 -1' material='color: white; opacity: 0.5' text='width: 1.5; height: 1.5; align: center; color: red; value: 5.00 s;'></a-entity>
		</a-camera>
	</a-entity>
</a-scene>
 </body>
</html>



