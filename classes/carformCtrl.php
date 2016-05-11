<?php
 
 class carformCtrl extends controller {
  
  public function get() {
   
   session_start();
   
   $carform = new carformView;

   $pageHeader = $carform->getHeader();
   $this->html .= $pageHeader;

   $navBar = $carform->getNavBar();
   $this->html .= $navBar;
   
   $body = $carform->getBody();
   $this->html .= $body;

   $footer = $carform->getFooter();
   $this->html .= $footer;
  }

  public function post() {
   session_start();
   
   //VIN from the post form
   $vin = $_POST['vin'];
   
   //set cURL to call Edmunds API
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL,
   "https://api.edmunds.com/api/vehicle/v2/vins/$vin?fmt=json&api_key=u48d7aetdk4yz6pwqnzd62ez");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $output = curl_exec($ch);
   curl_close($ch);
   
   //response from cURL calling the Edmunds API
   $response = json_decode($output);
   
   //setup data to make the DB query
   $userid = $_SESSION['user_id'];
   $make = $response->make->name;
   $model = $response->model->name;
   $year = $response->years[0]->year;
   $condition = $_POST['cond'];
   $price;

   if($condition == 'new'){
    $price = $response->price->baseInvoice;
   }
   else{
    $price = $response->price->usedPrivateParty;
   }
   //echo $price;
   //print_r($_POST);
   //print_r($response);
   //print_r($response->price);
   //print_r($response->price->baseInvoice);
   //print_r($response->price->usedPrivateParty);
   //sql prep
   define('DB_SERVER', 'sql2.njit.edu');
   define('DB_USERNAME', 'sl597');
   define('DB_PASSWORD', 'qBC6RIgkO');
   define('DB_DATABASE', 'sl597');
   $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

   //sql query
   $sql = "INSERT INTO carInventory (VIN, UserId, Make, Model, Year, carCondition,
   Price) VALUES('$vin', '$userid', '$make', '$model', '$year', '$condition',
   '$price')";

   if($db->query($sql) === TRUE) {
    echo "New record created successfully";
    header("location: index.php?controller=homepageCtrl");
   }
   else {
    echo "Error: " . $sql . "<br>" . $db->error;
   }
  }

  public function put() {}
  public function delete() {}

 }
