<?php
require dirname(__FILE__) . '/../files/KLogger.php';
echo 'file'.$_SESSION['uniqueID'];
$log   = KLogger::instance(dirname(__FILE__) . '/../files/log'.$_SESSION['uniqueID'], KLogger::INFO);
$uniqueID=$_SESSION['uniqueID'];
session_start();
$log->Loginfo("in saveForm");
$x1 = $_SESSION['txtname'];

//echo "$x1<br>";

$Pname = $_POST['pName'];
$filext = $_POST['fileExt'];
$txt1 = $_POST['txt1'];


$tab = "&nbsp; &nbsp; &nbsp;";
$space= "&nbsp;&nbsp;";
$pa = str_replace("", "" , str_replace(" ", $space , str_replace("\t", $tab, $txt1)));


if ($filext == '.cpp')
{	
	$file =  $Pname.$filext ;
	
	file_put_contents($file, $txt1);

	header('Content-Description: File Transfer');
	header('Content-Type: application/text/x-c++src');
	header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Transfer-Encoding: binary');
	echo "$txt1";
	
}

else if ($filext == '.h')
{

	$file =  $Pname.$filext ;
	
	file_put_contents($file, $txt1);
	
	header('Content-Description: File Transfer');
	header('Content-Type: application/text/x-chdr');
	header('Content-Disposition: attachment; filename='.basename($file));
	
	echo "$txt1";
}
else if ($filext == '.py')
{
	$file =  $Pname.$filext ;
	
	file_put_contents($file, $txt1);

	header('Content-Description: File Transfer');
	header('Content-Type: application/text/x-python');
	header('Content-Disposition: attachment; filename='.basename($file));
	
	echo "$txt1";
 
}
else
{
	echo "<script type='text/javascript'>alert('Please choose your file extension.');</script>";
	header('Refresh: 2; URL=saveForm.php');
}

?>
