<?php

$title = "View Submissions"; //enter title into the quotation marks
include("../shared_php/header.php");

    echo ("  <br><br> <h3> <u> Submissions: </u> </h3> <br> ");

$idmember = $_SESSION['idmember'];
//Queries for certain submission id for certain student and displays info
$memberSubmissionQuery = "SELECT Assignment.AssignmentName, Submission.Attempts, Submission.Performance, Submission.Grade
                          FROM Assignment
                          INNER JOIN Submission ON Assignment.idAssignment = Submission.SubmissionAssignmentId
                          WHERE Submission.SubmissionMemberId = '$idmember'";
$memberSubmissionResults = $mysqli->query($memberSubmissionQuery);
echo "<table>";
echo "<tr>
        <td><b>Assignment Name&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Number Of Attempts&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Performace&nbsp;&nbsp;&nbsp;</b></td>
        <td><b>Grade&nbsp;&nbsp;&nbsp;</b></td>
      </tr>";
while ($row = $memberSubmissionResults->fetch_array()) 
{
    ?>
    <tr>
        <td><?php echo $row['AssignmentName']; ?></td>
        <td><center><?php echo $row['Attempts']; ?></center></td>
        <td><?php echo $row['Performance']; ?></td>
        <td><?php echo $row['Grade']; ?></td>
    </tr>
<?php
} 

echo "</table>";
include("../shared_php/footer.php");
?>