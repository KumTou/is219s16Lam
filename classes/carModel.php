<?php

  class carModel extends model{
    private $make;
    private $model;
    private $year;

    public function setMake($make){
    $this->make = $make;
    }

    public function getMake(){
      return $this->make;
    }

    public function setModel($model){
      $this->model = $model;
    }
    public function getModel(){
      return $this->model;
    }
    
    public function setYear($year){
      $this->year = $year;
    }

    public function getYear(){
      return $this->year;
    }
  }
?>
