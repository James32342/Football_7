<?php
include "connect.php";

if(isset($_POST['d'])){
    mysqli_query($conn,"DELETE from statistics ORDER BY id DESC LIMIT 1");
    header("Location: statsdispl.php"); 
    exit;
}
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id'];   
    $name = $_POST['name'];
    $matches = $_POST['matches'];
    $goals=$_POST['goals'];
    $assists= $_POST['assists'];
    $clubs = $_POST['clubs'];
    $trophieswon = $_POST['trophieswon'];
    $redcard = $_POST['redcard'];
    

    mysqli_query($conn, "UPDATE statistics SET name='$name', matches='$matches', clubs='$clubs', goals='$goals', assists='$assists' ,trophieswon='$trophieswon',redcard='$redcard' WHERE id=$id");

    header("Location: statsdispl.php");
    exit;
} 



$result = mysqli_query($conn, "SELECT * FROM statistics ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>STATS</title>
    <style>
body {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    color: #e0e0e0;
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
    margin-bottom: 40px;
    color: #00c6ff;
    letter-spacing: 3px;
    text-transform: uppercase;
    text-shadow: 2px 2px 8px rgba(0, 198, 255, 0.5);
}

.club-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 25px;
    width: 100%;
    max-width: 1400px;
}

.club-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    width: 340px;
    height: 300px;
    padding: 25px;
    position: relative;
    transition: all 0.4s ease;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}

.club-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 12px 40px 0 rgba(0, 198, 255, 0.5);
}

.club-card p {
    margin: 15px 0;
    font-size: 18px;
    line-height: 1.6;
    color: #d1d9e6;
}

strong {
    color: #00c6ff;
    font-weight: bold;
}

.update-btn {
    position: absolute;
    bottom: 20px;
    right: 20px;
    padding: 10px 22px;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0, 198, 255, 0.3);
    transition: all 0.3s ease;
}

.update-btn:hover {
    background: linear-gradient(135deg, #0072ff, #00c6ff);
    box-shadow: 0 6px 18px rgba(0, 198, 255, 0.6);
}

.del {
    position: absolute;
    top: 25px;
    right: 25px;
    padding: 12px 30px;
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 15px rgba(255, 65, 108, 0.4);
}

.del:hover {
    background: linear-gradient(135deg, #ff4b2b, #ff416c);
    transform: scale(1.05);
}
.home-btn {
    position: absolute;
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

<h2>STATS</h2>

<div class="club-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="club-card">
            
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Matches:</strong> <?= htmlspecialchars($row['matches']) ?></p>
            
            <p><strong>Goals:</strong> <?= htmlspecialchars($row['goals']) ?></p>
            <p><strong>Assists:</strong> <?= htmlspecialchars($row['assists']) ?></p>
            <p><strong>Clubs:</strong> <?= htmlspecialchars($row['clubs']) ?></p>
            <p><strong>Trophies Won:</strong> <?= htmlspecialchars($row['trophieswon']) ?></p>
            <p><strong>Red Cards:</strong> <?= htmlspecialchars($row['redcard']) ?></p>
         

            
            <form action="stats.html" method="GET">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="hidden" name="name" value="<?= $row['name'] ?>">
    <input type="hidden" name="matches" value="<?= $row['matches'] ?>">
    <input type="hidden" name="goals" value="<?= $row['goals'] ?>">
    <input type="hidden" name="assists" value="<?= $row['assists'] ?>">
    <input type="hidden" name="clubs" value="<?= $row['clubs'] ?>">
    <input type="hidden" name="trophieswon" value="<?= $row['trophieswon'] ?>">
    <input type="hidden" name="redcard" value="<?= $row['redcard'] ?>">
    
    <button type="submit" class="update-btn">UPDATE</button>
</form>

        </div>
    <?php } ?>
</div>
<fortion="statsdispl.php" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit" class="del" name="d">DELETE</button>
</form>


</body>
</html>
