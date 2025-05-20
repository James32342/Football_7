<?php
include "connect.php";

if(isset($_POST['d'])){
    mysqli_query($conn,"DELETE from club ORDER BY id DESC LIMIT 1");
    header("Location: displ.php"); 
    exit;
}
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pos = $_POST['pos'];
    $rec = $_POST['rec'];
    $round = $_POST['round'];
    $stad = $_POST['stad'];
    $sqsize = $_POST['sqsize'];
    $manager = $_POST['manager'];

    mysqli_query($conn, "UPDATE club SET name='$name', pos='$pos', rec='$rec', round='$round', stad='$stad', sqsize='$sqsize', manager='$manager' WHERE id=$id");

    header("Location: displ.php");
    exit;
} 



$result = mysqli_query($conn, "SELECT * FROM club ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Clubs</title>
    <style>
        body {
            background-color: #111;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .club-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .club-card {
            background-color: #000;
            border: 1px solid #444;
            border-radius: 10px;
            width: 300px;
            height: 550px;
            margin: 15px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
        }

        .club-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .club-card p {
            margin: 5px 0;
            font-size: 25px;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .del {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 12px 28px;
            background: white;
            color: black;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease, transform 0.3s ease;
            z-index: 1000; 
        }

        .del:hover {
            background: #f4f4f4;
            transform: scale(1.05);
        }

        .update-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            margin-top: 10px;
            padding: 10px;
            background: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: black;
            font-weight: bold;
        }
        .home-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 12px 28px;
            background: white;
            color: black;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease, transform 0.3s ease;
            z-index: 1000; 
        }

        .home-btn:hover {
            background: #f4f4f4;
            transform: scale(1.05);
        }
        
    </style>
</head>
<a href="a.html" class="home-btn">HOME</a>

<body>

<h2>CLUBS</h2>

<div class="club-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="club-card">
            <img src="photos/<?= htmlspecialchars($row['logo']) ?>" alt="Club Logo">
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
            <p><strong>Position:</strong> <?= htmlspecialchars($row['pos']) ?></p>
            <p><strong>Record:</strong> <?= htmlspecialchars($row['rec']) ?></p>
            <p><strong>UCL Round:</strong> <?= htmlspecialchars($row['round']) ?></p>
            <p><strong>Stadium:</strong> <?= htmlspecialchars($row['stad']) ?></p>
            <p><strong>Squad Size:</strong> <?= htmlspecialchars($row['sqsize']) ?></p>
            <p><strong>Manager:</strong> <?= htmlspecialchars($row['manager']) ?></p>

            
            <form action="clubs.html" method="GET">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="hidden" name="name" value="<?= $row['name'] ?>">
    <input type="hidden" name="pos" value="<?= $row['pos'] ?>">
    <input type="hidden" name="rec" value="<?= $row['rec'] ?>">
    <input type="hidden" name="round" value="<?= $row['round'] ?>">
    <input type="hidden" name="stad" value="<?= $row['stad'] ?>">
    <input type="hidden" name="sqsize" value="<?= $row['sqsize'] ?>">
    <input type="hidden" name="manager" value="<?= $row['manager'] ?>">
    <button type="submit" class="update-btn">UPDATE</button>
</form>

        </div>
    <?php } ?>
</div>

<form method="POST">
    <div class="delete">
        <button class="del" name="d">DELETE</button>
    </div>
</form>

</body>
</html>
