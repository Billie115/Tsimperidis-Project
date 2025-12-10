<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
      if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add'])){
        $id_upallhlou = trim($_POST["id_upallhlou"]);
        $onoma = trim($_POST["onoma"]);
        $epwnumo = trim($_POST["epwnumo"]);
        $thlefwno1 = trim($_POST["thlefwno1"]);
        $thlefwno2 = trim($_POST["thlefwno2"]);
        $hm_proslhpshs = trim($_POST["hm_proslhpshs"]);
        $idikothta = trim($_POST["idikothta"]);
        insert('upallhloi',[$id_upallhlou, $onoma, $epwnumo, $thlefwno1, $thlefwno2, $hm_proslhpshs, $idikothta]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Υπάλληλοι</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="dashboard.php"><button>Back</button></a>
    <div style="text-align: center;">
        
        <h1>Υπάλληλοι</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Υπαλλήλου</h2>
            <form method="POST">
                <input type="text" name='id_upallhlou' placeholder="Κωδικός Υπαλλήλου" required>
                <input type="text" name='onoma' placeholder="Όνομα" required>
                <input type="text" name='epwnumo' placeholder="Επώνυμο" required>
                <input type="text" name='thlefwno1' placeholder="Τηλέφωνο 1" required>
                <input type="text" name='thlefwno2' placeholder="Τηλέφωνο 2">
                <input type="date" name='hm_proslhpshs' placeholder="Ημ/νια Πρόσληψης" required>
                <select name="idikothta">
                    <option value="poliths">poliths</option>
                    <option value="mhxanikos">mhxanikos</option>
                    <option value="manager">manager</option>
                    <option value="ka8arisths">ka8arisths</option>
                </select>
                <button type="submit" name="add">Προσθήκη</button>
            </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php ShowTable('upallhloi') ?>
            </div>

            <div class="panel-content"></div>
        </div>
    </div>
</body>

</html>