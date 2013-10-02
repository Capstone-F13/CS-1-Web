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

//Takes correct answer from files directory 
//$correctOutput = trim(file_get_contents($filePath . "finalOutput.txt"));
$correctOutput = 5;
echo "The correct output is: " . $correctOutput . "<br />";



	$idmember = $_SESSION['idmember'];
	$currentAssignmentID = $_SESSION['currentAssignmentID'];
	
		
    $submissionQuery = "SELECT * FROM Submission WHERE SubmissionMemberId ='$idmember'";
	$submissionResult = $mysqli->query($submissionQuery);
	$submissionArray = $submissionResult->fetch_array(); 
	
	$NoOfAttempts = $submissionArray['NoOfAttempts'] + 1;
	$OverallPerformance = $submissionArray['OverallPerformance'];
	$index = $submissionArray['Index'];
	
	$NoOfSuccesses = $submissionArray['NoOfSuccesses'];
	$SuccessInRow = $submissionArray['SuccessInRow'];
	$submissionAssignmentid = $submissionArray['SubmissionAssignmentId'];
	
	echo "SubmissionAssignmentId = ".$submissionAssignmentid. "<br />";
	echo "currentAssignmentID = ".$currentAssignmentID. "<br />";
	
	
//If answer is correct, puts in submission table
if ($studentAnswer == $correctOutput) 
{
	$NoOfSuccesses += 1;
	$SuccessInRow += 1;
	
	$length = strlen($OverallPerformance);
	
	echo "Level1 <br />";
	if($length < 15)
	{
		echo "level2 <br />";
		if($submissionArray != NULL)
		{
			echo "level3A <br />";

			$s_updateQuery = "UPDATE Submission, Grade
		        			  SET Submission.NoOfAttempts = '$NoOfAttempts', Submission.NoOfSuccesses = '$NoOfSuccesses', Submission.SuccessInRow = '$SuccessInRow',
		        			  
							  WHERE SubmissionMemberId = '$idmember'";
			
			$query = $mysqli->query($s_updateQuery);
			 									
		}
		
		else 
		{
			echo "level3B";
			$s_insertQuery = "INSERT INTO Submission
							VALUES ('', '$idmember', '$currentAssignmentID', '$NoOfAttempts', '$NoOfSuccesses', '$SuccessInRow')";
			$query = $mysqli->query($s_insertQuery);
		}
		
	}


	else
	{
		if($index > 15)
			$index = 0;
		
		$Performance = explode(";", $OverallPerformance); 
		$Performance[$index] = "S;";
		$s_updateQuery = "UPDATE Submission
	        			SET NoOfAttempts = '$NoOfAttempts',NoOfSuccesses = '$NoOfSuccesses', SuccessInRow = '$SuccessInRow'
						WHERE SubmissionMemberId = '$idmember', SubmissionAssignmentId = '$currentAssignmentID'";
		$query = $mysqli->query($queryString);
		
		$index += 1;
	
		$indexquery = "UPDATE Submission
					   SET Index = '$index'
					   WHERE SubmissionMemberId = '$idmember'";
					  
		$indexresult = $mysqli->query($indexquery);
	}
	
	
	 echo "You were correct!";
} 

//If answer is wrong, puts in submission table along with a link to debugger to see steps 
else 
{
	$SuccessInRow = 0;		
	$length = strlen($OverallPerformance);
	echo "Level1";
	if($length < 5)
	{
		echo "Level2";
		if($submissionArray != NULL)
		{
			echo "Level3";
	    	$queryString = "UPDATE Submission
		        			SET NoOfAttempts = '$NoOfAttempts',NoOfSuccesses = '$NoOfSuccesses', SuccessInRow = '$SuccessInRow'       			
							WHERE SubmissionMemberId = '$idmember', SubmissionAssignmentId = '$currentAssignmentID'";
			$query = $mysqli->query($queryString);
		}
		
		else 
		{
			echo "Level 3 part 2";
			$queryString = "INSERT INTO Submission
							VALUES ('', '$idmember', '$currentAssignmentID', '$NoOfAttempts', '$NoOfSuccesses', '$SuccessInRow')";
			$query = $mysqli->query($queryString);
		}
		
	}


	else
	{
		if($index > 5)
			$index = 0;
		
		$Performance = explode(";", $OverallPerformance); 
		$Performance[$index] = "F;";
		$queryString = "UPDATE Submission
	        			SET NoOfAttempts = '$NoOfAttempts',NoOfSuccesses = '$NoOfSuccesses', SuccessInRow = '$SuccessInRow'
						WHERE SubmissionMemberId = '$idmember', SubmissionAssignmentId = '$currentAssignmentID'";
		$query = $mysqli->query($queryString);
		
		$index += 1;
	
		$indexquery = "UPDATE Submission
					   SET Index = '$index'
					   WHERE SubmissionMemberId = '$idmember'";
					  
		$indexresult = $mysqli->query($indexquery);
	}
	
	
    echo "Your answer was not correct. ";
    echo "Would you like to step through the program one line at a time in the debugger? <br />";
    echo "<a href='../shared_php/practice.php'>Yes, take me and the program to the debugger<a>";
    echo "<br />";
    echo "<a href='../student/myCourses.php'>No, I would like to go back to the assignments list<a>";
    
}

include("../shared_php/footer.php");
?>
