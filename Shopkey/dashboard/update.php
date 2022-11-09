<!DOCTYPE html>

<?php 
ob_start();
session_start();
$user=$_SESSION['name'];
if($user==''){
header('location:../');
}
	
	if(isset($_REQUEST['imagesubmit']))
                    {
                    try{
                        
                        if(empty($_REQUEST['pname'])){ throw new Exception('Name Cannot be empty');}               

                        if(empty($_REQUEST['pprice'])){ throw new Exception('Price Must!');}
                        if(empty($_REQUEST['pdes'])){ throw new Exception('Give Description to help connsumers!');}
                           
                        /*Initialization of Variable[$]*/
                        $Pname=$_REQUEST['pname'];
                        $Pprice=$_REQUEST['pprice'];
                        $Pdes=$_REQUEST['pdes']; 
						$Id=$_REQUEST['ID'];

                        $con=mysqli_connect("localhost","root","","test");
                        if(!$con){throw new Exception('Cannot Connect to database');}
                        $sql = "update products set pro_name='$Pname', pro_price='$Pprice',pro_dec='$Pdes' where id='$Id' ";
								
							

                        if(mysqli_query($con,$sql)){
                            throw new Exception("Product Updated Successfully!");
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
	
    if(isset($_REQUEST['ID'])){
		$con=mysqli_connect("localhost","root","","test");
        $result=mysqli_query($con,"SELECT * FROM `products` where id='$_REQUEST[ID]' ");
        $row=mysqli_fetch_array($result);
	}

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


            <div class="editproduct addproduct">
			
                        <h2>Edit product</h2>
                        <form action="update.php"  method="post" enctype="multipart/form-data">
							<input type="hidden" name="ID" value="<?php echo $_REQUEST['ID'];?>"><br>
                            <label for=""class="addp">Name of product</label><br>
	
                            <input type="text" class="box" name="pname" id="name" value="<?php echo $row['pro_name'];?>">
                            <br><br>
                            <label for=""class="addp">Price</label><br>

                            <input type="text" class="box" name="pprice" id="name" value="<?php echo $row['pro_price'];?>">
                            <br><br>
                            <label for=""class="addp">Description</label><br>

                            <textarea type="text" name="pdes" id="name" maxlength="200" ><?php echo $row['pro_dec'];?> </textarea>
                            <br><br>
                            <label for=""class="addp">Image</label>
							<img src="<?php echo $row['pro_img'];?>" width="100px" height="100px"/>

                            <input type="file" class="" id="image" name="pimg">
                            <br><br>

                                <label style="color:red;">
                                    <?php if(isset($error_message)){echo $error_message;} ?>
                                        
                                </label>
                            <br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" class="box" id="submit" name="imagesubmit" value="UPDATE" >
                        </form>
				
						
				<?php 
                mysqli_close($con);
                ?>
				
                </div>
          </div>
    </body>

</html>


