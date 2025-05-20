<?php
include "connect.php";

if(isset($_POST['d'])){
    mysqli_query($conn,"DELETE from players ORDER BY id DESC LIMIT 1");

    header("Location: playersdispl.php"); 
    exit;
}
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id'];   
    $name = $_POST['name'];
    $age = $_POST['age'];
    $position=$_POST['position'];
    $club= $_POST['club'];
    $nationality = $_POST['nationality'];
    $transfervalue = $_POST['transfervalue'];
    

    mysqli_query($conn, "UPDATE players SET name='$name', age='$age', position='$position', club='$club', nationality='$nationality', transfervalue='$transfervalue' WHERE id=$id");

    header("Location: playersdispl.php");
    exit;
} 



$result = mysqli_query($conn, "SELECT * FROM players ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>PLAYERS</title>
    <style>
body {
    background:black;
    color: #333;
    font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h2 {
    font-size: 38px;
    text-align: center;
    color: #4a90e2;
    margin-bottom: 40px;
    letter-spacing: 1.5px;
    font-weight: 700;
}
.club-container {
    display: flex;
    flex-wrap: wrap; /* <-- This is the fix */
    gap: 25px;
    width: 100%;
    padding: 10px;
    justify-content: center;
}



.club-card {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 18px;
    height: 280px;
    width: 250px;
    padding: 20px;
    transition: all 0.4s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
}

.club-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
}

.club-card p {
    margin: 12px 0;
    font-size: 17px;
    line-height: 1.6;
    color: #555;
    font-weight: bold;
}

strong {
    color: #4a90e2;
    font-weight: 600;
}

.update-btn {
    position: absolute;
    bottom: 20px;
    right: 20px;
    padding: 10px 18px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.update-btn:hover {
    background-color: #357ABD;
    transform: scale(1.05);
}

.del {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 28px;
    background: #ff6b6b;
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
}

.del:hover {
    background: #ff4757;
    transform: scale(1.05);
}
.home-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    padding: 12px 28px;
    background: #4a90e2;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 15px rgba(74, 144, 226, 0.4);
    z-index: 1000;
}

.home-btn:hover {
    background: #357ABD;
    transform: scale(1.05);
}



    </style>
</head>
<a href="a.html" class="home-btn">Home</a>

<body>

<h2>PLAYER</h2>

<div class="club-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="club-card">
            
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Age:</strong> <?= htmlspecialchars($row['age']) ?></p>
            
            <p><strong>Position:</strong> <?= htmlspecialchars($row['position']) ?></p>
            <p><strong>Club:</strong> <?= htmlspecialchars($row['club']) ?></p>
            <p><strong>Nationality:</strong> <?= htmlspecialchars($row['nationality']) ?></p>
            <p><strong>Transfer Value:</strong> <?= htmlspecialchars($row['transfervalue']) ?></p>
         

            
            <form action="players.html" method="GET">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <input type="hidden" name="name" value="<?= $row['name'] ?>">
  <input type="hidden" name="age" value="<?= $row['age'] ?>">
  <input type="hidden" name="position" value="<?= $row['position'] ?>">
  <input type="hidden" name="club" value="<?= $row['club'] ?>">
  <input type="hidden" name="nationality" value="<?= $row['nationality'] ?>">
  <input type="hidden" name="transfervalue" value="<?= $row['transfervalue'] ?>">
  <button type="submit" class="update-btn">Update</button>
</form>


        </div>
    <?php } ?>
</div>

<form action="playersdispl.php" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit" class="del" name="d">DELETE</button>
</form>


</body>
</html>
