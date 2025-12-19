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
    $VIN = trim($_POST["VIN"]);
    $xrwma = trim($_POST["xrwma"]);

    $montelo = trim($_POST["montelo"]);
    $res = select('id_montelou', 'montelo', "onomasia='$montelo'");

    $id_montelou = $res[0]['id_montelou'];
    $ari8mos_kinhthra = trim($_POST["ari8mos_kinhthra"]);
    $eidos_mhxanhs = trim($_POST["eidos_mhxanhs"]);

    $aitos_kataskebhs = trim($_POST["aitos_kataskebhs"]);
    $kibhka = trim($_POST["kibhka"]);
    $tansmission = trim($_POST["tansmission"]);
    $xhliometra = trim($_POST["xhliometra"]);

    $endictikh_timh = trim($_POST["endictikh_timh"]);
    $katastash = trim($_POST['katastash']);
    insert('Autokinhto', [$VIN, $id_montelou, $ari8mos_kinhthra, $aitos_kataskebhs, $eidos_mhxanhs, $kibhka, $tansmission, $xhliometra, $xrwma, $endictikh_timh, $katastash]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αυτοκίνητα</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--======================================================================================================-->
    <!------------------------------------------------- INSERT ------------------------------------------------->
    <!--======================================================================================================-->
    <div>
        <div class="center_block">
            <h1>Αυτοκίνητα</h1>
            <div class="insert_block">
                <h2>Προσθήκη Αυτοκινήτων</h2>
                <form method="POST">
                    <input type="text" name="VIN" placeholder="VIN" required>
                    <select id="cars" name="etairia">
                        <option value="Μάρκα">--Μάρκα-- </option>
                        <?php $cars = select("onoma", "etairia"); ?>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?= htmlspecialchars($car['onoma']) ?>">
                                <?= htmlspecialchars($car['onoma']) ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <select id="cars" name="montelo">
                        <option value="Μοντέλο">--Μοντέλο-- </option>
                        <?php $cars = select("onomasia", "montelo"); ?>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?= htmlspecialchars($car['onomasia']) ?>">
                                <?= htmlspecialchars($car['onomasia']) ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" name=ari8mos_kinhthra placeholder="Αριθμός Κινητήρα" required>
                    <input type="text" name="xrwma" placeholder="Χρώμα" required>
                    <input type="number" name="aitos_kataskebhs" placeholder="Έτος κατασκευής" required>
                    <input type="text" name="eidos_mhxanhs" placeholder="Τύπος Καυσίμου" required>
                    <input type="text" name="tansmission" placeholder="Κυβότιο Ταχυτήτων" required>
                    <input type="text" name="kibhka" placeholder="Κηβικά" required>
                    <input type="number" name="xhliometra" placeholder="Χιλιόμετρα" required>
                    <input type="number" name="endictikh_timh" placeholder="Ενδεικτική τιμή" required>
                    <select name="katastash" id="">
                        <option>--Κατάσταση--</option>
                        <option value="dia8eshmo">Διαθέσιμο</option>
                        <option value="poulhmeno">Πουλημένο</option>
                    </select>
                    <button type="submit" name="add">Προσθήκη</button>
                </form>
            </div>
<!--======================================================================================================-->
<!------------------------------------------------- FILTER ------------------------------------------------->
<!--======================================================================================================-->
        <div class="table_block">
            <?php
            global $conn;

            // Read filters (single selection)
            $selected_car = $_POST['car'] ?? '';
            $selected_model = $_POST['model'] ?? '';
            $selected_katastash = $_POST['katastash'] ??'';
            $selected_xrwma = $_POST['xrwma'] ??'';
            $selected_eidos_mhxanhs = $_POST['eidos_mhxanhs'] ??'';

            // Read prices from POST
            $price1 = $_POST['timh1'] ?? '';
            $price2 = $_POST['timh2'] ?? '';

            // Read κιβικα from POST
            $kibhka_apo = $_POST['kibhka_apo'] ?? '';
            $kibhka_eos = $_POST['kibhka_eos'] ?? '';

            // Escape inputs
            $selected_car = mysqli_real_escape_string($conn, $selected_car);
            $selected_model = mysqli_real_escape_string($conn, $selected_model);
            $selected_katastash = mysqli_real_escape_string($conn, $selected_katastash);
            $selected_xrwma = mysqli_real_escape_string($conn, $selected_xrwma);
            $selected_eidos_mhxanhs = mysqli_real_escape_string($conn, $selected_eidos_mhxanhs);
            $price1 = mysqli_real_escape_string($conn, $price1);
            $price2 = mysqli_real_escape_string($conn, $price2);

            $kibhka_apo = mysqli_real_escape_string($conn, $kibhka_apo);
            $kibhka_eos = mysqli_real_escape_string($conn, $kibhka_eos);

            // Build WHERE clause for brand/model
            $whereParts = [];

            if ($selected_car !== '') {
                $whereParts[] = "marka = '$selected_car'";
            }

            if ($selected_model !== '') {
                $whereParts[] = "montelo = '$selected_model'";
            }

            if ($selected_katastash !==  ''){
                $whereParts[] = "katastash = '$selected_katastash'";
            }

            if ($selected_eidos_mhxanhs !==  ''){
                $whereParts[] = "eidos_mhxanhs = '$selected_eidos_mhxanhs'";
            }

            if ($selected_xrwma !==  ''){
                $whereParts[] = "xrwma = '$selected_xrwma'";
            }

            if (is_numeric($price1) && is_numeric($price2)) {
                $whereParts[] = "endiktikh_timh BETWEEN $price1 AND $price2";
            } elseif (is_numeric($price1)) {
                $whereParts[] = "endiktikh_timh >= $price1";
            } elseif (is_numeric($price2)) {
                $whereParts[] = "endiktikh_timh <= $price2";
            }

            if (is_numeric($kibhka_apo) && is_numeric($kibhka_eos)) {
                $whereParts[] = "kibhka BETWEEN $kibhka_apo AND $kibhka_eos";
            } elseif (is_numeric($kibhka_apo)) {
                $whereParts[] = "kibhka >= $kibhka_apo";
            } elseif (is_numeric($kibhka_eos)) {
                $whereParts[] = "kibhka <= $kibhka_eos";
            }

            $where = $whereParts ? implode(' AND ', $whereParts) : '1';
            ?>
            
            <div class="filter_block">
                <form method="post">
                    <!-- Car brands -->
                    <?php renderSelect(
                        'car',
                        'etairia',
                        'onoma',
                        'Μάρκα',
                        $selected_car,
                        '-- Όλες οι μάρκες --',
                        true
                    );
                    ?>
                    <br>
                    <!-- Models -->
                    <?php
                    $brandIds = select('id_etairias', 'etairia', "onoma = '$selected_car'");
                    $ids = array_map(fn($b) => $b['id_etairias'], $brandIds);
                    $idsList = "'" . implode("','", $ids) . "'";
                    ?>
                    <?php renderSelect(
                            'model',
                            'montelo',
                            'onomasia',
                            'Μοντέλο',
                            $selected_model,
                            '-- Όλα τα μοντέλα --',
                            true,
                            "id_etairias IN ($idsList)"
                            ); 
                            
                            renderSelect(
                                'katastash',
                                'autokinhto',
                                'katastash',
                                'Κατάσταση',
                                $selected_katastash,
                                '-- Όλες οι καταστάσεις --',
                                true
                            );

                            renderSelect(
                                'xrwma',
                                'autokinhto',
                                'xrwma',
                                'Χρωμα',
                                $selected_xrwma,
                                '-- Όλα τα χρωματα --',
                                true
                            );

                            renderSelect(
                                'eidos_mhxanhs',
                                'autokinhto',
                                'eidos_mhxanhs',
                                'Ειδος μηχανες',
                                $selected_eidos_mhxanhs,
                                '-- Όλες οι μηχανες --',
                                true
                            );
                        ?>
                    <input
                        type="text"
                        class="ui-input"
                        name="timh1"
                        placeholder="Τιμή από"
                        value="<?= htmlspecialchars($_POST['timh1'] ?? '') ?>">
                    <input
                        type="text"
                        class="ui-input"
                        name="timh2"
                        placeholder="Τιμή έως"
                        value="<?= htmlspecialchars($_POST['timh2'] ?? '') ?>">
                    <br>
                    <input
                        type="text"
                        class="ui-input"
                        name="kibhka_apo"
                        placeholder="Κηβικα από"
                        value="<?= htmlspecialchars($_POST['kibhka_apo'] ?? '') ?>">
                    <input
                        type="text"
                        class="ui-input"
                        name="kibhka_eos"
                        placeholder="Κηβικα έως"
                        value="<?= htmlspecialchars($_POST['kibhka_eos'] ?? '') ?>">
                    <button type="submit" class="ui-btn">Φιλτράρισμα</button>
                </form>
            </div>
        </div>
<!--=====================================================================================================-->
<!------------------------------------------------- TABLE ------------------------------------------------->
<!--=====================================================================================================-->
            <?php
            // Show table with combined filters
            ShowTable('Autokinhta_view', $where);
            ?>
        </div>

    </div>
</body>

</html>