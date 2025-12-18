<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("temporarydb.php");
include("../sidebar.php");
/* FETCH DATA FOR LINE CHART */
$months = [];
$counts = [];

$sql = "SELECT MONTHNAME(hm_ago) AS Month_name,
 COUNT(*) AS total 
 FROM poliseis
 GROUP BY MONTH(hm_ago)";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $months[] = $row['Month_name'];
    $counts[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .chart-container {
            width: 50vw;
            height: 50vh;
        }

        @media (max-width:768px) {
            .chart-container {
                width: 80vw;
                height: 40vw;
            }
        }
    </style>
</head>

<body style="flex-wrap: nowrap; margin-top:20px;">
    <div style="display: flex; flex-wrap:wrap; gap:30px; margin-bottom: 100px; ">
        <div id="sales_chart-div">
            <div class="chart-container">
                <canvas id="carsLineChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('carsLineChart').getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?= json_encode($months) ?>,
                        datasets: [{
                            label: 'Σύνολο Αυτοκινήτων',
                            data: <?= json_encode($counts) ?>,
                            fill: false,
                            borderWidth: 2,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
        <div style="display: flex; flex-direction:column; border:1px solid black; padding:10px; height: 250px; border-radius:10px; margin-left:2vw">
            <h3>Αυτοκίνητα</h3>

            <div class="autokinhta_num-div">
                <?php
                // Run query
                $sql = "SELECT COUNT(*) AS diatheshma_num FROM autokinhto WHERE katastash='dia8eshmo'";
                $result = $conn->query($sql);

                // Fetch the single row
                if ($result) {
                    $row = $result->fetch_assoc();
                    $diatheshmo = $row['diatheshma_num'];
                } else {
                    $diatheshmo = 0; // fallback
                }

                // Display the count
                echo "<h3>$diatheshmo</h3>";
                ?>
                <p style="margin-left:10px;">Διαθέσιμα</p>
            </div>

            <div class="autokinhta_num-div">
                <?php
                // Run query
                $sql = "SELECT COUNT(*) AS poulhmena_num FROM autokinhto WHERE katastash='poulhmeno'";
                $result = $conn->query($sql);

                // Fetch the single row
                if ($result) {
                    $row = $result->fetch_assoc();
                    $poulhmeno = $row['poulhmena_num'];
                } else {
                    $poulhmeno = 0; // fallback
                }

                // Display the count
                echo "<h3>$diatheshmo</h3>";
                ?>
                <p style="margin-left: 10px;">Πουλημένα</p>

            </div>
        </div><br>
        <div style="border: 1px solid black; border-radius:10px; padding:10px;display:flex;height:150px; margin-left:1vw; overflow-x:auto; overflow-y: hidden;">
            <h3>Συντήρηση</h3>
            <div class="sunthrish_num-div">
                <div>
                    <?php
                    // Run query
                    $sql = "SELECT COUNT(*) AS oloklhrw8hke_num FROM syntirish WHERE katastash='oloklhrw8hke'";
                    $result = $conn->query($sql);

                    // Fetch the single row
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $oloklhrw8hke = $row['oloklhrw8hke_num'];
                    } else {
                        $oloklhrw8hke = 0; // fallback
                    }

                    // Display the count
                    echo "<h3>$oloklhrw8hke</h3>";
                    ?>
                    <p style="margin-left: 10px;">Ολοκληρώθηκε</p>

                </div>
            </div>
            <div class="sunthrish_num-div">
                <div>
                    <?php
                    // Run query
                    $sql = "SELECT COUNT(*) AS ekremei_num FROM syntirish WHERE katastash='ekremei'";
                    $result = $conn->query($sql);

                    // Fetch the single row
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $ekremei = $row['ekremei_num'];
                    } else {
                        $ekremei = 0; // fallback
                    }

                    // Display the count
                    echo "<h3>$ekremei</h3>";
                    ?>
                    <p style="margin-left: 10px;">Εκρεμεί</p>

                </div>
            </div>
            <div class="sunthrish_num-div">
                <div>
                    <?php
                    // Run query
                    $sql = "SELECT COUNT(*) AS akurw8hke_num FROM syntirish WHERE katastash='akurw8hke'";
                    $result = $conn->query($sql);

                    // Fetch the single row
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $akurw8hke = $row['akurw8hke_num'];
                    } else {
                        $diatheshmo = 0; // fallback
                    }

                    // Display the count
                    echo "<h3>$akurw8hke</h3>";
                    ?>
                    <p style="margin-left: 10px;">Ακυρώθηκε</p>

                </div>
            </div>
        </div>

    </div>
</body>

</html>