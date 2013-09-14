<script language="php">
   
	//$host = "capstone-s13.cs.kent.edu";   // database server host domain name
	$host = "localhost";
        $uid = "ckerstin";                  // needs to be secured
	$pass = "capstones13";
	//$dbname = "capstones13"; 
	$dbname = "cs1web"; //local dbname     
	$db_obj = mysql_connect($host, $uid, $pass, $dbname);  // connection object

	if (!$db_obj) {  // connection failed
		printf("Can't connect to $host $dbname. %s:%s\n", mysqli_connect_errno(), mysqli_connect_error());
		exit();
	}

	mysql_select_db($dbname, $db_obj);
      
</script>
