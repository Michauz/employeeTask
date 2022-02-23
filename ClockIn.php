<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="script.js"></script>

</head>
<body>

	<?php
		$connection = connectToDataBase::getInstance();
		$connection -> getAllEmployeeClock($_POST["employeeId"],$_POST["roleId"]);
	?>

</body>
</html>

<?php
class connectToDataBase {
  private static $instance = null;
  private $connection;
  
  private function __construct() {
  	$servername = "localhost";
	$username = "root";
	$password = "root";
	$conn = new mysqli($servername, $username, $password,"mysql");
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully";
	$this->connection = $conn;
    // The expensive process (e.g.,db connection) goes here.
  }
 
  // The object is created from within the class itself
  // only if the class has no instance.
  public static function getInstance()
  {
    if (self::$instance == null)
    {
      self::$instance = new connectToDataBase();
    }
 
    return self::$instance;
  }
  public function getConnection(){
  	return $this->connection;
  }
  public function getAllEmployeeClock($employeeId,$roleId){
	$sql = "SELECT * FROM EmployeeRoles where EmployeeId = " . $employeeId . " and enabled=1" . " and RoleId=" . $roleId;
	$res = $this->connection->query($sql);
	//echo(json_encode($res->fetch_assoc()));
	$insertQuery = "";
	$date   = new DateTime(); //this returns the current date time
	$result = $date->format('Y-m-d-H-i');
	echo $result . "<br>";
	$krr    = explode('-', $result);
	$now = implode("", $krr);
	  while($row = $res->fetch_assoc()) {
	  	$insertQuery =  "INSERT INTO Attendance VALUES (" . $employeeId .", " . $roleId .", " . $now .")";
	  	echo $insertQuery;

	  }
		$res = $this->connection->query($insertQuery);
  }
}


?>