<?php
	//Configuration for our php server
	set_time_limit(0);
	ini_set('default_socket_timeout', 300);
	session_start();

	//make constants using define
	define('client_ID', 'd99afae27fbc42c8bd2e4516f7b24590');
	define('client_Secret', '94e5978deeb24fa4b6f4b7c2f76e1d77');
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

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<!--Creating a login for people to go and give approval for our web app to access their Instagram Account
		After getting approval we are now going to have the information so we can play with it.
		-->
		<a href="https:api.instagram/oauth/authorize/?client_id= <?php echo client_ID; ?>^redirect_url=<?php echo redirectURI; ?>response_type=code">LOGIN</a>
</body>
</html>