<?php

$title = "My Courses";
include("../shared_php/header.php");

//debugging output for staying logged in
if ($_SESSION['stayLoggedIn'] == true) {
    echo "staying logged in";
} else {
    echo "not checked";
}

    echo ("  <br><br> <h3> <u> Current Courses: </u> </h3> <br> ");

//list courses student is in
$rosterQueryString = "SELECT * FROM Roster WHERE StudentId=" . $_SESSION['idmember'];
$rosterQuery = $mysqli->query($rosterQueryString);
while ($rosterQueryRow = mysqli_fetch_array($rosterQuery)) {
    //echo classname
    $classnameQueryString = "SELECT * FROM Classes WHERE idClass=" . $rosterQueryRow['ClassId'];
    $classnameQuery = $mysqli->query($classnameQueryString);
    $classnameRow = mysqli_fetch_array($classnameQuery);
    echo "<h1>" . $classnameRow['ClassName'] . "</h1><br />";

    //echo assignments
    $assignmentQueryString = "SELECT * FROM Assignment WHERE AssignmentClass=" . $rosterQueryRow['ClassId'];
    $assignmentQuery = $mysqli->query($assignmentQueryString);
    while ($assignmentQueryRow = mysqli_fetch_array($assignmentQuery)) {
        echo "<b>Assignment Name:</b> " . $assignmentQueryRow['AssignmentName'] . "<br />";
        echo "<b>Due Date:</b> " . $assignmentQueryRow['AssignmentDueDate'] . "<br />";
        echo "<b>Instructions:</b> " . $assignmentQueryRow['AssignmentInstructions'] . "<br />";
        if ($assignmentQueryRow['AssignmentType'] == 0) {
            echo "<b>Assignment Type:</b> C++<br />";
        } else {
            echo "<b>Assignment Type:</b> Python<br />";
        }
        echo "<a href='../student/submission.php?idAssignment=" . $assignmentQueryRow['idAssignment'] . "'>Start This Assignment</a><br />";
        echo "<br />";
    }
}

include("../shared_php/footer.php");
?>