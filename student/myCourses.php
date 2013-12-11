<?php

$title = "My Courses";
include("../shared_php/header.php");

/*
//debugging output for staying logged in
if ($_SESSION['stayLoggedIn'] == true) {
    echo "staying logged in";
} else {
    echo "not checked";
}
*/
    echo ("  <br><br> <h3> <u> Current Courses: </u> </h3> <br> ");

//list courses student is in
$rosterQueryString = "SELECT * FROM Roster WHERE StudentId=" . $_SESSION['idmember'];  //Gathers current students id number
$rosterQuery = $mysqli->query($rosterQueryString); //Query string

//Outer while loop cycles through each class
while ($rosterQueryRow = mysqli_fetch_array($rosterQuery)) 
{
    //Queries the classes for the current logged in student, then displays class
    $classnameQueryString = "SELECT * FROM Classes WHERE idClass=" . $rosterQueryRow['ClassId'];
    $classnameQuery = $mysqli->query($classnameQueryString);
    $classnameRow = mysqli_fetch_array($classnameQuery);
    echo "<h1>" . $classnameRow['ClassName'] . "</h1><br />";

    $classId = $rosterQueryRow['ClassId'];
    //Queries the generated assignments for the current logged in student
    $assignmentQueryString = "SELECT * FROM Assignment WHERE AssignmentClass= '$classId' AND AssignmentType= '0' ";
    $assignmentQuery = $mysqli->query($assignmentQueryString);
    
	//This inner loop will cycle through every assignment for the currently iterated class, then display each assignment under the class
    while ($assignmentQueryRow = mysqli_fetch_array($assignmentQuery)) 
    {
        echo "<b>Assignment Name:</b> " . $assignmentQueryRow['AssignmentName'] . "<br />";
        echo "<b>Due Date:</b> " . $assignmentQueryRow['AssignmentDueDate'] . "<br />";
        echo "<b>Instructions:</b> " . $assignmentQueryRow['AssignmentInstructions'] . "<br />";
        
        //Will display different depending on what programming 
        if ($assignmentQueryRow['AssignmentType'] == 0) {
            echo "<b>Assignment Type:</b> C++<br />";
        } else {
            echo "<b>Assignment Type:</b> Python<br />";
        }
		
		//Displays link to assignment
        echo "<a href='../student/submission.php?idAssignment=" . $assignmentQueryRow['idAssignment'] . "'>Start This Assignment</a><br />";
        echo "<br />";
    }

    $classId = $rosterQueryRow['ClassId'];
    //Queries the unit test assignments for the current logged in student
    $assignmentQueryString = "SELECT * FROM Assignment WHERE AssignmentClass= '$classId' AND AssignmentType= '1' ";
    $assignmentQuery = $mysqli->query($assignmentQueryString);

     while ($assignmentQueryRow = mysqli_fetch_array($assignmentQuery)) 
    {
        echo "<b>Assignment Name:</b> " . $assignmentQueryRow['AssignmentName'] . "<br />";
        echo "<b>Due Date:</b> " . $assignmentQueryRow['AssignmentDueDate'] . "<br />";
        echo "<b>Instructions:</b> " . $assignmentQueryRow['AssignmentInstructions'] . "<br />";
        
        //Will display different depending on what programming 
        if ($assignmentQueryRow['AssignmentType'] == 0) {
            echo "<b>Assignment Type:</b> C++<br />";
        } else {
            echo "<b>Assignment Type:</b> Python<br />";
        }
        
        //Displays link to assignment
        echo "<a href='../student/submission.php?idAssignment=" . $assignmentQueryRow['idAssignment'] . "'>Start This Assignment</a><br />";
        echo "<br />";
    }

/*
    $UnitTestQueryString = "SELECT * FROM UnitTest WHERE UnitTestClass=" . $rosterQueryRow['ClassId'];
    $UnitTestQuery = $mysqli->query($UnitTestQueryString);
    //var_dump($UnitTestQuery);

   

    while($UnitTestQueryRow = mysqli_fetch_array($UnitTestQuery))
    {
        echo "<b>Unit Test Name:</b> " . $UnitTestQueryRow['UnitTestName'] . "<br />";
        echo "<b>Due Date:</b> " . $UnitTestQueryRow['UnitTestDueDate'] . "<br />";
        echo "<b>Instructions:</b> " . $UnitTestQueryRow['UnitTestInstructions'] . "<br />";
        
        //Will display different depending on what programming 
        if ($UnitTestQueryRow['UnitTestType'] == 0) {
            echo "<b>Unit Test Type:</b> C++<br />";
        } else {
            echo "<b>Unit Test Type:</b> Python<br />";
        }

        $id = $UnitTestQueryRow['idUnitTest'];
        $name = $UnitTestQueryRow['UnitTestName'];
        
        //Displays link to assignment
        echo "<a href='../student/unit_testing.php?idUnitTest=".$id."&UnitTestName=".$name."'>Start This Assignment</a><br />";
        echo "<br />";
    }
*/

}

include("../shared_php/footer.php");
?>
