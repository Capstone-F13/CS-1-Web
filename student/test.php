<!DOCTYPE html>
<head>
  <script type="text/javascript" src="../js/unit-test.js"></script>
</head>
<?php
$title = "Unit Testing";        //enter title into the quotation marks
include("../shared_php/header.php");
require dirname(__FILE__) . '/../files/KLogger.php';
//$_SESSION['uniqueID']=uniqid ();
$idmember = $_SESSION['idmember'];
$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
$log->logInfo('In Practice page',$_SESSION['uniqueID']);

$query = "SELECT Classes.idClass, Classes.ClassName, Assignment.idAssignment, Assignment.AssignmentName, Assignment.AssignmentType
          FROM Classes
          INNER JOIN Assignment ON Classes.idClass = Assignment.AssignmentClass
          INNER JOIN Roster ON Classes.idClass = Roster.ClassId
          WHERE Roster.StudentId = '$idmember'"; 
$result = $mysqli->query($query);

if( (isset($_POST['course'])) && (isset($_POST['txtarea'])) )
{
    $query = "SELECT "
}
?>

<header id="top_header">
  <h1 style="text-align: center">Unit Test</h1>
  <style>
   <?php //Line below allows multiple submit buttons on same line ?>
    form { display: inline; }
  </style>
</header>



  <!--Main Section where show code, upload and save -->
<section id="main_section" >
<?php
if( (!isset($_POST['course'])) || (!isset($_POST['txtarea'])) || ($_POST['txtarea'] == "") )
{
  /*
    if(isset($_POST['txtarea']))
      $_POST['txtarea'] = null;
    */  
?> 
  <form action="test.php" id="courses" name="courses" method="POST" enctype="multipart/form-data">
    <h1>Choose Assignment</h1>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <input type="radio" name="course" id="course" value="<?php echo $row['idAssignment']; ?>"> <?php echo $row['ClassName']." - ".$row['AssignmentName']; ?> <br />  
    <?php
    }
    ?> 

    <h1>Code:</h1>
    <input type="file" name="file" id="file" onchange="loadfile(this)"><br />
    <textarea id="txtarea" name="txtarea" rows="10" cols="50"></textarea>
    <input type="submit" id="courseSubmit" name="courseSubmit" value="Submit" onclick="validate();">
    </form>
    
<?php
}
?>

<?php
//var_dump($_POST['txtarea']);
  include("../shared_php/footer.php");
?>
</html>