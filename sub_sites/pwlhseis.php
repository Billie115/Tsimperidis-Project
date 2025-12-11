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
                    <input type="text" name="polishs" placeholder="id_polishs">
                    
                    <p>apo: <input id="apo" name="apo" type="date"></p>
                    <p>eos: <input id="eos" name="eos" type="date"></p>

                    <input type="text" placeholder="απο τιμη" name="apo_timh">
                    <input type="text" placeholder="εωσ τιμη" name="eos_timh">
                    <button type="submit">Αναζητηση</button>
                </form>

                <?php
                global $conn;

                // --- read form inputs (names must match your <input name="...">) ---
                $sale_id = trim($_POST['polishs'] ?? '');   // your form uses name="polishs"
                $apo_hm  = trim($_POST['apo'] ?? '');
                $eos_hm  = trim($_POST['eos'] ?? '');
                $apo_tmh = trim($_POST['apo_timh'] ?? '');
                $eos_tmh = trim($_POST['eos_timh'] ?? '');

                // sanitize / escape (and validate numbers)
                $apo_hm  = $conn->real_escape_string($apo_hm);
                $eos_hm  = $conn->real_escape_string($eos_hm);

                // For numeric values, normalize and validate
                if ($apo_tmh !== '') {
                    // allow commas or dots, then cast to float
                    $apo_tmh = str_replace(',', '.', $apo_tmh);
                    if (!is_numeric($apo_tmh)) $apo_tmh = '';
                    else $apo_tmh = $conn->real_escape_string($apo_tmh);
                }
                if ($eos_tmh !== '') {
                    $eos_tmh = str_replace(',', '.', $eos_tmh);
                    if (!is_numeric($eos_tmh)) $eos_tmh = '';
                    else $eos_tmh = $conn->real_escape_string($eos_tmh);
                }

                // build where parts
                $whereParts = [];

                if ($sale_id !== '') {
                    $sale_id_esc = $conn->real_escape_string($sale_id);
                    $whereParts[] = "id_polishs LIKE '{$sale_id_esc}%'";
                }

                // DATE filter (hm_ago column)
                if ($apo_hm !== '' && $eos_hm !== '') {
                    $whereParts[] = "hm_ago BETWEEN '{$apo_hm}' AND '{$eos_hm}'";
                } elseif ($apo_hm !== '') {
                    $whereParts[] = "hm_ago >= '{$apo_hm}'";
                } elseif ($eos_hm !== '') {
                    $whereParts[] = "hm_ago <= '{$eos_hm}'";
                }

                // PRICE filter — **use correct column name `timh`** (not `timi`)
                if ($apo_tmh !== '' && $eos_tmh !== '') {
                    $whereParts[] = "timh BETWEEN {$apo_tmh} AND {$eos_tmh}";
                } elseif ($apo_tmh !== '') {
                    $whereParts[] = "timh >= {$apo_tmh}";
                } elseif ($eos_tmh !== '') {
                    $whereParts[] = "timh <= {$eos_tmh}";
                }

                // final where (if empty use '1' so ShowTable/select sees no filter)
                $where = !empty($whereParts) ? implode(' AND ', $whereParts) : '1';

                // call the table renderer (your ShowTable expects table + where)
                showTable('poliseis', $where);
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