<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$country = strip_tags($_GET["country"]);
$cities="";
if (isset($_GET["Lookup"]))
$cities = strip_tags($_GET["Lookup"]);

if ($country!= NULL && $cities==Null){
  $answer1 = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $result1 = $answer1->fetchAll(PDO::FETCH_ASSOC);
  echo "<table>";
     echo "<tr>";
     echo "<th> Name </th>";
     echo "<th> Continent </th>";
     echo "<th> Independence </th>";
     echo "<th> Head of State </th>";
     echo "</tr>";
  foreach ($result1 as $r1){
     echo "<tr>";
     echo "<td>".$r1['name']."</td>";
     echo "<td>".$r1['continent']."</td>";
     echo "<td>".$r1['independence_year']."</td>";
     echo "<td>".$r1['head_of_state']."</td>";
     echo "</tr>";
     
     }
     echo "</table>";
}

else if ($country!= NULL && $cities!= NULL){
  $answer2 = $conn->query("SELECT c.name, c.district, c.population FROM cities c JOIN countries cs ON c.country_code  = cs.code And cs.name ='$country'");
    
  $result2 = $answer2->fetchAll(PDO::FETCH_ASSOC);
  if ($result2==NULL)
    echo "<h3> Enter the complete name of the country whose cities you want to look up.</h3>";
  else {
  echo "<table>";
  echo "<tr>";
  echo "<th> Name </th>";
  echo "<th> District </th>";
  echo "<th> Population </th>";
  echo "</tr>";
  foreach ($result2 as $r2){
     echo "<tr>";
     echo "<td>".$r2['name']."</td>";
     echo "<td>".$r2['district']."</td>";
     echo "<td>".$r2['population']."</td>";
     echo "</tr>";
     }
     echo "</table>";
  }
}
?>
<ul>
<?php if ($country==NULL)
    foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
