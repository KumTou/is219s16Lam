<?php

class app{
 public function __construct(){ 
 
  $controller = 'carList';
  if(isset($_REQUEST['controller'])){
    $controller = $_REQUEST['controller'];
  }

  $route = new $controller;
  $method = $_SERVER['REQUEST_METHOD'];
  $route->$method();
  $html = $route->getHTML();
  echo $html;
  
 }
}

?>
