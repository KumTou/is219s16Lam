<?php

class carList extends controller {
   // where the table of the cars go. if no cars, should prompt to add car
   
   public function get(){
      $this->html .=  html::newLink('Add Car', 'index.php?controller=carController');    
     $this->html .= '</br></br>';
     
      session_start();
      
          
     if(count($_SESSION) == 0){
       $this->html .= 'There are no cars. Please add one or two.. or more';
     
    }
     else{ 
       $headers = ['Make', 'Model', 'Year', 'Action'];
       $car = new carModel($guid);
       foreach($_SESSION as $guid => $array){
	  $rows[] = array($car->getMake(), $car->getModel(), $car->getYear(),
	  html::newLink('View',
	  'index.php?controller=carDetails&guid='.$car->getGUID()));
          
      
      }
       $this->html .= html::newTable($headers, $rows);
       
     }  
   print_r($_SESSION);	 
}

}
?>
