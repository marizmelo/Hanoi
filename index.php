<?php
/*
	@title: Hanoi is a simplistic yet powerful PHP framework
	@author: Mariz Melo
	@release: 02/24/2014
	@url: http://github.com/marizmelo/hanoi
*/
	include_once('hanoi/hanoi.php');

	$config = new Configure(1,1); // check hanoi/core/Configure/Configure.class.php

	$track = new Track(1,1);

?>
<html>
<head>
	<title><?=$config->title?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
	<h1>Welcome to Hanoi a simplistic yet powerful PHP Framework</h1>
</body>
</html>