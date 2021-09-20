	function saveDataToNewFile(filename, filedata){
		$.ajax({
			type: 'post',
			cache: false,
			url: 'scripts/create_new_file.php', 
			data: {filename: filename, filedata: filedata}
		});
	}