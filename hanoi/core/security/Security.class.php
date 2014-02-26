<?php
/*@type: 		CLASS */
/*@author:  	MARIZ MELO */
/*@description: controls security on the system / site */


class Security extends Debug{
	
	
	private $session = 'hanoi18021981';	//temporary name for session
	
	
	/*INITILIZES CLASS WITH ACCESS TO DEBUG SYSTEM*/
	function __construct($debug=0, $debugphp=0){
		
		if($debug){
			$this->debugSTART($debugphp);
			$this->debugMESSAGE('S', 'DATABASE object created');
		}
		return '';
		
	}//__construct
	
	
	
//	HELP	
	function __toString(){
	
		//copyrights, don't change the credits
		$HELP  = '	<br><div>';
		$HELP .= '	<b>type:</b>		SECURITY Class <br>';
		$HELP .= '	<b>author:</b>		Mariz Melo <br>';
		$HELP .= '	<b>released:</b>	10-03-2010 <br>';
		$HELP .= '	<b>description:</b>	<i>"Provide methods to control SESSIONS and security on the application/site"</i> <br>';
		$HELP .= '	<br>';
		$HELP .= '		REQUIREMENTS<br />';
		$HELP .= '		//crate a instance of the class Security<br>';
		$HELP .= '			ex: $instance_var = new Security(); <br>';
		$HELP .= '	<br>';
		$HELP .= '		METHOD: <b>securitySETSESSION</b>( (string) session name/id, (bool) 1 - close session, (int) minutes before close session ) <br>';
		$HELP .= '			//initialize or destroy the session passed as argument<br>';
		$HELP .= '			ex1: $instance_var->securitySETSESSION("sessionName"); //starting the session<br>';
		$HELP .= '			ex2: $instance_var->securitySETSESSION("sessionName", 1); //finishing the session<br>';
		$HELP .= '	</div>';
		
		
		//if the debug system is activated - see: hanoi/core/debug/Debug.class.php
		$this->debugMESSAGE('H', $HELP); //show help message
		 
		return '';
	}
	
	
		
	
	
//	START SESSION
	function securitySTARTSESSION()
	{
		
		session_start();	//start session
		
		//DEBUG
		$this->debugMESSAGE('S', 'SESSION WAS SUCCESSFULY STARTED!');
		
	}	
	
	
//	CLOSE SESSION
	function securityCLOSESESSION($session)
	{
	
		if( isset( $_SESSION[$session] ) )
		{
			
			session_unset( $_SESSION[$session] ); 	//remove session variable
			session_destroy();	 							//destroy session
					
			//DEBUG
			$this->debugMESSAGE('S', 'Session was SUCCESSFULY DESTROYED!');
			
		}
		
	}
	

//	EXPIRE SESSION
	function securityEXPIRESESSION($session, $expire=30)	
	{
		
		if( isset($_SESSION[$session]['LAST_ACTIVITY']) && (time() - $_SESSION[$session]['LAST_ACTIVITY'] > $expire*60) )
		{
			
			$this->securityCLOSESESSION($session);
			
		}
		else
		{
		
			if( isset( $_SESSION[$session] ) )
			{
				
				//if don't exit the start time for the session
				if( !isset($_SESSION[$session]['START_TIME']) )
						$_SESSION[$session]['START_TIME'] = time();
				
				
				$_SESSION[$session]['LAST_ACTIVITY'] = time(); //update session last activity everytime check the session;
				
			}
			else
			{
				//DEBUG
				$this->debugMESSAGE('E', 'SESSION is not initialized!');	
			}
			
		}
			
		
	}
	
	

//	START/STOP SESSION
	function securitySETSESSION($xsession, $close=0, $expire=30)
	{	
			
			session_start(); //starts the session
			
			//DEBUG
		 	
			
			//echo $expire;
			
			//verify if was requested the disconnection or if the session was expired, either one will kill the session
			if( $close == '1' ||  ( $expire!=0 && isset($_SESSION[$xsession]['LAST_ACTIVITY']) && (time() - $_SESSION[$xsession]['LAST_ACTIVITY'] > $expire*60) ) ){
				
				//verify if the session is active, othewise don't make sense
				if(isset($_SESSION[$xsession])){
					
					session_unset($_SESSION[$xsession]); //remove session variable
					session_destroy(); //destroy session
					
					//DEBUG
					$this->debugMESSAGE('S', 'Session was SUCCESSFULY DESTROYED!');
				}
				
			}else{
				
				ini_set("memory_limit", "10M"); //CHANGE FOR UPLOAD CLASS OR IMAGE HANDLE CLASS LATER
				
				//if the session was registered 
				if(isset($_SESSION[$xsession])){
					
					//if don't exit the start time for the session
					if( !isset($_SESSION[$xsession]['START_TIME']) )
							$_SESSION[$xsession]['START_TIME'] = time();
					
					
					$_SESSION[$xsession]['LAST_ACTIVITY'] = time(); //update session last activity everytime check the session;
							
				}
				
			}
			
		
	}//end: securitySETSESSION();
	
	
	function securityREALIP(){
		
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
	
	
	function securitySALT($length=12){

	   list($usec, $sec) = explode(' ', microtime());
	   srand((float) $sec + ((float) $usec * 100000));
	   
	   
	
	   $validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
	   $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	   $validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";
	
	   $level 	  = rand(1,2);
	   $password  = "";
	   $counter   = 0;
	
	   while ($counter < $length) {
	     $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);
	
	     // All character must be different
	     if (!strstr($password, $actChar)) {
	        $password .= $actChar;
	        $counter++;
	     }
	   }
	
	   return $password;

	}
	
//	RETURN THE CURRENT QUERYSTRING
	function securityQUERYSTRING(){	
	 
	  	isset($_SERVER["QUERY_STRING"]) ? $self = $_SERVER["QUERY_STRING"] : $self = false;
	  	
	  	return $self;
		
	}
	
//	RETURN CURRENT SCRIPT FILE
	function securityCURRENTSCRIPT(){

		$address = explode("/", $_SERVER['SCRIPT_NAME']);

		$counter = count($address);
		
		return $address[--$counter];	//less one to obtain the current script loaded
		
	}
	
	

}

?>