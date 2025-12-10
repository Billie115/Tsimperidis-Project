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
        $xroma = trim($_POST["xroma"]);
        $etos_agoras = trim($_POST["etos_agoras"]);
        $modelo = trim($_POST["modelo"]);
        $etos_kataskeuis = trim($_POST["etos_kataskeuis"]);
        $endictikh_timh =trim($_POST["endictikh_timh"]);
        insert('Autokinhto',[$VIN, $xroma, $etos_agoras, $modelo, $etos_kataskeuis]);
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αυτοκίνητα</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body >
    <a href="dashboard.php"><button>Back</button></a>
<div style="text-align: center;">
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Αυτοκινήτων</h2>
        <form method="POST">
        <input type="text" name='VIN' placeholder="VIN" required>
        <input type="text" name='xroma' placeholder="Χρόμα" required>
        <input type="number" name='etos_agoras' placeholder="Έτος αγοράς" required>
        <input type="text" name='modelo' placeholder="Μοντέλο " required>
        <input type="number" name="etos_kataskeuis" placeholder="Έτος κατασκευής" required>
        <input type="number" name="endictikh_timh" placeholder="Ενδικτική τιμή" required>
        
        <button type="submit" name="add">Προσθήκη</button>
            
         </form>
        </div>
    <div>
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
                ShowTable('autokinhto', $where);
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

                    <br>
                    <input type="text" name="timh1" placeholder="Τιμή από" value="<?= htmlspecialchars($_POST['timh1'] ?? '') ?>"><br>
                    <input type="text" name="timh2" placeholder="Τιμή έως" value="<?= htmlspecialchars($_POST['timh2'] ?? '') ?>"><br>
                    <button type="submit">Φιλτράρισμα</button>

                </form>



    </div>

</body>

</html>