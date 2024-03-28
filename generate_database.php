<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $surveyDate = $_POST["survey_date"];
    $location = $_POST["location"];
    $surveyor = $_POST["surveyor"];
    
    // Check if fish arrays are set
    $speciesArray = isset($_POST["species"]) ? $_POST["species"] : [];
    $lengthArray = isset($_POST["length"]) ? $_POST["length"] : [];
    $weightArray = isset($_POST["weight"]) ? $_POST["weight"] : [];
    $colorArray = isset($_POST["color"]) ? $_POST["color"] : [];

    // Create SQLite database file
    $databaseFile = 'survey_database.sqlite';

    try {
        // Connect to SQLite database
        $pdo = new PDO("sqlite:$databaseFile");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create tables if they don't exist
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Survey (
                id INTEGER PRIMARY KEY,
                date TEXT,
                location TEXT,
                surveyor TEXT
            )
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Fish (
                id INTEGER PRIMARY KEY,
                species TEXT,
                length REAL,
                weight REAL,
                color TEXT
            )
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS SurveyFish (
                id INTEGER PRIMARY KEY,
                survey_id INTEGER,
                fish_id INTEGER,
                FOREIGN KEY(survey_id) REFERENCES Survey(id),
                FOREIGN KEY(fish_id) REFERENCES Fish(id)
            )
        ");

        // Insert survey data
        $stmt = $pdo->prepare("
            INSERT INTO Survey (date, location, surveyor)
            VALUES (:date, :location, :surveyor)
        ");
        $stmt->execute(array(
            ':date' => $surveyDate,
            ':location' => $location,
            ':surveyor' => $surveyor
        ));

        $surveyId = $pdo->lastInsertId();

        // Insert fish data and link survey and fish
        $stmt = $pdo->prepare("
            INSERT INTO Fish (species, length, weight, color)
            VALUES (:species, :length, :weight, :color)
        ");

        foreach ($speciesArray as $index => $species) {
            $stmt->execute(array(
                ':species' => $species,
                ':length' => $lengthArray[$index],
                ':weight' => $weightArray[$index],
                ':color' => $colorArray[$index]
            ));

            $fishId = $pdo->lastInsertId();

            // Link survey and fish
            $pdo->exec("
                INSERT INTO SurveyFish (survey_id, fish_id)
                VALUES ($surveyId, $fishId)
            ");
        }

        echo "Database file '$databaseFile' created successfully with data from the form.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
