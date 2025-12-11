<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add'])){
        $id_montelou=trim($_POST["id_montelou"]);
        $etairia = trim($_POST["etairia"]);
        $res= select('id_etairias','etairia',"onoma='$etairia'");

        $id_etairias= $res[0]['id_etairias'];
        $onomasia=trim($_POST["onomasia"]);
       
        insert('Montelo',[$id_montelou, $onomasia, $id_etairias]);
    }


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Μοντέλα</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body >
        <a href="dashboard.php"><button>Back</button></a>
<!--======================================================================================================--> 
<!------------------------------------------------- INSERT ------------------------------------------------->
<!--======================================================================================================-->
        <div class="center_block">
            <h1>Μοντέλα</h1>
            <div class="insert_block">
                <h2>Προσθήκη Μοντέλο</h2>
                <form method="POST">
                    <input type="text" name="id_montelou" placeholder="Κωδικός μοντέλου" required>
                    <select id="cars" name="etairia">
                        <option value="Μοντέλο" >--Εταιρία-- </option> 
                        <?php $cars = select("onoma", "etairia"); ?>
                        <?php foreach ($cars as $car): ?>
                        <option value="<?= htmlspecialchars($car['onoma']) ?>">
                            <?= htmlspecialchars($car['onoma']) ?> 
                        </option> 
                        <?php endforeach; ?> 
                    </select> 
                    <input type="text" name="onomasia" placeholder="Ονομασία Μοντέλου" required>
                    <button type="submit" name="add">Προσθήκη</button>
                </form>
            </div>
        </div>
<!--=====================================================================================================-->
<!------------------------------------------------- TABLE ------------------------------------------------->
<!--=====================================================================================================-->
        <div class="table_block">
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
                ShowTable('Montelo');
                ?>
<!--======================================================================================================-->
<!------------------------------------------------- FILTER ------------------------------------------------->
<!--======================================================================================================-->
                <div>
                    <form method="post">

                        <!-- Car brands -->
                        <?php renderSelect(
                            'car', 
                            'etairia', 
                            'onoma', 
                            'Μάρκα', 
                            $selected_car, 
                            '-- Όλες οι μάρκες --', 
                            true); 
                        ?>
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
                                "id_etairias IN ($idsList)"); 
                            ?>
                        <?php endif; ?>

                        <div class="ui-filter-wrapper">
                            <button type="submit" class="ui-btn">Φιλτράρισμα</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>