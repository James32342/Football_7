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
$position=$_POST['position'];
$clubfrom= $_POST['clubfrom'];
$clubto = $_POST['clubto'];
$transferfee = $_POST['transferfee'];
$wage= $_POST['wage'];

if(!empty($id)){
    $query = mysqli_query($conn, "UPDATE transfers 
    SET name='$name', age='$age', position='$position', clubfrom='$clubfrom', clubto='$clubto', transferfee='$transferfee', wage='$wage' 
    WHERE id='$id'");


}else{
    $query = mysqli_query($conn, "INSERT INTO transfers(name, age,position,clubfrom,clubto ,transferfee,wage)
    VALUES('$name', '$age', '$position', '$clubfrom', '$clubto','$transferfee', '$wage')");

}


// Show alert and redirect
if ($query) {
    echo "<script>alert('Data inserted successfully!'); window.location='transfers.html';</script>";
} else {
    die("Error: " . mysqli_error($conn));
}
?>
