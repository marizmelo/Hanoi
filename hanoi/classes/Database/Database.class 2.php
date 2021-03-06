<?php
/*
	@type: CLASS
	@author: MARIZ MELO
	@description: PDO functions to deal with database connection 
*/	

class Database extends Debug{
	
	//ATTRIBUTES
	private $url;
	private $user;
	private $pass;
	private $database;
	private $sgdb;
	private $dbconnection;	//system variable
	public static $persistent = 0; //determine if connection should be persistent or not


	/*INITILIZES CLASS WITH ACCESS TO DEBUG SYSTEM*/
	function __construct($debug=0, $debugphp=0){
		if($debug){
			$this->debugSTART($debugphp);
			$this->debugMESSAGE('S', 'DATABASE object created');
		}
		return '';
	}//__construct


	//METHOD: help about how to use the class
	function __toString(){
		//copyrights, don't change the credits
		$HELP  = 'type: DATABASE Class\n'
		. 'author:	Mariz Melo\n'
		. 'description: "Provide methods to connect applications with databases"\n'
		. 'instructions:\n\n'
		. 'METHOD: databaseCONNECT( \n\t\t(string) database address, \n\t\t(string) database username, \n\t\t(string) database password, \n\t\t(string) database name, \n\t\t(string) database type - mysql is default )\n'
		. '\n//connect to database system\n'
		. 'ex :  $database->databaseCONNECT( "localhost", "userlogin", "userpass", "mydata", "database" );\n'
		. '\nex2: $database->databaseCONNECT( "localhost", "userlogin", "userpass", "mydata" );\n'
		. '// in case of be using mysql you don not need declare database type\n'
		. '\nMETHOD: databaseSELECT( (string) SQL select query )\n'
		. '//return an array with results from a SELECT query or 0 (if did not found anything)\n'
		. 'ex: $myselect = $database->databaseSELECT("SELECT * FROM tablename");\n'
		. '\nMETHOD: databaseMODIFY()\n'
		. '//used for INSERT, UPDATE, or DELETE queries. Just return the value 0 if could not executed the request.\n'
		. '\nex : $myinsert = $database->databaseMODIFY("INSERT INTO tablename (column) VALUES (value) WHERE column = some_value");\n'
		. '\nex2: $myupdate = $database->databaseMODIFY("UPDATE tablename SET column = value WHERE column = value2");\n'
		. '\nex3: $mydelete = $database->databaseMODIFY("DELETE FROM tablename WHERE column = value");\n';
		//if the debug system is activated - see: ./xcore/php/Debug/Debug.class.php
		$this->debugMESSAGE('H', $HELP); //show help message
		return '';
	}	
	
	//METHOD: Stabilish connection with database server.
	function databaseCONNECT($url, $user, $pass, $database, $sgdb='mysql'){	

		//check if the arguments come with values
		if(isset($url) && isset($user) && isset($pass) && isset($database)){
			
			$this->url = $url;
			$this->user = $user;
			$this->pass = $pass;
			$this->database = $database;
			$this->sgdb = $sgdb;
			
			//creates an array with the values
			$db = array('server'=>$this->url, 'user'=>$this->user, 'pass'=>$this->pass, 'database'=>$this->database, 'interface'=>'INTERFACE', 'sgdb'=>$this->sgdb);
			
			//verify which database system will be used and includes the especific library for it
			switch($db['sgdb']){
				case 'mysql':	if (!extension_loaded('pdo_mysql')){
									$this->debugMESSAGE('E', 'pdo_mysql module is not installed');
									exit();
								}//verifies if mysql module is installed on the system
								$dns = "mysql:host=".$db['server'].";dbname=".$db['database'];
								break;
								
				/*case 'oracle':	include_once('./xcore/php/Database/db_oracle.php');
								break;
								
				case 'interbase':	include_once('./xcore/php/Database/db_interbase.php');
								break;
								
				case 'firebird':	include_once('./xcore/php/Database/db_firebird.php');
								break;
								
				case 'sqlserver':	include_once('./xcore/php/Database/db_sqlserver.php');
								break;
								
				case 'sqllite':	include_once('./xcore/php/Database/db_sqllite.php');
								break;*/
			}//switch

			try {
    		$this->dbconnection = new PDO($dns, $db['user'], $db['pass']);
    		$this->debugMESSAGE('S', 'Database successfuly connected!');
    		$this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
			    $this->debugMESSAGE('E', "Could not connect with Database! ".$e->getMessage());
					die();
			}
		}else{
			//DEBUG
			$this->debugMESSAGE('E', "Missing REQUIRED arguments. See INSTRUCTIONS BELOW for more details:");
			echo $this; //call the HELP method	
		}
		
	}
	
