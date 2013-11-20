<!DOCTYPE html>
<html>

<!---------------------------------------------------------------------------->
<?php

$title = "Unit Test";

/*****************************************************************************/

//Initialized Variable And Get Variable Data From courseid
$courseId = "";
if (empty($_POST["courseid"]))
{
	$courseId = "";
}
else
{
	$courseId = $_POST["courseid"];
}

/*****************************************************************************/

//Initialized Variable And Get Variable Data From filename
$fileName = "";
if(empty($_POST["fileName"]))
{
	$fileName = "";
}
else
{
	$fileName = $_POST["fileName"];
}

/*****************************************************************************/

//Initialized Variable And Get Variable Data From hide
$hidden = "";
if(empty($_POST["hide"]))
{
	$hidden = "";
}
else
{
	$hidden = $_POST["hide"];
}

/*****************************************************************************/

//Initialized Variable And Get Variable Data From hide
$unitCode = "";
if(empty($_POST["code"]))
{
	$unitCode = "";
}
else
{
	$unitCode = $_POST["code"];
}

/*****************************************************************************/

//Initialize connection to the database
require_once("../shared_php/databaseConnect.php");

//Display selection menu at the top of the page
include("../shared_php/header.php");

//Query the Assignment table for data
$aQuery = "SELECT idAssignment, AssignmentName, AssignmentDueDate, AssignmentInstructions, AssignmentCode, AssignmentClass, 
				AssignmentType, AssignmentMaxAttempts
          	FROM Assignment";
$aResult = $mysqli->query($aQuery);

?>
<!---------------------------------------------------------------------------->

	<head>
	
		<style>
			form { display: inline; }
		</style>
		
		<script type="text/JavaScript" src=""></script>
			
		
	</head>
		
	<form action="unitTest.php" id="unitTest" method="post" enctype="multipart/form-data">
	
	<body>
		
		<br></br>
		<h1 style="text-align: center"> <u>Unit Test Page</u> </h1>
		
		<br></br>
		
		<h2 style="text-align: left"> Choose Assignment: </h2>
		<br>

		<?php
			//Read Assignment Query For Data
			while ($row = mysqli_fetch_array($aResult)) 
			{
		?>
				<input type="radio" name="courseid" id="courseid" value=<?php echo $row['idAssignment'];?> required> <?php echo $row['AssignmentName'];?>
				</br>
		<?php
			}
		?>
		
		<br>
		
		<h3 style="text-align: left"> Unit Test: </h3> 
		Name: <input type="text" name="fileName" required>
		<br></br>
		
		Enter Code:
		<br>
		
		<textarea rows="20" cols="60" name="code" required></textarea>

		<br>
		
		<input type="submit" name="Submit" value="Submit">
		Hidden: <input type="checkbox" name="hide" id="hide" value="1">
		
	</body>
	
	<?php

		$textFileName = $fileName . ".txt";
		
		
		$uQuery = "INSERT INTO unittest 
				   VALUES(' ', '$fileName', '$courseId', '$hidden', '$textFileName')";
		$uResult = $mysqli->query($uQuery);
		
		
		//Writes the UnitTest to a textfile
		$fh = fopen($textFileName, 'w');
		//Adds filename to beginning of doc.
		//fwrite($fh, $textFileName . PHP_EOL);
		fwrite($fh, $unitCode);
		fclose($fh);
		
	?>
	
	<?php
		include("../shared_php/footer.php");
	?>
	</form>
</html>