<?php

define('IN_SCRIPT', true);
// Start a session
session_start();

//Connect to the MySQL Database
require_once("databaseConnect.php");


//this function will display error messages in alert boxes, used for login forms so if a field is invalid it will still keep the info
//use error('foobar');
function error($msg) {
    ?>
    <html>
    <head>
  
    <script language="JavaScript">
    <!--
        alert("<?=$msg?>");
        history.back();
    //-->
    </script>
    </head>
    <body>
    </body>
    </html>
    <?
    exit;
}

//This functions checks and makes sure the email address that is being added to database is valid in format. 
function check_email_address($email) {
  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
     if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }  
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

if (isset($_POST['submit'])) {
	
	if ($_POST['forgotpassword']=='') {
		error('Please Fill in Email.');
	}
	if(get_magic_quotes_gpc()) {
		$forgotpassword = htmlspecialchars(stripslashes($_POST['forgotpassword']));
	} 
	else {
		$forgotpassword = htmlspecialchars($_POST['forgotpassword']);
	}
	//Make sure it's a valid email address, last thing we want is some sort of exploit!
	if (!check_email_address($_POST['forgotpassword'])) {
  		error('Email Not Valid - Must be in format of name@domain.tld');
	}
    // Lets see if the email exists
    $sql = "SELECT COUNT(*) FROM Member WHERE MemberEmail = '$forgotpassword'";
    $result = mysql_query($sql)or die('Could not find member: ' . mysql_error());
    if (!mysql_result($result,0,0)>0) {
        error('Email Not Found!');
    }
/*
INSTEAD OF THIS, SET PASSWORD BACK TO BANNER ID
	//Generate a RANDOM MD5 Hash for a password
	$random_password=md5(uniqid(rand()));
	
	//Take the first 8 digits and use them as the password we intend to email the user
	$emailpassword=substr($random_password, 0, 8);
	
	//Encrypt $emailpassword in MD5 format for the database
	$newpassword = md5($emailpassword);
	
*/	

		$query_getbanner = "SELECT MemberBanner FROM Member WHERE MemberEmail = '" . $_POST['forgotpassword']."'";
		$result = mysql_query($query_getbanner);
		$row = mysql_fetch_array($result);
		$newpassword = md5($row['MemberBanner']);
		
        // Make a safe query
       	$query = sprintf("UPDATE `Member` SET `MemberPassword` = '%s' 
						  WHERE `MemberEmail` = '$forgotpassword'",
                    mysql_real_escape_string($newpassword));
					
					mysql_query($query)or die('Could not update members: ' . mysql_error());

//Email out the infromation
$subject = "Your New Password"; 
$message = "Your new password is as follows:
---------------------------- 
Password: $emailpassword
---------------------------- 
Please make note this information has been encrypted into our database 

This email was automatically generated."; 
                       
          if(!mail($forgotpassword, $subject, $message,  "FROM: $site_name <$site_email>")){ 
             die ("Sending Email Failed, Please Contact Site Admin! ($site_email)"); 
          }else{ 
                error('New Password Sent!.');
         } 
		
	}
	
else {
?>
<html>
<head>

<title>Forget Password</title>
        <link rel="stylesheet" href="../css/base.css">
        <link rel="stylesheet" href="../css/layout.css">
		<link rel="stylesheet" href="../css/main.css">

</head>

<body>

        <div class="form-bg">
      <form name="forgotpasswordform" action="" method="post">
 									<h2>Forget Password</h2>
                <p><input name="forgotpassword" placeholder="Email" type="text" value="" id="forgotpassword"></p>
                <button type="submit" name="submit" value="Submit" class="button" style="float:right;display:block;margin-right:40px">Submit </button>
				<a href="../index.html" style="float:left;display:block;margin-left:40px;color:#FFFFFF;
					border-top: 2px solid #EEEEEE;
					border-right: 2px solid #808080;
					border-bottom: 2px solid #808080;
					border-left: 2px solid #EEEEEE;" 
				class="button">Back</a>
                <br />

      
      </div>
      
      
      
      
</body>
</html>   
<?
}
?>

