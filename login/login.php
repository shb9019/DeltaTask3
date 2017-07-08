<?php
	session_start();
	if(isset($_SESSION["username"])){
		header("Location: ../Home");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="shortcut icon" href="../resources/seo-web-code-icon.png" type="image/png" />
	<title>Login</title>
	<style>
		header, footer{
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
				width: 420px;
				height: 350px;
				padding-top: 40px;
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
			h1{
				padding-left: 40px;
			}
			footer{
				position: fixed;
				bottom: 5px;
				width: 98%;
				text-align: right;
			}
			footer i:hover{
				color: #666;
				cursor: pointer;
			}
			#error{
				display: block;
				color: red;
				text-align: center;
			}
		</style>		

	</head>
	<body>
		<script>
			$(document).ready(function(){
				$("#logForm").submit(function(e){
					e.preventDefault();
					var data = $(this).serializeArray();
					var formdata = [];
					for(var i=0;i<data.length;i++){
						formdata[data[i].name] = data[i].value;
						
					}
					
					$.ajax({
						type: 'POST',
						url: 'logindb.php',
						data: {username: formdata["username"],password: formdata["password"]},
						success: function(responseText){
							document.getElementById("error").innerHTML = responseText;
							if(responseText=='*Success'){
								window.location = "../Home";
							}
						}
					});
				});
			});
		</script>
		<header>
			<i class="fa fa-code fa-3x" title="Snipps"></i>
		</header>
		<form id="logForm" method="post">
		<h1>Login</h1><br>
		<input type="text" placeholder="Username" name="username"><br>
		<input type="password" placeholder="Password" name="password">
		<input type="submit">
		<p id="error"></p>
		</form>
		<footer>
			<i class="fa fa-user-plus fa-3x" aria-hidden="true" title="Sign Up" onclick="window.location = '../register'"></i>
		</footer>
	</body>
</html>