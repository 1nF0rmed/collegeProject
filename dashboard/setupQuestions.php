<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../jquery-3.2.1.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<style>
		input{
			max-width: 100%;
		}
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.min.js"></script>
    <title>Document</title>
</head>
<body>
	<div class="col s6 offset-s3 z-depth-1" style="max-width:100%;margin-top:10px">
	<form action="addQuestion.php" method="POST">
	<input type="text" name="title" placeholder="Question Title"i><br><br>
	<div style="display:inline-block;">
		<textarea name="description" id="des" placeholder="Question Description" style="height:500px;width:500px"></textarea>
		<textarea class="preview" placeholder="Preview" style="height:500px;width:500px" contenteditable="True"></textarea>
	</div>
	
	<div class="input_fields_wrap">
		
		<div>
			<input type="text" name="parameters[]" placeholder="Parameter" style="width:150px;">
			<input type="text" name="testcase1[]" placeholder="Test Case #1" style="width:150px;">
			<input type="text" name="testcase2[]" placeholder="Test Case #2" style="width:150px;">
                        <input type="text" name="testcase3[]" placeholder="Test Case #3"style="width:150px;">
			<input type="text" name="testcase4[]" placeholder="Test Case #4"style="width:150px;">
                        <input type="text" name="testcase5[]" placeholder="Test Case #5" style="width:150px;">
			<br><br>
			<input type="text" name="output[]" placeholder="Output #1" style="width:150px;">
			<input type="text" name="output[]" placeholder="Output #2" style="width:150px;">
                        <input type="text" name="output[]" placeholder="Output #3"style="width:150px;">
			<input type="text" name="output[]" placeholder="Output #4"style="width:150px;">
                        <input type="text" name="output[]" placeholder="Output #5" style="width:150px;">
		</div>
	</div>
	<input type="submit" value="SUBMIT">
	</div>
	</form>
	<button class="add_field_button">Add Parameters</button>
	<script>
		$(document).ready(function() {
   			 var max_fields = 5; //maximum input boxes allowed
    		         var wrapper = $(".input_fields_wrap"); //Fields wrapper
    			 var add_button = $(".add_field_button"); //Add button ID
    
    			 var x = 1; //initlal text box count
    			 $(add_button).click(function(e){ //on add input button click
        			e.preventDefault();
        			if(x < max_fields){ //max input box allowed
            				x++; //text box increment
            				$(wrapper).append('<div><input type="text" name="parameters[]" placeholder="Parameter" style="width:150px;"/><input type="text" name="testcase1[]" placeholder="Test Case #1" style="width:150px;"><input type="text" name="testcase2[]" placeholder="Test Case #2" style="width:150px;"><input type="text" name="testcase3[]" placeholder="Test Case #3"style="width:150px;"><input type="text" name="testcase4[]" placeholder="Test Case #4"style="width:150px;"><input type="text" name="testcase5[]" placeholder="Test Case #5" style="width:150px;"><a class="remove_field" href="#">X</a></div>'); //add input box
        			}
    			 });
    
   			 $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        		 	e.preventDefault(); $(this).parent('div').remove(); x--;
    			 })
			
			$("#des").keyup(function(){
				var converter = new showdown.Converter();
    			text = $("#des").val();
				//alert(text);
    			html = converter.makeHtml(text);
				$(".preview").text(html);
			});
		 });
	</script>
</body>
</html>
