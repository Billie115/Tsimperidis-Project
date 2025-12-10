<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <title>Κεντρική Σελίδα</title>
</head>

<header>
    <a href="../index.php"><button>Log-out</button></a>
    <div id="heading-div">
        <h1 style="font-size:x-large">Αντιπροσωπία Αυτοκινήτων</h1>
    </div><br>
</header>
<main>

    <body>
        <div style="display: flex; flex-wrap:wrap; align-content:center; justify-content:center; gap:10px">
            <div class="menu-items" onclick="window.location.href='etairies.php'" id="etairia-div">
                <i class="material-icons" style="font-size: 35px;">apartment</i>
                <h2 style="margin-top:-3px ;">Εταιρίες </h2>
                <p>Εταιρίες που συνεργαζόμαστε.</p>
            </div>
            <div class="menu-items" id="autokinita-div" onclick="window.location.href='autokinhta.php'">
                <i class="material-icons" style="font-size: 35px;">directions_car</i>
                <h2 style="margin-top:-3px ;">Αυτοκίνητα</h2>
                <p>Αυτοκίνητα της αντιπροσωπίας.</p>
            </div>
            <div class="menu-items" id="pelates-div" onclick="window.location.href='pelates.php'">
                <i class="material-icons" style="font-size: 35px;">group</i>
                <h2 style="margin-top:-3px ;">Πελάτες</h2>
                <p>Οι πελάτες τις αντιπροσωπίας μας.</p>
            </div>
            <div class="menu-items" id="poliseis-div" onclick="window.location.href='pwlhseis.php'">
                <i class="material-icons" style="font-size: 35px;">account_balance</i>
                <h2 style="margin-top:-3px ;">Πωλήσεις</h2>
                <p>Πωλήσεις της επιχείρησης μας.</p>
            </div>
            <div class="menu-items" id="syntirisi-div" onclick="window.location.href='sunthrish.php'">
                <i class="material-icons" style="font-size: 35px;">car_repair</i>
                <h2 style="margin-top:-3px ;">Συντήριση</h2>
                <p>Πωλήσεις της επιχείρησης μας.</p>
            </div>
        
            <div class="menu-items" id="pwlhtes-div" onclick="window.location.href='upallhloi.php'">
                <i class="material-icons" style="font-size: 35px;">badge</i>
                <h2 style="margin-top:-3px ;">Υπάλληλοι</h2>
                <p>Υπάλληλοι Αντιπρωσοπίας</p>
            </div>
        </div>
    </body>
</main>
<footer>
    Developed by ©KavalaCore 2025
</footer>

</html>