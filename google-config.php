<?php
 
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('285491540791-6fb49dufjqsg19jh6a1ks00feuhgak6v.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
 
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:8888/vmg/google-login.php');
 
//
$google_client->addScope('email');
 
// $google_client->addScope('profile');

//start session on web page
if(session_id() == ""){
    session_start();
    }
