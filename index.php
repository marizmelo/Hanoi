<?php
/*
	@title: Hanoi is a simple yet powerful PHP framework
	@author: Mariz Melo
	@release: 02/24/2014
	@url: http://github.com/marizmelo/hanoi
*/
	include_once('hanoi/hanoi.php');

	$config = new Configure(1); // check hanoi/core/Configure/Configure.class.php
	echo $config;
	$track = new Track(1);

	$database = new Database(1);
	//echo $database;
?>
<html>
<head>
	<title><?=$config->title?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
	<?=$track->debugMESSAGE('H', 'THANK YOU FOR USING HANOI, THE SYSTEM IS READY TO USE!')?>
</body>
</html>