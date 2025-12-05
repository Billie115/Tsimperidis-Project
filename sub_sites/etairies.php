<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $host = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "Antiprosopia";

    $conn = new mysqli($host, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Etairia";
    $result = $conn->query($sql);

    function select($columns, $tables, $where = "", $order = "", $limit = "", $offset = "") {
        global $conn;

        // Build SQL string
        $sql = "SELECT $columns FROM $tables";

        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        if (!empty($order)) {
            $sql .= " ORDER BY $order";
        }
        if (!empty($limit)) {
            $sql .= " LIMIT $limit";
            if (!empty($offset)) {
                $sql .= " OFFSET $offset";
            }
        }

        $result = $conn->query($sql);

        if (!$result) {
            die("SQL Error: " . $conn->error); // Show SQL errors for debugging
        }

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows; // returns an array of all rows (empty if none)
    }

    function insert($tables, $data) {
        global $conn;
        $sql = "INSERT INTO $tables VALUES '('.$data.')'";
        $result = $conn -> query($sql);
        if (!$result) {
            die("".$conn -> error);
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etairies</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link CSS -->
</head>


<body>
    <button onclick="history.back()" style="left: 0;">Back</button>
    <div>
        <h2>Λίστα Εταιριών</h2>

    <?php
    $rows = select("*", "Etairia"); // gets all rows
    ?>

    <?php if (!empty($rows)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <?php
                // Print headers dynamically from first row keys
                foreach (array_keys($rows[0]) as $col_name) {
                    echo "<th>" . htmlspecialchars($col_name) . "</th>";
                }
                ?>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <td><?php echo htmlspecialchars($cell); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>
    <button style="float: right;">Filter</button>
    </div>

</body>

</html>