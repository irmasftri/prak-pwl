<?php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
//Set the OAuth 2.0 Client ID
$google_client->setClientId('765005040051-psl9amuncl4i1hah80o2mk7vnt7bsbpi.apps.googleusercontent.com');
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('ntPqk-8inXqDav0x6N3qxYeL');
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:8080/fb/index.php');

$google_client->addScope('email');
$google_client->addScope('profile');

session_start();

?>