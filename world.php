<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Establish a database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country name from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Prepare and execute the SQL query with a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->execute(['country' => "%$country%"]);

// Fetch all matching records
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>World Database Lookup</title>
</head>
<body>
    <h1>Results for "<?php echo htmlspecialchars($country); ?>"</h1>
    <ul>
    <?php foreach ($results as $row): ?>
        <li><?= htmlspecialchars($row['name']) . ' is ruled by ' . htmlspecialchars($row['head_of_state']); ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>

