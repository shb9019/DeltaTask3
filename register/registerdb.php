<?php
	session_start();

	if($_SERVER["REQUEST_METHOD"]=="POST"){

	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	$conn = new mysqli("localhost","root","");

	$sql = "CREATE DATABASE IF NOT EXISTS snips;";
	$conn->query($sql);

	$password = htmlspecialchars($password);
	$password = trim($password);
	$salt = sha1(md5($password));
	$password = md5($password.$salt);

	$sql = "USE snips;";
	$conn->query($sql);
	
	$sql =" CREATE TABLE IF NOT EXISTS user(username VARCHAR(255) PRIMARY KEY,email text,password char(255));"; 
	$conn->query($sql);

	$sql = "INSERT INTO user (username,email,password) VALUES ('".$username."','".$email."','".$password."');";
	$conn->query($sql);
	$_SESSION["username"] = $username;
	$_SESSION["email"] = $email;
	$conn->close();
	}
?>