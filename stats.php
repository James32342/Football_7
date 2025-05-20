<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "club";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from POST
$id = $_POST['id'];   
$name = $_POST['name'];
$matches = $_POST['matches'];
$goals = $_POST['goals'];
$assists = $_POST['assists'];
$clubs = $_POST['clubs'];
$trophieswon = $_POST['trophieswon'];
$redcard = $_POST['redcard'];
if(!empty($id)){
    $query = mysqli_query($conn, "UPDATE statistics SET name='$name', matches='$matches', goals='$goals', assists='$assists',clubs='$clubs', trophieswon='$trophieswon',redcard='$redcard' WHERE id='$id'");

}
else{
    $query = mysqli_query($conn, "INSERT INTO statistics(name, matches, goals, assists, clubs, trophieswon,redcard)
    VALUES('$name', '$matches', '$goals', '$assists', '$clubs', '$trophieswon','$redcard')");
}
if($query){
    echo "<script>window.location='stats.html';</script>";
}
else{
    // Print the error message directly, which could be helpful for debugging
    die("Error: ".mysqli_error($conn));
}

?>
