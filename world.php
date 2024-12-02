<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country name from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Prepare and execute the SQL query with a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
$stmt->execute(['country' => "%$country%"]);


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>World Database Lookup</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Results for "<?php echo htmlspecialchars($country); ?>"</h1>
    <table>
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['continent']); ?></td>
                    <td><?= htmlspecialchars($row['independence_year']); ?></td>
                    <td><?= htmlspecialchars($row['head_of_state']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

