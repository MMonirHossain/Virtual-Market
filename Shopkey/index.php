
<!--Here will be header
-->
<!DOCTYPE html>
<?php
if(isset($_REQUEST['form'])){
	try{
		if(empty($_REQUEST['userName'])){throw new Exception('Username Cannot be Empty');}
		if(empty($_REQUEST['passWord'])){throw new Exception('Password Cannot be Empty');}

		$user=$_REQUEST['userName'];
		
		//$pass=$_REQUEST['passWord'];
		//$pass=md5($pass);


		include('config.php');

		$statement=$db->prepare("select username,password from shops where username=:Username and password=:Password");
		$statement->bindParam(":Username",$_REQUEST['userName']);
		$statement->bindParam(":Password",$_REQUEST['passWord']);
		$statement->execute();
		$num=$statement->rowCount();

		if($num==1){
				session_start();
				$_SESSION['name']=$user;
				header('location:dashboard/index.php');
				
			}
		else{
			throw new Exception('Username or Password not found!');
			}

	}
	
	catch(Exception $e){
		$error_message= $e->getMessage();
	}

}

?>





<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>


	<div class="login">
		<h2>USER LOGIN</h2>
		
			<form action="index.php" method="POST" enctype="multipart/form-data">
			
				<?php
					if(isset($error_message)){
					echo $error_message;}
				?>
			
				<table>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="userName"/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="passWord"/></td>
						</tr>
					<tr>
						<td></td>
						<td><div class="btn"><input type="submit" value="LOGIN" name="form"/></div></td>
					</tr>
				</table>
				</form>
			<p><a href="#">Forgot password?</a></p>
			<p><a href="../index.php">Back to Home</a></p>
	</div>



<!--here will be footer
-->
</body>
</html>