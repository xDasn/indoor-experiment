var random_code, task_order;
/*
function getScenesList(){
	$.ajax({
		type: 'post',
		cache: false,
		url: 'scripts/return_scenes.php'
	});
};*/

function shuffle(array) {
	array.sort(() => Math.random() - 0.5);
};

function generateId() {
	//var tasks = getScenesList();
	var tasks = ["01_","02_","03_","04_","05_","06_","07_","08_","09_","10_","11_","12_","13_","14_","15_","16_","17_","18_","19_","20_","21_","22_","23_","24_","25_","26_","27_","28_","29_","30_","31_","32_","33_","34_","35_","36_"];
	shuffle(tasks);
	random_code = (Math.round(Math.random()*100000000));
	task_order = tasks.toString().replaceAll(",", "");
};
