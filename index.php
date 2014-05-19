<?php
    $install_url = 'http'.((empty($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off')?'':'s') .'://'. $_SERVER['SERVER_NAME'] .'/public/';    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido a SEART</title>
        <base target="_blank">
        <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap-responsive.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="public/assets/css/index.css" media="screen" />
        <style>
            
        </style>
    </head>
    <body>
        <div id="intro" class="well"><br><br>
           <center><img src="http://seart.co/public/index.php/../assets/images/logo_tutorias_unju.png" style="margin: -23px 0px 23px 0px"></center>
            <h1>Bienvenido a SEART - UNJu</h1>
            <h2><center>Sistema Experto para al Análisis de Riesgos en Tutorías.</center></h2>
            <div class="continue">
                <a class="btn btn-primary" href="http://seart.co/public/index.php/login"><i class= "icon-user icon-white"></i> Ingrese aquí &raquo;</a>
            </div>
        </div>

        <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="public/assets/js/jquery-1.7.2.min.js"><\/script>')</script>

        <!-- This would be a good place to use a CDN version of jQueryUI if needed -->
        <script type="text/javascript" src="public/assets/js/bootstrap.min.js" ></script>
    </body>
</html>