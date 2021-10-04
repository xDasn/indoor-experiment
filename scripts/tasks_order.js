var random_code, task_order;

function getScenesList(){
	$.ajax({
		type: 'post',
		cache: false,
		url: 'scripts/return_scenes.php'
	});
};

var tasks = getScenesList();

function generateId() {
	random_code = (Math.round(Math.random()*100000000));
	console.log(tasks);
	shuffle(tasks);
	task_order = tasks.toString().replaceAll(",", "");
};

function shuffle(array) {
	array.sort(() => Math.random() - 0.5);
};