<?php
include("../shared_php/header.php");
include("../shared_php/compile.php");
require dirname(__FILE__) . '/../files/KLogger.php';
error_reporting(-1);
/*
$unitTestId = $_SESSION['idUnitTest'];
$name = $_SESSION['UnitTestName'];

$title = "Unit Testing"; //enter title into the quotation marks
@$id = $_SESSION['idUnitTest'] = $_GET['idUnitTest'];
@$name = $_SESSION['UnitTestName'] = $_GET['UnitTestName'];
//$_SESSION['uniqueID']=uniqid ();
$idmember = $_SESSION['idmember'];

$query = "SELECT UnitTestType, UnitTestReveal, UnitTestCode 
          FROM UnitTest
          WHERE idUnitTest = '$unitTestId'";
        
$query = "SELECT Classes.idClass, Classes.ClassName, UnitTest.idUnitTest, UnitTest.UnitTestName, UnitTest.UnitTestType
FROM Classes
INNER JOIN UnitTest ON Classes.idClass = UnitTest.UnitTestClass
INNER JOIN Roster ON Classes.idClass = Roster.ClassId
WHERE Roster.StudentId = '$idmember'";
$queryResult = $mysqli->query($query);


$queryRow = $queryResult->fetch_row();
$type = $queryRow[0];
$reveal = $queryRow[1];
$code = $queryRow[2];
$input = $_POST['txtarea'];
$filepath = "../shared_php/tmp/";
$root = "CS-1-Web/shared_php/tmp";
$filename = rand(0,1000000);
if($type == 0)
  $ext = "cpp";
else if($type == 1)
  $ext = "py";

check_launch_compile($ext);
compile_prog($ext);
*/

$reveal = 1;

?>

<!DOCTYPE html>
<head>
  <script type="text/javascript" src="../js/unit-test.js"></script>
  <title>Unit Test Results</title>
</head>
<?php

//$_SESSION['uniqueID']=uniqid ();
$idmember = $_SESSION['idmember'];
$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
$log->logInfo('In Practice page',$_SESSION['uniqueID']);

?>

<header id="top_header">
  <h1 style="text-align: center">Unit Results</h1>
  <style>
   <?php //Line below allows multiple submit buttons on same line ?>
    form { display: inline; }
  </style>
</header>


  <!--Main Section where show code, upload and save -->
<section id="main_section" >
    <h1> Unit Test - Test Name <?php //echo $name ?> </h1>
    <h3>The correct answer is: <?php  ?></h3>
    <h3>Your answer: <?php ?></h3>
    <h3>Your Code:</h3>
    <textarea name="txtarea" id="txtarea"><?php echo $_POST['txtarea']; ?></textarea><br /><br />

    <?php 
    if($reveal == 1)
    {
    ?>
        <h3>Unit Test For This Assignment</h3>
        <textarea name="txtarea2" id="txtarea2" cols="50"><?php echo '//unit test'; //$code; ?></textarea>
    <?php
    }
    ?>



  <!-- code to display link to textarea-->
 <script>
function updateCode()
{
    filepicker.read(document.getElementById('uploadedfile').value, function(data){
      codeEditor.replaceSelection(data, "end");
    });
}

</script>

<!--Functions for debugging-->
        <script type="text/javascript">


  var codeEditor = CodeMirror.fromTextArea(document.getElementById("txtarea"), {
    mode: "text/x-csrc",
	lineNumbers: true,
	indentUnit: 4,
	tabMode: "shift",
	matchBrackets:true,
	});
codeEditor.setSize("40em", "20em");

var codeEditor2 = CodeMirror.fromTextArea(document.getElementById("txtarea2"), {
    mode: "text/x-csrc",
  lineNumbers: true,
  indentUnit: 4,
  tabMode: "shift",
  matchBrackets:true,
  });
codeEditor.setSize("40em", "20em");


            
var showresponse = function(data)
{
           
  document.getElementById("tname").innerHTML = JSON.stringify(data);
                
}
  </script>

  </section>

<?php

  include("../shared_php/footer.php");
?>
</html>