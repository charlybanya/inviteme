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
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <!-- Latest compiled and minified CSS  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
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
            <li><span>Image 01</span><div><h3>Con·Prickie</h3></div></li>
            <li><span>Image 02</span><div><h3>·Asiste·</h3></div></li>
            <li><span>Image 03</span><div><h3>A·Los·Mejores·Eventos</h3></div></li>
            <li><span>Image 04</span><div><h3>Con·Prickie</h3></div></li>
            <li><span>Image 05</span><div><h3>·Asiste·</h3></div></li>
            <li><span>Image 06</span><div><h3>A·Los·Mejores·Eventos</h3></div></li>
        </ul>
        <div class="container">
            <h1><span>¿QUIERES IR AL CORONA CAPITAL POR 1 PESO?</span></h1>
            <h2>PRONTO TE DIREMOS COMO</h2>
            <br><br><br>
            <?php
            FacebookSession::setDefaultApplication('848341915184985', '746f5977bece9cfe41956dd3a22877f6');
            $helper = new FacebookRedirectLoginHelper('http://www.prickie.com.mx/site/fbRedirect.php', '848341915184985', '746f5977bece9cfe41956dd3a22877f6');
            try{
            $session = $helper->getSessionFromRedirect();
            }  catch (\Facebook\FacebookAuthorizationException $ex){
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
            echo "<h4>Ya estas registrado<h4>";
            ?>
            <br><br>
            <div class="example-base">
                <h4>Preparate ...<br>
                    <span id="clock"></span>
            </div>
            <script type="text/javascript">
                $('#clock').countdown(new Date(Date.UTC(2014, 9, 29, 21, 0, 0))).on('update.countdown', function(event) {
                    var $this = $(this).html(event.strftime(''
                            + '%-d día%!d '
                            + '%H hr '
                            + '%M min '
                            + '%S seg</h4>'));
                });
            </script>

            <?php
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