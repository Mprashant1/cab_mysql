<?php
	class DBconnection{
		public $servername;
		public $username;
		public $password;
		public $dbname;
		public $conn;
		function __construct(){
			$this->conn = new mysqli("localhost","root", "","cab_ride");
			if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		    }else{
		    	//echo "Connection established";
		    }
		}
	}
?>