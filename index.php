<?php
 
require_once 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
 
session_start();
 
$config = require_once 'config.php';

// create TwitterOAuth object
$twitteroauth = new TwitterOAuth($config['consumer_key'], $config['consumer_secret']);
 
 ///prueba get

//$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_secret'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

// request token of application
$request_token = $twitteroauth->oauth(
    'oauth/request_token', [
        'oauth_callback' => $config['url_callback']
    ]
);
 
// throw exception if something gone wrong
if($twitteroauth->getLastHttpCode() != 200) {
    throw new \Exception('There was a problem performing this request');

	header('Location: index.php');
	}
 
// save token of application to session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

//$_SESSION['usuario_twitter'] = $request_token['screen_name'];

//$acces_token=$connection->getAccessToken($_REQUEST('oauth_verifier'));

//$_SESSION['acces_token']=$acces_token;



 
// generate the URL to make request to authorize our application
$url = $twitteroauth->url(
    'oauth/authorize', [
        'oauth_token' => $request_token['oauth_token']
    ]
);

// generate the URL to make request to authorize our application

header('Location:  ready.php');




?>