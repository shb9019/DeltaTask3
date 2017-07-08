<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$conn = new mysqli("localhost","root","","snips");
		if($conn->connect_error){
			echo 'Error Connecting '.$conn->connect_error;
		}
		
		$sql =" CREATE TABLE IF NOT EXISTS ids (id INT(15) NOT NULL PRIMARY KEY AUTO_INCREMENT);"; 
		$conn->query($sql);

		$sql = "INSERT INTO ids () VALUES ();";
		$conn->query($sql);

		$sql = "SELECT MAX(id) AS max FROM ids";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();

		$index = md5($row['max']);

		if($_POST["lang"] == 'c_cpp')
			$ext = ".cpp";
		else if($_POST["lang"] == 'csharp')
			$ext = ".cs";
		else if($_POST["lang"] == 'coffee')
			$ext = ".coffee";
		else if($_POST["lang"] == 'css')
			$ext = ".css";
		else if($_POST["lang"] == 'dart')
			$ext = '.dart';
		else if($_POST["lang"] == 'golang')
			$ext = '.go';
		else if($_POST["lang"] == 'haskell')
			$ext = '.hs';
		
		else if($_POST["lang"] == 'java')
			$ext = '.java';
		else if($_POST["lang"] == 'javascript')
			$ext = '.js';
		else if($_POST["lang"] == 'julia')
			$ext = '.jl';
		else if($_POST["lang"] == 'php')
			$ext = '.php';
		else if($_POST["lang"] == 'python')
			$ext = '.py';
		else
			$ext = '.txt';

		mkdir("../Snipps/".$index);
		$ht = fopen("../Snipps/".$index."/.htaccess","w+") or die("Unable to create .htaccess");
		fwrite($ht,"DirectoryIndex ".$index.$ext);

		$file = fopen("../Snipps/".$index."/".$index.$ext,"w+") or die("Unable to create file.");
		fwrite($file,($_POST["snipp"]));
		fclose($file);

		$expiration = strtotime($_POST["expiration"]);
		date_default_timezone_set('Asia/Kolkata');
		

		$sql = "CREATE TABLE IF NOT EXISTS files (ind VARCHAR(255) PRIMARY KEY,language VARCHAR(255),Author VARCHAR(255),anonymous INT(5),expiration VARCHAR(255), privacy INT(5));";
		$conn->query($sql);

		$sql = "INSERT INTO files (ind,language,Author,anonymous,expiration,privacy) VALUES ('".$index."','".$_POST["lang"]."','".$_SESSION["username"]."',".$_POST["anony"].",'".date('Y-m-d h:i:s',$expiration)."',".$_POST["privacy"].");";
		$conn->query($sql);

		$conn->close();
	}
?>