<?php
include "connect.php";

if(isset($_POST['d'])){
    mysqli_query($conn,"DELETE from transfers ORDER BY id DESC LIMIT 1");
    header("Location: transfersdispl.php"); 
    exit;
}
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id'];   
    $name = $_POST['name'];
    $age = $_POST['age'];
    $position=$_POST['position'];
    $clubfrom= $_POST['clubfrom'];
    $clubto = $_POST['clubto'];
    $transferfee = $_POST['transferfee'];
    $wage= $_POST['wage'];

    mysqli_query($conn, "UPDATE transfers SET name='$name', age='$age', position='$position', clubfrom='$clubfrom', clubto='$clubto', transferfee='$transferfee', wage='$wage' WHERE id=$id");

    header("Location: transfersdispl.php");
    exit;
} 



$result = mysqli_query($conn, "SELECT * FROM transfers ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transfers</title>
    <style>
      body {
    background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
    color: #f8f8f8;
    font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h2 {
    font-size: 40px;
    text-align: center;
    color: #d26cd5; /* Soft Violet Pink */
    margin-bottom: 40px;
    letter-spacing: 2px;
    font-weight: 800;
    text-shadow: 0 0 10px #d26cd5;
}

.club-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    width: 100%;
    max-width: 1400px;
    padding: 20px;
}

.club-card {
    background: #121212;
    border: 2px solid #d26cd5;
    border-radius: 12px;
    width: 280px;
    height: 320px; /* slightly increased height */
    padding: 25px;
    padding-bottom: 60px; /* extra bottom space for the button */
    transition: all 0.4s ease;
    box-shadow: 0 0 15px rgba(210, 108, 213, 0.2);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.update-btn {
    position: absolute;
    bottom: 15px;
    right: 15px;
    padding: 10px 18px;
    background: linear-gradient(45deg, #ff66c4, #d26cd5);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(255, 102, 196, 0.4);
    transition: background 0.3s ease; /* Only animate background on hover */
    transform-origin: bottom right; /* Ensure the scaling happens from the bottom-right corner */
}

.update-btn:hover {
    background: linear-gradient(45deg, #d26cd5, #ff66c4);
    transform: scale(1.05); /* Scale the button on hover */
}


.club-card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(210, 108, 213, 0.5);
}

.club-card p {
    margin: 10px 0;
    font-size: 18px;
    font-weight: 600;
    color: #f5f5f5;
}

strong {
    color: #ff66c4; /* Neon pink for strong emphasis */
    font-weight: 800;
}



.del {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 28px;
    background: linear-gradient(45deg, #ff66c4, #d26cd5);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(255, 102, 196, 0.5);
    transition: background 0.3s ease, transform 0.3s ease;
}

.del:hover {
    background: linear-gradient(45deg, #d26cd5, #ff66c4);
    transform: scale(1.05);
}
.home-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    padding: 12px 28px;
    background: linear-gradient(45deg, #ff66c4, #d26cd5); /* Same gradient as the other buttons */
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(255, 102, 196, 0.5);
    transition: background 0.3s ease, transform 0.3s ease;
    z-index: 1000; /* Ensures the button stays on top of other elements */
}

.home-btn:hover {
    background: linear-gradient(45deg, #d26cd5, #ff66c4); /* Reverse gradient on hover */
    transform: scale(1.05); /* Slight scale effect on hover */
}



    </style>
</head>
<a href="a.html" class="home-btn">HOME</a>


<body>

<h2>TRANSFERS</h2>

<div class="club-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="club-card">
            
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Age:</strong> <?= htmlspecialchars($row['age']) ?></p>
            
            <p><strong>Position:</strong> <?= htmlspecialchars($row['position']) ?></p>
            <p><strong>Club From:</strong> <?= htmlspecialchars($row['clubfrom']) ?></p>
            <p><strong>Club To:</strong> <?= htmlspecialchars($row['clubto']) ?></p>
            <p><strong>Transfer Fee:</strong> <?= htmlspecialchars($row['transferfee']) ?></p>
            <p><strong>Wages:</strong> <?= htmlspecialchars($row['wage']) ?></p>

            
            <form action="transfers.html" method="GET">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="hidden" name="name" value="<?= $row['name'] ?>">
    <input type="hidden" name="age" value="<?= $row['age'] ?>">
    <input type="hidden" name="position" value="<?= $row['position'] ?>">
    <input type="hidden" name="clubfrom" value="<?= $row['clubfrom'] ?>">
    <input type="hidden" name="clubto" value="<?= $row['clubto'] ?>">
    <input type="hidden" name="transferfee" value="<?= $row['transferfee'] ?>">
    <input type="hidden" name="wage" value="<?= $row['wage'] ?>">
    <button type="submit" class="update-btn">UPDATE</button>
</form>

        </div>
    <?php } ?>
</div>

<form action="transfersdispl.php" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit" class="del" name="d">DELETE</button>
</form>

</body>
</html>
