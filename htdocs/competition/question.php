<?php

?>

<html>
	<head>
		<title>Execute Questions</title>
		<link rel="stylesheet" href="../lib/codemirror.css">
		<script src="../jquery-3.2.1.min.js"></script>
		<script src="../lib/codemirror.js"></script>
		<script src="../mode/python/python.js"></script>
	</head>

	<body>
		<textarea id="codeeditor"></textarea>
		<script>
			var editor = CodeMirror.fromTextArea(document.getElementById("codeeditor"), {lineNumbers:true});
			function extractCode() {
				var text = editor.getValue();
				return text;
			}
		</script>
		<div>
			<textarea name="code" id="base" style="display:none;" ></textarea>
			<input type="submit" id="submit" value="SUBMIT"/>
		</div>
		<h2>OUTPUT:</h2>
		<span id="output"></span>
		<script>
			$(document).ready(function(){
				$("#submit").click(function(){
					$("#base").html(extractCode());
					$.post("executeCode.php",
					{
						code: $("#base").text()
					},
					function(data, status){
						$("#output").html(data);
					}
					)
				});
			});
		</script>
	</body>
</html>
