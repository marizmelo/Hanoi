<?php
/*
	@type: CLASS
	@author: MARIZ MELO
	@description: Functions to deal with database connection 
	@todo:	
		use PDO connection
		verify if database modules are not present (line 95)	
*/	

class Database extends Debug{
	
	//attributes
	private $url;
	private $user;
	private $pass;
	private $database;
	private $sgdb;
	private $dbconnection;	//system variable



	/*INITILIZES CLASS WITH ACCESS TO DEBUG SYSTEM*/
	function __construct($debug=0, $debugphp=0){
		
		if($debug){
			$this->debugSTART($debugphp);
			$this->debugMESSAGE('S', 'DATABASE object created');
		}
		return '';
		
	}//__construct




	//help about how to use the class
	function __toString(){

		//copyrights, don't change the credits
		$HELP  = '
		<br>
		<b>type:</b>		DATABASE Class <br>
		<b>author:</b>		Mariz Melo <br>		
		<b>description:</b>	<i>"Provide methods to connect applications with databases"</i> <br>
		<br>
		<b>instructions:</b><br>
		METHOD: <b>databaseCONNECT</b>( (string) database <b>address</b>, (string) database <b>username</b>, (string) database <b>password</b>, (string) database <b>name</b>, (string) database <b>type</b> - mysql is default )<br>
		//connect to database system<br>
		ex :  $database->databaseCONNECT( "localhost", "userlogin", "userpass", "mydata", "database" );<br>
		ex2: $database->databaseCONNECT( "localhost", "userlogin", "userpass", "mydata" ); // in case of be using mysql you don not need declare database type <br>
		<br>
		METHOD: <b>databaseSELECT</b>( (string) SQL select query ) <br>
		//return an array with results from a SELECT query or 0 (if did not found anything)<br>
		ex: $myselect = $database->databaseSELECT("SELECT * FROM tablename");<br>
		<br>
		METHOD: <b>databaseMODIFY</b>() <br>
		//used for INSERT, UPDATE, or DELETE queries. Just return the value 0 if could not executed the request.<br>
		ex : $myinsert = $database->databaseMODIFY("INSERT INTO tablename (column) VALUES (value) WHERE column = some_value");<br>
		ex2: $myupdate = $database->databaseMODIFY("UPDATE tablename SET column = value WHERE column = value2");<br>
		ex3: $mydelete = $database->databaseMODIFY("DELETE FROM tablename WHERE column = value");<br>
		';//end:HELP

		//if the debug system is activated - see: ./xcore/php/Debug/Debug.class.php
		$this->debugMESSAGE('H', $HELP); //show help message
		
		return '';
		
	}	
	
	

	//Stabilish connection with database server.
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
				case 'mysql':	if (!extension_loaded('mysql')){
									$this->debugMESSAGE('E', 'mysql not installed');
									exit();
								}//verifies if mysql module is installed on the system
								include_once('./xcore/php/Database/db_mysql.php');
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


			$this->dbconnection = db_connect($db);	//assign the connection object to the class attribute (can be used in other methods)
			

			
			//DEBUG		
			if($this->dbconnection)
				$this->debugMESSAGE('S', 'Database successfuly <b>connected</b>!');
			
			
			
		}else{
			
			//DEBUG
			$this->debugMESSAGE('E', "Missing REQUIRED arguments. See INSTRUCTIONS BELOW for more details:");
			echo $this; //call the HELP method
			
				
		}
		
	}
	
	

	//Free query used in query.
	function databaseFREE($query){
		
		db_free($query);	//free the database
		
	}



	//destroy object and close the database connection
	function __destruct(){
	
		//if exist a connection on the attribute variable see "connectDB" method
		if($this->dbconnection){
			
			//db_disconnect($this->dbconnection);	//disconnect from the database	//no longer necessary (but kept the disconnect message)
			
			$this->debugMESSAGE('S', 'Database successfuly <b>disconnected</b>!<br>'); //show debug message
				
		}else{
			
			$this->debugMESSAGE('E', 'No database connection found!<br>');	//show debug message
			
		}
		
		
	} //end: method
	
	
	
	

	//used for select request to the database
	public function databaseSELECT($sql){		
		
		if($this->dbconnection){	
			
			//start: if sql
			if(isset($sql)){
	
			
				$myquery = db_query($sql, $this->dbconnection);	//select data from the database
				
				
				//start: if return data
				if( isset($myquery) ){
						
					//debug system
					$this->debugMESSAGE('S', "Database request <b>executed</b>!<br><i>\"{$sql}\"</i>");  //show debug message
		
					
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
		
				}
				else
				{
					//if did NOT found any data
					//check debug system	
					$this->debugMESSAGE('E', "Your request did <b>not</b> returned any value<br><i>\"{$sql}\"</i>"); //show debug message
					
					return 0; //return 0
					
				} //start: if return data
				
				
			}else{
				//check debug system
				$this->debugMESSAGE('E', 'Missing argument SQL query required for this method'); //show debug message			
			}
			
		}else{ return 0; }//end: check connection
	
	
	}//end: method
	




	//use for insert, update, or delete (necessary because this don't need count the number of return records)
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
		
				}
				else
				{
					//check debug system
					$this->debugMESSAGE('E', "Your request COULD NOT be completed!<br><i>\"{$sql}\"</i>"); //show debug message
					
					return 0; //return 0
				}
			
			}else{
			
				//check debug system
				$this->debugMESSAGE('E', 'Missing argument SQL query required for this method'); //show debug message	
				
			}
		
		}else{ return 0; }//end: check connection
		
	}//end: method
	
	
	//return table for current database
	public function databaseTABLES(){
		
		switch($this->sgdb){
			default:		
				$tables = $this->databaseSELECT('SHOW TABLES FROM '.$this->database.';');
		}
		
		return $tables;			
		
	}//end:databaseTABLES()
	
	
	
	//return field name and information for table passed as parameter
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
	
	
	//CREATE METHOD TO DEAL WITH PERSISTENT CONNECTION (EX: mysql_pconnect)<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
	//CREATE METHOD TO DEAL WITH SQL INJECTION <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	
	
		
}//end CLASS



?>