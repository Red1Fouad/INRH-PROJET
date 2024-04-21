<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Read the contents of the users.txt file
        $usersFile = "users.txt";
        $usersData = file($usersFile, FILE_IGNORE_NEW_LINES);
        
        // Loop through each line in the file to check for matching username and password
        foreach ($usersData as $userData) {
            // Split each line into username and password
            list($storedUsername, $storedPassword) = explode(", ", $userData);
            
            // Check if the provided username and password match
            if ($username === $storedUsername && $password === $storedPassword) {
                // Authentication successful
                $response = array("success" => true);
                echo json_encode($response);
                exit;
            }
        }
        
        // If no matching username and password found
        $response = array("success" => false, "message" => "Invalid username or password");
        echo json_encode($response);
    } else {
        // If username or password is not provided
        $response = array("success" => false, "message" => "Please provide both username and password");
        echo json_encode($response);
    }
} else {
    // If the request is not AJAX
    http_response_code(403);
    exit("Forbidden");
}

