<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD']=="POST"){
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
        
        <button type="submit">Προσθήκη</button>
            
         </form>
        </div>
    <div>
        <h1>Αυτοκίνητα</h1>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php filter('Autokinhto'); ?>
            </div>

            <div class="panel-content"></div>
    </div>

</body>

</html>