<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['add'])){
    $kodikos_etairias = trim($_POST["kodikos_etairias"]);
    $onoma_etairias = trim($_POST["onoma_etairias"]);
    $xora_proeleusis = trim($_POST["xora_proeleusis"]);
    $tilefono = trim($_POST["tilefono_etairias"]);
        insert('etairia',[$kodikos_etairias, $onoma_etairias, $xora_proeleusis, $tilefono]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etairies</title>
    <link rel="stylesheet" href="style.css">
</head>

<body >
    <a href="dashboard.php"><button>Back</button></a>

    <div style="text-align: center;">
        <h1>Λίστα Εταιριών</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Εταιριών</h2>
        <form method="POST">
        <input type="text" name='kodikos_etairias' placeholder="Κωδικός εταιρίας" required>
        <input type="text" name='onoma_etairias' placeholder="Όνομα εταιρίας" required>
        <input type="text" name='xora_proeleusis' placeholder="Χόρα Προέλευσης" required>
        <input type="text" name='tilefono_etairias' placeholder="Εταιρικό ΑΦΜ" required>
        <button type="submit" name='add'>Προσθήκη</button>
            
         </form>
        </div>
         <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php ShowTable('etairia') ?>
            </div>

            <div class="panel-content">
            </div>
        
        <h1>Delete</h1>
        <form method="post">
            <?php $cars = select("onoma", "etairia"); ?>

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
            $name = trim($_POST['car']); // the selected item

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
