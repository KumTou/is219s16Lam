<?php
  
  class editCtrl extends controller {
  
    public function get() {
    
      session_start();
      
      $editPage = new editView;
      
      $pageHeader = $editPage->getHeader();
   	  $this->html .= $pageHeader;
   	  
   	  $navBar = $editPage->getNavBar();
      $this->html .= $navBar;
      
      $vin = $_GET['vin'];
      /*//set cURL to call Edmunds API
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,
      "https://api.edmunds.com/api/vehicle/v2/vins/$vin?fmt=json&api_key=u48d7aetdk4yz6pwqnzd62ez");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec($ch);
      curl_close($ch);
      
      //response from cURL calling the Edmunds API
      $response = json_decode($output);*/
      
      //sql prep
      define('DB_SERVER', 'sql2.njit.edu');
      define('DB_USERNAME', 'sl597');
      define('DB_PASSWORD', 'qBC6RIgkO');
      define('DB_DATABASE', 'sl597');
      $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      
      //sql query
      $sql = "SELECT * FROM carInventory WHERE VIN = '$vin'";
      $response = $db->query($sql);
      $row = $response->fetch_assoc();

      $body = $editPage->getBody($row, $vin);
      $this->html .= $body;
      
      $footer = $editPage->getFooter();
      $this->html .= $footer;
    
    }
    
    public function post() {
    
      session_start();
      $vin = $_POST['vin'];
      
      //sql prep
      define('DB_SERVER', 'sql2.njit.edu');
      define('DB_USERNAME', 'sl597');
      define('DB_PASSWORD', 'qBC6RIgkO');
      define('DB_DATABASE', 'sl597');
      $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      
      if($_GET['action'] == "delete"){
      
        //sql query
        $sql = "DELETE FROM carInventory WHERE VIN = '$vin'";
        
        if($db->query($sql) === TRUE) {
          echo "Record deleted successfully";
          header("location: index.php?controller=homepageCtrl");
        }
        else {
          echo "Error: " . $sql . "<br>" . $db->error;
        }
      
      }
      else {
        
        $newPrice = $_POST['price'];
        $condition = $_POST['cond'];
        
        //sql query
        $sql = "UPDATE carInventory SET Price = '$newPrice', carCondition = '$condition' WHERE VIN = '$vin'";
        
        if($db->query($sql) === TRUE){
          echo "Record updated successfully";
          header("location: index.php?controller=homepageCtrl");
        }
        else {
          echo "Error: " . $sql . "<br>" . $db->error;
        }
      }
    
    }
    
    public function put() {}
    public function delete() {}
    
  }