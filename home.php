<?php
require 'config.php';

$query = "SELECT * FROM festival";
$statement = $pdo->query($query);
$festivals = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival Management - Home</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="create.php">Create Festival</a></li>
        </ul>
    </nav>

    <h1>Festival Records</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Festival Name</th>
                <th>Date Celebrated</th>
                <th>Description</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($festivals as $festival): ?>
                <tr>
                    <td><?php echo htmlspecialchars($festival['id']); ?></td>
                    <td><?php echo htmlspecialchars($festival['festival_name']); ?></td>
                    <td><?php echo htmlspecialchars($festival['date_celebrated']); ?></td>
                    <td><?php echo htmlspecialchars($festival['short_description']); ?></td>
                    <td><?php echo htmlspecialchars($festival['festival_type']); ?></td>
                    <td>
                        <a href="read.php?id=<?php echo $festival['id']; ?>">View</a>
                        <a href="update.php?id=<?php echo $festival['id']; ?>">Update</a>
                        <a href="delete.php?id=<?php echo $festival['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
