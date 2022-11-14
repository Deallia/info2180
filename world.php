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

if ($country!== NULL){
  $answer = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $result = $answer->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $r){
     echo "<table>";
     echo "<tr>";
     echo "<th> Name </th>";
     echo "<th> Continent </th>";
     echo "<th> Independence </th>";
     echo "<th> Head of State </th>";
     echo "</tr>";
     echo "<tr>";
     echo "<td>".$r['name']."</td>";
     echo "<td>".$r['continent']."</td>";
     echo "<td>".$r['independence_year']."</td>";
     echo "<td>".$r['head_of_state']."</td>";
     echo "</tr>";
     echo "</table>";
     }
}
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
