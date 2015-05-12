<?php
	//Configuration for our php server
	set_time_limit(0);
	ini_set('default_socket_timeout', 300);
	session_start();

	//make constants using define
	define('clientID', 'd99afae27fbc42c8bd2e4516f7b24590');
	define('clientSecret', '94e5978deeb24fa4b6f4b7c2f76e1d77');
	define('redirectURI', 'http://localhost/Apie/index.php');
	define('ImageDirectory', 'pics/');
?>


<!-- CLIENT INFO
CLIENT ID
d99afae27fbc42c8bd2e4516f7b24590
CLIENT SECRET
94e5978deeb24fa4b6f4b7c2f76e1d77
WEBSITE URL
http://localhost/Apie/index.php
REDIRECT URI
http://localhost/Apie/index.php -->

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta  name="viewport" content="width-device-width, initial-scale=1">
	<title>Kawaii</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="author" href="humans.txt">
</head>
<body>
		<!--Creating a login for people to go and give approval for our web app to access their Instagram Account
		After getting approval we are now going to have the information so we can play with it.
		-->
		<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
</body>
</html>