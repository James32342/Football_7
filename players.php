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
$age = $_POST['age'];
$transfervalue = $_POST['transfervalue'];
$club = $_POST['club'];
$position = $_POST['position'];
$nationality = $_POST['nationality'];

if(!empty($id)){
    $query = mysqli_query($conn, "UPDATE players SET name='$name', age='$age', transfervalue='$transfervalue', club='$club', position='$position', nationality='$nationality' WHERE id='$id'");
}
else{
    $query = mysqli_query($conn, "INSERT INTO players(name, age, transfervalue, club, position, nationality) VALUES('$name', '$age', '$transfervalue', '$club', '$position', '$nationality')");
}

if($query){
    echo "<script>window.location='players.html';</script>";
}
else{
    // Print the error message directly, which could be helpful for debugging
    die("Error: ".mysqli_error($conn));
}


?>
