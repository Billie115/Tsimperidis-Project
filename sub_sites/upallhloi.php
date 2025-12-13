<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("temporarydb.php");
include("functions.php");

// Handle insert
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

// Read filter values
$id_upallhlou_filter = trim($_POST['id_upallhlou'] ?? '');
$onoma_filter        = trim($_POST['onoma'] ?? '');
$epwnumo_filter      = trim($_POST['epwnumo'] ?? '');
$thlefwno1_filter    = trim($_POST['thlefwno1'] ?? '');
$thlefwno2_filter    = trim($_POST['thlefwno2'] ?? '');
$hm_proslhpshs_apo   = trim($_POST['hm_proslhpshs_apo'] ?? '');
$hm_proslhpshs_eos   = trim($_POST['hm_proslhpshs_eos'] ?? '');
$idikothta_filter     = trim($_POST['idikothta'] ?? '');
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

<!--======================================================================================================-->
<!-- INSERT BLOCK -->
<!--======================================================================================================-->
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
    <!-- FILTER BLOCK -->
    <!--======================================================================================================-->
    <div class="filter_block">
        <h2>Filters</h2>
        <form method="post">
            <input type="text" name="id_upallhlou" placeholder="Κωδικός Υπαλλήλου" value="<?php echo htmlspecialchars($id_upallhlou_filter); ?>">
            <input type="text" name="onoma" placeholder="Όνομα" value="<?php echo htmlspecialchars($onoma_filter); ?>">
            <input type="text" name="epwnumo" placeholder="Επώνυμο" value="<?php echo htmlspecialchars($epwnumo_filter); ?>">
            <input type="text" name="thlefwno1" placeholder="Τηλέφωνο 1" value="<?php echo htmlspecialchars($thlefwno1_filter); ?>">
            <input type="text" name="thlefwno2" placeholder="Τηλέφωνο 2" value="<?php echo htmlspecialchars($thlefwno2_filter); ?>">
            <input type="date" name="hm_proslhpshs_apo" placeholder="Ημ/νια Πρόσληψης Από" value="<?php echo htmlspecialchars($hm_proslhpshs_apo); ?>">
            <input type="date" name="hm_proslhpshs_eos" placeholder="Ημ/νια Πρόσληψης Έως" value="<?php echo htmlspecialchars($hm_proslhpshs_eos); ?>">

            <?php
            global $conn;
            renderSelect(
                'idikothta',
                'upallhloi',
                'idikothta',
                'idikothta',
                $idikothta_filter,
                '-- Όλες οι ιδιότητες --'
            );
            ?>
            <button type="submit">Αναζήτηση</button>
        </form>
    </div>

    <!--======================================================================================================-->
    <!-- TABLE BLOCK -->
    <!--======================================================================================================-->
    <div class="table_block">
        <div class="panel-header">
            <?php
            $whereParts = [];

            if ($id_upallhlou_filter !== '') $whereParts[] = "id_upallhlou LIKE '{$id_upallhlou_filter}%'";
            if ($onoma_filter !== '')        $whereParts[] = "onoma LIKE '{$onoma_filter}%'";
            if ($epwnumo_filter !== '')      $whereParts[] = "epwnumo LIKE '{$epwnumo_filter}%'";
            if ($thlefwno1_filter !== '')    $whereParts[] = "thlefwno1 LIKE '{$thlefwno1_filter}%'";
            if ($thlefwno2_filter !== '')    $whereParts[] = "thlefwno2 LIKE '{$thlefwno2_filter}%'";

            if ($hm_proslhpshs_apo !== '' && $hm_proslhpshs_eos !== '') {
                $whereParts[] = "hm_proslhpshs BETWEEN '{$hm_proslhpshs_apo}' AND '{$hm_proslhpshs_eos}'";
            } elseif ($hm_proslhpshs_apo !== '') {
                $whereParts[] = "hm_proslhpshs >= '{$hm_proslhpshs_apo}'";
            } elseif ($hm_proslhpshs_eos !== '') {
                $whereParts[] = "hm_proslhpshs <= '{$hm_proslhpshs_eos}'";
            }

            if ($idikothta_filter !== '') $whereParts[] = "idikothta LIKE '{$idikothta_filter}%'";

            $where = !empty($whereParts) ? implode(" AND ", $whereParts) : "1";

            ShowTable('upallhloi', $where);
            ?>
        </div>
    </div>
</div>
</body>
</html>
