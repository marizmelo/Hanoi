<?php

	function db_connect($db) {
	
		global $xdebug;
		
		$oCon = mysql_connect($db['server'], $db['user'], $db['pass']);
		if(!$oCon){
			//die( $this->debugMessage('S', 'Your request COULD NOT be executed, message:<br />'.mysql_error()) );
			return 0;
			
		}else{
			
			if(!is_null($db['database']))
				db_select_db($db['database']);
		
			return $oCon;
		}
	}

	function db_select_db($sDatabase) {
		mysql_select_db($sDatabase);
	}

	function db_query($sSQL) {
		$oStmt = mysql_query($sSQL);
		return $oStmt;
	}

	function db_colnum($oStmt) {
		return mysql_num_fields($oStmt);
	}
	
	//add oct 2010, count number of rows
	function db_rowRows($oStmt) {
		return mysql_num_rows($oStmt);
	}

	function db_columnName($oStmt,$iPos) {
		return mysql_field_name($oStmt,$iPos-1);
	}
	
	function db_columnType($oStmt,$iPos) {
		return mysql_field_type($oStmt,$iPos-1);
	}

	function db_fetch($oStmt) {
		//return mysql_fetch_array($oStmt);		//modify in Oct 31 2010 - MARIZ MELO	
		return mysql_fetch_assoc($oStmt);
	}

	function db_free($oStmt) {
		return mysql_free_result($oStmt);
	}

	function db_disconnect($oCon) {
		return mysql_close($oCon);
	}
	
?>
