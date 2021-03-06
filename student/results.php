<?php
require dirname(__FILE__) . '/../files/KLogger.php';
$title = "Results"; //enter title into the quotation marks
include("../shared_php/header.php");

$idmember = $_SESSION['idmember'];
$currentAssignmentID = $_SESSION['currentAssignmentID'];

	
$submissionQuery = "SELECT * FROM Submission WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID' ";
$submissionResult = $mysqli->query($submissionQuery);
$submissionArray = $submissionResult->fetch_array();
        
$overallPerformance = $submissionArray['Performance'];
$submissionAttempts = $submissionArray['Attempts'] + 1;
$submissiongrade = $submissionArray['Grade']; 


$assignmentQuery = "SELECT AssignmentMaxAttempts, SuccessesToPass, AssignmentDueDate FROM Assignment WHERE idAssignment = '$currentAssignmentID'";
$assignmentResult = $mysqli->query($assignmentQuery);
$assignmentArray = $assignmentResult->fetch_array();

$maxAttempts = $assignmentArray['AssignmentMaxAttempts'];
$successesToPass = $assignmentArray['SuccessesToPass'];
$dueDate = $assignmentArray['AssignmentDueDate'];

$date = date('Y-m-d H:i:s');

if($date > $dueDate)
{
	echo "Assignment is passed due date, cannot proceed.";
	exit();
}
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


//If answer is correct, puts in submission table
if ($studentAnswer == $correctOutput) 
{
    echo "You are correct <br />";
	//Checks to see if student has submitted before
	if($submissionArray != NULL)
	{
        echo " 1";
        //The length of performance is checked to see if we need to start deleting old submission P/F
        $length = strlen($overallPerformance) + 1;
        if($length <= 10)
        {
            echo " 2";
            //Checks to see if student has recieved grade for assignment.  Do this so student can continue doing assignment even once graded 
            if($submissiongrade != '')
            {
                echo " 3";
                $s_updateQuery = "UPDATE Submission
			        			  SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = CONCAT('$overallPerformance', 'P')			        			       
								  WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
				
			    $query = $mysqli->query($s_updateQuery);
            }
           	
           
            
       	//Checks to see that student is still under max attempts and has yet not received a grade		
		    if($submissionAttempts <= $maxAttempts && $submissiongrade == '')
		    {
                echo " 4";
                $mystring = "";              
                
                for($i = 0; $i < $successesToPass - 1; $i++)
                    $mystring .= "P";
                                          
                $pos = strpos($overallPerformance,  $mystring);
                          
                //Checks to see if the number of successes in a row('P's' in a row) matches the number needed to pass the assignment
                //If there is, student get a 'P' for the assignment grade, If not, a 'P' is appeneded to overall performace 
                if($pos === FALSE)
                {
                     echo " 5";
			        $s_updateQuery = "UPDATE Submission
			        			      SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = CONCAT('$overallPerformance', 'P')		        			       
								      WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
				
			        $query = $mysqli->query($s_updateQuery);
                 
		        }
			
		        else 
		        {
                    echo " 6";
			        $s_updateQuery = "UPDATE Submission
			        			      SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = CONCAT('$overallPerformance', 'P'), Grade = 'P'			        			       
								      WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
				
			        $query = $mysqli->query($s_updateQuery);
                    
                    echo "You have passed this assignment";
		        }
			
	         }
                //This is a "saftey" statement.  It's when the student is sucessful in a submit but has reached their max attempts
                //without reaching the required goal of successes in a row, resulting in a 'F'
             else if($submissionAttempts > $maxAttempts && $submissiongrade == '')
             {
                  echo " 7";
  
                  $s_updateQuery = "UPDATE Submission
			         			    SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = CONCAT('$overallPerformance', 'P'), Grade = 'F'			        			       
								    WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
				
			      $query = $mysqli->query($s_updateQuery);
                        
                  echo "Even though you were correct, you have reached your max attempts without enough successes in a row, which results in a 'F' ";
            }

        }
           		
        
        //This else pertains to the length if statement, so our length is over what we want to keep
	    else
	    {
            echo " 9";
	        $performanceArray = str_split($overallPerformance);
		    $performanceShift = array_shift($performanceArray);
		    $performance = array_push($performanceArray, 'P');	
            $string = implode("",$performanceArray);
            
		    $mystring = "";              
                
            for($i = 0; $i < $successesToPass - 1; $i++)
                $mystring .= "P";
                                    
            $pos = strpos($overallPerformance,  $mystring);
                          
            //Checks to see if the number of successes in a row('P's' in a row) matches the number needed to pass the assignment
            //If there is, student get a 'P' for the assignment grade, If not, a 'P' is appeneded to overall performace 
            if($pos === FALSE)
            {
                    echo " 10";
			    $s_updateQuery = "UPDATE Submission
			        			    SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = '$string'		        			       
								    WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
				
			    $query = $mysqli->query($s_updateQuery);               
		    }
			
		    else 
		    {
                echo " 11";
			    $s_updateQuery = "UPDATE Submission
			        			    SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = '$string', Grade = 'P'			        			       
								    WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
				
			    $query = $mysqli->query($s_updateQuery);
                    
                echo "You have passed this assignment";
		    }
		
        } 
    }
	
    //Submission result is null
	else 
	{
        echo " 12";
		$s_insertSubmission = "INSERT INTO Submission
							   VALUES ('', '$idmember', '$currentAssignmentID', '1', '$date', 'P', '')";
		$s_submissionQuery = $mysqli->query($s_insertSubmission);
			
		if($successesToPass == 1)
		{
            echo " 13";
			$s_updateGrade = "UPDATE Submission
							  SET Grade = 'P'
                              WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
                              
			$s_gradeQuery = $mysqli->query($s_updateGrade);
            
            echo "You have received a 'P' for this assignment";
								
		}
						
	}
		
}

	
//If answer is wrong, puts in submission table along with a link to debugger to see steps 
else 
{	
	$length = strlen($overallPerformance) + 1;
	if($length <= 5)
	{
		if($submissionArray != NULL)
		{
            
	    	$queryString = "UPDATE Submission
		        			SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = CONCAT('$overallPerformance', 'F')   			
							WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
			$query = $mysqli->query($queryString);           
		}
		
		else 
		{
			$queryString = "INSERT INTO Submission
							VALUES ('', '$idmember', '$currentAssignmentID', '$submissionAttempts', '$date', 'F', '')";
			$query = $mysqli->query($queryString);
		}
		
	}


	else
	{	
		$performanceArray = str_split($overallPerformance);
		$performanceShift = array_shift($performanceArray);
		$performance = array_push($performanceArray, 'P');	
        $string = implode("",$performanceArray);	
		$queryString = "UPDATE Submission
	        			SET Attempts = '$submissionAttempts', DateSubmit = '$date', Performance = '$string'
						WHERE SubmissionMemberId = '$idmember' AND SubmissionAssignmentId = '$currentAssignmentID'";
		$query = $mysqli->query($queryString);

	}
	
	
    echo "Your answer was not correct. ";
    echo "Would you like to step through the program one line at a time in the debugger? <br />";
    echo "<a href='../shared_php/practice.php'>Yes, take me and the program to the debugger<a>";
    echo "<br />";
    echo "<a href='../student/myCourses.php'>No, I would like to go back to the assignments list<a>";
    
}


include("../shared_php/footer.php");
?>
