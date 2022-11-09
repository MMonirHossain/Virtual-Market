<!DOCTYPE html>
<?php

//$latuitude=(float)$_REQUEST['lati'];

//define("WELCOME", "GeeksforGeeks");
//$latuitude=24.0186;
//$longitude=$_REQUEST['lngi'];
//$longitude=90.4185;

//echo $latuitude." ".$longitude.gettype($latuitude)." ".gettype($longitude)."<br>";



//define("center_lat", 24.0186);
//define("center_lng", 90.4185);
//$center_lat =(float)$_REQUEST['lati'];//floatval($var)
//$center_lng =(float)$_REQUEST['lngi'];
//echo center_lat." ".center_lng." ".gettype(center_lat)." ".gettype(center_lng)."<br>";

$center_lat =$_REQUEST['lati'];
$center_lng =$_REQUEST['lngi'];
$keyword=$_REQUEST['search_query'];
$radius = $_REQUEST['rng'];

$con=mysqli_connect("localhost","root","","test");


$query = "SELECT s.shopname as shpname, p.username as name, s.latitude as lat, s.longitude as lng,
(3959*acos(cos(radians($center_lat))*cos(radians(s.latitude))*cos(radians(s.longitude)-radians($center_lng))+sin(radians($center_lat))*sin(radians( s.latitude) ) ) ) AS distance 

FROM products p 
INNER JOIN shops s 
ON p.username = s.username
WHERE p.pro_name LIKE '%$keyword%'
HAVING distance < $radius 
ORDER BY distance 
LIMIT 0 , 20";



$result = mysqli_query($con,$query);

$latitudes=  array();
$longitudes= array();
$usernames=array();
$shopnames=array();
$cnt=0;

//echo $center_lat." ".$center_lng." ".gettype($center_lat)." ".gettype($center_lng)."<br>";

while($row=mysqli_fetch_array($result)){

  array_push($latitudes, $row['lat']);
  array_push($longitudes, $row['lng']);
 array_push($usernames, $row['name']);
 array_push($shopnames, $row['shpname']);
 $cnt++;
}


?>
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

<style>

input[type="range"]::-webkit-slider-thumb{
-webkit-appearance:none;
background-color:#88B77B;
height:25px;
width:25px;
border-radius:50%;
}

</style>


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
    <div class="header_register ">
      <form action="index1.php" method="get">
	  
		<div class="container" style="color:#ffffff;z-index:5;width:400px;position:absolute;top:50%;left:95%;transform: translate(-50%, -50%) rotate(-90deg);display:flex;align-items:center;justify-content: space-around;padding: 0 15px;">		
		<div id="number" style="height:40px;width:70px;display:flex;align-items:center;justify-content:center;font-family:'Poppins',sans-serif;font-weight:600;font-size:20px;background-color:#88B77B;border-radius: 3px;transform: rotate(90deg);">0</div>
		<p>km</p>
		<input type="range" name="rng" min="0" max="10" value="<?php echo $radius; ?>" id="slider" style="width: 100%; -webkit-appearance: none;height: 0px; position: relative; background-color: #282923; border-radius: 10px; outline: none;">
		</div>
		
	  
      <input type="hidden" id="latitude" name="lati" ><br>
      <input type="hidden" id="longitude" name="lngi" ><br>
      <input type="text" name="search_query" placeholder="search">
      <input type="submit" value="search">
      </form>


      <a href="Shopkey/">MY SHOP</a>
      <a href="Shopkey/createshop.php">ADD NEW</a>
    </div>
    
  </div>


<div class="mainpart" id="map" style="height:540px;"></div>

<div id="de"></div>
<div id="da"></div>


<script>
    
	
	var slider = document.getElementById("slider");
	var output = document.getElementById("number");
	output.innerHTML = slider.value;

	slider.oninput = function() {
	  output.innerHTML = this.value;
	}

	
     function initMap(){

        Latitude = <?php echo $center_lat;?>;
        Longitude = <?php echo $center_lng;?>;

        var options = {
          zoom:15,
          center:{lat:Latitude,lng:Longitude}
        }

        // New map
        var map = new google.maps.Map(document.getElementById('map'), options);
		
		new google.maps.Marker({position:{lat:Latitude,lng:Longitude},map:map, icon:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png' });
        // Map options
        // Listen for click on map
        //google.maps.event.addListener(map, 'click', function(event){
          // Add marker
        //  addMarker({coords:event.latLng});
        //});

        /*
        // Add marker
        var marker = new google.maps.Marker({
          position:{lat:42.4668,lng:-70.9495},
          map:map,
          icon:'home_black_24dp.svg'
        });

        var infoWindow = new google.maps.InfoWindow({
          content:'<h1>Lynn MA</h1>'
        });

        marker.addListener('click', function(){
          infoWindow.open(map, marker);
        });
        */

		
		var sz = <?php echo $cnt;?>;
		
		
		var keyWd="<?php echo $keyword;?>" ;
		
		var latArray =  <?php echo json_encode($latitudes); ?>;
		var lonArray =  <?php echo json_encode($longitudes); ?>;
		var userArray =  <?php echo json_encode($usernames); ?>;
		var shopArray =  <?php echo json_encode($shopnames); ?>;
		
		
		if(sz==0){alert("No available shop for this product");}
		
		for(var i = 0;i <sz;i++){	
			
          //addMarker( {coords:{lat:latArray[i].toString(),lng:lonArray[i].toString()},content:'<a href="order.php?ID=' + userArray[i] + '&key=' + keyWd + '">'+userArray[i] +'</a>'} );
          addMarker( {coords:{lat:Number(latArray[i]),lng:Number(lonArray[i])},content:'<a href="order.php?ID=' + userArray[i] + '&key=' + keyWd + '">'+shopArray[i] +'</a>'} );
		  
		}
         


        // Add Marker Function
          function addMarker(props){
              var marker = new google.maps.Marker({ position:props.coords, map:map });

              

              // Check content
              if(props.content){ 
                var infoWindow = new google.maps.InfoWindow( { content:props.content } );

                marker.addListener('click', function(){ infoWindow.open(map, marker);});
              }
          }
          
    

    }
</script>






<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBO3g0q8m_TPIDGZMxv4GR9x-0Q9CI1TU&callback=initMap">
</script>




<?php require_once("footer.php"); ?>
