<!DOCTYPE html>
<head>
  <script type="text/javascript" src=""></script>
</head>

<!----------------------------------------------------------------------->

<?php

//Page Title
$title = "Unit Testing";
//Initialize connection to the database
require_once("../shared_php/databaseConnect.php");
//Display selection menu at top of the page
include("../shared_php/header.php");


$result = $mysqli->query("SELECT idAssignment, AssignmentName, AssignmentDueDate, AssignmentInstructions, AssignmentCode, AssignmentClass, 
							AssignmentType, AssignmentMaxAttempts
          				  FROM Assignment");

?>
 
<header id="top_header">
  <h1 style="text-align: center">Unit Test Page</h1>
  <style>
   <?php //Line below allows multiple submit buttons on same line ?>
    form { display: inline; }
  </style>
</header>
 
 
 
 <!--Main Section where show code, upload and save -->
<section id="main_section" >
	
  		<form action="unitTest.php?insert_unittest=true" id="unitTest" method="post" enctype="multipart/form-data">
  			
 <!---------------------------------------------------------------------------------------------------------------->
 	
    	<h1>Choose Assignment:</h1>
    	
    	</br>
    	
    	<?php
    		while ($row = mysqli_fetch_array($result)) {
    	?>
        	<input type="radio" name="course" id="course" value= "<?php echo $row['idAssignment'];?>"> <?php echo $row['AssignmentName'];?>
        	</br>
    	<?php
    	}
    	?>
    	
    	</br>
    	
 <!----------------------------------------------------------------------------------------------------------------->
 
    	<h1>Add Unit Test:</h1>
    	<script type="text/javascript" src="//api.filepicker.io/v1/filepicker.js">
    	filepicker.setKey('ANXgRAtRSvutC6rHIAY4Az');
    	</script>

    	<!-- Note data-fp-extensions must be separated by comma and NO space -->
    	<input id="uploadedfile" onchange="updateCode();" data-fp-button-class="button" data-fp-button-text="Upload File" data-fp-services="COMPUTER,DROPBOX,GMAIL,FTP,GITHUB,GOOGLE_DRIVE,URL" data-fp-container="modal" data-fp-extensions=".cpp,.h,.py" data-fp-apikey="ANXgRAtRSvutC6rHIAY4Az" type="filepicker">
    	<script type="text/javascript" src="../js/unit-test.js"></script>
    	
    	</br>
    	</br>
    	Name: <input type="text" name="fileName">  <input type="checkbox" name="hidden" id="hidden" value="0"> Hide?</br>
     
    	<?php
    
    	if (isset($_SESSION['UnitTestProgram'])){
      	echo '<textarea name="txtname" id="txtname">' . $_SESSION['UnitTestProgram'] . '</textarea>';
    	} else {
      	echo '<textarea name="txtname" id="txtname"></textarea>';
    	}
    	
    	if(isset($_SESSION['fileName']))
		{
			$myFile = @$_POST["fileName"];
			$fh = fopen($myFile, "w");
			fwrite ($fh, $_POST["txtname"]);
			fclose ($fh);
		}
		
		?>
    	
    	<input type="submit" value="Submit" onclick="validate()">
 
    	</form> 
 
	<!-- code to display link to textarea-->
	<script>

	function updateCode()
	{
    	filepicker.read(document.getElementById('uploadedfile').value, function(data){
      		codeEditor.replaceSelection(data, "end");
    	});
	}
 
	</script>
 
	<!--Functions for debugging-->
	<script type="text/javascript">
 
  		var codeEditor = CodeMirror.fromTextArea(document.getElementById("txtname"), {
    			mode: "text/x-csrc",
        		lineNumbers: true,
        		indentUnit: 4,
        		tabMode: "shift",
        		matchBrackets:true,
    	});
	
		codeEditor.setSize("40em", "20em");
 
		var inputEditor = CodeMirror.fromTextArea(document.getElementById("input"), {
  			smartIndent: false
    	});


		inputEditor.setSize("40em", "5em");
           

		var showresponse = function(data)
		{         
  			document.getElementById("tname").innerHTML = JSON.stringify(data);              
		}

	</script>
 	
</section>

<!--------------------------------------------------------------------------------------->
 
<?php

if (isset($_REQUEST['insert_unittest']))
{
	$fileName = $_REQUEST['fileName'];
	
	echo $fileName; 
	
	$ID = @$_REQUEST['course'];
	echo $ID;
	
	$query = "INSERT INTO unittest
			  VALUES ('', '$fileName', '$ID', '1', 'FALSE')";
	
	//	::::INSERT ACTUAL TEST HERE::::
	$newResult = $mysqli->query($query);
		      		
	var_dump($newResult);				
	
			
}

  include("../shared_php/footer.php");
?>
</html>