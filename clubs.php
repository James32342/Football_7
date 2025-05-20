<?php
include "connect.php";  


$id = $_POST['id'];      
$name = $_POST['name'];
$pos = $_POST['pos'];
$rec = $_POST['rec'];
$round = $_POST['round'];
$stad = $_POST['stad'];
$sqsize = $_POST['sqsize'];
$manager = $_POST['manager'];

$logo = $_FILES['logo']['name']; 
$tmp_name = $_FILES['logo']['tmp_name']; 



if(!empty($logo)){
    move_uploaded_file($tmp_name, "photos/$logo");  
} else {
   
    $logo_query = mysqli_query($conn, "SELECT logo FROM club WHERE id='$id'");
    $fetch_logo = mysqli_fetch_assoc($logo_query);
    $logo = $fetch_logo['logo'];  
}



if(!empty($id)){
    $query = mysqli_query($conn,"UPDATE club SET name='$name', pos='$pos', rec='$rec', round='$round', stad='$stad', sqsize='$sqsize', manager='$manager', logo='$logo' WHERE id='$id'");
}

else{
    $query = mysqli_query($conn,"INSERT INTO club(name, pos, rec, round, stad, sqsize, manager, logo) VALUES('$name', '$pos', '$rec', '$round', '$stad', '$sqsize', '$manager', '$logo')");
}



if($query){
    echo "<script>window.location='clubs.html';</script>";
}

else{
    die("Error: ".mysqli_error($conn));
}

?>
