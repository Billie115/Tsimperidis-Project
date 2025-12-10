<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
    include("temporarydb.php");
    include("functions.php");
      if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add'])){
        $id_suntirishs = trim($_POST["id_suntirishs"]);
        $hm_rant = trim($_POST["hm_rant"]);
        $perigrafi = trim($_POST["perigrafi"]);
        $id_upallhlou = trim($_POST["id_upallhlou"]);
        $pinakida_kukloforias = trim($_POST["pinakida_kukloforias"]);
        $katastash = trim($_POST["katastash"]);
        insert('syntirish',[$id_suntirishs, $hm_rant, $perigrafi, $id_upallhlou, $pinakida_kukloforias, $katastash]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Συντιρίσεις</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="dashboard.php"><button>Back</button></a>
    <div style="text-align: center;">
        
        <h1>Συντιρίσεις</h1>
        <div style="border: 1px solid black; padding:10px; border-radius:10px; width:90%; justify-self:center">
            <h2>Προσθήκη Συντίρισης</h2>
            <form method="POST">
                <input type="text" name='id_suntirishs' placeholder="Κωδικός Συντίρισης" required>
                <input type="date" name='hm_rant' placeholder="Ημερομηνία Συντίρισης" required>
                <input type="text" name='perigrafi' placeholder="Περιγραφή" required>
                <input type="text" name='id_upallhlou' placeholder="Κωδικός Υπαλλήλου" required>
                <input type="text" name='pinakida_kukloforias' placeholder="Πινακίδα Κυκλοφορίας" required>
                <select name="katastash">
                    <option value="akurw8hke">akurw8hke</option>
                    <option value="oloklhrw8hke">oloklhrw8hke</option>
                    <option value="ekremh">ekremh</option>
                </select>
                <button type="submit" name="add">Προσθήκη</button>
            </form>
        </div>
        <div id="filterPanel" class="filter-panel">
            <div class="panel-header">
                <?php ShowTable('syntirish') ?>
            </div>

            <div class="panel-content"></div>
        </div>
        <h1>Delete</h1>
            <form method="post">
                <?php $cars = select("id_suntirishs", "syntirish"); ?>

                <select id="cars" name="car">
                    <?php foreach ($cars as $car): ?>
                        <option value="<?= htmlspecialchars($car['id_suntirishs']) ?>">
                            <?= htmlspecialchars($car['id_suntirishs']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="delete" onclick="setTimeout(() => location.reload(true), 50);">Delete</button>
            </form>

            <?php
                if (isset($_POST['delete'])) {
                    $name = trim($_POST['car']); // the selected item

                    // safer delete using prepared statement
                    $stmt = $conn->prepare("DELETE FROM syntirish WHERE id_suntirishs = ?");
                    $stmt->bind_param("s", $name);
                    $stmt->execute();
                    $stmt->close();
                    echo "Deleted: " . htmlspecialchars($name);
                }
            ?>
    </div>
</body>

</html>