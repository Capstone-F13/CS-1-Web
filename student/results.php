<?php
require dirname(__FILE__) . '/../files/KLogger.php';
$title = "Results"; //enter title into the quotation marks
include("../shared_php/header.php");

/*
$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
$log->LogInfo("In results.php");
*/

//compile and run program again, this time comparing output to student submitted answer
$studentAnswer = trim($_POST['studentAnswer']);
echo "Your answer: " . $studentAnswer . "<br />";

//Queries everything from assignment table
$query1 = "SELECT * FROM Assignment WHERE idAssignment=" . $_SESSION['currentAssignmentID'];
$result1 = $mysqli->query($query1);
$array1 = mysqli_fetch_array($result1);

//Querying the assignment name of this assignment to use as file name when putting results in file
$query2 = "SELECT AssignmentName FROM Assignment WHERE idAssignment=" . $_SESSION['currentAssignmentID'];
$result2 = $mysqli->query($query2);
$array2 = mysqli_fetch_array($result2);
$fileName = $array2[0];

//create file to store program from database
//$firstOutput = $_SESSION['firstOutput'];
$filePath = "../files/student_answers/".$_SESSION['firstname']."_".$_SESSION['lastname']."/";

if(!file_exists($filePath))
{
	mkdir($filePath);
}


//if assignment type is 0 (for c++) compile using gcc and run and pipe output to text file.
if ($array1['AssignmentType'] == 0) {
    file_put_contents($filePath . $fileName.".txt", $studentAnswer);
    /*
    system("g++ " . $filePath . $fileName . " -o " . $filePath . "finalOutput");
    system("exec " . $filePath . "finalOutput" . " >& " . $filePath . "finalOutput.txt");
	 */
}

//if assignment type is 1 (for python) interpret using python and pipe output to text file.
else if ($array1['AssignmentType'] == 1) {
    file_put_contents($filePath . $fileName.".txt", $studentAnswer);
    //system("python " . $filePath . $fileName . " >& " . $filePath . "finalOutput.txt");
}

$correctOutput = trim(file_get_contents($filePath . "finalOutput.txt"));
echo "The correct output is: " . $correctOutput . "<br />";

if ($studentAnswer == $correctOutput) {
    echo "You were correct!";
    $queryString = "INSERT INTO Submission (SubmissionMemberId,SubmissionAssignmentId,SubmissionSuccess) 
        VALUES (" . $_SESSION['idmember'] . "," . $_SESSION['currentAssignmentID'] . ",1)";
    $query = mysql_query($queryString);
} else {
    echo "Your answer was not correct. ";
    echo "Would you like to step through the program one line at a time in the debugger? <br />";
    echo "<a href='../shared_php/practice.php'>Yes, take me and the program to the debugger<a>";
    echo "<br />";
    echo "<a href='../student/myCourses.php'>No, I would like to go back to the assignments list<a>";
    $queryString = "INSERT INTO Submission (SubmissionMemberId,SubmissionAssignmentId,SubmissionSuccess) 
        VALUES (" . $_SESSION['idmember'] . "," . $_SESSION['currentAssignmentID'] . ",0)";
    $query = mysql_query($queryString);
}

include("../shared_php/footer.php");
?>
