<?php
session_start();
/* error_reporting(E_ALL);
  ini_set('display_errors', true); */
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

$print = new Printers();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prickie</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <!-- Latest compiled and minified CSS  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script src="js/jquery.form.min.js"></script>
        <script src="js/inviteme.js"></script>
        <link href="boilerplate.css" rel="stylesheet" type="text/css">
        <link href="css/prickie.css" rel="stylesheet" type="text/css">
        <link href="css/concursos.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="respond.min.js"></script>
    </head>
    <body>
        <div class="gridContainer clearfix">
            <a href="index2.php"><div id="header">
                    <div id="userData">
                        <?php
                        echo "\n";
                        if (isset($_SESSION['graphObjectArray']['id'])) {
                            $print->userData();
                        } else {
                            FacebookSession::setDefaultApplication('848341915184985', '746f5977bece9cfe41956dd3a22877f6');
                            $helper = new FacebookRedirectLoginHelper('http://www.prickie.com.mx/site/login.php', '848341915184985', '746f5977bece9cfe41956dd3a22877f6');
                            echo '<a class="fb-connect button" href="' . $helper->getLoginUrl(array('scope' => 'email,user_friends')) . '" ></a>';
                        }
                        ?>
                    </div>
                </div></a>
            <?php
            if (isset($_SESSION['graphObjectArray']['id'])) {
                ?>
                <div id="menu">
                    <a href="index2.php?section=profile" >Mi Perfil</a>
                    <!--<a href="index2.php?section=concursos" >Mis Concursos</a>-->
                    <!--<a href="index2.php?section=saldo" >Saldo</a>-->
                    <!--<a href="index2.php?section=invitaciones" >Invitaciones</a>-->
                    <a href="index2.php?section=logout" >Cerrar Sesion</a>
                </div>
                <?php
            }
            ?>
            <div id="separator">¡Gana los boletos de tu vida pagando desde $1!</div>
            <div id="contenido">
                <?php
                if ($_GET['section'] == 'profile') {
                    $db = new Database();
                    if ($db->checkRegister($_SESSION['graphObjectArray']['id'])){
                        $print->reviewProfile($_SESSION['graphObjectArray']['id']);
                    }  else {
                        $print->reviewData($_SESSION['graphObjectArray']['id']);
                    }
                    
                } elseif ($_GET['section'] == 'concursos') {
                    
                } elseif ($_GET['section'] == 'saldo') {
                    
                } elseif ($_GET['section'] == 'invitaciones') {
                    
                } elseif ($_GET['section'] == 'logout') {
                    session_destroy();
                    header('Location: index2.php');
                } elseif ($_GET['concurso']) {
                    $print->showEvent($_GET['concurso']);
                } else {
                    if (isset($_SESSION['graphObjectArray']['id'])) {
                        echo '<section id="body-smf">';
                        $print->sorteosCard();
                        echo "\n</section>\n";
                    } else {
                        echo '<iframe class = "youtube" src="//www.youtube.com/embed/cam7IFIucjA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
                    }
                    ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#concierto0_out').mouseover(function() {
                                $("#concierto0_out").css("display", "none");
                                $("#concierto0_on").css("display", "block");
                                $("#descripcionCard0").slideDown("fast");
                            });
                            $('#concierto0_on').mouseleave(function() {
                                $("#concierto0_out").css("display", "block");
                                $("#concierto0_on").css("display", "none");
                                $("#descripcionCard0").hide();
                            });
                            $('#concierto1_out').mouseover(function() {
                                $("#concierto1_out").css("display", "none");
                                $("#concierto1_on").css("display", "block");
                                $("#descripcionCard1").slideDown("fast");
                            });
                            $('#concierto1_on').mouseleave(function() {
                                $("#concierto1_out").css("display", "block");
                                $("#concierto1_on").css("display", "none");
                                $("#descripcionCard1").hide();
                            });

                            $('#concierto2_out').mouseover(function() {
                                $("#concierto2_out").css("display", "none");
                                $("#concierto2_on").css("display", "block");
                                $("#descripcionCard2").slideDown("fast");
                            });
                            $('#concierto2_on').mouseleave(function() {
                                $("#concierto2_out").css("display", "block");
                                $("#concierto2_on").css("display", "none");
                                $("#descripcionCard2").hide();
                            });

                            $('#concierto3_out').mouseover(function() {
                                $("#concierto3_out").css("display", "none");
                                $("#concierto3_on").css("display", "block");
                                $("#descripcionCard3").slideDown("fast");
                            });
                            $('#concierto3_on').mouseleave(function() {
                                $("#concierto3_out").css("display", "block");
                                $("#concierto3_on").css("display", "none");
                                $("#descripcionCard3").hide();
                            });

                            $('#concierto4_out').mouseover(function() {
                                $("#concierto4_out").css("display", "none");
                                $("#concierto4_on").css("display", "block");
                                $("#descripcionCard4").slideDown("fast");
                            });
                            $('#concierto4_on').mouseleave(function() {
                                $("#concierto4_out").css("display", "block");
                                $("#concierto4_on").css("display", "none");
                                $("#descripcionCard4").hide();
                            });
                        });

                    </script>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>


