<?php

$title = "View Submissions"; //enter title into the quotation marks
include("../shared_php/header.php");

    echo ("  <br><br> <h3> <u> Submissions: </u> </h3> <br> ");

//Queries for certain submission id for certain student and displays info
$memberSubmissionQueryString = "SELECT DISTINCT SubmissionAssignmentId FROM Submission WHERE SubmissionMemberId=" . $_SESSION['idmember'];
$memberSubmissionQuery = mysql_query($memberSubmissionQueryString);
echo "<table>";
echo "<tr>
        <td><b>Assignment Name&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Number Of Attempts&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Number Of Successes&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Number of Successes In A Row&nbsp;&nbsp;&nbsp;</b></td>
      </tr>";
while ($memberSubmissionRow = mysql_fetch_array($memberSubmissionQuery)) {
    //get assignment name
    $assignmentNameQueryString = "SELECT AssignmentName FROM Assignment WHERE idAssignment=" . $memberSubmissionRow['SubmissionAssignmentId'];
    $assignmentNameQuery = $mysqli->query($assignmentNameQueryString);
    $assignmentNameArray = mysqli_fetch_array($assignmentNameQuery);
    $assignmentName = $assignmentNameArray['AssignmentName'];

    //get number of attempts
    $numberOfAttemptsQueryString = "SELECT SubmissionSuccess FROM Submission WHERE SubmissionAssignmentId=" . $memberSubmissionRow['SubmissionAssignmentId'] . " AND SubmissionMemberId=" . $_SESSION['idmember'];
    $numberOfAttemptsResult = $mysqli->query($numberOfAttemptsQueryString);
    $numberOfAttempts = mysql_num_rows($numberOfAttemptsResult);

    //get number of successes
	$counter=0;
	$maxInARow = 0;
    $currentInARow = 0;
	while($result = mysqli_fetch_array($numberOfAttemptsResult)){
		if ($result['SubmissionSuccess']==1)
		{
			$counter++;		//simple counter of successes
			
			//get number of successes in a row
			$currentInARow++;
            if ($currentInARow > $maxInARow) {
                $maxInARow = $currentInARow;
            }
        } 
		else {
            $currentInARow = 0;
        }
	}
	$numberOfSuccesses = $counter;
	$numberOfSuccessesInARow = $maxInARow;

    //get number of successes in a row


    echo "
        <tr>
            <td>" . $assignmentName . "</td>
            <td>" . $numberOfAttempts . "</td>
            <td>" . $numberOfSuccesses . "</td>
            <td>" . $numberOfSuccessesInARow . "</td>
        </tr>
        ";
}
echo "</table>";
include("../shared_php/footer.php");
?>