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
$query = "SELECT * FROM Assignment WHERE idAssignment=" . $_SESSION['currentAssignmentID'];
$result = $mysqli->query($query);
$array = mysqli_fetch_array($result);


//create file to store program from database
$firstOutput = $_SESSION['firstOutput'];
$filePath = "../files/";


//if assignment type is 0 (for c++) compile using gcc and run and pipe output to text file.
if ($array['AssignmentType'] == 0) {
    $fileName = "finalOutput.cpp";
    fopen($filePath . $fileName, 'w+');
    file_put_contents($filePath . $fileName, $firstOutput);
    system("g++ " . $filePath . $fileName . " -o " . $filePath . "finalOutput");
    system("exec " . $filePath . "finalOutput" . " >& " . $filePath . "finalOutput.txt");
}

//if assignment type is 1 (for python) interpret using python and pipe output to text file.
else if ($array['AssignmentType'] == 1) {
    $fileName = "finalOutput.py";
    fopen($filePath . $fileName, 'w+');
    file_put_contents($filePath . $fileName, $firstOutput);
    system("python " . $filePath . $fileName . " >& " . $filePath . "finalOutput.txt");
}

//Takes correct answer from files directory 
$correctOutput = trim(file_get_contents($filePath . "finalOutput.txt"));
echo "The correct output is: " . $correctOutput . "<br />";

//If answer is correct, puts in submission table
if ($studentAnswer == $correctOutput) 
{
    echo "You were correct!";
    $queryString = "INSERT INTO Submission (SubmissionMemberId,SubmissionAssignmentId,SubmissionSuccess) 
        VALUES (" . $_SESSION['idmember'] . "," . $_SESSION['currentAssignmentID'] . ",1)";
    $query = mysql_query($queryString);
} 

//If answer is wrong, puts in submission table along with a link to debugger to see steps 
else 
{
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
