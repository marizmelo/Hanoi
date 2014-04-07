<?php
/*
	@type: CLASS
	@author: MARIZ MELO
	@description: This class is solely to display messages on the system
*/

//THIS CLASS ALLOW ME TO WRITE DEBUG MESSAGES ON THE SCREEN
class Track extends Debug{
	/*INITILIZES CLASS WITH ACCESS TO DEBUG SYSTEM*/
	function __construct($debug=0, $debugphp=0){
		if($debug){
			$this->debugSTART($debugphp);
			$this->debugMESSAGE('S', 'TRACK object created');
		}
		return '';
	}
	
	/*SHOW HELP FROM DEBUG CLASS (SUPERCLASS)*/
	function __toString(){
		return $this->superHELP();
	}
}

?>