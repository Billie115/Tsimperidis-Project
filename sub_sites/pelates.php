<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
      if($_SERVER['REQUEST_METHOD']=="POST"){
    $AT = trim($_POST["AT"]);
    $onoma_pelati = trim($_POST["onoma_pelati"]);
    $eponimo_pelati = trim($_POST["eponimo_pelati"]);
        insert('Pelatis',[$AT, $onoma_pelati, $eponimo_pelati]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Πελάτες</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <a href="dashboard.php"><button>Back</button></a>
    <div style="text-align: center;">
        
        <h1>Πελάτες</h1>
                <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Πελατών</h2>
        <form method="POST">
        <input type="text" name='AT' placeholder="Αριθμός Ταυτότητας" required>
        <input type="text" name='onoma_pelati' placeholder="Όνομα " required>
        <input type="text" name='eponimo_pelati' placeholder="Επώνυμο" required>
        
        <button type="submit">Προσθήκη</button>
            
         </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php filter('Pelatis'); ?>
            </div>

            <div class="panel-content"></div>
    </div>

</body>

</html>