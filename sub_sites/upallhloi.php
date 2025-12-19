<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
include("../sidebar.php");
include("temporarydb.php");
include("functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add'])) {
    $id_upallhlou = trim($_POST["id_upallhlou"]);
    $onoma = trim($_POST["onoma"]);
    $epwnumo = trim($_POST["epwnumo"]);
    $thlefwno1 = trim($_POST["thlefwno1"]);
    $thlefwno2 = trim($_POST["thlefwno2"]);
    $hm_proslhpshs = trim($_POST["hm_proslhpshs"]);
    $idikothta = trim($_POST["idikothta"]);
    insert('upallhloi', [$id_upallhlou, $onoma, $epwnumo, $thlefwno1, $thlefwno2, $hm_proslhpshs, $idikothta]);
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
    <!--======================================================================================================-->
    <!------------------------------------------------- INSERT ------------------------------------------------->
    <!--======================================================================================================-->
    <div>
        <div class="center_block">
            <h1>Υπάλληλοι</h1>
            <div class="insert_block">
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
            <!--======================================================================================================-->
            <!------------------------------------------------- FILTER ------------------------------------------------->
            <!--======================================================================================================-->
            <div class="filter_block">
                <h2>Filters</h2>
                <form method="post" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center;">
                    <?php
                    // Read filters
                    $id_upallhlou = trim($_POST['id_upallhlou'] ?? '');
                    $onoma = trim($_POST['onoma'] ?? '');
                    $epwnumo = trim($_POST['epwnumo'] ?? '');
                    $thlefwno1 = trim($_POST['thlefwno1'] ?? '');
                    $thlefwno2 = trim($_POST['thlefwno2'] ?? '');
                    $hm_proslhpshs_apo = trim($_POST['hm_proslhpshs_apo'] ?? '');
                    $hm_proslhpshs_eos = trim($_POST['hm_proslhpshs_eos'] ?? '');
                    $idikothta = trim($_POST['idikothta'] ?? '');
                    // Build WHERE
                    $whereParts = [];
                    if ($id_upallhlou !== '') $whereParts[] = "id_upallhlou LIKE '$id_upallhlou%'";
                    if ($onoma !== '') $whereParts[] = "onoma LIKE '$onoma%'";
                    if ($epwnumo !== '') $whereParts[] = "epwnumo LIKE '$epwnumo%'";
                    if ($thlefwno1 !== '') $whereParts[] = "thlefwno1 LIKE '$thlefwno1%'";
                    if ($thlefwno2 !== '') $whereParts[] = "thlefwno2 LIKE '$thlefwno2%'";
                    if ($hm_proslhpshs_apo !== '' && $hm_proslhpshs_eos !== '') {
                        $whereParts[] = "hm_proslhpshs BETWEEN '$hm_proslhpshs_apo' AND '$hm_proslhpshs_eos'";
                    }

                    if ($idikothta !== '') $whereParts[] = "idikothta LIKE '$idikothta%'";

                    $where = !empty($whereParts) ? implode(" AND ", $whereParts) : "1"; ?>

                    <input type="text" name="id_upallhlou" placeholder="Κωδικός Υπαλλήλου" value="<?= htmlspecialchars($_POST['id_upallhlou'] ?? '') ?>">
                    <input type="text" name="onoma" placeholder="Όνομα" value="<?= htmlspecialchars($_POST['onoma'] ?? '') ?>">
                    <input type="text" name="epwnumo" placeholder="Επώνημο" value="<?= htmlspecialchars($_POST['epwnumo'] ?? '') ?>">
                    <input type="text" name="thlefwno1" placeholder="Τηλέφωνο 1" value="<?= htmlspecialchars($_POST['thlefwno1'] ?? '') ?>">
                    <input type="text" name="thlefwno2" placeholder="Τηλέφωνο 2" value="<?= htmlspecialchars($_POST['thlefwno2'] ?? '') ?>">
                    <input type="date" name="hm_proslhpshs_apo" placeholder="ημ/νια απο" value="<?= htmlspecialchars($_POST['hm_proslhpshs_apo'] ?? '') ?>">
                    <input type="date" name="hm_proslhpshs_eos" placeholder="ημ/νια εως" value="<?= htmlspecialchars($_POST['hm_proslhpshs_eos'] ?? '') ?>">
                    <?php
                    renderSelect(
                        'idikothta',
                        'upallhloi',
                        'idikothta',
                        'Ιδιότητα',
                        $idikothta,
                        '-- Όλοι οι υπαλληλοι --',
                        true
                    );

                    ?>
                    <button type="submit">Φιλτράρισμα</button>
                </form>
            </div>
        </div>
        <!--=====================================================================================================-->
        <!------------------------------------------------- TABLE ------------------------------------------------->
        <!--=====================================================================================================-->
        <div class="table_block">
            <div class="panel-header">
                <?php
                ShowTable('upallhloi', $where);
                ?>
            </div>
        </div>
    </div>
</body>

</html>