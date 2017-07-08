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
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>hljs.initHighlightingOnLoad();</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="../ace-builds-master/src-noconflict/ace.js"></script>
		<link rel="shortcut icon" href="../resources/seo-web-code-icon.png" type="image/png" />
		<title>Home</title>
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
			button{
				background-color: transparent;
				float: right;
				top: 10px;
				border: none;
			}
			button:focus{
				outline: none;
			}
			img{
				padding-top: 15px;
				width: 30px;
				height: 30px;
			}
			a{
				display: block;
				margin: 0;
				width: 200px;				
				color: black;
				text-decoration: none;
				background-color: white;
			}
			a:hover{
				background-color: #DDD;
			}
			a i{
				display: inline-block;
				padding-left: 18px;
			}
			a p{
				display:inline-block;
				width: 70%;
				
				text-align: right;
			}
			#menu{
				display: none;
				position: fixed;
				right: 0;
				top: 62px;
				z-index: 2;
			}
			#menuButt:hover{
				cursor: pointer;
			}
			#editor{
				margin: 15px;
				width: 90%;
				height: 300px;
				display: block;
				margin: auto;
			}
			#parent{
				border: 1px solid white;
				position: relative;
				display: block;
				top: 70px;
				width: 900px;
				height: 600px;
				margin: auto;
				background-color: white;
			}
			#head p{
				font-size: 20px;
			}
			#head{
				border: 1px solid white;
				padding-left: 20px;
				color: black;
			}
			#options{
				display: inline-block;
				border: 1px solid white;
				width: 49%;
				height: 300px;
			}
			#synt{
				display: inline-block;
				width: 100%;
				padding-left: 46px;
				
			}
			#chooseLang{
				display:inline-block;
				color: black;
				margin-left: 459px;
			}
			input[type="file"]{
				display: none;
				z-index: 1;
				cursor: pointer;
			}
			#upload{
				background-color: #444;
				color: white;
				padding: 5px 10px 5px 12px;
			}
			#upload:hover{
				background-color: #111;
				cursor: pointer;

			}
			input[type="button"]{
				margin-left: 350px;
				background-color: #444;
				color: white;
				padding: 5px 10px 5px 12px;
				border: none;
				font-size: 16px;
				margin-top: 80px;
			}
			input[type="button"]:hover{
				background-color: #111;
				cursor: pointer;
			}
			#checkAn, #checkAx{
				z-index: 1;
				display: none;
			}
			#anonymous, #private{
				display: inline-block;
				margin: 10px;
				background-color: #444;
				border-radius: 5px;
				padding: 5px 10px
			}
			#anonymous:hover,#private:hover{
				cursor: pointer;
			}
			#otherOptions{
				display: inline-block;
				width: 100%;
				padding-left: 36px;
								height: 200px;
			}
			#Exp{
				display: inline-block;
			}
			#chooseExp{
				display: inline-block;
				margin-left: 220px;
			}
			#Create{

			}
		</style>
	</head>
	<body>
		<header>
			<i class="fa fa-code fa-3x"></i>
			<nav>
				<button type="button" id="menuButt" onclick="openMenu()"><img src="../resources/drop.png"></button>
				<p>Welcome <?php echo $_SESSION["username"] ?></p>
			</nav>
		</header>
		<nav id="menu">
			<a href="mysnipps">
				<i class="fa fa-file-text" aria-hidden="true"></i>
				<p>My Snipps</p>
			</a>		
			<a href="allSnipps">
				<i class="fa fa-th-list" aria-hidden="true"></i>
				<p>Public Snipps</p>
			</a>
			<a href="editProfile">
				<i class="fa fa-cog" aria-hidden="true"></i>
				<p>Edit Profile</p>
			</a>
			<a href="#" onclick="signOut()">
				<i class="fa fa-sign-out"></i>
				<p>Sign Out</p>
			</a>
		</nav>

		<div id="parent">
			<div id="head">
			<p>New Snipp</p>
			</div>
			<div id="editor"></div>
			<div id="synt">
				<label id="upload"> 
				Upload Code<input type="file" value="Upload Code">
				</label>	
				<p id="chooseLang">Choose Language</p>
				<select name="lang" id="syntax">
					<option value="c_cpp">C++</option>
					<option value="csharp">C#</option>
					<option value="coffee">Coffeescript</option>
					<option value="css">CSS</option>
					<option value="dart">Dart</option>
					<option value="golang">Go</option>
					<option value="haskell">Haskell</option>
					<option value="html">HTML</option>
					<option value="java">Java</option>
					<option value="javascript">Javascript</option>
					<option value="julia">Julia</option>
					<option value="php">PHP</option>
					<option value="python">Python</option>		
					<option value="textfile">Plain Text</option>
				</select>
			</div>
			<div id="otherOptions">
			<label id="anonymous">
				Publish Anonymously
				<input type="checkbox" name="anonymous" id="checkAn" onclick="changeColor()">
			</label>
			<label id="private">
				Keep Snipp Private
				<input type="checkbox" name="Private" id="checkPr" onclick="changeColorPr()">
			</label>
			<p id="chooseExp" style="color: black">Set Expiration</p>
			<select name="expiration" id="Exp">
				<option value="+10000 days">Never</option>
				<option value="+10 minutes">10 minutes</option>
				<option value="+1 hour">1 Hour</option>
				<option value="+1 Day">+1 Day</option>
				<option value="+1 Week">+1 Week</option>
				<option value="+2 Weeks">+2 Weeks</option>
				<option value="+1 month">+1 month</option>
			</select>	
			<input type="button" id="Create" value="Create New Snipp" name="Create">
			</div>
		</div>	

		<script>
			function openMenu(){
				document.getElementById("menu").setAttribute("style","display:block;");
			}
			$(window).click(function(){
				document.getElementById("menu").setAttribute("style","display: none");
			});
			$('#menu,#menuButt').click(function(event){
				event.stopPropagation();
			});

			var editor = ace.edit('editor');
			editor.setTheme("ace/theme/monokai");
    		editor.getSession().setMode("ace/mode/c_cpp");
    		$('#syntax').change(function(){
    			var val = $("#syntax option:selected").val();
    			editor.getSession().setMode("ace/mode/"+val);
    		});
    		function changeColor(){
    			var el = document.getElementById("anonymous");
    			console.log(document.getElementById("checkAn").checked);
    			if(document.getElementById("checkAn").checked){
    				el.style.backgroundColor = "green";
    			}
    			else{
    				el.style.backgroundColor = "#444";
    			}
    		}
    		function changeColorPr(){
    			var el = document.getElementById("private");
    			console.log(document.getElementById("checkPr").checked);
    			if(document.getElementById("checkPr").checked){
    				el.style.backgroundColor = "green";
    			}
    			else{
    				el.style.backgroundColor = "#444";
    			}
    		}

    		$('#Create').click(function(){
    			var snipp = editor.getValue();
    			var lang = $("#syntax").val();
    			var anonymous;
    			if($("#checkAn").is(":checked")){
    				anonymous = 1;
    			}
    			else{
    				anonymous = 0;
    			}
    			var privacy;
    			if($("#checkPr").is(":checked")){
    				privacy = 1;
    			}
    			else{
    				privacy = 0;
    			}
    			var expiration = $("#Exp").val();
    			$.ajax({
    				type: 'POST',
    				url: 'uploadSnipp.php',
    				data: {snipp: snipp,lang: lang,anony: anonymous,privacy: privacy,expiration: expiration},
    				success: function(responseText){
    					console.log(responseText);
    				}
    			});
    		});

    		function signOut(){
    			$.ajax({
    				type: 'POST',
    				url: 'signOut.php',
    				success: function(){
    					window.location = '..';
    					
    				}
    			});
    		}
		</script>
	</body>
</html>