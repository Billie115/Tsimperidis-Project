<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD']=="POST"){
    $kodikos_etairias = trim($_POST["kodikos_etairias"]);
    $onoma_etairias = trim($_POST["onoma_etairias"]);
    $xora_proeleusis = trim($_POST["xora_proeleusis"]);
    $tilefono = trim($_POST["tilefono_etairias"]);
        insert('Etairia',[$kodikos_etairias, $onoma_etairias, $xora_proeleusis, $tilefono]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etairies</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body >
    <a href="dashboard.php"><button>Back</button></a>
<<<<<<< HEAD

    <div style="text-align: center;">
        <h1>Λίστα Εταιριών</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Εταιριών</h2>
        <form method="POST">
        <input type="text" name='kodikos_etairias' placeholder="Κωδικός εταιρίας" required>
        <input type="text" name='onoma_etairias' placeholder="Όνομα εταιρίας" required>
        <input type="text" name='xora_proeleusis' placeholder="Χόρα Προέλευσης" required>
        <input type="text" name='tilefono_etairias' placeholder="Τηλέφωνο εταιρίας" required>
        <button type="submit">Προσθήκη</button>
            
         </form>
        </div>
         <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php filter('Etairia'); ?>
            </div>

            <div class="panel-content">
            </div>
=======
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
>>>>>>> c7315b371797b68fcb7dee9e4599f56669fd00ea
    </div>
</body>

</html>
