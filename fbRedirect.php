<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', true);
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
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>www.prickie.com.mx</title>
        <!-- Facebook Conversion Code for pixel registro 1 -->
        <script>(function() {
                var _fbq = window._fbq || (window._fbq = []);
                if (!_fbq.loaded) {
                    var fbds = document.createElement('script');
                    fbds.async = true;
                    fbds.src = '//connect.facebook.net/en_US/fbds.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(fbds, s);
                    _fbq.loaded = true;
                }
            })();
            window._fbq = window._fbq || [];
            window._fbq.push(['track', '6021411218355', {'value': '0.00', 'currency': 'MXN'}]);
        </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6021411218355&amp;cd[value]=0.00&amp;cd[currency]=MXN&amp;noscript=1" /></noscript>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Latest compiled and minified CSS  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="css/demofb.css" />
    <link rel="stylesheet" type="text/css" href="css/style4.css" />
    <link rel="stylesheet" type="text/css" href="css/clock.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.0.4/dist/jquery.countdown.min.js"></script>
    <script src="js/inviteme.js"></script>

</head>
<body id="page">
    <ul class="cb-slideshow">
        <li><span>Image 01</span></li>
        <li><span>Image 02</span></li>
        <li><span>Image 03</span></li>
        <li><span>Image 04</span></li>
        <li><span>Image 05</span></li>
        <li><span>Image 06</span></li>
    </ul>
    <div class="container">
        <h1><span>¿QUIERES IR AL CORONA CAPITAL POR 1 PESO?</span></h1>
        <h2>PRONTO TE DIREMOS CÓMO</h2>
        <br><br><br>
        <?php
        FacebookSession::setDefaultApplication('848341915184985', '746f5977bece9cfe41956dd3a22877f6');
        $helper = new FacebookRedirectLoginHelper('http://www.prickie.com.mx/site/fbRedirect.php', '848341915184985', '746f5977bece9cfe41956dd3a22877f6');
        try {
            $session = $helper->getSessionFromRedirect();
        } catch (\Facebook\FacebookAuthorizationException $ex) {
            header('Location: index.php');
        }

        if (isset($session)) {
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            $graphObject = $response->getGraphObject(GraphUser::className());
            $fbData = (array) $graphObject;
            $arrKeys = array_keys($fbData);
            $_SESSION['graphObjectArray'] = $fbData[$arrKeys[0]];
            $print = new Printers();
            $check = new Database();
            if ($check->checkRegister($_SESSION['graphObjectArray']['id'])) {
                header('Location: index2.php');
                echo "<h4>Ya estas registrado<h4>";
            } else {
                $print->reviewData($_SESSION['graphObjectArray']);
            }
        } else {
            header('Location: index.php');
        }
        ?>
    </div>
</body>
</html>