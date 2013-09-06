<?php
$title = "My Account"; //enter title into the quotation marks
include("../shared_php/header.php");

echo "<h2><a href='../shared_php/changePass.php'>Change Password</a></h2>";

if ($_SESSION['isinstructor'] == 1) {
	echo "<h2><a href='../instructor/sendNotif.php'>Send Notifications</a></h2>";
}

if ($_SESSION['isinstructor'] == 0) {

echo "<h2><a href='../student/viewNotif.php'>View Notifications</a></h2>";
}
if ($_SESSION['isinstructor'] == 0) {
	echo "<h2><a href='../student/viewSubmissions.php'>View Submissions</a></h2>";
}

include("../shared_php/footer.php");
?>
