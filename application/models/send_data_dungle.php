<?php
class Send_data_dungle extends CI_Model {
     
   

   public function SendDataDungle()
   {
   	$returnVal=0;

   	system($this->config->item('config_path_prog')."sendDataDungle.exe",$returnVal);

   	switch ($returnVal) {
   		case 0 :
            echo 'Execution du programme ok';
            break;

         case 1:
   			echo 'Miscellaneous errors, such as "divide by zero" and other impermissible operations'; 
   			break;

   		case 2:
   			echo 'Misuse of shell builtins (according to Bash documentation)	empty_function() {}	Missing keyword or command'; 
   			break;
   		
   		default:
   			echo "Val retourné".$returnVal;
   			break;
   	}

   	/*
	1	Catchall for general errors	let "var1 = 1/0"	Miscellaneous errors, such as "divide by zero" and other impermissible operations
2	Misuse of shell builtins (according to Bash documentation)	empty_function() {}	Missing keyword or command
126	Command invoked cannot execute	/dev/null	Permission problem or command is not an executable
127	"command not found"	illegal_command	Possible problem with $PATH or a typo
128	Invalid argument to exit	exit 3.14159	exit takes only integer args in the range 0 - 255 (see first footnote)
128+n	Fatal error signal "n"	kill -9 $PPID of script	$? returns 137 (128 + 9)
130	Script terminated by Control-C	Ctl-C	Control-C is fatal error signal 2, (130 = 128 + 2, see above)
255*	Exit status out of range	exit -1	exit takes only integer args in the range 0 - 255

   	*/

    }






}

?>