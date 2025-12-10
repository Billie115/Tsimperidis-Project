<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
      if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add'])){
        $afm_pelath = trim($_POST["afm_pelath"]);
        $onoma = trim($_POST["onoma"]);
        $epwnumo = trim($_POST["epwnumo"]);
        $email = trim($_POST["email"]);
        $thlefwno1 = trim($_POST["thlefwno1"]);
        $thlefwno2 = trim($_POST["thlefwno2"]);
        insert('pelates',[$afm_pelath, $onoma, $epwnumo, $email, $thlefwno1, $thlefwno2]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Πελάτες</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="dashboard.php"><button>Back</button></a>
    <div style="text-align: center;">
        
        <h1>Πελάτες</h1>
                <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Πελατών</h2>
        <form method="POST">
        <input type="text" name='afm_pelath' placeholder="Αριθμός Ταυτότητας" required>
        <input type="text" name='onoma' placeholder="Όνομα " required>
        <input type="text" name='epwnumo' placeholder="Επώνυμο" required>
        <input type="text" name='email' placeholder="Email" required>
        <input type="text" name='thlefwno1' placeholder="Τηλέφωνο 1" required>
        <input type="text" name='thlefwno2' placeholder="Τηλέφωνο 2">
        
        <button type="submit" name="add">Προσθήκη</button>
            
         </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <form method="post">

                    <input type="text" name="afm_pelath" placeholder="ΑΦΜ πελατη" value="<?= htmlspecialchars($_POST['id_etairias'] ?? '') ?>">
                    <input type="text" name="onoma" placeholder="Όνομα Πελατη" value="<?= htmlspecialchars($_POST['onoma'] ?? '') ?>">
                    <input type="text" name="epwnumo" placeholder="Επωνημο Πελατη" value="<?= htmlspecialchars($_POST['xwra'] ?? '') ?>">

                    <button type="submit">Αναζήτηση</button>
                </form>

                <?php
                    // Read filters
                    $afm = trim($_POST['afm_pelath'] ?? '');
                    $name = trim($_POST['onoma'] ?? '');
                    $surname = trim($_POST['epwnumo'] ?? '');

                    // Build WHERE
                    $whereParts = [];

                    if ($afm !== '') $whereParts[] = "afm_pelath LIKE '$afm%'";
                    if ($name !== '') $whereParts[] = "onoma LIKE '$name%'";
                    if ($surname !== '') $whereParts[] = "epwnumo LIKE '$surname%'";

                    $where = !empty($whereParts) ? implode(" AND ", $whereParts) : "1";

                    // Show table
                    ShowTable('pelates', $where);
                ?>
            </div>

            <div class="panel-content"></div>
    </div>

</body>

</html>