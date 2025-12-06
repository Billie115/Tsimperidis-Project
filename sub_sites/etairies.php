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
    <title>Etairies</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <a href="dashboard.php"><button>Back</button></a>
    <div>
        <h1>Λίστα Εταιριών</h1>
                <div id="filterPanel" class="filter-panel">
                    <div class="panel-header">
                        <?php filter('Etairia'); ?>
                    </div>

                <div class="panel-content"></div>
        
        <h1>Delete</h1>
        <form method="post">
            <?php $cars = select("onoma", "Etairia"); ?>

            <select id="cars" name="car">
                <?php foreach ($cars as $car): ?>
                    <option value="<?= htmlspecialchars($car['onoma']) ?>">
                        <?= htmlspecialchars($car['onoma']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="delete">Delete</button>
        </form>

        <?php
        if (isset($_POST['delete'])) {
            $name = $_POST['car']; // the selected item

            // safer delete using prepared statement
            $stmt = $conn->prepare("DELETE FROM Etairia WHERE onoma = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $stmt->close();

            echo "Deleted: " . htmlspecialchars($name);
        }
        ?>


        </form>
    </div>
</body>

</html>
