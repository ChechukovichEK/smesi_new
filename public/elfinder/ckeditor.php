<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>elFinder CKEditor</title>
	
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	
	<!-- jQuery UI -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
	
	<!-- elFinder CSS -->
	<link rel="stylesheet" href="css/elfinder.min.css">
	<link rel="stylesheet" href="css/theme.css">
	
	<!-- elFinder JS -->
	<script src="js/elfinder.min.js"></script>
</head>
<body>

<div id="elfinder"></div>

<script>
	// CKEditor передаёт номер callback-функции через URL
	var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, '$1');
	
	$('#elfinder').elfinder({
		url : 'php/connector.minimal.php',
		getFileCallback : function(file) {
			// Передаём выбранный файл обратно в CKEditor
			window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
			window.close();
		}
	});
</script>

</body>
</html>