<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$conn = new mysqli("localhost","root","","snips");

		$sql = "UPDATE user SET username = '".$_POST["username"]."',email='".$_POST["email"]."'WHERE username = '".$_SESSION["username"]."';";
		$conn->query($sql);

		$sql = "UPDATE files SET Author = '".$_POST["username"]."' WHERE Author = '".$_SESSION["username"]."';";
		$conn->query($sql);

		$_SESSION["username"] = $_POST["username"];
		$_SESSION["email"] = $_POST["email"];

		$conn->close();
	}
?>