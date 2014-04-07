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
		
		$this->debugMESSAGE('S', "TIMEZONE : '{$this->class_att['timezone']}'");
		date_default_timezone_set($this->class_att['timezone']);
		
		return '';
	}


	/*HELP instructions*/
	function __toString(){
		$HELP  = '	<br />';
		$HELP .= '	<b>type:</b>		CONFIGURE Class <br />';
		$HELP .= '	<b>author:</b>		Mariz Melo <br />';
		$HELP .= '	<b>description:</b>	<i>"Default variables and methods for the website/system"</i> <br />';
		$HELP .= '	<br />';
		$HELP .= '	<b>instructions:</b><br />';
		$HELP .= '		VARIABLES:<br />';
		$HELP .= '			<b>title:</b> Hold website/system title name<br />';
		$HELP .= '			<b>lang:</b> <a href="http://www.w3schools.com/tags/ref_language_codes.asp">ISO 639</a> + \'-\' + <a href="http://www.iso.org/iso/english_country_names_and_code_elements">ISO 3166-1</a> codes for language code (default: en-US)<br />';
		$HELP .= '			//example :  <br />';
		$HELP .= '			$conf = new Configure(); <br />$conf->title = "My awesome project"; //overwrite the default value <br />echo $conf->title;<br />';
		$HELP .= '<br />';
		$HELP .= '		METHOD: <b>configureMEMORY</b>( (integer) memory amount ) <br />';
		$HELP .= '			//Memory that PHP can have access to it, useful for upload files for example. Call only if you need.<br />';
		$HELP .= '			ex: $conf->configureMEMORY(30); //will allocat 30mb, without value the default is 10mb<br />';
		$HELP .= '<br />';
		
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