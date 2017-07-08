<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$conn = new mysqli("localhost","root","","snips");

		$currPass = htmlspecialchars($_POST["currPass"]);
		$currPass = trim($currPass);
		$salt = sha1(md5($currPass));
		$currPass = md5($currPass.$salt);

		$changePass = htmlspecialchars($_POST["changePass"]);
		$changePass = trim($changePass);
		$salt = sha1(md5($changePass));
		$changePass = md5($changePass.$salt);

		$conn = new mysqli("localhost","root","","snips");

		$sql = "SELECT password FROM user WHERE username = '".$_SESSION["username"]."';";
		$result = $conn->query($sql);

		if($row = $result->fetch_assoc()){
			if($row["password"]==$currPass){
				$sql = "UPDATE snips SET password = '".$changePass."';";
				$conn->query($sql);
				echo '*Password Changed';
			}
		}
		else{
			echo '*Wrong Password Bro';
		}

		$conn->close();
	}
?>