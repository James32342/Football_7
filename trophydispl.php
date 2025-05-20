<?php
include "connect.php";

if(isset($_POST['d'])){
    mysqli_query($conn,"DELETE from trophy ORDER BY id DESC LIMIT 1");
    header("Location: trophydispl.php"); 
    exit;
}
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id'];   
    $name = $_POST['name'];
    $type = $_POST['type'];
    $association=$_POST['association'];
    $currentholders= $_POST['currentholders'];
    $venue = $_POST['venue'];
 

    mysqli_query($conn, "UPDATE trophy SET name='$name', type='$type', association='$association', currentholders='$currentholders', venue='$venue' WHERE id=$id");

    header("Location: trophydispl.php");
    exit;
} 



$result = mysqli_query($conn, "SELECT * FROM trophy ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>TROPHIES</title>
    <style>
       body {
    background-color: #0d1117;
    color: #f0f6fc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    font-size: 36px;
    color: #58a6ff;
    margin-bottom: 30px;
    letter-spacing: 2px;
    text-shadow: 0 0 5px #58a6ff, 0 0 10px #58a6ff;
}

.club-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.club-card {
    background-color: #161b22;
    border: 1px solid #30363d;
    border-radius: 15px;
    width: 320px;
    height: auto;
    padding: 20px;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 0 15px rgba(88, 166, 255, 0.1);
}

.club-card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(88, 166, 255, 0.5);
}

.club-card p {
    margin: 10px 0;
    font-size: 20px;
    line-height: 1.5;
    color: #c9d1d9;
}

strong {
    color: #58a6ff;
}

.update-btn {
    position: absolute;
    bottom: 15px;
    right: 15px;
    padding: 10px 20px;
    background: linear-gradient(to right, #58a6ff, #1f6feb);
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: white;
    font-weight: bold;
    font-size: 14px;
    transition: background 0.3s ease;
}

.update-btn:hover {
    background: linear-gradient(to right, #1f6feb, #58a6ff);
}

.del {
    position: fixed;
    top: 20px;
    right: 20px;
    width: auto;
    height: 50px;
    font-size: 16px;
    padding: 10px 25px;
    border: none;
    border-radius: 8px;
    background: crimson;
    color: white;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
}

.del:hover {
    background: darkred;
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

<h2>TROPHY</h2>

<div class="club-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="club-card">
            
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($row['type']) ?></p>
            <p><strong>Association:</strong> <?= htmlspecialchars($row['association']) ?></p>
            <p><strong>Current-Holders:</strong> <?= htmlspecialchars($row['currentholders']) ?></p>
            <p><strong>Venue:</strong> <?= htmlspecialchars($row['venue']) ?></p>
            

            
            <form action="trophy.html" method="GET">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="hidden" name="name" value="<?= $row['name'] ?>">
    <input type="hidden" name="type" value="<?= $row['type'] ?>">
    <input type="hidden" name="association" value="<?= $row['association'] ?>">
    <input type="hidden" name="currentholders" value="<?= $row['currentholders'] ?>">
    <input type="hidden" name="venue" value="<?= $row['venue'] ?>">
   
  
    <button type="submit" class="update-btn">UPDATE</button>
</form>

        </div>
    <?php } ?>
</div>

<form action="trophydispl.php" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit" class="del" name="d">DELETE</button>
</form>

</body>
</html>
