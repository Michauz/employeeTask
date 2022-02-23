


	<?php
		$connection = connectToDataBase::getInstance();
		$connection->getAllEmployeeRole($_GET["employeeId"]);
	?>


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
  public function getAllEmployeeRole($id){
	$sql = "SELECT RoleId,description FROM EmployeeRoles where EmployeeId = " . $id . " and enabled=1";
	$res = $this->connection->query($sql);
	//echo(json_encode($res->fetch_assoc()));
	$rows = array();
	  while($row = $res->fetch_assoc()) {
	    $rows[] = $row;
	  }
	echo json_encode($rows);
  }
}


?>