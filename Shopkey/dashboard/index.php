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
    $queryimg=mysqli_query($con,"select pro_img from products where id='$_REQUEST[ID]'");
    $row1=mysqli_fetch_array($queryimg);
    $imagename=$row1['pro_img'];
    unlink($imagename);
    mysqli_query($con,"delete from products where id='$_REQUEST[ID]'");
    
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
                    <th>SL no</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <!--This code for create view of the products-->
                <?php
                    $con=mysqli_connect("localhost","root","","test");
                    $result=mysqli_query($con,"SELECT * FROM `products` where username='$user' ");
                    $Sl=1;
                    while($row=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $Sl++;?></td>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['pro_name'];?></td>
                    <td><?php echo $row['pro_price'];?></td>
                    <td><?php echo $row['pro_dec'];?></td>
                    <td><img src="<?php echo $row['pro_img'];?>" width="100px" height="100px"/></td>

                    <td><a href="update.php?ID= <?php echo $row['id'];?> ">Edit </a></td>
                    <td><a href="index.php? ID=<?php echo $row['id'];?>       ">Delete</a></td>

                </tr>
                <?php }
                mysqli_close($con);
                ?>
            </table>


            </div>
          </div>
    </body>

</html>