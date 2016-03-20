<?php
 abstract class model{
   private $guid;
  
   public function __construct(){
     session_start();
     $this->guid = uniqid();
   }
   public function save(){
   $_SESSION[$this->guid] = (array) $this;
   }
   public function getGUID(){
     return $this->guid;
   }
/* // this code underneath is just for learning purposes
   public function __construct($guid=NULL){
     if ($guid !=NULL{
       foreach($_SESSION[$guid] as $key=>$value){
          $this->$key = $value;
       }
     }
   } 

   public function save(){
      $this->guid = uniqid();
      $params = get_object_vars($this);
      foreach($params as $param =>$value){
        $_SESSION[$this->guid][$param] = $this->$param;
      }
   }

   public function getGUID(){
     return $this->guid;
   } */
   }
?>
