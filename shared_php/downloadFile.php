<?php
require_once("../shared_php/databaseConnect.php");
?>

<?php
	/*
		Get assignment code and name from table assignment where
			AssignmentClass = $cid (provided in url)
			idAssignment = page id (provided in url)
		URL variable usage: "downloadFile.php?=x&cid=y
			where x = page id and y = cid
	*/
	$selectSQL = "SELECT AssignmentCode, AssignmentName FROM `assignment` WHERE AssignmentClass = " . $_GET['cid'] . " AND idAssignment = " . $_GET['id'] ;
	$result = mysql_query($selectSQL);
	$row = mysql_fetch_row($result);

	//Ensure file name has no spaces (breaks Content-Disposition otherwise)
	$fileName = str_replace(' ', '_', $row[1]) . ".txt";
	
	//Set-up page to be content distribution, ensure page only performs download, otherwise unintended content will be written to file
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment; filename=' . $fileName);
	header('Content-Length: "' . strlen($row[0]));

	//Perform the echo to file of assignment code, then close this PHP section (prevents further PHP/HTML from being written to file)
	echo $row[0];
	exit;
?>