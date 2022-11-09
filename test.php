

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<script type="text/javascript">
	
        
	
</script>


<?php
// Get parameters from URL
$keyword=$_REQUEST['search_query'];
$data=$_REQUEST['dat'];
$center_lat =24.0186;
$center_lng = 90.4185;
$radius = 1;

echo $keyword." ".$data;

$con=mysqli_connect("localhost","root","","test");


$query = "SELECT p.username as name, s.latitude as lat, s.longitude as lng,
(3959*acos(cos(radians('$center_lat'))*cos(radians(s.latitude))*cos(radians(s.longitude)-radians('$center_lng'))+sin(radians('$center_lat'))*sin(radians( s.latitude) ) ) ) AS distance 

FROM products p 
INNER JOIN shops s 
ON p.username = s.username
WHERE p.pro_name LIKE '$keyword'
HAVING distance < '$radius' 
ORDER BY distance 
LIMIT 0 , 20";

$result = mysqli_query($con,$query);
//$arr=  array();

$latitudes=  array();
$longitudes= array();
$usernames=array();
$cnt=-1;


while($row=mysqli_fetch_array($result)){
  

	//$str= "{coords:{lat:". $row['lat']. ",lng:". $row['lng']. "},content:'<a>". $row['name']."</a>'}";
	//echo $str."<br>";
	//array_push($arr, $str);
	 array_push($latitudes, $row['lat']);
  array_push($longitudes, $row['lng']);
 array_push($usernames, $row['name']);
 $cnt++;
	
}
echo $cnt.'<br>';

while($cnt>=0){
	echo $cnt.'== '.$latitudes[$cnt].' '.$longitudes[$cnt].' '.$usernames[$cnt--]."<br>";
}


?>

<script>

var markers =   <?php echo json_encode($arr); ?>;
  

 document.writeln(markers.length);   
// Display the array elements
for(var i = 0; i < markers.length; i++){
    document.write(markers[i]);
}
</script>

</body>
</html>
