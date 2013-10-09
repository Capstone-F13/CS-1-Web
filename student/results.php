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
	
$submissionQuery = "SELECT NoOfAttempts, NoOfSuccesses FROM Submission WHERE SubmissionMemberId ='$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
$submissionResult = $mysqli->query($submissionQuery);
$submissionArray = $submissionResult->fetch_array(); 

$NoOfAttempts = $submissionArray['NoOfAttempts'] + 1;	
$NoOfSuccesses = $submissionArray['NoOfSuccesses'];

$assignmentQuery = "SELECT AssignmentMaxAttempts, SuccessesToPass FROM Assignment WHERE idAssignment = '$currentAssignmentID'";
$assignmentResult = $mysqli->query($assignmentQuery);
$assignmentArray = $assignmentResult->fetch_array();

$memberQuery = "SELECT OverallPerformance FROM Member WHERE idMember = '$idmember'";
$memberResult = $mysqli->query($memberQuery);
$memberArray = $memberResult->fetch_array();

$OverallPerformance = $memberArray['OverallPerformance'];

	
	
//If answer is correct, puts in submission table
if ($studentAnswer == $correctOutput) 
{
	$NoOfSuccesses += 1;
	$successToPass = $assignmentArray['SuccessesToPass'];
	
	$length = strlen($OverallPerformance);
	
	if($length <= 5)
	{
		if($submissionArray != NULL)
		{
						
			if($NoOfSuccesses >= $successToPass)
			{
				$grade = 'P';
				
				$s_updateQuery = "UPDATE Submission, Grades, Member
			        			  SET Submission.NoOfAttempts = '$NoOfAttempts', Submission.NoOfSuccesses = '$NoOfSuccesses',
			        			  Grades.grade = '$grade', 
			        			  Member.OverallPerformance = CONCAT('$OverallPerformance', 'S')
								  WHERE Submission.SubmissionMemberId = '$idmember' AND Submission.SubmissionAssignmentId = '$currentAssignmentID'";
				
				$query = $mysqli->query($s_updateQuery);
			}
			
			else 
			{
				$s_updateQuery = "UPDATE Submission, Member
			        			  SET Submission.NoOfAttempts = '$NoOfAttempts', Submission.NoOfSuccesses = '$NoOfSuccesses',
			        			  Member.OverallPerformance = CONCAT('$OverallPerformance', 'S')
								  WHERE Member.idMember = '$idmember' AND Submission.SubmissionAssignmentId = '$currentAssignmentID'";
				
				$query = $mysqli->query($s_updateQuery);
			}
			
			 									
		}
		
		//Submission array is null
		else 
		{
			$s_insertSubmission = "INSERT INTO Submission
								   VALUES ('', '$idmember', '$currentAssignmentID', '$NoOfAttempts', '$NoOfSuccesses')";
			$s_submissionQuery = $mysqli->query($s_insertSubmission);
			
			if($NoOfSuccesses >= $successToPass)
			{
				$s_insertGrade = "INSERT INTO Grades
								  VALUES ('', '$idmember', '$currentAssignmentID', 'P')";
				$s_gradeQuery = $mysqli->query($s_insertGrade);
								
			}
			
			$s_updateMember = "UPDATE Member
							   SET OverallPerformance = 'S'
							   WHERE idMember = '$idmember'";
			$s_memberQuery = $mysqli->query($s_updateMember);
			 
			
		}
		
	}

	//Length else
	else
	{
	    $performanceArray = str_split($OverallPerformance);
		$performanceShift = array_shift($performanceArray);
		$performance = array_push($performanceShift, 'S');		 
		
		if($NoOfSuccesses >= $successToPass)
		{
			$grade = 'P';
			
			$s_updateQuery = "UPDATE Submission, Grades, Member
		        			  SET Submission.NoOfAttempts = '$NoOfAttempts', Submission.NoOfSuccesses = '$NoOfSuccesses',
		        			  Grades.grade = '$grade', 
		        			  Member.OverallPerformance = '$performance'
							  WHERE Submission.SubmissionMemberId = '$idmember' AND Submission.SubmissionAssignmentId = '$currentAssignmentID'";
			
			$query = $mysqli->query($s_updateQuery);
		}
		
		else 
		{
			$s_updateQuery = "UPDATE Submission, Member
		        			  SET Submission.NoOfAttempts = '$NoOfAttempts', Submission.NoOfSuccesses = '$NoOfSuccesses',
		        			  Member.OverallPerformance = CONCAT('$OverallPerformance', 'S')
							  WHERE Member.idMember = '$idmember' AND Submission.SubmissionAssignmentId = '$currentAssignmentID'";
			
			$query = $mysqli->query($s_updateQuery);
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
