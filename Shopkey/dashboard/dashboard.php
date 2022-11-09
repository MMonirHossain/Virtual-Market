<!DOCTYPE html>
<?php include 'header.php';?>
<?php include 'sidebar.php';?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    
</body>
</html>

    
<div class="container py-5">
    <div class="row mt-4">
    <?php 
            $dbhost='localhost';
            $dbuser='root';
            $dbpass='';
            $dbname='testn';
            $con=mysqli_connect("localhost","root","","test");
            $query = "SELECT * FROM addoffer";
            $query_run = mysqli_query($con,$query);
            $check_offer = mysqli_fetch_assoc($query_run);

            if ($check_offer)
            {
                while($row = mysqli_fetch_assoc($query_run))
                {
                    ?>
                        <div class="col-md-3">
                            <div class="card">
                            <img  src="<?php echo $row ['pro_image']; ?>" class="card-img-top" ;height="200px" width="200px" alt="Product">
                                <div class="card-body">
                                    
                                    <h2 class="card-title"><?php echo $row ['pro_name'];?></h2>
                                    <p class= "card-text">
                                         <p>Old Price : <?php echo $row ['old_price']; echo "<br>" ?></p>
                                         <p>New Price :<?php echo $row ['new_price']; echo "<br>"?> </p>
                                         <p>Description : <?php echo $row ['pro_dec'];?></p>

                                    </p>
                                </div>
                            </div>    
                        </div>

                    <?php
                    
                }


            }
            else{
                echo "Offer not found ";
            }
        ?>
      
    </div>


</div>


