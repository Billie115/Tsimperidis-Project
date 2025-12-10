<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Wild Theme Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <title>Κεντρική Σελίδα</title>
</head>

<body>

<header>
    <div style="text-align: right; padding: 20px;">
        <a href="../index.php">
            <button style="font-size: 18px;">Log-out</button>
        </a>
    </div>

    <div id="heading-div">
        <h1>Αντιπροσωπία Αυτοκινήτων</h1>
    </div>
</header>

<main>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 20px;">

        <div class="menu-items" id="etairia-div" onclick="window.location.href='etairies.php'">
            <i class="material-icons" style="font-size: 45px;">apartment</i>
            <h2>Εταιρίες</h2>
            <p>Εταιρίες που συνεργαζόμαστε.</p>
        </div>

        <div class="menu-items" id="autokinita-div" onclick="window.location.href='autokinhta.php'">
            <i class="material-icons" style="font-size: 45px;">directions_car</i>
            <h2>Αυτοκίνητα</h2>
            <p>Αυτοκίνητα της αντιπροσωπίας.</p>
        </div>

        <div class="menu-items" id="pelates-div" onclick="window.location.href='pelates.php'">
            <i class="material-icons" style="font-size: 45px;">group</i>
            <h2>Πελάτες</h2>
            <p>Οι πελάτες τις αντιπροσωπίας μας.</p>
        </div>

        <div class="menu-items" id="poliseis-div" onclick="window.location.href='pwlhseis.php'">
            <i class="material-icons" style="font-size: 45px;">account_balance</i>
            <h2>Πωλήσεις</h2>
            <p>Πωλήσεις της επιχείρησης.</p>
        </div>

        <div class="menu-items" id="syntirisi-div" onclick="window.location.href='sunthrish.php'">
            <i class="material-icons" style="font-size: 45px;">car_repair</i>
            <h2>Συντήρηση</h2>
            <p>Εργασίες συντήρησης.</p>
        </div>

        <div class="menu-items" id="mixanikoi-div" onclick="window.location.href='mhxanikoi.php'">
            <i class="material-icons" style="font-size: 45px;">engineering</i>
            <h2>Μηχανικοί</h2>
            <p>Το τεχνικό προσωπικό.</p>
        </div>

        <div class="menu-items" id="pwlhtes-div" onclick="window.location.href='pwlhtes.php'">
            <i class="material-icons" style="font-size: 45px;">badge</i>
            <h2>Πωλητές</h2>
            <p>Υπάλληλοι πωλήσεων.</p>
        </div>

    </div>
</main>

<footer>
    Developed by ©KavalaCore 2025
</footer>

</body>
</html>
