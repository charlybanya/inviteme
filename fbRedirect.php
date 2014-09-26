<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', true);
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/GraphUser.php');
require_once('includes/Printers.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\GraphUser;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/colorbox.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/jquery.form.min.js"></script>
        <script src="js/jquery.colorbox-min.js"></script>
        <script src="js/inviteme.js"></script>
        <title>www.prickie.com.mx</title>
    </head>
    <body>
        <?php
        FacebookSession::setDefaultApplication('848341915184985', '746f5977bece9cfe41956dd3a22877f6');
        $helper = new FacebookRedirectLoginHelper('http://www.prickie.com.mx/site/fbRedirect.php', '848341915184985', '746f5977bece9cfe41956dd3a22877f6');
        $session = $helper->getSessionFromRedirect();
        if (isset($session)) {
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            $graphObject = $response->getGraphObject(GraphUser::className());
            $fbData = (array) $graphObject;
            $arrKeys = array_keys($fbData);
            $_SESSION['graphObjectArray'] = $fbData[$arrKeys[0]];
            $print = new Printers();
            $print->reviewData($_SESSION['graphObjectArray']);
        } else {
            header('Location: index.php');
        }
        ?>