<?php
$conn = new mysqli("localhost", "root", "", "club");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM players");

echo "
<style>
    body {
        background-color: #0d1117;
        font-family: Arial, sans-serif;
        color: white;
        padding: 20px;
    }
    table {
        border-collapse: collapse;
        width: 90%;
        margin: auto;
    }
    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #444;
    }
    th {
        background-color: #21262d;
    }
    tr:nth-child(even) {
        background-color: #161b22;
    }
    tr:nth-child(odd) {
        background-color: #1f242d;
    }
    h2 {
        text-align: center;
    }
</style>
";

echo "<h2>Players List</h2>";
echo "<table>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Transfer Value</th>
        <th>Club</th>
        <th>Position</th>
        <th>Nationality</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['age']}</td>
            <td>{$row['transfervalue']}</td>
            <td>{$row['club']}</td>
            <td>{$row['position']}</td>
            <td>{$row['nationality']}</td>
          </tr>";
}

echo "</table>";

$conn->close();
?>
