<?php
ob_start();
session_start();
$user=$_SESSION['name'];
if($user==''){
header('location:../');
}
?>

<?php
/*
if(isset($_REQUEST['updateshop']))
                    {
                    try{
                        
                        if(empty($_REQUEST['pname'])){ throw new Exception('Name Cannot be empty');}               

                        if(empty($_REQUEST['pprice'])){ throw new Exception('Price Must!');}
                        if(empty($_REQUEST['pdes'])){ throw new Exception('Give Description to help connsumers!');}
                        

                        


                        $con=mysqli_connect("localhost","root","","test");
                        if(!$con){throw new Exception('Cannot Connect to database');}
                        $sql = "INSERT INTO products (username, pro_name, pro_price,pro_dec,pro_img)
                                VALUES ('$user','$Pname','$Pprice','$Pdes','$target')";

                        if(mysqli_query($con,$sql)){
                            throw new Exception("Product Added Successfully!");
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


*/

?>


<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to grouchary shop</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body>
        <input type="checkbox" id="check">
        <!--header area start -->
        <header>
            <label for="check">
                <i class="fas fa-bars" id="sidebar_btn"></i> 
            </label>
            <div class="left_area">
                    <h3>grouchary <span>shop </span></h3>
            </div>
            <div class="right_area">
                <a href="logout.php" class="logout_btn">Logout</a>
            </div>
        </header>

        <!--header area end -->
        <!--sidebar area start -->
        <div class="sidebar">
            <center>
                <img src="index.jpg" class="profile_img" alt="">
                <h4><?php echo $user;?></h4> 
            </center>
            <a href="index.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <a href="addproduct.php"><i class="fas fa-pastafarianism"></i><span>Add Product</span></a>
            <!--
			<a href="addoffer.php"><i class="fas fa-tag"></i><span>Add Offer</span></a>
            <a href="editoffer.php"><i class="fas fa-tag"></i><span>Edif Offer</span></a>
			-->
            <a href="setting.php"><i class="fas fa-user-cog"></i><span>Settings</span></a>
			<a href="orders.php"><i class="fas fa-user-cog"></i><span>Orders</span></a>
        </div>

        

        <div class="mainview" > 
            <div class="main">
                <div class="addproduct">
				
                <h2>Update Profile</h2>
				<form action="setting.php" method="POST" enctype="multipart/form-data">

				

				<table>
					<tr>
						<td>Change Name:</td>
						<td><input type="text" name="fullName" placeholder="" /></td>
						
					</tr>

					<tr>
						<td>Change Passport/NID No.:</td>
						<td><input type="text" name="nidNo"/></td>
						
					</tr>
				
					<tr>
						<td>Change Shop Name:</td>
						<td><input type="text" name="shopName"/></td>
					</tr>

					<tr>
						<td>Change Address:</td>
						<td><input type="text" name="Address"/></td>
					</tr>
					
					<tr>
						<td>Change Email:</td>
						<td><input type="email" name="Email"/></td>
					</tr>
					<tr>
						<td>Change Password:</td>
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
						<td><div class="btn"><input type="submit" value="Update" name="updateshop"/></div></td>
					</tr>
				</table>

				</form>
                </div>
            </div>

          </div>
    </body>

</html>