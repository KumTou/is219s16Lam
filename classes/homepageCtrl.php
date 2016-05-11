
	<?php
	  class homepageCtrl extends controller {
	    
	    public function get() {
	      
	      session_start();
	      //print_r($_SESSION);
	      define('DB_SERVER', 'sql2.njit.edu');
	      define('DB_USERNAME', 'sl597');
	      define('DB_PASSWORD', 'qBC6RIgkO');
	      define('DB_DATABASE', 'sl597');
	      $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	      
	      $sql = "SELECT * FROM carInventory WHERE userId='".$_SESSION['user_id']."'";
	      $result = mysqli_query($db, $sql);
	      $row = $result->fetch_assoc();
	      $keys = (array_keys($row));
	      
	      $homepage = new homepageView;
	      
	      $pageHeader = $homepage->getHeader();
	      $this->html .= $pageHeader;
	      
	      $navBar = $homepage->getNavBar();
	      $this->html .= $navBar;
	      
	      if($row != 0) {
	        $userInventory = $homepage->getUserInventory($keys, $result);
	        $this->html .= $userInventory;
	      }
	      
	      $sql = "SELECT * FROM carInventory";
	      $result = mysqli_query($db, $sql);
	      $row = $result->fetch_assoc();
	      $keys = (array_keys($row));
	      	     	      
	      $inventoryTable = $homepage->getCarInventory($keys, $result);
	      $this->html .= $inventoryTable;
	      
	      $buttons = $homepage->getButtons();
	      $this->html .= $buttons;
	      
	      $footer = $homepage->getFooter();
	      $this->html .= $footer;
	    }

	    public function post() {}
	    public function put() {}
	    public function delete() {}
	  }
