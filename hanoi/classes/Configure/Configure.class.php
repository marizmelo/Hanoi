<?php
/*
	@type: CLASS
	@author: MARIZ MELO
	@description: Initialize the custom variable values for the website / project
*/


class Configure extends Debug{


	/*@attributes*/
	/*@timezones : http://www.php.net/manual/en/timezones.php*/
	private $class_att = array(	'title'=>'Hanoi is a simplistic yet powerful PHP framework', 
								'lang'=>'en-US',
								'timezone'=>'America/Los_Angeles');


	/*INITILIZES CLASS WITH ACCESS TO DEBUG SYSTEM*/
	function __construct($debug=0, $debugphp=0){
		if($debug){
			$this->debugSTART($debugphp);
			$this->debugMESSAGE('S', 'CONFIGURE object created');
		}
		
		$this->debugMESSAGE('S', "TIMEZONE : {$this->class_att['timezone']}");
		date_default_timezone_set($this->class_att['timezone']);
		
		return '';
	}


	/*HELP instructions*/
	function __toString(){
		$HELP  = 'type: CONFIGURE Class\n'
		. 'author:	Mariz Melo\n'
		. 'description: "Default variables and methods for the website/system"\n\n'
		. 'instructions:\n\n'
		. '\tVariables:\n\n'
		. '\ttitle: Hold website/system title name\n'
		. '\tlang: ISO 639 - ISO 3166-1 codes for language code (default: en-US)\n\n'
		. '\texample:\n\n'
		. '\t\t$conf = new Configure();\n'
		. '\t\t$conf->title = "My awesome project"; //overwrite the default value\n'
		. '\t\techo $conf->title;\n\n'
		. '\t\tMETHOD: configureMEMORY( (integer) memory amount )\n'
		. '\t\t//Memory that PHP can have access to it, useful for upload files for example. \n\t\t//Call only if you need.\n\n'
		. '\t\tex: $conf->configureMEMORY(30); //allocate 30mb, default is 10mb';
		
		$this->debugMESSAGE('H', $HELP);
		return '';
	}
	
	
	/*GETS and SETS for attributes array*/
	function __get($att){
		if(array_key_exists($att, $this->class_att))
			return $this->class_att[$att];
		else
			$this->debugMESSAGE('E', 'Attribute not found!');
	}
	function __set($att, $val){
		(array_key_exists($att, $this->class_att)) ? $this->class_att[$att] = $val : $this->debugMESSAGE('E', 'Attribute "'.$att.'" not found!');
	}
	
	
	//Memory that will be used by the system
	function configureMEMORY($memory = 10)
	{
		ini_set('memory_limit', $memory.'M');	//initialize memory available (default 10mb)	
	}
	

}//class

?>