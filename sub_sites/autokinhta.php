<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add'])){
        $VIN = trim($_POST["VIN"]);
        $xrwma = trim($_POST["xrwma"]);
        
        $montelo = trim($_POST["montelo"]);
        $res= select('id_montelou','montelo',"onomasia='$montelo'");

        $id_montelou= $res[0]['id_montelou'];
        $ari8mos_kinhthra=trim($_POST["ari8mos_kinhthra"]);
        $eidos_mhxanhs=trim($_POST["eidos_mhxanhs"]);

        $aitos_kataskebhs = trim($_POST["aitos_kataskebhs"]);
        $kibhka = trim($_POST["kibhka"]);
        $tansmission = trim($_POST["tansmission"]);
        $xhliometra = trim($_POST["xhliometra"]);

        $endictikh_timh =trim($_POST["endictikh_timh"]);
        $katastash =trim($_POST['katastash']);
        insert('Autokinhto',[$VIN, $id_montelou, $ari8mos_kinhthra, $aitos_kataskebhs, $eidos_mhxanhs, $kibhka, $tansmission, $xhliometra, $xrwma, $endictikh_timh, $katastash]);
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

<body >
    <a href="dashboard.php"><button>Back</button></a>
<div class="form-wrapper">

    <!-- Toggle Button -->
    <button class="toggle-btn" onclick="toggleForm()">➕ Προσθήκη Αυτοκινήτων</button>

    <!-- Hidden Form -->
    <div class="form-card" id="addCarForm">
        <h2>Προσθήκη Αυτοκινήτων</h2>

        <form method="POST">

            <input type="text" name="VIN" placeholder="VIN" required>
            <select id="cars" name="etairia">
                <option value="Μάρκα" >--Μάρκα-- </option> 
                <?php $cars = select("onoma", "etairia"); ?>
                <?php foreach ($cars as $car): ?>
                 <option value="<?= htmlspecialchars($car['onoma']) ?>">
                     <?= htmlspecialchars($car['onoma']) ?> </option> 
                     <?php endforeach; ?> 
                    
            </select> 
            <select id="cars" name="montelo">
                <option value="Μοντέλο" >--Μοντέλο-- </option> 
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
                <option >--Κατάσταση--</option>
                <option value="dia8eshmo">Διαθέσιμο</option>
                <option value="poulhmeno">Πουλημένο</option>
            </select>
            <button type="submit" name="add">Προσθήκη</button>

        </form>
    </div>

</div>

<script>
function toggleForm() {
    const form = document.getElementById("addCarForm");
    form.style.display = (form.style.display === "block") ? "none" : "block";
}
</script>


        <h1>Αυτοκίνητα</h1>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php 
                global $conn;

                // Read filters (single selection)
                $selected_car = $_POST['car'] ?? '';
                $selected_model = $_POST['model'] ?? '';

                // Read prices from POST
                $price1 = $_POST['timh1'] ?? '';
                $price2 = $_POST['timh2'] ?? '';

                // Escape inputs
                $selected_car = mysqli_real_escape_string($conn, $selected_car);
                $selected_model = mysqli_real_escape_string($conn, $selected_model);
                $price1 = mysqli_real_escape_string($conn, $price1);
                $price2 = mysqli_real_escape_string($conn, $price2);

                // Build WHERE clause for brand/model
                $whereParts = [];

                if ($selected_car !== '') {
                    $whereParts[] = "
                        montelo IN (
                            SELECT montelo.id_montelou
                            FROM montelo
                            INNER JOIN etairia ON montelo.id_etairias = etairia.id_etairias
                            WHERE etairia.onoma = '$selected_car'
                            " . ($selected_model !== '' ? "AND montelo.onomasia = '$selected_model'" : "") . "
                        )
                    ";
                }

                // Build WHERE clause for price
                if ($price1 !== '' && $price2 !== '') {
                    $whereParts[] = "endiktikh_timh BETWEEN $price1 AND $price2";
                } elseif ($price1 !== '') {
                    $whereParts[] = "endiktikh_timh >= $price1";
                } elseif ($price2 !== '') {
                    $whereParts[] = "endiktikh_timh <= $price2";
                }

                // Combine all WHERE conditions
                $where = !empty($whereParts) ? implode(' AND ', $whereParts) : '1';

                // Load models if a brand was selected
                $models = [];
                if ($selected_car !== '') {
                    $models = select(
                        "onomasia",
                        "montelo INNER JOIN etairia ON montelo.id_etairias = etairia.id_etairias",
                        "etairia.onoma = '$selected_car'"
                    );
                }

                // Show table with combined filters
                ShowTable('Autokinhta_view');
                ?>

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
                    ); ?>

                    <br><br>

                    <!-- Models -->
                    <?php if (!empty($selected_car)): ?>
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
                        ); ?>
                    <?php endif; ?>

                    <div class="ui-filter-wrapper">

    <input 
        type="text" 
        class="ui-input"
        name="timh1" 
        placeholder="Τιμή από" 
        value="<?= htmlspecialchars($_POST['timh1'] ?? '') ?>"
    >

    <input 
        type="text" 
        class="ui-input"
        name="timh2" 
        placeholder="Τιμή έως" 
        value="<?= htmlspecialchars($_POST['timh2'] ?? '') ?>"
    >

    <button type="submit" class="ui-btn">Φιλτράρισμα</button>

    </div>


                </form>



    </div>

</body>

</html>