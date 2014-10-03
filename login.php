<?php

session_start();
/*error_reporting(E_ALL);
ini_set('display_errors', true);*/
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
require_once('includes/Database.php');

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

FacebookSession::setDefaultApplication('848341915184985', '746f5977bece9cfe41956dd3a22877f6');
$helper = new FacebookRedirectLoginHelper('http://www.prickie.com.mx/site/login.php', '848341915184985', '746f5977bece9cfe41956dd3a22877f6');
try {
    $session = $helper->getSessionFromRedirect();
} catch (\Facebook\FacebookAuthorizationException $ex) {
    header('Location: index2.php');
}

if (isset($session)) {
    $request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    $graphObject = $response->getGraphObject(GraphUser::className());
    $fbData = (array) $graphObject;
    $arrKeys = array_keys($fbData);
    $_SESSION['graphObjectArray'] = $fbData[$arrKeys[0]];
    //Obtener Imagen
    $request = new FacebookRequest(
            $session, 'GET', '/me/picture', array(
        'redirect' => false,
        'height' => '80',
        'type' => 'normal',
        'width' => '80',
            )
    );
    $response = $request->execute();
    $graphObject = $response->getGraphObject();
    $fbImage = (array) $graphObject;
    $arrKeys2 = array_keys($fbImage);
    $array = $fbImage[$arrKeys2[0]];
    $_SESSION['url'] = $array['url'];
    $print = new Printers();
    $check = new Database();
    if ($check->checkRegister($_SESSION['graphObjectArray']['id'])) {
        header('Location: index2.php');
    } else {
        header('Location: index2.php?section=profile');
    }
} else {
    header('Location: index2.php');
}
?>
