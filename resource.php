<?php


// Get parameters from URL
$keyword=$_REQUEST['search_query'];
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = 1;

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a mySQL server
$con=mysqli_connect("localhost","root","","test");


$query = sprintf("SELECT p.username as name, s.latitude as lat, s.longitude as lng,
(3959*acos(cos(radians('%s'))*cos(radians(s.latitude))*cos(radians(s.longitude)-radians('%s'))+sin(radians('%s'))*sin(radians( s.latitude) ) ) ) AS distance 

FROM products p 
INNER JOIN shops s 
ON p.username = s.username
WHERE p.pro_name LIKE '%s'
HAVING distance < '%s' 
ORDER BY distance 
LIMIT 0 , 20",
  mysqli_real_escape_string($center_lat),
  mysqli_real_escape_string($center_lng),
  mysqli_real_escape_string($center_lat),
  mysqli_real_escape_string($keyword),
  mysqli_real_escape_string($radius)
);

$result = mysqli_query($con,$query);




header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("u_name", $row['name']);
  $newnode->setAttribute("Lat", $row['lat']);
  $newnode->setAttribute("Lng", $row['lng']);
  $newnode->setAttribute("Distance", $row['distance']);
}

echo $dom->saveXML();
?>