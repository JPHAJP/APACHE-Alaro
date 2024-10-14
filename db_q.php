<?php
// Database connection parameters from environment variables
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

// Create a connection
$mysqli = new mysqli($host, $user, $password, $dbname, $port);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully<br>";

// If a query is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $_POST['query'];
    
    // Basic security measure: Escape special characters in the query
    $safe_query = $mysqli->real_escape_string($query);

    // Execute the query
    if ($result = $mysqli->query($safe_query)) {
        // Check if the query returned results
        if ($result->num_rows > 0) {
            echo "<table border='1'><tr>";
            // Fetch and display column headers
            $fields = $result->fetch_fields();
            foreach ($fields as $field) {
                echo "<th>{$field->name}</th>";
            }
            echo "</tr>";
            // Fetch and display rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $column) {
                    echo "<td>$column</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Query executed successfully, no results to display.";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>

<!-- HTML form for query input -->
<form method="post">
    <textarea name="query" rows="4" cols="50" placeholder="Enter your SQL query here"></textarea><br>
    <input type="submit" value="Execute Query">
</form>