<?php
$title = "Practice";        //enter title into the quotation marks
include("../shared_php/header.php");
require dirname(__FILE__) . '/../files/KLogger.php';
//$_SESSION['uniqueID']=uniqid ();

$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
$log->logInfo('In Practice page',$_SESSION['uniqueID']);
?>
<header id="top_header">
  <h1 style="text-align: center">Practice Page</h1>
  <style>
   <?php //Line below allows multiple submit buttons on same line ?>
    form { display: inline; }
  </style>
</header>

<div id="new_div">
  <aside id="side_code">
  <h4>Sample Code:</h4>
  <input type="radio" name="prog-sample" class="prog-sample" value="c++" id="c_">C++
  <br />
  <input type="radio" name="prog-sample" class="prog-sample" value="python" id="Py_">Python
  <div id="c1" style="display: none; margin: 5px; width: 110px; border-top: 2px solid blue;">
  <a href="#"  onclick="display_file('../codeSamples/test.cpp')">C++ sample1</a><br><br>
  <a href="#" onclick="display_file('../codeSamples/test2.cpp')">C++ sample2</a>
  </div>
  <div id="py2" style="display: none; margin: 5px; width: 110px; border-top: 2px solid blue;">
  <a href="#" onclick="display_file('../codeSamples/test_py1.py')">Py sample1</a><br><br>
  <a href="#" onclick="display_file('../codeSamples/test_py2.py')">Py sample2</a>
  </div>

  <!-- this script to show/hide radio button menu...-->
  <script type="text/javascript">
  $(function(){     
      $('.prog-sample').click(function(){
	  if ($(this).attr("id") == "Py_")
	    {
	      $('#py2').show();
	      $("#c1").hide();
	    }
	  else if ($(this).attr("id") == "c_")
	    {
	      $('#c1').show();
	      $("#py2").hide();
	    }
	  else 
	    {
	      $("#c++1").hide();
	      $("#py2").hide();
	    }
	});
    });
</script>

<p style="margin-top: 20px;">Controls: </p>
        <button id="Compilebtn" type="button" onClick="compile()" class="button">Compile</button>
        <br>
        <button id="Runbtn" type="button" onClick="run()" class="button">Run</button>
        <br>
        <button id="Outputbtn" type="button"  onClick="getStdOut()" class="button">Output</button>
        <br>
        <button id="Exitbtn" type="button" onClick="giveInput()" class="button">giveInput</button>
        <br>
        <button id="stepOvbtn" type="button"  onClick="stepOver()" class="button">StepOver</button>
        <br>
        <button id="StepOubtn" type="button"  onClick="stepOut()" class="button">StepOut</button>
        <br>
        <button id="StepInbtn" type="button" onClick="stepIn()" class="button">StepIn</button>
        <br>
        <button id="Killdebugbtn" type="button" onClick="killDebugger()" class="button">kill Debugger</button>
        <br>
  </aside>

  <!--Main Section where show code, upload and save -->
  <section id="main_section" >
  <h1>Code:</h1>
  <script type="text/javascript" src="//api.filepicker.io/v1/filepicker.js">
  filepicker.setKey('ANXgRAtRSvutC6rHIAY4Az');
  </script>

  
<form>
<!-- Note data-fp-extensions must be separated by comma and NO space -->
<input id="uploadedfile" onchange="updateCode();" data-fp-button-class="button" data-fp-button-text="Upload File" data-fp-services="COMPUTER,DROPBOX,GMAIL,FTP,GITHUB,GOOGLE_DRIVE,URL" data-fp-container="modal" data-fp-extensions=".cpp,.h,.py" data-fp-apikey="ANXgRAtRSvutC6rHIAY4Az" type="filepicker"> 
</form>

  <form enctype="multipart/form-data" name="SaveForm" action="saveForm.php" method="POST" target="win1" onsubmit="window.open('', 'win1', 'width=400, height=200, left=200, top=50,status=yes,resizable=yes,scrollbars=yes')">
  <input name="submit" type="submit" class="button" Value="Save Changes">

  <!--GDB = 'g', PDB = 'p' -->
            <select id="debugger" name="debugger">
                <option>Choose a language to Compile</option>
                <option value="c++">C++</option>
                <option value="python">Python</option>
            </select>

            <br>

  <?php /*if (!empty($_FILES['uploadedfile']) && file_exists($_FILES['uploadedfile']['tmp_name'])) {
    echo htmlentities(file_get_contents($_FILES['uploadedfile']['tmp_name']) , ENT_QUOTES, 'UTF-8');
  }*/?>
  <?php
  if (isset($_SESSION['AssignmentCode'])){
    echo '<textarea name="txtname" id="txtname">' . $_SESSION['AssignmentCode'] . '</textarea>';
  } else {
    echo '<textarea name="txtname" id="txtname"></textarea>';
  }
  ?>

<pre>The below area for input:</pre>
            <textarea id="input" name="input"></textarea>
  <br>

  </form>
  
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


  var codeEditor = CodeMirror.fromTextArea(document.getElementById("txtname"), {
    mode: "text/x-csrc",
	lineNumbers: true,
	indentUnit: 4,
	tabMode: "shift",
	matchBrackets:true,
	});
codeEditor.setSize("40em", "20em");

var inputEditor = CodeMirror.fromTextArea(document.getElementById("input"), {
  smartIndent: false
      });
inputEditor.setSize("40em", "5em");
            
var showresponse = function(data)
{
           
  document.getElementById("tname").innerHTML = JSON.stringify(data);
                
}
  </script>

  </section>
</div>

<!--Start output the result and the variable section -->
<bottom style="margin-bottom:0px;" id="b-bottom">

  <!-- Start of result table-->
  <table id="t-table" > 
  <tr> 
  <td>
  <span style="padding: 0px;">Output:</span>
  <textarea style="font: 16px Arial; color: blue; " name="tname" id="tname" cols="55" rows="15" readonly style="resize: none;"></textarea>

  </td> 
  <td style="padding-left: 50px;">
  <!-- Start display variable table-->
  <table rules="all" cellpadding="10">
  <tr style="text-align: center;">
  <th>Variable</th>
  <th>Value</th>
  </tr>
  <tr style="text-align: center;">
  <td>y   <!-- ROW:1 COL:1 --></td>
  <td>3   <!-- ROW:1 COL:2 --></td>
  </tr>
  </table>

  <!-- End display variable table-->
  
  </td>
  </tr> 
  </table>

  <br>
</bottom>

<?php
  include("../shared_php/footer.php");
?>
