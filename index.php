<?php
// Database credentials
$hostname = getenv("MYSQL_HOST");
$username = getenv("MYSQL_USER');
$password = getenv("MYSQL_PASSWORD');
$dbname = getenv("MYSQL_DBNAME');

// Connect to the database
$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}

// Fetch data from the "student" table
$sql = "SELECT * FROM compute";
$result = $conn->query($sql);
$row = [];

// Store the fetched data in an associative array
if ($result->num_rows > 0) {
    $row = $result->fetch_all(MYSQLI_ASSOC);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        td, th {
            border: 1px solid black;
            padding: 10px;
            margin: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>timestamp</th>
                <th>namespace</th>
                <th>pod</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($row)) {
                foreach ($row as $rows) {
                    echo "<tr>";
                    echo "<td>" . $rows['timestamp'] . "</td>";
                    echo "<td>" . $rows['namespace'] . "</td>";
                    echo "<td>" . $rows['pod'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
