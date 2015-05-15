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

	//function that is going to connect to Instagram
	function connectToInstagram($url){
		//ch is a cUrl handle returned by curl_init
		$ch = curl_init();

		//Set multiple options for a cURL transfer
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true, //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
			CURLOPT_SSL_VERIFYPEER => false, //FALSE to stop cURL from verifying the peer's certificate. 
			CURLOPT_SSL_VERIFYHOST => 2, 
		));

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	//function to get userID cause userName doesn't allow us to get pictures
	function getUserID($userName){
		$url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID; // to get id
		$instagramInfo = connectToInstagram($url); //connection to instagram
		$results = json_decode($instagramInfo, true); //creating a local variable to decode json information

		return $results['data']['0']['id']; //returning a userID
	}

	//function to print out images onto screen
	function printImages($userID){
		$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5';
		$instagramInfo = connectToInstagram($url);
		$results = json_decode($instagramInfo, true); // parse through the information one by one
		foreach($results['data'] as $items){
			$image_url = $items['images']['low_resolution']['url']; //going to go through all of my ressults and give myself back the url of those pictures because we want it to save it in the PHP server
			echo '<img src=" '.$image_url.' "/><br>';
		}
	}



	//isset checks for booligans
	//checking if it gets the code
	if (isset($_GET['code'])){
		//this gets the code
		$code = ($_GET['code']);
		//this url is gets the access the token
		$url = 'https://api.instagram.com/oauth/access_token';
		//array to access the tokens
		$access_token_settings = array('client_id' => clientID,
			//your client secret
			'client_secret' => clientSecret,
			//supported value
			'grant_type' => 'authorization_code',
			'redirect_uri' => redirectURI,
			'code' => $code
			);
	//cURL is hwta we use in PHP , it's a library calls to other api's
		$curl = curl_init($url); //setting a cURL session and we put in $url because that's where we are getting the data from.
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); //setting the POSTFIELDS to the array setup that we created
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting it equal to 1 because we are getting strings back
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //but in live work-production we want to set this to true

	//Perform a cURL session
	$result = curl_exec($curl);
	curl_close($curl);

	//json_decode decodes a json string
	$results = json_decode($result, true);
	$userName = $results['user']['username'];

	$userID = getUserID($userName);
	printImages($userID);
	}

	else{
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

<?php 
}
?>