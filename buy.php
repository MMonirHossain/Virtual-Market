<!DOCTYPE html>

<?php



 if(isset($_REQUEST['order']))
            {
                    try{
                        
              
                        if(empty($_REQUEST['address'])){ throw new Exception('Your Delivery location plz..');}   
                        if(empty($_REQUEST['number'])){ throw new Exception('Give a active phone number to reach you');}
                        if(empty($_REQUEST['quant'])){ throw new Exception('Enter your required amount');}
                        
                        /*Initialization of Variable[$]*/

                       
                        
                        $username= $_REQUEST['user'];
                        $Pid=$_REQUEST['ID'];
                        $Pname=$_REQUEST['pname'];
                        $Daddress=$_REQUEST['address'];
                        $Cnumber=$_REQUEST['number'];
                        $Quantity=$_REQUEST['quant'];
                        $Total=$_REQUEST['total'];
                        
                        
                        $con=mysqli_connect("localhost","root","","test");
                        if(!$con){throw new Exception('Cannot Connect to database');}
                        $sql = "INSERT INTO `order` (user_name, p_id, p_name,d_address,c_number, quantity, total )
                                VALUES ('$username',$Pid,'$Pname','$Daddress',$Cnumber,$Quantity, $Total)";

                        if(mysqli_query($con,$sql)){
							
							echo ("<script LANGUAGE='JavaScript'>  window.alert('Order placed successfully');    window.location.href='index.php';  </script>");
                            
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

        if( (isset($_REQUEST['ID']) && isset($_REQUEST['user'])) ||isset($_REQUEST['order']) )
        {
            $product_id=$_REQUEST['ID'];
            $shop_id=$_REQUEST['user'];

            


            $con=mysqli_connect("localhost","root","","test");
            $result=mysqli_query($con,"SELECT * FROM `products` where username='$shop_id' and id='$product_id' ");

            $row=mysqli_fetch_array($result);

        }
        else{

            header('location:index.php');
        }
?>

<html lang="en">
	<meta charset="utf-8">
    <title>Buy Now</title>
    <head>
    <link rel="stylesheet" href="buy.css"type="text/css">
	
	<script>
			
			
            function mult(value){
                var x,y,z,total;
                y=document.getElementById('u_price').value;
                z=document.getElementById('d_charge').value;
                x=y*value;
                total=x-(-z);
                document.getElementById('s_total').value = x;
                document.getElementById('total').value = total;
            }
    </script>
	
	
    </head>
    <body>
        <center>
        <div class="center">
            <div class="container">  
                <div class="text"><h2>Order Form</h2></div>

                    <form action="buy.php?ID=<?php echo $product_id;?>&user=<?php echo $shop_id;?>" method="post" enctype="multipart/form-data">

                        <div class="data">
                            <label>Product ID</label>
                            <input type="text" id="pid" name="pid" value=<?php echo $row['id'];?> readonly>
                        </div>

                        <div class="data">
                            <label>Product name</label>
                            <input type="text" id="pname" name="pname" value=<?php echo $row['pro_name'];?> readonly>
                        </div>
                        <div class="data">
                            <label>Delivery Address</label>
                            <input type="text" name="address"> 
                        </div>
                        <div class="data">
                            <label>Contact Number</label>
                            <input type="text" name="number">
                        </div>
                        <div class="data">
                            <label>Unit Price</label>
                            <input type="text"  id="u_price" value=<?php echo $row['pro_price'];?> readonly>
                        </div>
                        <div class="data">
                            <label>Quantity</label>
                            <input type="text" name="quant" onkeyup="mult(this.value)">
                        </div>
                        <div class="data">
                            <label>Subtotal</label>
                            <input type="text" id="s_total" readonly>
                        </div>
                        
                        <div class="data">
                            <label>Delivery Charge</label>
                            <input type="text" id="d_charge" value=100 readonly>
                        </div>
                        <div class="data">
                            <label>Total</label>
                            <input type="text" name="total" id="total" value="" >
                        </div>
                        
						<div class="data">
							<p style="color:red;">
								<?php if(isset($error_message)){echo $error_message;} ?>
									
							</p>
						</div>
					
                        <div class="btn">
                            
                            <button name="order" type="submit">Check Out</button>
                        </div>
                    </form>
            </center>                
    </body>
</html>