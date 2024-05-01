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
        table1_identification TEXT,
        table1_calibre TEXT,
        table1_qualite TEXT,
        table2_espece TEXT,
        table2_taille TEXT,
        table2_qualite TEXT,
        clients TEXT,
        autres_clients TEXT
    )");

    // Create fish_survey table if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS fish_survey (
        id INTEGER PRIMARY KEY,
        date TEXT,
        species TEXT,
        main_survey_id INTEGER,
        processing TEXT,
        eviscere TEXT,
        etete TEXT,
        equete TEXT,
        measurement_type TEXT,
        measurement_value TEXT,
        FOREIGN KEY (main_survey_id) REFERENCES main_survey(id)
    )");

    // Create category_survey table if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS category_survey (
        id INTEGER PRIMARY KEY,
        category_name TEXT,
        fish_survey_id INTEGER,
        FOREIGN KEY (fish_survey_id) REFERENCES fish_survey(id)
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

        // Retrieve answers from Table 1
        $table1_identification = $_POST['table1_answers']['Identification'];
        $table1_calibre = $_POST['table1_answers']['Calibre ou taille commerciale'];
        $table1_qualite = $_POST['table1_answers']['Qualité du poisson'];
        
        // Retrieve answers from Table 2
        $table2_espece = $_POST['table2_answers']['Espèce'];
        $table2_taille = $_POST['table2_answers']['Taille'];
        $table2_qualite = $_POST['table2_answers']['Qualité'];

        // Check if main survey exists based on the provided data
        $stmt = $db->prepare("SELECT id FROM main_survey WHERE port = ? AND date = ?");
        $stmt->execute([$port, $date]);
        $main_survey = $stmt->fetch(PDO::FETCH_ASSOC);

        // Insert main survey data if it doesn't exist
        if (!$main_survey) {
            $stmt = $db->prepare("INSERT INTO main_survey (date, port, enqueteur, entreprise, adresse, telephone, qualite, duree, table1_identification, table1_calibre, table1_qualite, table2_espece, table2_taille, table2_qualite, clients, autres_clients) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$date, $port, $enqueteur, $entreprise, $adresse, $telephone, $qualite, $duree, $table1_identification, $table1_calibre, $table1_qualite, $table2_espece, $table2_taille, $table2_qualite, $clients, $autres_clients]);
            $main_survey_id = $db->lastInsertId();
        } else {
            $main_survey_id = $main_survey['id'];
        }

        // Insert fish survey data into the fish_survey table
        if (isset($_POST['species']) && is_array($_POST['species'])) {
            foreach ($_POST['species'] as $key => $species) {
                // Retrieve processing data
                $processing = isset($_POST["processing"][$key]) ? $_POST["processing"][$key] : '';
                // Retrieve measurement data
                $measurement_type = isset($_POST["measurementType"][$key]) ? $_POST["measurementType"][$key] : '';
                $measurement_value = isset($_POST["measurementValue"][$key]) ? $_POST["measurementValue"][$key] : '';

                // Retrieve additional processing data
                $eviscere = isset($_POST["eviscere"][$key]) ? 'Yes' : 'No';
                $etete = isset($_POST["etete"][$key]) ? 'Yes' : 'No';
                $equete = isset($_POST["equete"][$key]) ? 'Yes' : 'No';

                $stmt = $db->prepare("INSERT INTO fish_survey (date, species, main_survey_id, processing, eviscere, etete, equete, measurement_type, measurement_value) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$date, $species, $main_survey_id, $processing, $eviscere, $etete, $equete, $measurement_type, $measurement_value]);
                $fish_survey_id = $db->lastInsertId();

                // Insert category survey data
                if (isset($_POST["categories"][$key]) && is_array($_POST["categories"][$key])) {
                    $categories = $_POST["categories"][$key];
                    foreach ($categories as $category_name) {
                        $stmt = $db->prepare("INSERT INTO category_survey (category_name, fish_survey_id) 
                                VALUES (?, ?)");
                        $stmt->execute([$category_name, $fish_survey_id]);
                    }
                } else {
                    echo "Error: No categories data provided.";
                }
            }
        } else {
            echo "Error: No species data provided.";
        }


        echo "Survey data saved successfully.";
    } else {
        echo "Error: Required fields are missing.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}