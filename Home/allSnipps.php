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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="shortcut icon" href="../resources/seo-web-code-icon.png" type="image/png" />
		<title>Public Snipps</title>
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
			table{
				position: relative;
				top: 90px;
			}
			table { color: #333;
   					font-family: Helvetica, Arial, sans-serif; 
    				width: 900px; 
    				border-collapse: collapse; 
    				border-spacing: 0; } 
			td, th {  
				border: 1px solid #CCC; 
				height: 30px;
				transition: all 0.3s;
			} 

			th {  
    			background: #DFDFDF; 
    			font-weight: bold; 
			}

			td {  
    			background: #FAFAFA; 
    			text-align: center; 
			}
			tr:nth-child(even) td { background: #F1F1F1; }   
      
			tr:nth-child(odd) td { background: #FEFEFE; }  

			tr td:hover { background: #666; color: #FFF; }  

			#ind{
				cursor: pointer;
			}
		</style>
	</head>
	<body>
		<header>
			<i class="fa fa-code fa-3x"></i>
			<nav>
				<p>Welcome <?php echo $_SESSION["username"] ?></p>
			</nav>
		</header>
		<table id="table">
			<tr>
				<th>Index</th>
				<th>Language</th>
				<th>Expiration</th>
				<th>Author</th>
			</tr>
		</table>
	</body>
	<script>
		$(document).ready(function(){
				$.ajax({
					type: 'POST',
					url: 'loadAllSnipps.php',
					success: function(data){	
						console.log(data);
						var tableData = JSON.parse(data);
						for(var i=0;i<tableData.length;i++){
					
							var th = document.createElement("tr");
								var ind = document.createElement("td");
								var txt = document.createTextNode(tableData[i]["Index"]);
								ind.appendChild(txt);
								ind.setAttribute("onclick","goToSnipp('"+tableData[i]["Index"]+"')");
								ind.setAttribute("id","ind");
								var language = document.createElement("td");
								var txt = document.createTextNode(tableData[i]["Language"]);
								language.appendChild(txt);
								var exp = document.createElement("td");
								var txt = document.createTextNode(tableData[i]["expiration"]);
								exp.appendChild(txt);
								var auth = document.createElement("td");
								var txt = document.createTextNode(tableData[i]["Author"]);
								auth.appendChild(txt);
							th.appendChild(ind);
							th.appendChild(language);	
							th.appendChild(exp);	
							th.appendChild(auth);
							document.getElementById("table").appendChild(th);
						}
					}
				});
			});

			function goToSnipp(data){
				window.location = "../Snipps/"+data;
			}
	</script>
</html>			