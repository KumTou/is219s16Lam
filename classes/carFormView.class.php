<?php

 class carFormView{
   public function getHTML(){
     $link = html::newLink('Cancel', 'index.php');
     echo $link;
     echo '<br/><br/>';
     
     $inputs[] = html::input(['type' => 'text', 'name' => 'make', 'id' =>
    ' make','label'  => 'Make']);
     $inputs[] = html::input(['type' => 'text', 'name' => 'model', 'id' =>
     'model', 'label' => 'Model']);
     $inputs[] = html::input(['type' => 'number', 'name' => 'year', 'id' =>
     'year', 'label' => 'Year']);
     $inputs[] = '<br/>';
     $inputs[] = '<button type= "submit">Save</button>';
     $form = html::newForm(['action' => 'index.php?controller=carController', 'method' => 'post'], $inputs);
     echo $form;
   
   }
 }
  

?>
