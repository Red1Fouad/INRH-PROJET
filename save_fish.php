<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $surveyDate = $_POST["survey_date"];
    $location = $_POST["location"];
    $surveyor = $_POST["surveyor"];
    
    // Check if fish arrays are set and convert them to arrays if necessary
    $speciesArray = isset($_POST["species"]) ? (array)$_POST["species"] : [];
    $lengthArray = isset($_POST["length"]) ? (array)$_POST["length"] : [];
    $weightArray = isset($_POST["weight"]) ? (array)$_POST["weight"] : [];
    $colorArray = isset($_POST["color"]) ? (array)$_POST["color"] : [];


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

        // Check if the survey already exists
        $stmt = $pdo->prepare("SELECT id FROM Survey WHERE date = :date AND location = :location AND surveyor = :surveyor");
        $stmt->execute(array(':date' => $surveyDate, ':location' => $location, ':surveyor' => $surveyor));
        $existingSurvey = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingSurvey) {
            // Survey doesn't exist, insert it
            $stmt = $pdo->prepare("INSERT INTO Survey (date, location, surveyor) VALUES (:date, :location, :surveyor)");
            $stmt->execute(array(':date' => $surveyDate, ':location' => $location, ':surveyor' => $surveyor));

            // Get the survey ID
            $surveyId = $pdo->lastInsertId();
        } else {
            // Survey already exists, use its ID
            $surveyId = $existingSurvey['id'];
        }

        // Insert fish data and link survey and fish
        $stmt = $pdo->prepare("
            INSERT INTO Fish (species, length, weight, color)
            VALUES (:species, :length, :weight, :color)
        ");

        // Iterate over fish arrays
        $totalFish = count($speciesArray);
        for ($i = 0; $i < $totalFish; $i++) {
            $stmt->execute(array(
                ':species' => $speciesArray[$i],
                ':length' => $lengthArray[$i],
                ':weight' => $weightArray[$i],
                ':color' => $colorArray[$i]
            ));

            $fishId = $pdo->lastInsertId();

            // Link survey and fish
            $pdo->exec("
                INSERT INTO SurveyFish (survey_id, fish_id)
                VALUES ($surveyId, $fishId)
            ");
        }

        echo "Database file '$databaseFile' updated successfully with data from the form.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