	//METHOD: Free query used in query.
	function databaseFREE($query){
		
		db_free($query);	//free the database
		
	}


	//METHOD: destroy object and close the database connection
	function __destruct(){
		//if exist a connection on the attribute variable see "connectDB" method
		if($this->dbconnection && !$this->persistent){
			// Close database connection
			$this->dbconnection = null;
			$this->debugMESSAGE('S', 'Database successfuly disconnected!'); //show debug message
		}else if(!$this->persistent){
			$this->debugMESSAGE('E', 'No database connection found!');	//show debug message
		}
	} //end: method
	

	//METHOD: used for select request to the database
	public function databaseSELECT($sql){		
		
		if($this->dbconnection){	
			//start: if sql
			if(isset($sql)){
	
				$myquery = db_query($sql, $this->dbconnection);	//select data from the database
				
				//start: if return data
				if( isset($myquery) ){
					//debug system
					$this->debugMESSAGE('S', "Database request executed</b>! \"{$sql}\"");  //show debug message
		
					//start: if did found any record
					if($myquery != 0){
						$numrows = db_rowRows($myquery);	//get number of rows returned
						//if the number was NOT equal 0
						if($numrows != 0){
							$counter = 0;
							while($row = db_fetch($myquery)){
								$resultarray[$counter] = $row;
								$counter++;	
							}
						}
						$this->databaseFREE($myquery); //free the query request
					}//end: if did found any record
					//if we have an array with record lines
					if(isset($resultarray)){			
						return $resultarray;	//return the array
						$this->debugMESSAGE('S', "Your request DID NOT returned the follow values:<br>".print_r($resultarray));
					}else{
						$this->debugMESSAGE('E', "Your request DID NOT returned any value"); //otherwise return 0
						return 0;
					}
				}	else {
					//if did NOT found any data
					//check debug system	
					$this->debugMESSAGE('E', "Your request did <b>not</b> returned any value<br><i>\"{$sql}\"</i>"); //show debug message
					return 0; //return 0
				} //start: if return data				
			} else {
				//check debug system
				$this->debugMESSAGE('E', 'Missing argument SQL query required for this method'); //show debug message			
			}
		}else{ return 0; }//end: check connection
	}//end: method
	


	//METHOD: use for insert, update, or delete (necessary because this don't need count the number of return records)
	public function databaseMODIFY($sql){	
		if($this->dbconnection){
			//check if the argument was informed
			if(isset($sql)){
				//try process the sql query
				$myquery = db_query($sql, $this->dbconnection);
				//if could do it
				if($myquery){
					//check debug system
					$this->debugMESSAGE('S', "Database request <b>executed</b>!<br><i>\"{$sql}\"</i>");	//show debug message
					return 1;
				} else {
					//check debug system
					$this->debugMESSAGE('E', "Your request COULD NOT be completed!<br><i>\"{$sql}\"</i>"); //show debug message
					return 0; //return 0
				}
			} else {
				//check debug system
				$this->debugMESSAGE('E', 'Missing argument SQL query required for this method'); //show debug message	
			}
		} else { 
			return 0; 
		}//end: check connection
	}//end: method
	
	
	//METHOD: return table for current database
	public function databaseTABLES(){
		switch($this->sgdb){
			default:		
				$tables = $this->databaseSELECT('SHOW TABLES FROM '.$this->database.';');
		}
		return $tables;			
	}//end:databaseTABLES()
	
	
	//METHOD: return field name and information for table passed as parameter
	public function databaseFIELDS($table){
		switch($this->sgdb){
			default:
				$columns = $this->databaseSELECT('SHOW COLUMNS FROM '.$this->database.'.'.$table.';');		
		}
		if($columns)
			$this->debugMESSAGE('S', 'Returning columns for table <b>'.$table.'</b>');
		else
			$this->debugMESSAGE('E', 'Error trying return columns for table <b>'.$table.'</b>');
			return $columns;			
	}//end:databaseFIELDS()
}//end CLASS
?>