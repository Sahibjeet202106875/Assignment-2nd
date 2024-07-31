<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if ($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $festival_name = $_POST['festival_name'];
        $date_celebrated = $_POST['date_celebrated'];
        $short_description = $_POST['short_description'];
        $festival_type = $_POST['festival_type'];

        $query = "UPDATE festival SET festival_name = :festival_name, date_celebrated = :date_celebrated, short_description = :short_description, festival_type = :festival_type WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([
            ':festival_name' => $festival_name,
            ':date_celebrated' => $date_celebrated,
            ':short_description' => $short_description,
            ':festival_type' => $festival_type,
            ':id' => $id
        ]);

        header("Location: index.php");
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
    <title>Update Festival</title>
    <link rel="stylesheet" href="style/update.css">
</head>
<body>
    <h1>Update Festival</h1>
    <form action="update.php?id=<?php echo $festival['id']; ?>" method="post">
        <label for="festival_name">Festival Name:</label>
        <input type="text" id="festival_name" name="festival_name" value="<?php echo htmlspecialchars($festival['festival_name']); ?>" required><br>

        <label for="date_celebrated">Date Celebrated:</label>
        <input type="date" id="date_celebrated" name="date_celebrated" value="<?php echo htmlspecialchars($festival['date_celebrated']); ?>" required><br>

        <label for="short_description">Short Description:</label>
        <textarea id="short_description" name="short_description" required><?php echo htmlspecialchars($festival['short_description']); ?></textarea><br>

        <label for="festival_type">Festival Type:</label>
        <input type="text" id="festival_type" name="festival_type" value="<?php echo htmlspecialchars($festival['festival_type']); ?>" required><br>

        <input type="submit" value="Update">
    </form>
    <a href="home.php">Cancel</a>
</body>
</html>
