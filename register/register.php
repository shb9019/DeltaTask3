<?php
	session_start();
	header("Cache-Control: no-cache, must-revalidate");
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="shortcut icon" href="../resources/seo-web-code-icon.png" type="image/png" />
		<title>Register</title>
		<style>
			header{
				color: white;
			}
			body{
				background-image: url("../resources/wall.jpg");
				background-size: 100%;
				font-family: 'Roboto', sans-serif;
  				font-weight: 100;
			}
			form{
				border: ;
				position: fixed;
				width: 500px;
				height: 500px;
				padding-top: 20px;
				background-color: white;
				transform: translate(-50%,-50%);
				left: 50%;
				top: 50%;
			}
			input[type="text"], input[type="password"]{
				border: 0;
				display: block;
				position: relative;
				padding-left: 10px;
				left: 50%;
				transform: translate(-50%,0);
				height: 40px;
				width: 300px;
				border-bottom: 1px solid #ccc;
				transition: 0.5s border-bottom;
				font-size: 16px;
			}	
			input[type="text"]:focus, input[type="password"]:focus{
				outline: none;
				border-bottom: 1px solid black;
				transition: 0.5s border-bottom;

			}
			h1{
				padding-left: 60px;
			}
			input[type="submit"]{
				margin-top: 50px;
				border: none;
				position: relative;
				background-color: #444;
				display: block;
				left: 50%;
				transform: translate(-50%,0);
				padding: 8px 12px;
				font-size: 16px;
				color: white;
				font-weight: 500;
			}
			input[type="submit"]:hover{
				background-color: #111;
			}
			#Error{
				color: red;
				display: block;
				margin: auto;
				padding-top: 20px;
				text-align: center;
			}
			#avail{
				color: red;
				position: absolute;
				float: right;
				width: 90%;
				z-index: 1;
				text-align: right;
				top: 135px;
				padding-right: 20px;
			}
			footer{
				color: white;
				position: fixed;
				bottom: 10px;
				width: 97%;
				text-align: right;
			}
			footer i:hover{
				cursor: pointer;
				color: #666;
			}
		</style>
	</head>
	<body>
		<script>
			var error;
			var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i; 
			var username = /^[A-Za-z0-9_]{1,20}$/;
			var password =  /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
			$(document).ready(function(){
				$("#regForm").submit(function(e){
					e.preventDefault();
					var data = $(this).serializeArray();
					var formdata = [];
					for(var i=0;i<data.length;i++){
						formdata[data[i].name] = data[i].value;
						console.log(data[i].value);
					}
					error = checkEverything(formdata);
					if(error=="*No Error"){

						$.ajax({
							type: 'POST',
							url: 'registerdb.php',
							data: {email: formdata["email"],username: formdata["username"],password: formdata["password"]},
							success: function(){
								window.location = '../home';
							}
						});
					}
					else{
						document.getElementById("Error").innerHTML = error;
					}
				});
			});


			function checkEverything(data){
				if((data["username"])==""){
					return "*Please Enter Username";
				}
				else if(!username.test(data["username"])){
					return "*Username must contain 3-20 characters and no special characters(except _)";
				}
				else if((data["email"])==""){
					return "*Please Enter Email ID";
				}
				else if(!email.test(data["email"])){
					return "*Please enter valid Email ID";
				}
				else if(data["password"]==""){
					return "*Please enter Password";
				}
				else if(data["password2"]==""){
					return "*Please retype Password";
				}
				else if(data["password"]!=data["password2"]){
					return "*Passwords do not match";
				}
				else if(!password.test(data["password"])){
					return "*Password must contain 6-20 characters";
				}
				else if(document.getElementById("avail").innerHTML!="Available"){
					return "Username already Exists";
				}
				else{
					return "*No Error";
				}

			}

			function checkAvail(s){
				var p = document.getElementById("avail");
				if(s.length==0){
					p.innerHTML = "";
				}
				else{
					var ajaxRequest = new XMLHttpRequest();
					var ech;
					ajaxRequest.onreadystatechange = function(){
						if(this.readyState==4 && this.status==200){
							document.getElementById("avail").innerHTML = this.responseText;

						}
					}

					ajaxRequest.open("GET","checkAvail.php?s="+s,true);
					ajaxRequest.send();
				}
			}	

			function login(){
				window.location = '../login'
			}
		</script>
		<header>
			<i class="fa fa-code fa-3x" aria-hidden="true" title="Snipps"></i>
		</header>
		<form id="regForm" method="post">
		<h1>Sign Up</h1>
			<input type="text" name="username" placeholder = "Userame" onkeyup="checkAvail(this.value)"><p id="avail"></p><br>
			<input type="text" name="email" placeholder="E-Mail"><br>
			<input type="password" name="password" placeholder="Password"><br>
			<input type="password" name="password2" placeholder="Retype Password">
			<input type="submit" value="Register" id="butt">
			<p id="Error"></p>
		</form>
		<footer>
			<i class="fa fa-sign-in fa-3x" aria-hidden="true" title="Snipps" onclick="login()"></i>
		</footer>
	</body>
</html>