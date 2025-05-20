<?php
// Database connection
$servername = "localhost"; // Change this to your server name
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "club"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch deletion logs from the deletion_log table
$sql = "SELECT * FROM deletion_log ORDER BY deleted_at DESC"; // Using 'deleted_at' for ordering
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deletion Logs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add your styles here */
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(84, 84, 115);
            color: #333;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color:rgb(0, 0, 0);
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color:rgb(0, 0, 0);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color:rgb(0, 0, 0);
        }

    </style>
</head>
<body>

    <h1>Deletion Logs</h1>

    <?php
    if ($result->num_rows > 0) {
        // Start table
        echo '<table>';
        echo '<tr><th>ID</th><th>Table</th><th>Deleted Record ID</th><th>Deleted Data</th><th>Deletion Time</th><th>Deleted By</th></tr>';
        
        // Output each log
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>"; // Log ID
            echo "<td>" . $row["table_name"] . "</td>"; // Table name
            echo "<td>" . $row["deleted_record_id"] . "</td>"; // Deleted record ID
            echo "<td>" . $row["deleted_data"] . "</td>"; // Deleted data
            echo "<td>" . $row["deleted_at"] . "</td>"; // Deletion time
            echo "<td>" . $row["deleted_by"] . "</td>"; // User who deleted
            echo "</tr>";
        }

        // End table
        echo '</table>';
    } else {
        echo "<p>No logs found.</p>";
    }

    // Close connection
    $conn->close();
    ?>

    <a href="a.html" class="back-btn">Back to Home</a>

</body>
</html>
