<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query = "DELETE FROM festival WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $id]);

        header("Location: home.php");
        exit;
    } else {
        $query = "SELECT * FROM festival WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $id]);
        $festival = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$festival) {
            header("Location: error.php");
            exit;
        }
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
    <title>Delete Festival</title>
    <link rel="stylesheet" href="style/delete.css">
</head>
<body>
    <h1>Delete Festival</h1>
    <p>Are you sure you want to delete the following festival?</p>
    <p><strong>Festival Name:</strong> <?php echo htmlspecialchars($festival['festival_name']); ?></p>
    <p><strong>Date Celebrated:</strong> <?php echo htmlspecialchars($festival['date_celebrated']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($festival['short_description']); ?></p>
    <p><strong>Type:</strong> <?php echo htmlspecialchars($festival['festival_type']); ?></p>

    <form action="delete.php?id=<?php echo $festival['id']; ?>" method="post">
        <input type="submit" value="Delete">
    </form>
    <a href="home.php">Cancel</a>
</body>
</html>
