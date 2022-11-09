<!DOCTYPE html>
<html lang="en">
<head>
  <title>BOT-TOLA</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link href="responce.css" rel="stylesheet" type="text/css">
  
  <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
  <script>


navigator.geolocation.getCurrentPosition(myFunction);

function myFunction(position) {
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
  }
  myFunction();
</script>
</head>
<body>

  <div class="main_header" id="head">
    <div class="site_info">
      
          <div class="header_image">
              <a href="index.php"><img src="image/logo.png"></a>
          </div>

          <div class="header_text">
              <h1>BOT-TOLA</h1>
              <h2>Find Your Needs</h2>          
          </div>
      
    </div>
    <!--
    <div class="search">
      
    </div>
    -->
    <div class="header_register">

      <a href="Shopkey/">MY SHOP</a>
      <a href="Shopkey/createshop.php">ADD NEW</a>
    </div>
    
  </div>

<!--main part start-->

<div class="landingpage_body">
  <form action="index1.php" method="get">
	<input type="hidden" id="slider" name="rng" value="1" ><br>
    <input type="hidden" id="latitude" name="lati" ><br>
    <input type="hidden" id="longitude" name="lngi" ><br>
    <input type="text" name="search_query" placeholder="search">
    <input type="submit" value="search">
  </form>
  <p>Search for what you are looking for puchase...</p>

</div>

<!--main part end-->


  <div class="footer_border">
    <div class="footer_menu">
      <a href="#">About us</a>
      <a href="#">Contact</a>
      <a href="#">Terms and Services</a>
      <a href="#">Advertizement</a>
    </div>
    <p>&copy;All right reserved by Team Third EYE from DUET</p>
  </div>  



<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

-->
</body>
</html>