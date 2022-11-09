<!DOCTYPE html>

		<?php
					if(isset($_REQUEST['form']))
					{
					try{
						/*Valition of the form*/





						if(empty($_REQUEST['fullName'])){ throw new Exception('Name Cannot be empty');}
						

						if(empty($_REQUEST['nidNo'])){ throw new Exception('NID/PASSPORT No must');}
						

						if(empty($_FILES['nidPhoto']['name'])){throw new Exception('Select NID/Passport image');}
						$filesize=filesize($_FILES['nidPhoto']['tmp_name'])*.0009765625*.0009765625;
						if($filesize > 2){throw new Exception('NID/Password Photo cannot be Over 2MB');}
						$image=$_FILES['nidPhoto']['name'];
						$ext1=substr($image,strripos($image,'.'));
						if($ext1!='.png'&& $ext1!='.jpg' && $ext1!='.JPG' && $ext1!='.PNG'){throw new Exception('Please select a valid image file');}												
						



						if(empty($_REQUEST['shopName'])){ throw new Exception('Enter your Shopname');}
						
						if(empty($_REQUEST['licenceNo'])){ throw new Exception('Enter your licence no');}
						

						if(empty($_FILES['licencePhoto']['name'])){throw new Exception('Select Licence image');}
						$filesize=filesize($_FILES['licencePhoto']['tmp_name'])*.0009765625*.0009765625;
						if($filesize > 2){throw new Exception('Licence Photo cannot be Over 2MB');}
						$image=$_FILES['licencePhoto']['name'];
						$ext2=substr($image,strripos($image,'.'));
						if($ext2!='.png'&& $ext2!='.jpg' && $ext2!='.JPG' && $ext2!='.PNG'){throw new Exception('Please select a valid image file');}												
						



					if(empty($_REQUEST['latitude']) || $_REQUEST['latitude']==0){ throw new Exception('Latitude cannot be empty!');}
					if(empty($_REQUEST['longitude']) ||$_REQUEST['longitude']==0){ throw new Exception('Longitude cannot be empty!');}

						if(empty($_REQUEST['Address'])){ throw new Exception('Enter Address');}
						


						if(empty($_REQUEST['Email'])){ throw new Exception('Enter Email');}
						
						if(empty($_REQUEST['passWord'])){ throw new Exception('Enter Password');}
						
						
						/*Initialization of Variable[$]*/
						$Fullname=$_REQUEST['fullName'];
						$Nidno=$_REQUEST['nidNo'];


						$nidimage=$Nidno.$ext1;
						$target1="nidimage/".$nidimage;
						move_uploaded_file($_FILES['nidPhoto']['tmp_name'],$target1);

						$Shopname=$_REQUEST['shopName'];
						$Licenceno=$_REQUEST['licenceNo'];

						$target2="licenceimage/".basename($_FILES['licencePhoto']['name']);
						move_uploaded_file($_FILES['licencePhoto']['tmp_name'],$target2);

						$Latitude=$_REQUEST['latitude'];
						$Longitude=$_REQUEST['longitude'];
						$ADDRESS=$_REQUEST['Address'];
						$EMAIL=$_REQUEST['Email'];
						$Password=$_REQUEST['passWord'];

						
			
						
						$con=mysqli_connect("localhost","root","","test");
						if(!$con){throw new Exception('Cannot Connect to database');}
$sql = "INSERT INTO shops (fullName, nidno, nidphoto,shopname,shoplicenceno,licencephoto,address,latitude,longitude,username,password)
		VALUES ('$Fullname','$Nidno','$target1','$Shopname','$Licenceno','$target2','$ADDRESS','$Latitude','$Longitude','$EMAIL','$Password')";

						if(mysqli_query($con,$sql)){
							throw new Exception("Shop Created Successfully!");
						}
						else{
							throw new Exception("Failed! Try again later!");
							
						}

						
						
						mysqli_close($con);
					}
					catch(Exception $e){
						$error_message=$e->getMessage();
						}
					}

		?>



<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="../style.css" rel="stylesheet" type="text/css">
	<link href="../responce.css" rel="stylesheet" type="text/css">
  
  <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 
</head>

<body>

<div class="createshop">
		<h2>NEW SHOP REGISTRATION FORM</h2>
		<p>Must fill all the fields!</p>
		
			<center>
				<form action="createshop.php" method="POST" enctype="multipart/form-data">

				

				<table>
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="fullName" placeholder="Your Certificate Name" /></td>
						
					</tr>

					<tr>
						<td>Passport/NID No.:</td>
						<td><input type="text" name="nidNo"/></td>
						
					</tr>
					<tr>
						<td>Photo of NID/Passport:</td>
						<td><input type="file" name="nidPhoto"/></td>
					</tr>
					<tr>
						<td>Shop Name:</td>
						<td><input type="text" name="shopName"/></td>
					</tr>
					<tr>
						<td>Shop Licence No.:</td>
						<td><input type="text" name="licenceNo"/></td>
					</tr>
					<tr>
						<td>Licence's Photo:</td>
						<td><input type="file" name="licencePhoto"/></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><input type="text" name="Address"/></td>
					</tr>
					
					<tr>
						<td>Shop Location:</td>
						<td>
							<div class="btn"><p id="status" onclick="getLocation()">SET LOCATION</p></div>
							<p id="show"></p>							
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="hidden" name="latitude" id="lat" value=0 /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="hidden" name="longitude" id="lng" value=0/></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" name="Email"/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="passWord"/></td>
					</tr>
					<tr>
						<td>
							<p style="color:red;">
								<?php if(isset($error_message)){echo $error_message;} ?>
									
							</p>
						</td>
					</tr>

					<tr>
						<td></td>
						<td><div class="btn"><input type="submit" value="MAKE SHOP" name="form"/></div></td>
					</tr>
				</table>

				<div class="home_back"><p><a href="../index.php">Back to Home</a></p></div>
				</form>
			</center>

			<script>
				var x = document.getElementById("show");
				var y=document.getElementById("status");
				

				function getLocation() {
				  if (navigator.geolocation) {
				    navigator.geolocation.getCurrentPosition(showPosition);
				  } else { 
				    x.innerHTML = "Geolocation is not supported by this browser.";
				  }
				}

				function showPosition(position) {
					    var latitude = position.coords.latitude;
						var longitude = position.coords.longitude; 

					
				  x.innerHTML= "Latitude: " + latitude + "<br>Longitude: " + longitude;
				  y.innerHTML= "Completed";

				document.getElementById("lat").value = latitude;
  				document.getElementById("lng").value = longitude;

				}

			</script>


	</div>








<?php require_once("../footer.php"); ?>



