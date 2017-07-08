<?php
	
		$s = $_REQUEST["s"];

		$conn = new mysqli("localhost","root","","snips");
		if($conn->connect_error){
			die('Connection Failed'.$conn->connect_error);
		}
		$sql = "SELECT username FROM user WHERE username='".$s."';";
		$result = $conn->query($sql);
		if($result->num_rows>0){
			echo 'Not Available';
		}
		else{
			echo 'Available';
		}

		$conn->close();
?>