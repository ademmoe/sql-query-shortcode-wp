function shortcode_sqltable() {
    ob_start();

    // Database connection settings
    $host = "localhost";      // Change if needed
    $dbname = "databasename"; // Change to your DB name
    $username = "your_username";
    $password = "your_password";

    try {
        // Create la connection
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

        // SQL query to DB
        $sql = "SELECT id, name, betrag, grund FROM bestand";


        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Lfd. Nr</th><th>Name</th><th>Betrag</th><th>Grund</th></tr>"; // Change the name of the columns, remove or add more columns

        foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['betrag']) . "</td>";
            echo "<td>" . htmlspecialchars($row['grund']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";

    } catch (PDOException $e) {
        echo "<p style='color:red;'>Error whilst connecting to Database: " . htmlspecialchars($e->getMessage()) . "</p>";
    }

    return ob_get_clean(); // Return output
}
add_shortcode('sqltable', 'shortcode_sqltable');
