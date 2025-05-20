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
$type = $_POST['type'];
$association = $_POST['association'];

$currentholders = $_POST['currentholders'];
$venue = $_POST['venue'];

if(!empty($id)){
    $query = mysqli_query($conn, "UPDATE trophy set name='$name', type='$type', association='$association',currentholders='$currentholders',venue='$venue' WHERE id='$id'");
  


}else{

    $query = mysqli_query($conn, "INSERT INTO trophy(name, type, association,currentholders,venue)
    VALUES('$name', '$type', '$association', '$currentholders', '$venue')");
}


// Show alert and redirect
if ($query) {
    echo "<script>alert('Data inserted successfully!'); window.location='trophy.html';</script>";
} else {
    die("Error: " . mysqli_error($conn));
}
?>
