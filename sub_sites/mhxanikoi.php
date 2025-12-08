<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
      if($_SERVER['REQUEST_METHOD']=="POST"){
    $kodikos_mixanikou = trim($_POST["kodikos_mixanikou"]);
    $onoma_mixanikou = trim($_POST["onoma_mixanikou"]);
    $eponimo_mixanikou = trim($_POST["eponimo_mixanikou"]);
    $Hm_pros = trim($_POST["Hm-pros"]);
        insert('Michanikos',[$kodikos_mixanikou, $onoma_mixanikou, $eponimo_mixanikou, $Hm_pros]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Μηχανικοί</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <button onclick="history.back()" style="left: 0;">Back</button>
    <div>
        <h1>Μηχανικοί</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Εταιριών</h2>
        <form method="POST">
        <input type="text" name='kodikos_mixanikou' placeholder="Κωδικός " required>
        <input type="text" name='onoma_mixanikou' placeholder="Όνομα Μηχανικού" required>
        <input type="text" name='eponimo_mixanikou' placeholder="Επώνυμο Μηχανικού" required>
        <div>
        <label for="Hm-pros">Ημερομηνία Προσλυψης:</label>
        <input type="date" name='Hm-pros' required>
        </div>
        <button type="submit">Προσθήκη</button>
            
         </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php filter('Michanikos'); ?>
            </div>

            <div class="panel-content"></div>
    </div>

</body>

</html>