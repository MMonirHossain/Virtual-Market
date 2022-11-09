


<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to grouchary shop</title>
        <link rel="stylesheet" href="sidebar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
    </head>
    <body>
        <div class="sidebar">
                <center>
                    <img src="index.jpg" class="profile_img" alt="">
                    <h4><?php echo $user;?></h4> 
                </center>
                <a href="index.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
                <a href="addproduct.php"><i class="fas fa-pastafarianism"></i><span>Add Product</span></a>
                <a href="addoffer.php"><i class="fas fa-tag"></i><span>Add Offer</span></a>
                <a href="editoffer.php"><i class="fas fa-tag"></i><span>Edit Offer</span></a>
                <a href="setting.php"><i class="fas fa-user-cog"></i><span>Settings</span></a>
        </div>
    </body>
</html>