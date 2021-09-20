	function saveDataToExistingFile(filename, filedata){
		$.ajax({
			type: 'post',
			cache: false,
			url: 'scripts/write_to_file.php', 
			data: {filename: filename, filedata: filedata}
		});
	}