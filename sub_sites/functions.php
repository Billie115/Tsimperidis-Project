<?php
    function select($columns, $tables, $where = "", $order = "", $limit = "", $offset = ""){
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

    function insert($table, $data)
    {
        global $conn;

       // $columns = implode(", ", array_keys($data));
        $values  = "'" . implode("', '", array_values($data)) . "'";

        $sql = "INSERT INTO $table  VALUES ($values)";

        if (!$conn->query($sql)) {
            die("SQL Insert Error: " . $conn->error);
    
        }
    }


    function delete($tables, $where){
        global $conn;
        $sql = "DELETE FROM $tables WHERE $where;";

        if (!$conn->query($sql)) {
            die("SQL Delete Error: " . $conn->error);
        }
    }

    function update($table, $data, $where) {
        global $conn;

        // $data should be an associative array: ["column1" => "value1", "column2" => "value2"]
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = '$value'";
        }
        $setString = implode(", ", $set);

        $sql = "UPDATE $table SET $setString WHERE $where";

        if (!$conn->query($sql)) {
            die("SQL Update Error: " . $conn->error);
        }
    }

    function filter($table) {
        global $conn; // if select() uses $conn

        // Get column names
        $columns = select(
            "COLUMN_NAME",
            "INFORMATION_SCHEMA.COLUMNS",
            "TABLE_SCHEMA = 'car_agency_db' AND TABLE_NAME = '$table'"
        );

        // If form submitted, get selected columns; otherwise show all
        $columns_to_show = isset($_POST['selected_columns']) && !empty($_POST['selected_columns'])
            ? $_POST['selected_columns']
            : array_column($columns, 'COLUMN_NAME');

        // Get data rows from the table
        $rows = select(implode(", ", $columns_to_show), $table);

        // Start output
        echo '<form method="post">';
        echo '<p>Select columns to display:</p>';

        foreach ($columns as $col) {
            $checked = in_array($col['COLUMN_NAME'], $columns_to_show) ? 'checked' : '';
            echo '<label style="margin-right:10px;">';
            echo '<input type="checkbox" name="selected_columns[]" value="' . $col['COLUMN_NAME'] . '" ' . $checked . '>';
            echo htmlspecialchars($col['COLUMN_NAME']);
            echo '</label>';
        }

        echo '<br><br><button type="submit">Filter</button>';
        echo '</form>';

        // Display the filtered table
        if (!empty($rows)) {
            echo '<table border="1" cellpadding="5" cellspacing="0" style="margin-top:20px;">';
            echo '<tr>';
            
            foreach ($columns_to_show as $col_name) {
                echo '<th>' . htmlspecialchars($col_name) . '</th>';
            }
            echo '</tr>';

            foreach ($rows as $row) {
                echo '<tr>';
                foreach ($columns_to_show as $col_name) {
                    echo '<td>' . htmlspecialchars($row[$col_name]) . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No records found.</p>';
        }
        
    }
?>