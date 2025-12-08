<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Πωλήσεις</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <button onclick="history.back()" style="left: 0;">Back</button>
    <div>
        <h1>Πωλήσεις</h1>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php filter('poliseis'); ?>
            </div>

            <div class="panel-content"></div>
    </div>

</body>

</html>