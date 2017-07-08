<?php
	session_start();
	if(!isset($_SESSION["username"])){
		header('Location: ..');
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="../resources/seo-web-code-icon.png" type="image/png" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			body{
				background-image: url("../resources/wall.jpg");
				background-size: 100%;
				font-family: 'Roboto', sans-serif;
  				font-weight: 100;
  				color: white;
			}
			header nav{
				display: inline;
			}

			header nav p{
				display: inline;
				float: right;
				padding: 0px 20px;
				font-size: 20px;
			}
			header{
				position: fixed;
				width: 99%;
				top: 0;
				background-color: black;
				z-index: 1;
			}
			img{
				margin-left: 4vw;
				margin-top: 1vh;
			}
			h1,section{				
				margin-left: 30px;
			}
			button:not(#changePass){
				float: right;
			}
			button:hover{
				cursor: pointer;
			}
			section{

				max-width: 300px;
			}
			#changePass{
				padding: 10px;
			}
			#changePassword{
				display: block;
				color: white;
				background-color: #444;
				border: none;
				font-size: 17px;
				padding: 4px 12px;
				margin-top: 40px;
				margin-right: 95px;
			}
			#changePassword:hover{
				background-color: #111;
				cursor: pointer;
				border: 1px solid white;
			}
			#passForm{
				border: 1px solid white;
				z-index: 1;
				width: 300px;
				display: block;
				position: fixed;
				padding-top: 20px;
				background-color: white;
				height: 250px;
				left: 50%;
				top: 50%;
				transform: translate(-50%,-50%);
			}
			#passForm input{
				display: block;
				margin: auto;
				border: 1px solid white;
			}
			#passForm input[type="password"]{
				width: 200px;
				padding-left: 10px;
				height: 30px;
				border-bottom: 1px solid #555;
			}

			#passForm input[type="password"]:focus{
				outline: none;
				border-bottom: 1px solid black;
			}

			#passForm input[type="submit"]{
				background-color: #444;
				font-size: 17px;
				padding: 4px 12px;
				border: none;
				color: white;
			}
			#passForm input[type="text"]:hover{
				outline: none;
			}
			#passForm input[type="submit"]:focus{
				outline: none;
			}
		</style>
	</head>
	<body>
		<script>
			$passwordErr = "";
			var ajaxRequest;
			function ajaxFunction(){
				try{
					ajaxRequest = new XMLHttpRequest();
				}
				catch(e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					}
					 catch(e){
					 	try{
					 		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					 	}
					 	catch(e){
					 		alert("Your Browser Broke!!!");
					 		return false;
					 	}
					}
				}
			}
			ajaxFunction();
			function showUpemail(){
				document.getElementById("email").style = "display:none";
				document.getElementById("emailShow").style = "display:none";
				document.getElementById("emailNew").style = "display: auto";
				document.getElementById("emailMake").style = "display:auto";
			}

			function showUpUsername(){
				document.getElementById("username").style = "display:none";
				document.getElementById("usernameShow").style = "display:none";
				document.getElementById("usernameNew").style = "display: auto";
				document.getElementById("usernameMake").style = "display:auto";
			}

			function changeUsername(){
				var data = new FormData();
				var username = document.getElementById("usernameNew").value;
				var email = "<?php echo $_SESSION["email"]; ?>";
				data.append('email',name);
				data.append('username',username);
				ajaxRequest.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						document.getElementById("username").innerHTML = username;
						document.getElementById("username").style = "display:auto";
						document.getElementById("usernameShow").style = "display:auto";
						document.getElementById("usernameNew").style = "display: none";
						document.getElementById("usernameMake").style = "display:none";
					}
					
				}
				ajaxRequest.open("POST","change.php",true);
				ajaxRequest.send(data);
			}
			function changeEmail(){
				var data = new FormData();
				var username = "<?php echo $_SESSION["username"]; ?>";
				var email = document.getElementById("emailNew").value;
				data.append('email',email);
				data.append('username',username);
				ajaxRequest.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						document.getElementById("email").innerHTML = email;
						document.getElementById("email").style = "display:auto";
						document.getElementById("emailShow").style = "display:auto";
						document.getElementById("emailNew").style = "display: none";
						document.getElementById("emailMake").style = "display:none";
					}
					
				}
				ajaxRequest.open("POST","change.php",true);
				ajaxRequest.send(data);
			}
			function changePassword(){
				document.getElementById("passForm").style = "display: auto";
			}

			function changePass(){
				$('#passForm').submit(function(event){
					event.preventDefault();
					var currPass = $("#currPass").val();
					var changePass = $("#changePass").val();
					var form = $(this),url = "changePassword.php";
					var posting = $.post(url,{currPass: currPass, changePass: changePass});
					posting.done(function(responseText){
						document.getElementById("passForm").style = "display: none";
						document.getElementById("p").innerHTML = responseText;
					});
				});
			}
		</script>
		<header>
			<i class="fa fa-code fa-3x"></i>
			<nav>
				<p>Welcome <?php echo $_SESSION["username"] ?></p>
			</nav>
		</header>

		<h1>Edit Profile Details</h1>
		<section>
			<h2>Username</h2>
			<label id="username"><?php echo $_SESSION["username"];?></label>
			<button id="usernameShow" type="button" onclick="showUpUsername()">Edit</button>
			<input id="usernameNew" type="text" style="display:none;">
			<button id="usernameMake" type="button" onclick="changeUsername()" style="display:none;">Update</button>
		</section>
		<section>
			<h2>Email</h2>
			<label id="email"><?php echo $_SESSION["email"];?></label>
			<button id="emailShow" type="button" onclick="showUpemail()">Edit</button>
			<input id="emailNew" type="text" style="display:none;">
			<button id="emailMake" type="button" onclick="changeEmail()" style="display:none;">Update</button>
		</section>
		<section>
			<button type ="button" onclick="changePassword()" id="changePassword">Change Password</button>
		</section>
		
		<form method="post" id="passForm" style="display:none">
			<div id="username">
				<input type="password" name="currPass" id="currPass" placeholder = "Current Password"><br>
			</div>	
			<div id="password">
				<input type="password" name="changePass" id="changePass" placeholder="New Password"><br>
				<br>
			<input type="submit" value="Change Password" id="button" onclick="changePass()">
		</form>
		<p id="p" style="color: white"></p>
	</body>
</html>