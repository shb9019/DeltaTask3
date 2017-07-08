<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$username = trim($_POST["username"]);
		$username = stripslashes($username);
		$username = htmlspecialchars($username);

		$password = htmlspecialchars($_POST["password"]);
		$password = trim($password);
		$salt = sha1(md5($password));
		$password = md5($password.$salt);

		$conn = new mysqli("localhost","root","");

		$sql = "CREATE DATABASE IF NOT EXISTS snips;";
		$conn->query($sql);

		$sql = "USE snips;";
		$conn->query($sql);
	
		$sql =" CREATE TABLE IF NOT EXISTS user(username VARCHAR(255) PRIMARY KEY,email text,password char(255));"; 
		$conn->query($sql);

		$sql = "SELECT * FROM user WHERE username='".$username."';";
		$result = $conn->query($sql);

		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				if($row["password"]==$password){
					$_SESSION["username"] = $username;
					$_SESSION["email"] = $row["email"];
					echo '*Success';
				}
				else{
					echo '*Wrong Password';
				}
			}
		}	
		else{
			echo '*Username does not exist';
		}
	}
		
?>