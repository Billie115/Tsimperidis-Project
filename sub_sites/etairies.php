<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "127.0.0.1";
$username = "root";
$password = "";
$db = "car_agency_db";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
    include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etairies</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <button onclick="history.back()">Back</button>

    <div>
        <h2>Λίστα Εταιριών</h2>

        <?php
        $rows = select("*", "Etairia");
        ?>

        <?php if (!empty($rows)): ?>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <?php foreach (array_keys($rows[0]) as $col_name): ?>
                        <th><?= htmlspecialchars($col_name) ?></th>
                    <?php endforeach; ?>
                </tr>

                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <td><?= htmlspecialchars($cell) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>

        <button style="float: right;">Filter</button>
    </div>
</body>

</html>
