<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $festival_name = $_POST['festival_name'];
    $date_celebrated = $_POST['date_celebrated'];
    $short_description = $_POST['short_description'];
    $festival_type = $_POST['festival_type'];

    $query = "INSERT INTO festival (festival_name, date_celebrated, short_description, festival_type) VALUES (:festival_name, :date_celebrated, :short_description, :festival_type)";
    $statement = $pdo->prepare($query);
    $statement->execute([
        ':festival_name' => $festival_name,
        ':date_celebrated' => $date_celebrated,
        ':short_description' => $short_description,
        ':festival_type' => $festival_type
    ]);

    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Festival</title>
    <link rel="stylesheet" href="style/create.css"> 
</head>
<body>
    <h1>Create Festival</h1>
    <form action="create.php" method="post">
        <label for="festival_name">Festival Name:</label>
        <input type="text" id="festival_name" name="festival_name" required><br>

        <label for="date_celebrated">Date Celebrated:</label>
        <input type="date" id="date_celebrated" name="date_celebrated" required><br>

        <label for="short_description">Short Description:</label>
        <textarea id="short_description" name="short_description" required></textarea><br>

        <label for="festival_type">Festival Type:</label>
        <input type="text" id="festival_type" name="festival_type" required><br>

        <input type="submit" value="Create">
    </form>
    <a href="home.php">Cancel</a>
</body>
</html>
