	var tasks, random_code, test_variant, task_order;
	var value = Math.round(Math.random() * 100);
	if (value%4 == 0) {
		tasks  = ["A", "B", "C", "D", "E", "F"];
	}
	else if (value%3 == 0) {
		tasks = ["F", "D", "E", "B", "C", "A"];
	}
	else if (value%2 == 0) {
		tasks = ["B", "A", "D", "C", "F", "E"];
	}
	else {
		tasks = ["C", "E", "F", "A", "B", "D"];
	}
	
	function generateId() {
		random_code = (Math.round(Math.random()*100000000));
		task_order = 1;
		shuffle(tasks);
		test_variant = tasks.toString().replaceAll(",", "");		
	}
	
	function shuffle(array) {
		array.sort(() => Math.random() - 0.5);
	}