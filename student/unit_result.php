<?php
$_POST['txtarea']
?>

<!DOCTYPE html>
<head>
  <script type="text/javascript" src="../js/unit-test.js"></script>
</head>
<?php
$title = "Unit Results";        //enter title into the quotation marks
include("../shared_php/header.php");
require dirname(__FILE__) . '/../files/KLogger.php';
//$_SESSION['uniqueID']=uniqid ();
$idmember = $_SESSION['idmember'];
$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
$log->logInfo('In Practice page',$_SESSION['uniqueID']);

/*
$query = "SELECT Classes.idClass, Classes.ClassName, UnitTest.idUnitTest, UnitTest.UnitTestName, UnitTest.UnitTestType
          FROM Classes
          INNER JOIN UnitTest ON Classes.idClass = UnitTest.UnitTestClass
          INNER JOIN Roster ON Classes.idClass = Roster.ClassId
          WHERE Roster.StudentId = '$idmember'"; 
$result = $mysqli->query($query);
*/
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
<?php
    if(!isset($_POST['txtarea']) || $_POST['txtarea'] =="")
    {
    ?> 
    <h1> Unit Test - <?php echo $name ?> </h1>
    <form action="unit_testing.php" id="courses" name="courses" method="POST">

      <h1>Code:</h1>
      <script type="text/javascript" src="//api.filepicker.io/v1/filepicker.js">
      filepicker.setKey('ANXgRAtRSvutC6rHIAY4Az');
      </script>

      <!-- Note data-fp-extensions must be separated by comma and NO space -->
      <input id="uploadedfile" onchange="updateCode();" data-fp-button-class="button" data-fp-button-text="Upload File" data-fp-services="COMPUTER,DROPBOX,GMAIL,FTP,GITHUB,GOOGLE_DRIVE,URL" data-fp-container="modal" data-fp-extensions=".cpp,.h,.py" data-fp-apikey="ANXgRAtRSvutC6rHIAY4Az" type="filepicker"> 
      
      <textarea name="txtarea" id="txtarea"></textarea>
      <input type="hidden" id="input" name="input" />
      <input type="submit" id="courseSubmit" name="courseSubmit" value="Submit" onclick="return validate(codeEditor);">
    </form>    
<?php
    }

    else
    {
?>

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