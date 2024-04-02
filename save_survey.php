<?php
try {
    $db = new PDO('sqlite:database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception

    // Create main_survey table if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS main_survey (
        id INTEGER PRIMARY KEY,
        date TEXT,
        port TEXT,
        enqueteur TEXT,
        entreprise TEXT,
        adresse TEXT,
        telephone TEXT,
        qualite TEXT,
        duree TEXT,
        clients TEXT,
        autres_clients TEXT
    )");

    // Create fish_survey table if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS fish_survey (
        id INTEGER PRIMARY KEY,
        date TEXT,
        species TEXT,
        processing_radio TEXT,
        processing_checkboxes TEXT,
        size_cm TEXT,
        size_g TEXT,
        category TEXT,
        main_survey_id INTEGER,
        FOREIGN KEY (main_survey_id) REFERENCES main_survey(id)
    )");

    // Check if required fields are set
    if (
        isset($_POST['date'], $_POST['port'], $_POST['qualite'], $_POST['duree'], $_POST['clients'])
    ) {
        // Retrieve data from the POST array
        $date = $_POST['date'];
        $port = $_POST['port'];
        $enqueteur = isset($_POST['enqueteur']) ? $_POST['enqueteur'] : '';
        $entreprise = isset($_POST['entreprise']) ? $_POST['entreprise'] : '';
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $qualite = $_POST['qualite'];
        $duree = $_POST['duree'];
        $clients = implode(', ', $_POST['clients']);
        $autres_clients = isset($_POST['autres_clients']) ? $_POST['autres_clients'] : '';

        // Check if main survey exists based on the provided data
        $stmt = $db->prepare("SELECT id FROM main_survey WHERE port = ? AND date = ?");
        $stmt->execute([$port, $date]);
        $main_survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Insert main survey data if it doesn't exist
        if (!$main_survey) {
            $stmt = $db->prepare("INSERT INTO main_survey (date, port, enqueteur, entreprise, adresse, telephone, qualite, duree, clients, autres_clients) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$date, $port, $enqueteur, $entreprise, $adresse, $telephone, $qualite, $duree, $clients, $autres_clients]);
            $main_survey_id = $db->lastInsertId();
        } else {
            $main_survey_id = $main_survey['id'];
        }

        // Insert fish survey data into the fish_survey table
        foreach ($_POST['species'] as $key => $species) {
            $processing_radio = isset($_POST['processing_radio'][$key]) ? $_POST['processing_radio'][$key] : '';
            $processing_checkboxes = isset($_POST['processing_checkboxes'][$key]) ? implode(', ', $_POST['processing_checkboxes'][$key]) : '';
            $size_cm = isset($_POST['size_cm'][$key]) ? $_POST['size_cm'][$key] : '';
            $size_g = isset($_POST['size_g'][$key]) ? $_POST['size_g'][$key] : '';
            $category = isset($_POST['category'][$key]) ? $_POST['category'][$key] : '';

            $stmt = $db->prepare("INSERT INTO fish_survey (date, species, processing_radio, processing_checkboxes, size_cm, size_g, category, main_survey_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$date, $species, $processing_radio, $processing_checkboxes, $size_cm, $size_g, $category, $main_survey_id]);
        }

        echo "Survey data saved successfully.";
    } else {
        echo "Error: Required fields are missing.";
    }

    // Close the database connection
    $db = null;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
