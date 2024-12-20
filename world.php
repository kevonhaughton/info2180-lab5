<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country name and lookup type from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookupType = isset($_GET['lookup']) ? $_GET['lookup'] : 'country';

if ($lookupType == 'cities') {
    // Query for cities in the specified country
    $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);

    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output results in an HTML table
    echo "<table>";
    echo "<thead><tr><th>City Name</th><th>District</th><th>Population</th></tr></thead><tbody>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['district']) . "</td>";
        echo "<td>" . htmlspecialchars($row['population']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    // Query for country information
    $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);

    // Fetch all matching records
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output results in an HTML table
    echo "<table>";
    echo "<thead><tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr></thead><tbody>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
        echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
        echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

