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
    $id_suntirishs = trim($_POST["id_suntirishs"]);
    $hm_rant = trim($_POST["hm_rant"]);
    $perigrafi = trim($_POST["perigrafi"]);
    $id_upallhlou = trim($_POST["id_upallhlou"]);
    $pinakida_kukloforias = trim($_POST["pinakida_kukloforias"]);
    $katastash = trim($_POST["katastash"]);
    insert('syntirish', [$id_suntirishs, $hm_rant, $perigrafi, $id_upallhlou, $pinakida_kukloforias, $katastash]);
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
    <!--======================================================================================================-->
    <!------------------------------------------------- INSERT ------------------------------------------------->
    <!--======================================================================================================-->
    <div>
        <div class="center_block">
            <h1>Συντιρίσεις</h1>
            <div class="insert_block">
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
            <!--======================================================================================================-->
            <!------------------------------------------------- FILTER ------------------------------------------------->
            <!--======================================================================================================-->
            <div class="filter_block">
                <h2>Filters</h2>
                <form method="POST" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center;">


                    <input type="text" name="suntirishs" placeholder="id_suntirishs">
                    <p>Από: <input id="apo" name="apo_rand" type="date"></p>
                    <p>Εώς: <input id="eos" name="eos_rand" type="date"></p>
                    <input type="text" name="id_upallhlou" placeholder="id_upallhlou">
                    <input type="text" name="pinakida_kukloforias" placeholder="pinakida_kukloforias">
                    <?php
                    global $conn;
                    // Read user selection (if the form was submitted)
                    $selected_katastasi = $_POST['Κατασταση'] ?? '';
                    $selected_katastasi = mysqli_real_escape_string($conn, $selected_katastasi);
                    // Now render the dropdown dynamically
                    renderSelect(
                        'Κατασταση',
                        '(SELECT DISTINCT katastash FROM syntirish) AS t',
                        'katastash',
                        'Κατασταση',
                        $selected_katastasi,
                        '--Ολες οι κατηγοριες--'
                    );
                    ?>
                    <button type="submit">Αναζητηση</button>
                </form>
            </div>
        </div>
        <!--=====================================================================================================-->
        <!------------------------------------------------- TABLE ------------------------------------------------->
        <!--=====================================================================================================-->
        <div class="table_block">
            <?php
            global $conn;
            // --- Read form inputs ---
            $id_sunt = trim($_POST['suntirishs'] ?? '');
            $apo_hm  = trim($_POST['apo_rand'] ?? '');
            $eos_hm  = trim($_POST['eos_rand'] ?? '');
            $id_up   = trim($_POST['id_upallhlou'] ?? '');
            $pinakida = trim($_POST['pinakida_kukloforias'] ?? '');
            $katastasi = trim($_POST['Κατασταση'] ?? '');
            // Escape string inputs
            $id_sunt   = $conn->real_escape_string($id_sunt);
            $id_up     = $conn->real_escape_string($id_up);
            $pinakida  = $conn->real_escape_string($pinakida);
            $katastasi = $conn->real_escape_string($katastasi);
            $apo_hm    = $conn->real_escape_string($apo_hm);
            $eos_hm    = $conn->real_escape_string($eos_hm);
            $whereParts = [];
            // Filter by id_syntirishs
            if ($id_sunt !== '') {
                $whereParts[] = "id_syntirishs LIKE '{$id_sunt}%'";
            }
            // Date filter (column guessed: hmerominia)
            if ($apo_hm !== '' && $eos_hm !== '') {
                $whereParts[] = "hm_rant BETWEEN '$apo_hm' AND '$eos_hm'";
            } elseif ($apo_hm !== '') {
                $whereParts[] = "hm_rant >= '$apo_hm'";
            } elseif ($eos_hm !== '') {
                $whereParts[] = "hm_rant <= '$eos_hm'";
            }
            // Filter by employee id
            if ($id_up !== '') {
                $whereParts[] = "id_upallhlou = '$id_up'";
            }
            // Filter by plate number
            if ($pinakida !== '') {
                $whereParts[] = "pinakida_kukloforias = '$pinakida'";
            }
            // Filter by katastasi
            if ($katastasi !== '') {
                $whereParts[] = "katastash = '$katastasi'";
            }
            // Final WHERE
            $where = !empty($whereParts) ? implode(' AND ', $whereParts) : '1';
            // Show results
            showTable('syntirish', $where);
            ?>
        </div>
        <!--======================================================================================================-->
        <!------------------------------------------------- DELETE ------------------------------------------------->
        <!--======================================================================================================-->
        <div class="center_block">
            <div class="delete_block">
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
        </div>
    </div>
</body>

</html>