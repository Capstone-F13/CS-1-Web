<?php 
   define("basedir", "/var/www/html/WebR3a/files/");
   define("logdir", basedir.$_SESSION["uniqueID"]."/");
   define("BUFFSIZE", 8192);
   define("gdbprompt", "(gdb)");
   define("pdbprompt", "(Pdb)");
   define("ptype","py");
   define("ctype","cpp");
   define("gdbstr","bugs/>.");
   define("scr","student_source"); 
   define("errfile","error_file");

   /*
   function init_compile_debug(){
    //echo("in init_compile%");
    if ( !file_exists(logdir)){  //should use file_exists and is_dir
            if (! mkdir (logdir,0777) ){
                echo("start_debuger:couldnt create logdir");
            }
        
        }   
    }


      
   function compile_prog($prog_type){
      init_compile_debug();
      if ($prog_type == ptype){
         $command="python -m py_compile ".logdir.scr.".".$prog_type." >& ".logdir."/errors";
         //echo "Pcompile_prog:".$command."%";
         exec($command,$output,$return);
         //echo("Pcompile_prog:output=".$output."%");
         //echo("Pcompile_prog:output=".$return."%");
      }
      else{
         $command="g++ -g -o ".logdir.scr." ".logdir.scr.".".$prog_type." >& ".logdir."/errors";
         //echo("Gcompile_prog:command=".$command."%");
         exec($command,$output,$return);
         //echo("Gcompile_prog:output=".$output."%");
         //echo("Gcompile_prog:output=".$return."%");
      } 
   }

function check_launch_compile(){
     init_compile_debug();
     $prog=logdir.scr;
     $lang=$_POST['plang'];
     $theProgram = $_POST['txtname'];
     $prog=logdir.scr.".".$lang;
     $file = fopen($prog,"w");
     $size=fwrite($file, $theProgram);
     if ($size ==0){
         echo "did not write program to file";  
      }
      fclose($file);
      compile_prog($lang);
      return;           
   } 
 
   function start_debugger($prog_type){  
     init_compile_debug();
     if (!(($prog_type == ctype) or ($prog_type == ptype))){
         echo "start_debugger:incorrect prog_type parameter: ".$prog_type; 
     }
     $toDebugger = logdir."OUT".$prog_type.$_SESSION["uniqueID"];
     $fromDebugger = logdir."IN".$prog_type.$_SESSION["uniqueID"];
     $fileCheckO = file_exists($toDebugger);
     $fileCheckI = file_exists($fromDebugger);
     echo "checkO=". $fileCheckO;
     echo "checkI=". $fileCheckI;
     var_dump($fileCheckO);
     if(($fileCheckO == 0)&&($fileCheckI == 0)){
          $launch=basedir."interface".$prog_type.$_SESSION["uniqueID"]." > /dev/null & echo $! ";
          $cwd=getcwd();
          if (!chdir(logdir)){
             echo("couldnt chdir to ".logdir."\n");
          }
          $_SESSION[$prog_type]=exec($launch);
          echo("started program ".$child_pid."\n");
          while(($fileCheckO == 0)&&($fileCheckI == 0)){
               $fileCheckO = file_exists($toDebugger);
               $fileCheckI = file_exists($fromDebugger);
          }
          chdir($cwd);
          echo "checkO=". $fileCheckO;
          echo "checkI=". $fileCheckI;
           
      }



     if(($fdtoDbg = fopen($toDebugger, "w")) == 0)
          echo( "not opened"); //put error here


     if(($fdfrmDbg = fopen($fromDebugger, "r")) == 0 )
         echo( "not opened"); //put error here
     if ($prog_type == ctype){ 
                 while($input = fgets($fdfrmDbg)) {
                       $queue[] = $input;
                       echo($input);
                       if (strpos($input,gdbstr))
			   break;
                 }
                 echo("\nlooking for prompt\n");
                 $input = fread($fdfrmDbg,5); 
                 echo($input);
                 echo("\n found gdb prompt \n");
     }
     elseif ($prog_type == ptype){

            while($input = fgets($fdfrmDbg)) {
                       $queue[] = $input;
                       echo($input);
                       if (strpos($input,pprompt))
			   break;
                 }
                 echo("\nlooking for prompt\n");
                 $input = fread($fdfrmDbg,5);
                 echo($input);
                 echo("\n found pdb prompt \n");

      }
      else{
         echo "start_debugger: cannot get here";
      }

 
  }
  function debugger_send($command){
       $written=fwrite($fdtoDbg, $command, count($command));
       if ($written == 0) {
           echo "debugger_send:error short write\n";
       }
  }

*/

/*-----------------------------------------------------------------*/
    

   define("basedir1","C:/wamp/www/CS-1-Web/shared_php/tmp/");
   define("logdir1", basedir1.$_SESSION["uniqueID"]."/");
    

     function init_compile_debug1(){
    //echo("in init_compile%");
    if ( !file_exists(logdir1)){  //should use file_exists and is_dir
            if (! mkdir (logdir1) ){
                echo("start_debuger:couldnt create logdir");
            }
        
        }   
    }
     

     function check_launch_compile1($type){
     init_compile_debug1();
     $prog=logdir1.scr;
     $theProgram = $_POST['txtarea'];
     $prog=logdir1.scr.".".$type;
     $file = fopen($prog,"w");
     $size=fwrite($file, $theProgram);
     if ($size ==0){
         echo "did not write program to file";  
      }
      fclose($file);
      compile_prog1($type);
      return;           
   } 
   

     function compile_prog1($prog_type){
      init_compile_debug1();
      if ($prog_type == ptype){
         $command="python -m py_compile ".logdir1.scr.".".$prog_type." >& ".logdir1."/errors";
         //echo "Pcompile_prog:".$command."%";
         exec($command,$output,$return);
         //echo("Pcompile_prog:output=".$output."%");
         //echo("Pcompile_prog:output=".$return."%");
      }
      else{
        echo "here";
         $command="g++ -g -o ".logdir1."/".scr." ".logdir1."/".scr.".".$prog_type." >& ".logdir1."/errors/error.txt";
         //echo("Gcompile_prog:command=".$command."%");
         exec($command,$output,$return);
         //echo("Gcompile_prog:output=".$output."%");
         //echo("Gcompile_prog:output=".$return."%");
      } 
   }


   
?>