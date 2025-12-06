<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
    
      if($_SERVER['REQUEST_METHOD']=="POST"){
    $kodikos_ypallhlou = trim($_POST["kodikos_ypallhlou"]);
    $onoma_ypallhlou = trim($_POST["onoma_ypallhlou"]);
    $eponimo_ypallhlou = trim($_POST["eponimo_ypallhlou"]);
    $Hm_pros = trim($_POST["Hm-pros"]);
        insert('Politis',[$kodikos_ypallhlou, $onoma_ypallhlou, $eponimo_ypallhlou, $Hm_pros]);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Πωλητές</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
        <a href="dashboard.php"><button>Back</button></a>

<div>
        <h1>Πωλητές</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Εταιριών</h2>
        <form method="POST">
        <input type="text" name='kodikos_ypallhlou' placeholder="Κωδικός " required>
        <input type="text" name='onoma_ypallhlou' placeholder="Όνομα Υπαλλήλου" required>
        <input type="text" name='eponimo_ypallhlou' placeholder="Επώνυμο Υπαλλήλου" required>
        <div>
        <label for="Hm-pros">Ημερομηνία Προσλυψης:</label>
        <input type="date" name='Hm-pros' required>
        </div>
        <button type="submit">Προσθήκη</button>
            
         </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php filter('Politis'); ?>
            </div>

            <div class="panel-content"></div>
    </div>

</body>

</html>