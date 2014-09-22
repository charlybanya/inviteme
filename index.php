<?php
session_start();
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
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/jquery.form.min.js"></script>
        <script src="js/inviteme.js"></script>
        <title>prickie.com.mx</title>
    </head>
    <body>
        <?php
        // init app with app id (APPID) and secret (SECRET)
        FacebookSession::setDefaultApplication('848341915184985', '746f5977bece9cfe41956dd3a22877f6');

        // login helper with redirect_uri
        $helper = new FacebookRedirectLoginHelper('http://www.telmexhub.com.mx/inviteme', '848341915184985', '746f5977bece9cfe41956dd3a22877f6');
        try {
            $session = $helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            
        } catch (Exception $ex) {
            
        }

        // see if we have a session
        if (isset($session)) {
            // graph api request for user data
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            // get response
            $graphObject = $response->getGraphObject(GraphUser::className());
            // print data
            $_SESSION['graphObjectArray'] = (array) $graphObject;
            /* $_SESSION['graphObjectArray'] = array(
              'id' => '10202611455349527',
              'email' => 'charly_banya@hotmail.com',
              'first_name' => 'Cristopher',
              'gender' => 'male',
              'last_name' => 'Mendoza',
              'link' => 'https://www.facebook.com/app_scoped_user_id/10202611455349527/',
              'locale' => 'es_LA',
              'middle_name' => 'Carlos',
              'name' => 'Cristopher Carlos Mendoza',
              'timezone' => -5,
              'updated_time' => '2014-02-12T22:44:50+0000',
              'verified' => true
              ); */

            $print = new Printers();
            $print->reviewData($_SESSION['graphObjectArray']);
        } else {
            // show login url
            echo '<a href="' . $helper->getLoginUrl(array('scope' => 'email')) . '">Login</a>';
        }
        ?>
    </body>
</html>
