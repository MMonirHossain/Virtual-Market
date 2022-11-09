<!DOCTYPE html>

<?php 
ob_start();
session_start();
$user=$_SESSION['name'];
if($user==''){
header('location:../');
}

    if(isset($_REQUEST['ID'])){
    $con=mysqli_connect("localhost","root","","test");
    if(!$con)echo "Database not connected";
    $query=" DELETE FROM `order` WHERE order_id= '$_REQUEST[ID]'";
    
    mysqli_query($con,$query);
    
    mysqli_close($con);
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


            <div class="editproduct">
            <table>
                        <tr>
                            <th>Order ID</th>                    
                            <th>Product ID</th>
                            <th>Product name</th>
                            <th>Delivary Address</th>
                            <th>Contact</th>
                            <th>Quantity</th>
                            <th>Total</th>  
                            <th>Deliverd</th>  

                        </tr>

                       
                    <?php
                       

                        $con=mysqli_connect("localhost","root","","test");
                        $result=mysqli_query($con,"SELECT * FROM `order` where user_name='$user' ");
                        while( $row=mysqli_fetch_array($result) ){
                    ?>
                    <tr>
                        <td><?php echo $row['order_id'];?></td>
                        <td><?php echo $row['p_id'];?></td>
                        <td><?php echo $row['p_name'];?></td>
                        <td><?php echo $row['d_address'];?></td>
                        <td><?php echo $row['c_number'];?></td>
                        <td><?php echo $row['quantity'];?></td>
                        <td><?php echo $row['total'];?></td>
                        <td><a href="orders.php?ID=<?php echo $row['order_id'];?>">Delete</a></td>
                        

                    </tr>
                    <?php }
                    mysqli_close($con);
                    ?>
                        
                    </table>


            </div>
          </div>
    </body>

</html>


