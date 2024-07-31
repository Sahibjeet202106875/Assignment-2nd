<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $query = "SELECT * FROM festival WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([':id' => $id]);
    $festival = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$festival) {
        header("Location: error.php");
        exit;
    }
} else {
    header("Location: error.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Festival</title>
    <link rel="stylesheet" href="style/read.css">
</head>
<body>
    <h1>Festival Details</h1>
    <p><strong>Festival Name:</strong> <?php echo htmlspecialchars($festival['festival_name']); ?></p>
    <p><strong>Date Celebrated:</strong> <?php echo htmlspecialchars($festival['date_celebrated']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($festival['short_description']); ?></p>
    <p><strong>Type:</strong> <?php echo htmlspecialchars($festival['festival_type']); ?></p>
    <a href="home.php">Back to List</a>
</body>
</html>
