<?php	
	$hanoi_version = '0.1';

	//LOAD CLASSES METHOD
	function __autoload($class)
	{
		//hold default path for classes on the hanoi system
		$classfile = "hanoi/core/{$class}/{$class}.class.php";
		
		/*Just automatic loads the class where its exist on 
		  the system or was not loaded before, util to load
		  other classes then hanoi classes*/
		if(file_exists($classfile) && !class_exists($class)) {
			include $classfile;
		}
	}
?>