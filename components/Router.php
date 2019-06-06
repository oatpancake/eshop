<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author Anastasia
 */
class Router {
    
    private $routes;
    
    public function __construct() {
        $routesPath= ROOT.'/config/routes.php';
        $this->routes = include($routesPath); //priradime massivu vlastnost
    }
    private function getURI(){
	if (!empty($_SERVER['REQUEST_URI'])) {
	return trim($_SERVER['REQUEST_URI'], '/');
        }
        
    }

    public function run() {
        // Dotazovaci radka
        $uri = $this->getURI();
        
        // zkontolujeme jestli je takovy element
	foreach ($this->routes as $uriPattern => $path) {
            //porovnavame uriPattern s uri
            if(preg_match("~$uriPattern~", $uri)) {
                //definujeme jaky kontroller a action zpracovavaji dotaz
                $segments = explode('/', $path);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName); //UpperCaseFirst
                $actionName = 'action'.ucfirst((array_shift($segments))); //pridame nazvu metody action
                //dostaneme soubor tridy-kontroleru
                $controllerFile = ROOT . '/controllers/' .$controllerName.'.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                    
                }
                //vytvori objekt, zavola metodu(action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null) {
                    break;
		}
	}

}

}

}
    