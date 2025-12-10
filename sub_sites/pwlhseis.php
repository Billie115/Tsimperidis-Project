<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
      if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add'])){
        $id_polishs = trim($_POST["id_polishs"]);
        $hm_ago = trim($_POST["hm_ago"]);
        $timh = trim($_POST["timh"]);
        $VIN = trim($_POST["VIN"]);
        $afm_pelath = trim($_POST["afm_pelath"]);
        $id_upallhlou = trim($_POST["id_upallhlou"]);
        insert('poliseis',[$id_polishs, $hm_ago, $timh, $VIN, $afm_pelath, $id_upallhlou]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Πελάτες</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="dashboard.php"><button>Back</button></a>
    <div style="text-align: center;">
        
        <h1>Πελάτες</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Πελατών</h2>
            <form method="POST">
                <input type="text" name='id_polishs' placeholder="Κωδικός Πώλησεις" required>
                <input type="date" name='hm_ago' placeholder="Ημερομηνία Πώλησης" required>
                <input type="text" name='timh' placeholder="Τιμή" required>
                <input type="text" name='VIN' placeholder="VIN" required>
                <input type="text" name='afm_pelath' placeholder="ΑΦΜ Πελάτη" required>
                <input type="text" name='id_upallhlou' placeholder="Κωδικός Υπαλλήλου" required>

                <button type="submit" name="add">Προσθήκη</button>
            </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <form method="POST">
                    <p>apo: <input id="apo" name="apo" type="date"></p>
                    <p>eos: <input id="eos" name="eos" type="date"></p>
                    <button type="submit">Αναζητηση</button>
                </form>

                <?php 
                global $conn;

                $apo = trim($_POST["apo"] ?? "");
                $eos = trim($_POST["eos"] ?? "");

                if ($apo === "" || $eos === "") {
                    $where = "";
                } else {
                    $where = "hm_ago BETWEEN '$apo' AND '$eos'";
                }

                showTable("poliseis", $where);
                ?>
            </div>

            <div class="panel-content"></div>
        </div>
        <h1>Delete</h1>
            <form method="post">
                <?php $cars = select("id_polishs", "poliseis"); ?>

                <select id="cars" name="car">
                    <?php foreach ($cars as $car): ?>
                        <option value="<?= htmlspecialchars($car['id_polishs']) ?>">
                            <?= htmlspecialchars($car['id_polishs']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="delete">Delete</button>
            </form>

            <?php
                if (isset($_POST['delete'])) {
                    $name = trim($_POST['car']); // the selected item

                    // safer delete using prepared statement
                    $stmt = $conn->prepare("DELETE FROM poliseis WHERE id_polishs = ?");
                    $stmt->bind_param("s", $name);
                    $stmt->execute();
                    $stmt->close();
                    echo "Deleted: " . htmlspecialchars($name);
                }
            ?>
    </div>
</body>

</html>