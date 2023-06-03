<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform a query to fetch data
$sql = "SELECT * FROM video";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch data and store in an array
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    die("No data found");
}

// Convert the array to JSON
$json_data = json_encode($data);

if ($json_data === false) {
    die("JSON encoding failed: " . json_last_error_msg());
}
header('Content-Type: application/json');
echo $json_data;
$conn->close();
?>
