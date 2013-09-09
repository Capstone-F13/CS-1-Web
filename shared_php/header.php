<?php
session_start();
include("testConnection.php");






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

?>

<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $title; ?> </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="generator" content="RapidWeaver" />
        <link rel="stylesheet" href="../css/main.css" />
         <link rel="stylesheet" href="../css/codemirror.css" />
        <link rel="stylesheet" href="../css/jquery-ui.css" />
        <link rel="stylesheet" href="../css/nav-bar.css" />
        <script language="JavaScript1.1" src="../js/createAssignment.js" type="text/javascript"></script>
        <script language="JavaScript1.1" src="../js/animatedcollapse.js" type="text/javascript"></script>
        <script language="JavaScript1.1" src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script language="JavaScript1.1" src="../js/jquery-ui.js" type="text/javascript"></script>
        <script language="JavaScript1.1" src="../js/myAccount.js" type="text/javascript"></script>
        <script language="JavaScript1.1" src="../js/datepicker.js" type="text/javascript"></script>
		<script language="JavaScript1.1" src="../js/debugger.js" type="text/javascript"></script>

        <!-- includes for CodeMirror -->
        <script language="JavaScript" src="../js/codemirror.js"></script>
        <script language="JavaScript" src="../js/clike.js"></script>
        <script language="JavaScript" src="../js/python.js"></script>
        <style type="text/css">
        .CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;}
        .CodeMirror-activeline-background {background: #e8f2ff !important;}
            .capstone-errorline-background {background: #FF6A57;}
            .capstone-currentline-background {background: #FAE68C;}
        </style>
    </head>
    <body>
        <div id="big_wrapper">
            <div align="right">
                <?php
                if ($_SESSION['isinstructor'] == 0) { //if they're a student, output student buttons
                    echo " <div id='menu'>
   
      <ul id='nav'>
        <li><a href='../shared_php/logout.php'>Log out</a>        


               </li>
    </ul>
   

      <ul id='nav'>
        <li><a href='../shared_php/practice.php'>&nbsp; Practice   &nbsp;     |</a>

               </li>
    </ul>
   

   
    <ul id='nav'>
        <li><a href=''>&nbsp; My Account &nbsp;   |</a>
            <ul>
                <li><a href='../shared_php/changePass.php'>Change Password</a></li>
                <li><a href='../shared_php/viewNotif.php'>View Notification</a></li>
                <li><a href='../student/viewSubmissions.php'>View Submissions</a></li>

            </ul>
        </li>
    </ul>
    
    
     

   
<ul id='nav'>
        <li><a href='../student/myCourses.php' >&nbsp; My Courses &nbsp; |</a>      
             </li>
    </ul>



</div>  



";
                    
             }    else { //they must be an instructor, output instructor buttons
                    echo "  <div id='menu'>
   
      <ul id='nav'>
        <li><a href='../shared_php/logout.php'>Log out</a>        
               </li>
    </ul>
   


   
      <ul id='nav'>
        <li><a href='../shared_php/practice.php'>&nbsp; Practice &nbsp; |</a>      
               </li>
    </ul>
   
  

   
     <ul id='nav'>
        <li><a href=''> My Account &nbsp;  &nbsp;    |</a>      
            <ul>
                <li><a href='../shared_php/changePass.php'>Change Password</a></li>
                <li><a href='../instructor/sendNotif.php'>Send Notification</a></li>
				<li><a href='../shared_php/viewNotif.php'>View Notification</a></li>
            </ul>
        </li>
    </ul>
    
  
    <ul id='nav'>
        <li><a href=''> &nbsp Course Admin &nbsp |</a>        
            <ul>
                <li><a href='../instructor/addCourse.php'>Add Course</a></li>
                <li><a href='../instructor/courselog.php'>Copy Course</a></li>
                <li><a href='../instructor/closeCourse.php'>Close Course</a></li>
                <li><a href='../instructor/reopenCourse.php'>Reopen Course</a></li>

            </ul>
        </li>
    </ul>
    
    
       
    <ul id='nav'>
        <li><a href='../instructor/finishedCourses.php' >&nbsp; Closed Courses &nbsp;   |</a>       
             </li>
    </ul>
   
  

   
<ul id='nav'>
        <li><a href='../instructor/acourses.php' >&nbsp; Active Courses   &nbsp;  |</a>        
             </li>
    </ul>

</div>";
                }  
                    
                    
                ?>
                
                <br> <br>
            </div>
