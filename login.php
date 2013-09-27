<?php
require_once("shared_php/databaseConnect.php");
require dirname(__FILE__) . '/files/KLogger.php';
session_start();

//set "Keep Me Logged In" session variable
if(isset($_POST['remember'])) {
    $_SESSION['stayLoggedIn'] = true;
} else {
    $_SESSION['stayLoggedIn'] = false;
}

//check for last activity, and kill session as needed
if (isset($_SESSION['lastActivity'])) {
    if ($_SESSION['stayLoggedIn'] == true) {
        if (time() - $_SESSION['lastActivity'] > 2592000) {
            session_unset();
            session_destroy();
            header("Location:../shared_php/session_expired.php");
        }
    } else if (time() - $_SESSION['lastActivity'] > 1800) {
        session_unset();
        session_destroy();
        header("Location:../shared_php/session_expired.php");
    }
} else {
$_SESSION['lastActivity'] = time(); // update last activity time stamp
}

$email = $_POST["username"];
$passwordHash = md5($_POST["password"]);
$query = "SELECT idMember, FirstName, LastName, IsInstructor, MemberBanner FROM Member WHERE MemberEmail='$email' AND MemberPassword='$passwordHash'";
$result = $mysqli->query($query);

if (mysqli_num_rows($result) == 1) 
{
    //create all session variables required for user

    
    $memberData = mysqli_fetch_array($result);
    $_SESSION['start'] = time(); // get current time
    $_SESSION['expire'] = $_SESSION['start'] + (30 * 60) ; // ends the session in 30 minutes from starting time
    $_SESSION['email'] = $email;
    $_SESSION['firstname'] = $memberData['FirstName'];
    $_SESSION['lastname'] = $memberData['LastName'];
    $_SESSION['memberbanner'] = $memberData['MemberBanner'];
    $_SESSION['idmember'] = $memberData['idMember'];
    $_SESSION['isinstructor'] = $memberData['IsInstructor'];
	$_SESSION['uniqueID']=uniqid ();
   /*
    $log   = KLogger::instance(dirname(__FILE__) . '/files/log'.$_SESSION['uniqueID'], KLogger::INFO);
    $log->logInfo('dirname(__FILE__)=',dirname(__FILE__) );
    //redirect to instructor interface (active courses)
	*/	 
    if ($_SESSION['isinstructor'] == 1) {
        header("Location:instructor/acourses.php");
    }

    //redirect to student interface (my courses)
    else if ($_SESSION['isinstructor'] == 0) {
        header("Location:student/myCourses.php");
    }

    //else contact system admin
    else {
        echo "ERROR: neither a student nor an instructor; please contact a systen administrator";
    }
}
else {
    //redirect to login and (in red text) state "username or password incorrect"
    echo "Either there is no user with that login combination, or there is more than one user with that combination";
}
 @$_SESSION['log']->LogInfo("after login");
 echo "after login";

?>
