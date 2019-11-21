<?php
$host = getenv('IP');
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'world';

if($_SERVER['REQUEST_METHOD'] === 'GET' ){
  if(isset($_GET['country']) or !empty($_GET['country'])){
    $country = $_GET['country'];
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach($results as $row) {
      echo "<li>" .  $row['name'] . ' is ruled by ' . $row['head_of_state'] . "</li>";
    }
    echo "</ul>";

  }
}




