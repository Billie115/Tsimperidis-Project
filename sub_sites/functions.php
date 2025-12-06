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

        $columns = implode(", ", array_keys($data));
        $values  = "'" . implode("', '", array_values($data)) . "'";

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

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

?>