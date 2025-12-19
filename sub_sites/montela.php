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
    $id_montelou = trim($_POST["id_montelou"]);
    $etairia = trim($_POST["etairia"]);
    $res = select('id_etairias', 'etairia', "onoma='$etairia'");

    $id_etairias = $res[0]['id_etairias'];
    $onomasia = trim($_POST["onomasia"]);

    insert('Montelo', [$id_montelou, $onomasia, $id_etairias]);
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

<body>
    <!--======================================================================================================-->
    <!------------------------------------------------- INSERT ------------------------------------------------->
    <!--======================================================================================================-->
    <div>
        <div class="center_block">
            <h1>Μοντέλα</h1>
            <div class="insert_block">
                <h2>Προσθήκη Μοντέλο</h2>
                <form method="POST">
                    <input type="text" name="id_montelou" placeholder="Κωδικός μοντέλου" required>
                    <select id="cars" name="etairia">
                        <option value="Μοντέλο">--Εταιρία-- </option>
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
            <!--======================================================================================================-->
            <!------------------------------------------------- FILTER ------------------------------------------------->
            <!--======================================================================================================-->
            <div class="filter_block">
                <h2>Filters</h2>
                <div class="panel-header">
                    <?php
                    global $conn;

                    $onomasia    = $_POST['onomasia'] ?? '';
                    $id_montelou = $_POST['id_montelou'] ?? '';
                    $id_etairias = $_POST['id_etairias'] ?? '';


                    // Escape inputs
                    $onomasia = mysqli_real_escape_string($conn, $onomasia);
                    $id_montelou = mysqli_real_escape_string($conn, $id_montelou);
                    $id_etairias = mysqli_real_escape_string($conn, $id_etairias);

                    // Build WHERE clause for brand/model
                    $whereParts = [];

                    if ($onomasia !== '') {
                        $whereParts[] = "onomasia = '$onomasia'";
                    }

                    if ($id_montelou !== '') {
                        $whereParts[] = "id_montelou LIKE '$id_montelou%'";
                    }

                    if ($id_etairias !== '') {
                        $whereParts[] = "id_etairias LIKE '$id_etairias%'";
                    }

                    $where = $whereParts ? implode(' AND ', $whereParts) : '1';

                    ?>
                    <form method="post">
                        <!-- Car brands -->
                        <?php renderSelect(
                            'onomasia',
                            'montelo',
                            'onomasia',
                            'Montelo',
                            $onomasia,
                            '-- Όλα τα μοντελα --',
                            true
                        );
                        ?>
                        <input
                            type="text"
                            class="ui-input"
                            name="id_montelou"
                            placeholder="id μοντελου"
                            value="<?= htmlspecialchars($_POST['id_montelou'] ?? '') ?>">
                        <input
                            type="text"
                            class="ui-input"
                            name="id_etairias"
                            placeholder="Eταιρια"
                            value="<?= htmlspecialchars($_POST['id_etairias'] ?? '') ?>">
                        <button type="submit" class="ui-btn">Φιλτράρισμα</button>
                    </form>
                </div>
            </div>
            <!--=====================================================================================================-->
            <!------------------------------------------------- TABLE ------------------------------------------------->
            <!--=====================================================================================================-->
            <div class="table_block">
                <?php
                // Show table with combined filters
                ShowTable('montelo', $where);
                ?>

            </div>
        </div>
    </div>
</body>

</html>