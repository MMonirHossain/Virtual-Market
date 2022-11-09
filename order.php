
<!DOCTYPE html>

<?php

if(!isset($_REQUEST['ID'])){
    header('location:index.php');
}

$shopid=$_REQUEST['ID'];
$keyword=$_REQUEST['key'];

 $con=mysqli_connect("localhost","root","","test");
 $result=mysqli_query($con,"SELECT fullname, shopname, address FROM shops where username='$shopid' ");
 $row=mysqli_fetch_array($result);

?>

<html lang="en">
<head>
    <link href="order.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
            <h1><?php echo $row['shopname'];?></h1>
            <h2>Owner: <?php echo $row['fullname'];?></h2>
            <h2>Address: <?php echo $row['address'];?></h2>
            <div class="editproduct">
                    <table>
                        <tr>
                            <th>SL no</th>                    
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Order</th>                    
                        </tr>

                        <!--This code for create view of the products-->
                        <?php
                            $con=mysqli_connect("localhost","root","","test");
                            $result=mysqli_query($con,"SELECT * FROM `products` where username='$shopid' and pro_name LIKE '%$keyword%' ");
                            $Sl=1;
                            while($row=mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $Sl++;?></td>
                            <td><?php echo $row['pro_name'];?></td>
                            <td><?php echo $row['pro_price'];?></td>
                            <td><?php echo $row['pro_dec'];?></td>
                            <td><img src="Shopkey/dashboard/<?php echo $row['pro_img'];?>" width="100px" height="100px"/></td>

                            <!--
							<td><a href="buynow.php?ID=<?php echo $row['id'];?>&user=<?php echo $shopid;?>" >Buy Now</a></td>
							-->
                            <td><a href="buy.php?ID=<?php echo $row['id'];?>&user=<?php echo $shopid;?>" >Buy Now</a></td>
                            
                            

                        </tr>
                        <?php }
                        mysqli_close($con);
                        ?>
                    </table>
            </center>
</div>



    
</body>
</html>