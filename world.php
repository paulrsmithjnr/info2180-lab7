<?php
$host = getenv('IP');
$username = 'lab7_user';
$password = 'My_Password123';
$dbname = 'world';

if($_SERVER['REQUEST_METHOD'] === 'GET' ){
  if((isset($_GET['country']) or !empty($_GET['country'])) and (!isset($_GET['context']) or empty($_GET['context']))){
    $country = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>Country Name</th>";
    echo "<th>Continent</th>";
    echo "<th>Independence Year</th>";
    echo "<th>Head of State</th>";
    echo "</tr>";
    foreach($results as $row) {
      $countryName = $row['name'];
      $continent = $row['continent'];
      $independenceYear = $row['independence_year'];
      $headOfState = $row['head_of_state'];
      echo "<tr>";
      echo "<td>$countryName</td>";
      echo "<td>$continent</td>";
      echo "<td>$independenceYear</td>";
      echo "<td>$headOfState</td>";
      echo "</tr>";
    }
    echo "</table>";

  }
  else if ((isset($_GET['country']) or !empty($_GET['country'])) and (isset($_GET['context']) or !empty($_GET['context']))) {
    $country = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT c.name as city, c.district, c.population, cs.name as country FROM cities c join countries cs on c.country_code = cs.code WHERE cs.name = '$country'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($results)) {
      echo "<table>";
      echo "<tr>";
      echo "<th>City Name</th>";
      echo "<th>District</th>";
      echo "<th>Population</th>";
      echo "</tr>";
      foreach($results as $row) {
        $cityName = $row['city'];
        $district = $row['district'];
        $population = $row['population'];
        echo "<tr>";
        echo "<td>$cityName</td>";
        echo "<td>$district</td>";
        echo "<td>$population</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<h3>No cities found for the country entered!<h3>";
    }

  

  }
}




