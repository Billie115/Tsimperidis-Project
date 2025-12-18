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
    $id_etairias = trim($_POST["id_etairias"]);
    $onoma = trim($_POST["onoma"]);
    $xwra = trim($_POST["xwra"]);
    $thlefono = trim($_POST["thlefono"]);
    $etairiko_afm = trim($_POST["etairiko_afm"]);
    insert('etairia', [$id_etairias, $onoma, $xwra, $etairiko_afm]);
    insert('thlefono_etairias', [$thlefono, $id_etairias]);
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
    <!--======================================================================================================-->
    <!------------------------------------------------- INSERT ------------------------------------------------->
    <!--======================================================================================================-->
    <div>
        <div class="center_block">
            <h1>Λίστα Εταιριών</h1>
            <div class="insert_block">
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
            <!--======================================================================================================-->
            <!------------------------------------------------- FILTER ------------------------------------------------->
            <!--======================================================================================================-->
            <div class="filter_block">
                <h2>Filters</h2>
                <form method="post">
                    <input type="text" name="id_etairias" placeholder="Κωδικός εταιρίας" value="<?= htmlspecialchars($_POST['id_etairias'] ?? '') ?>">
                    <input type="text" name="onoma" placeholder="Όνομα εταιρίας" value="<?= htmlspecialchars($_POST['onoma'] ?? '') ?>">
                    <input type="text" name="xwra" placeholder="Χώρα προέλευσης" value="<?= htmlspecialchars($_POST['xwra'] ?? '') ?>">
                    <input type="text" name="etairiko_afm" placeholder="ΑΦΜ εταιρίας" value="<?= htmlspecialchars($_POST['etairiko_afm'] ?? '') ?>">
                    <button type="submit">Αναζήτηση</button>
                </form>
            </div>
        </div>
        <!--=====================================================================================================-->
        <!------------------------------------------------- TABLE ------------------------------------------------->
        <!--=====================================================================================================-->
        <div class="table_block">
            <?php
            // Read filters
            $id = trim($_POST['id_etairias'] ?? '');
            $name = trim($_POST['onoma'] ?? '');
            $country = trim($_POST['xwra'] ?? '');
            $afm = trim($_POST['etairiko_afm'] ?? '');

            // Build WHERE
            $whereParts = [];

            if ($id !== '') $whereParts[] = "id_etairias LIKE '$id%'";
            if ($name !== '') $whereParts[] = "onoma LIKE '$name%'";
            if ($country !== '') $whereParts[] = "xwra LIKE '$country%'";
            if ($afm !== '') $whereParts[] = "etairiko_afm LIKE '$afm%'";

            $where = !empty($whereParts) ? implode(" AND ", $whereParts) : "1";
            // Show table
            ShowTable('etairia', $where);
            ?>
        </div>
    </div>
</body>


</html>