<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // obecná nastavení
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        
        
        // Pripojeni systemovych souboru
        define('ROOT', dirname(__FILE__));
        require_once (ROOT.'/components/Router.php');
        
        // Nastaveni spojeni s DB
        
        // Volani Routeru
        $router = new Router();
        $router->run();
        
        
        ?>
    </body>
</html>
