<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="script.js"></script>
	<link rel="stylesheet" href="style.css">

</head>
<body>

	<?php
		$allEMp = getAllEmployees();
		?>
		<div class="dataContainer">
		<?php
		foreach ($allEMp as $key => $value) {
			?>
			<div class="singleData">
				<div class="dataId"> <?php echo $value["ID"]; ?> </div>
				<div class="dataName"> <?php echo $value["Name"]; ?> </div>
			</div>
			<div class="roleDataContainer">
				<?php foreach (getAllEmployeeRole($value["ID"]) as $keyy=>$valuee){
					?>
					<div 
						class="singleDataDesc" 
						data-name = " <?php echo $value["Name"]; ?>" 
						data-desc = " <?php echo $valuee["description"]; ?>">
						<?php echo $valuee['description'] ; ?>
							<div class='popUp'>
								<div class='text'></div>
									<button><a  class='post' 
												data-emp = '<?php echo $value["ID"]; ?>' 
												data-role = '<?php echo $valuee["RoleId"]; ?>' >yes</a></button>
									<button>No</button>
								</div>  
							</div>
					<?php } ?>
				
			</div>
			<?php } ?>
		</div>

</body>
</html>

<?php

	function getAllEmployees(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://localhost/GetEmployeeList.php',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);
		$data =  json_decode($response ,true);
		curl_close($curl);
		return $data;	
	}
		function getAllEmployeeRole($employeeId){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://localhost/GetEmployeeRoles.php?employeeId=' . $employeeId,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return json_decode($response ,true);	
	}
	function insertTime(){
				$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"http://localhost/ClockIn.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "employeeId=1&roleId=10");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close ($ch);
		echo $server_output;
	}

?>
<style>
.singleData {
    background: cadetblue;
    color: white;
    width: 30%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 10px;
    border: 4px solid yellowgreen;
    font-size: 4vw;
    padding: 10px;
}
.dataContainer {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.dataId {
    width: 100%;
    padding-left: 25px;
    font-size: 3vw;
}
.roleDataContainer {
    border: 1px solid;
    padding: 10px;
        margin-bottom: 10px;
    display: none;
}
.singleDataDesc {
    display: flex;
    border-bottom: 1px solid;
    place-content: center;

    flex-direction: column;
    align-items: center;
}
.popUp{
	display: none;
    text-align: center;
}

</style>
