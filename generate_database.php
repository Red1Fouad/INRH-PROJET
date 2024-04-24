<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $surveyDate = $_POST["date"];
    $port = $_POST["port"];
    $enqueteur = isset($_POST["enqueteur"]) ? $_POST["enqueteur"] : "";
    $entreprise = $_POST["entreprise"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $qualite = $_POST["qualite"];
    $duree = $_POST["duree"];

    // Table 1 answers
    $table1Answers = $_POST["table1_answers"];

    // Table 2 answers
    $table2Answers = $_POST["table2_answers"];

    // Clients
    $clients = isset($_POST["clients"]) ? $_POST["clients"] : [];
    $autresClients = isset($_POST["autres_clients"]) ? $_POST["autres_clients"] : "";

    // Fish count
    $fishCount = $_POST["fishCount"];

    // Create SQLite database file
    $databaseFile = 'database.sqlite';

    try {
        // Connect to SQLite database
        $pdo = new PDO("sqlite:$databaseFile");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create tables if they don't exist
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Survey (
                id INTEGER PRIMARY KEY,
                date TEXT,
                port TEXT,
                enqueteur TEXT,
                entreprise TEXT,
                adresse TEXT,
                telephone TEXT,
                qualite TEXT,
                duree TEXT
            )
        ");
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Table1Answers (
                id INTEGER PRIMARY KEY,
                survey_id INTEGER,
                question TEXT,
                answer TEXT,
                FOREIGN KEY(survey_id) REFERENCES Survey(id)
            )
        ");
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Table2Answers (
                id INTEGER PRIMARY KEY,
                survey_id INTEGER,
                question TEXT,
                answer TEXT,
                FOREIGN KEY(survey_id) REFERENCES Survey(id)
            )
        ");
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Clients (
                id INTEGER PRIMARY KEY,
                survey_id INTEGER,
                client TEXT,
                FOREIGN KEY(survey_id) REFERENCES Survey(id)
            )
        ");
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS Fish (
                id INTEGER PRIMARY KEY,
                survey_id INTEGER,
                species TEXT,
                processing TEXT,
                measurement_type TEXT,
                measurement_value REAL
            )
        ");
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS FishCategory (
                id INTEGER PRIMARY KEY,
                fish_id INTEGER,
                category TEXT,
                FOREIGN KEY(fish_id) REFERENCES Fish(id)
            )
        ");

        // Insert survey data
        $stmt = $pdo->prepare("
            INSERT INTO Survey (date, port, enqueteur, entreprise, adresse, telephone, qualite, duree)
            VALUES (:date, :port, :enqueteur, :entreprise, :adresse, :telephone, :qualite, :duree)
        ");
        $stmt->execute(array(
            ':date' => $surveyDate,
            ':port' => $port,
            ':enqueteur' => $enqueteur,
            ':entreprise' => $entreprise,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':qualite' => $qualite,
            ':duree' => $duree
        ));
        $surveyId = $pdo->lastInsertId();

        // Insert Table 1 answers
        foreach ($table1Answers as $question => $answer) {
            $stmt = $pdo->prepare("
                INSERT INTO Table1Answers (survey_id, question, answer)
                VALUES (:survey_id, :question, :answer)
            ");
            $stmt->execute(array(
                ':survey_id' => $surveyId,
                ':question' => $question,
                ':answer' => $answer
            ));
        }

        // Insert Table 2 answers
        foreach ($table2Answers as $question => $answer) {
            $stmt = $pdo->prepare("
                INSERT INTO Table2Answers (survey_id, question, answer)
                VALUES (:survey_id, :question, :answer)
            ");
            $stmt->execute(array(
                ':survey_id' => $surveyId,
                ':question' => $question,
                ':answer' => $answer
            ));
        }

        // Insert clients
        $stmt = $pdo->prepare("
            INSERT INTO Clients (survey_id, client)
            VALUES (:survey_id, :client)
        ");
        foreach ($clients as $client) {
            $stmt->execute(array(
                ':survey_id' => $surveyId,
                ':client' => $client
            ));
        }
        if (!empty($autresClients)) {
            $stmt->execute(array(
                ':survey_id' => $surveyId,
                ':client' => $autresClients
            ));
        }

        // Insert fish data
        foreach ($_POST['fish'] as $fishData) {
            $stmt = $pdo->prepare("
                INSERT INTO Fish (survey_id, species, processing, measurement_type, measurement_value)
                VALUES (:survey_id, :species, :processing, :measurement_type, :measurement_value)
            ");
            $stmt->execute(array(
                ':survey_id' => $surveyId,
                ':species' => $fishData['species'],
                ':processing' => $fishData['processing'][0], // Assuming only one processing option is selected
                ':measurement_type' => $fishData['measurementType'],
                ':measurement_value' => $fishData['measurementValue']
            ));

            $fishId = $pdo->lastInsertId();

            // Insert categories for fish
            if (isset($fishData['categories']) && is_array($fishData['categories'])) {
                foreach ($fishData['categories'] as $category) {
                    $stmtCategory = $pdo->prepare("
                        INSERT INTO FishCategory (fish_id, category)
                        VALUES (:fish_id, :category)
                    ");
                    $stmtCategory->execute(array(
                        ':fish_id' => $fishId,
                        ':category' => $category
                    ));
                }
            }
        }

        echo "Database file '$databaseFile' created successfully with data from the form.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
