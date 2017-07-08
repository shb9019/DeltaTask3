<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$conn = new mysqli("localhost","root","","snips");

		$sql = "CREATE TABLE IF NOT EXISTS files (ind VARCHAR(255) PRIMARY KEY,language VARCHAR(255),Author VARCHAR(255),anonymous INT(5),expiration VARCHAR(255), privacy INT(5));";
		$conn->query($sql);

		$sql = "SELECT ind,language,Author,expiration,privacy,anonymous FROM files;";
		$result = $conn->query($sql);
		$date = date('Y-m-d h:i:s');
		$date = (int)strtotime($date);
		$tabledata = array();
		date_default_timezone_set('Asia/Kolkata');
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				$dateExp = $row["expiration"];
				$dateExp = (int)strtotime($dateExp);				
				if(($dateExp > time())&&($row["privacy"]==0)){
					if($row["anonymous"]==0){
						$Author = $row["Author"];
					}
					else{
						$Author = 'Anonymous';
					}
					$tr = array(
						'Index' => $row["ind"],
						'Language' => $row["language"],
						'expiration' => $row["expiration"],
						'Author' => $Author
					);
					array_push($tabledata,$tr);
				}
			}
		}
		echo json_encode($tabledata);
		$conn->close();
	}
?>