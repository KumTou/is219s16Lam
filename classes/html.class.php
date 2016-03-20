<?php
class html{
// create a new link
  public static function newLink($name, $href){
    $link ='<a href ="' . $href . '">' . $name . '</a>';
    return $link;
  }
  
  //create a new table
  public static function newTable($headers, $rows){
    $table = '<table><thead><tr>';
    foreach($headers as $header){
       $table .= '<th>' .$header . '</th>';
    }
    $table .= '</tr></thead><tbody>';
    foreach ($rows as $row){
      $table .= '<tr>';
      foreach($row as $col){
         $table .= '<td>' .$col .'</td>';
      }
      $table .= '</tr>';
    }
    return $table .'</tbody></table>';
  }
// Code to make Form. 
  private static function parameters($array){
    $parameters = '';
    foreach($array as $key => $value){
     if ($key != 'label'){
       $parameters .= ' ' . $key . '="' . $value . '"';
     }
    }
    return $parameters;
  }

  private static function label($id, $label){
    return '<label for="' . $id . '">' . $label . '</label><br>';
  }

  public static function input($inputs){
    $input = '';
    if(isset($inputs['label'])){
      $input .= html::label($inputs['id'], $inputs['label']);
    }
    return $input .'<input' . html::parameters($inputs).'/><br>';
  }

 //generates form 
 public static function newForm($parameters, $inputs){
   $form = '<form' . html::parameters($parameters). '>';
   foreach($inputs as $input){
     $form .= $input;
   }
   return $form .= '</form>';
 } 

}  
?>
