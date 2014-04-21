<?php
/*
	@type: CLASS
	@author: MARIZ MELO
	@description: Debug system, this class is inherited by all classes on the framework
*/


abstract class Debug{
	
	
	private $_XDEBUG = 0;
	
	
	
	public function debugLOG()
	{
	  $bt = debug_backtrace();
	  $caller = array_shift($bt);
	
	   echo $caller['file']." ".$caller['line'];
	
	  // do your logging stuff here.    
	}
	
	
	public function superHelp(){	
	
		$HELP  = 'type: DEBUG "abstract" Class\n'
		. 'author: Mariz Melo\n'
		. 'released: 10-11-2010\n'
		. 'description: "Provide methods to control DEBUG system messages"'
		. 'METHODS: debugSTART( (int) 1 ) //just set 1 if want to see the PHP messages'
		. 'ex: $instance_var->debugSTART(); //only the system messages'
		. 'ex: $instance_var->debugSTART(); //initialize only the system messages';
		
		
		$this->debugMESSAGE('H', $HELP); //show help message
		return '';
		
	}
	
	
	//START THE DEBUG MESSAGES
	public function debugSTART($phperror = 0){
		
		//PHP SYSTEM ERROR MESSAGES
		if ($phperror == 1) {
			
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
			
		}		
			
		//START TO SHOW SYSTEM MESSAGES
		$this->_XDEBUG = 1; //set the object variable to 1 allowing the system report messages
		
	}//end: method

	public function debugCOLOR($msg, $color){
		echo "<script>console.log('%c----------------- HANOI ---------------------','color:".$color.";font-weight:bold;');console.log('{$msg}\\n');</script>";
	}
	
	
	//SHOW DEBUG MESSAGES: ARGUMENT VALUES: 'E' - error, 'S' - success, or 'H' - help
	public function debugMESSAGE($chType=0, $strMsg=0, $strLineFile=0){
		
		//verify here the debug variable
		if($this->_XDEBUG){
		
			switch($chType){
				case 'H':
					$this->debugCOLOR($strMsg, "#C9C9C9");
					break;
				case 'S':
					$this->debugCOLOR($strMsg, "#52DFB0");
					break;
				case 'E':
					$this->debugCOLOR($strMsg, "#D95D5D");
					break;
				case 'W':
					$this->debugCOLOR($strMsg, "#FFD000");
					break;
				
			}//end:switch
		
		}//end:if
		
	}//end:method
	
	
}//class


?>