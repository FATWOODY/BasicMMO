<?php
if ($cron == true) {
    $dir = '../';
}
require $dir . 'includes/config.php';

class MySQL {
    private $conn;

    // Connect to the database
    function connect() {
        global $DB_INFO;

        // Establishing the connection using mysqli
        $this->conn = new mysqli($DB_INFO['hostname'], $DB_INFO['username'], $DB_INFO['password'], $DB_INFO['database']);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Execute a query
    function query($query) {
        return $this->conn->query($query);
    }

    // Prepare a statement
    function prepare($query) {
        return $this->conn->prepare($query);
    }

    // Fetch a result as an associative array
    function fetch($result) {
        return $result->fetch_assoc();
    }

    // Get the number of rows from a result
    function num($result) {
        return $result->num_rows;
    }

    // Get the number of affected rows
    function affected() {
        return $this->conn->affected_rows;
    }

    // Close the connection
    function close() {
        return $this->conn->close();
    }
}

$db = new MySQL();
$db->connect();

$mintime15 = time() - (60 * 15);
$timeminus24 = time() - (60 * 60 * 24);

$gamedate = date("d-m-Y - H:i:s");

$result = $db->query("SELECT * FROM settings");
while ($rowz = $db->fetch($result)) {
    $x1 = $rowz['sName'];
    $x2 = $rowz['sValue'];
    $SETTINGS[$x1] = $x2;
}

require $dir . 'includes/functions.php';
?>
