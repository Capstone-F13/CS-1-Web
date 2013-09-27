<?php

$title = "Submission: Assignment " . $_GET['idAssignment']; //enter title into the quotation marks
include("../shared_php/header.php");
/*
require dirname(__FILE__) . '/../files/KLogger.php';
$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
*/

//have to set current assignment ID into a session variable
$_SESSION['currentAssignmentID'] = $_GET['idAssignment'];

echo ("  <br><br> <h3> <u> Submissions: </u> </h3> <br> ");
//Query selects everything from the assignment table 
$query = "SELECT * FROM Assignment WHERE idAssignment=" . $_SESSION['currentAssignmentID'];
$result = mysql_query($query);
$array = mysql_fetch_array($result);



//Displays the query from the assignment table 
echo "<b>Assignment Name:</b> " . $array['AssignmentName'] . "<br />";
echo "<b>Instructions:</b> " . $array['AssignmentInstructions'] . "<br />";
echo "<b>Due Date:</b> " . $array['AssignmentDueDate'] . "<br />";
echo "<br />";
$log->LogInfo("in submissions");
//create file to store program from database
$program = $array['AssignmentCode'];
$filePath = "../files/";
$fileName = "compiledDatabaseProgram" . $_GET['idAssignment'] . ".py";
$fullFileName = $filePath . $fileName;
$log->LogInfo($fullFileName);
fopen($fullFileName, 'w+');

//store program into file
file_put_contents($fullFileName, $program);

//compile the file/program on the server
system("python " . $fullFileName . " > " . $filePath . "test.txt");

//get file contents from test.txt and put them into the session variable firstOutput
$_SESSION['firstOutput'] = file_get_contents($filePath . "test.txt");
?>

<div class="codebox">
    <code>
        <pre>
            <?//php echo $_SESSION['firstOutput']; ?>
<?php $escape = htmlspecialchars($array['AssignmentCode']);
echo $escape; ?>
        </pre>
    </code>
</div>

<br />
<b>What is the output of this program?</b>
<br />
<form name="input" action="results.php" method="post">
    <input type="text" name="studentAnswer" id="studentAnswer" style="width:250px">
    <br />
    <button class="button">Submit</button>
</form>
<?php
include("../shared_php/footer.php");
?>
