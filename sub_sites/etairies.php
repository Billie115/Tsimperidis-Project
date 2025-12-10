<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD']=="POST"&& isset($_POST['add'])){
        $id_etairias = trim($_POST["id_etairias"]);
        $onoma = trim($_POST["onoma"]);
        $xwra = trim($_POST["xwra"]);
        $thlefono = trim($_POST["thlefono"]);
        $etairiko_afm = trim($_POST["etairiko_afm"]);
        insert('etairia',[$id_etairias, $onoma, $xwra, $etairiko_afm]);
        insert('thlefono_etairias',[$thlefono, $id_etairias]);
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

<body>
    <a href="dashboard.php"><button>Back</button></a>

    <div style="text-align: center;">
        <h1>Λίστα Εταιριών</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Εταιριών</h2>
            <form method="POST">
                <input type="text" name='id_etairias' placeholder="Κωδικός εταιρίας" required>
                <input type="text" name='onoma' placeholder="Όνομα εταιρίας" required>
                <input type="text" name='xwra' placeholder="Χόρα Προέλευσης" required>
                <input type="text" name='thlefono' placeholder="Τηλέφωνο" required>
                <input type="text" name='etairiko_afm' placeholder="Εταιρικό ΑΦΜ" required>
                <button type="submit" name='add'>Προσθήκη</button>
            </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php ShowTable('etairia_view') ?>
            </div>
            <div class="panel-content"></div>
        </div>
    </div>
</body>

</html>