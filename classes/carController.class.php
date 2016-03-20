<?php

  class carController extends controller{

   public function get(){
   // session_start();
   // print_r($_SESSION);
    $form = new carFormView;
    $form_html = $form->getHTML();
    $this->html .= $form_html;
   }

   public function post(){
    print_r($_POST);
    $car = new carModel;
    $car->setMake($_POST['make']);
    $car->setModel($_POST['model']);
    $car->setYear($_POST['year']);
    $car->save();
    header('Location: index.php');
	
	
   }

  }
?>
