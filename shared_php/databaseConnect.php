<?php
   /*
	$host = "capstone-s13.cs.kent.edu";   // database server host domain name
	$uid = "ckerstin";                  // needs to be secured
	$pass = "capstones13";
	$dbname = "capstones13";
	$mysqli = new mysqli($host, $uid, $pass, $dbname);  // connection object
    */
    
    $host = "localhost";   // database server host domain name
	$uid = "root";                  // needs to be secured
	$pass = "";
	$dbname = "capstone";
	$mysqli = new mysqli($host, $uid, $pass, $dbname);  // connection object
	
	
    /* check connection */
	if ($mysqli->connect_errno) 
	{
	    printf("Connect failed: %s\n", $mysqli->connect_error);
	    exit();
	}
      
?>
