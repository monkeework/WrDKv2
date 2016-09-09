<?php #database-class.php
#http://www.codingcage.com/2015/09/login-registration-email-verification-forgot-password-php.html

class Database
{

		#should be getting from config-inc.php file yes?
		#otherwise two points to maintain.

		private $host = "localhost";
		private $db_name = "MAtest";
		private $username = "root";
		private $password = "root";
		public $conn;

		public function dbConnection()
 {

		 $this->conn = null;
				try
	{
						$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
	 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
	catch(PDOException $exception)
	{
						echo "Connection error: " . $exception->getMessage();
				}

				return $this->conn;
		}
}
