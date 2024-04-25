<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }
        label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 4px;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 150px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
        }
        </style>
</head>
<body>
<img src="inrh_logo.png" alt="INRH Logo" class="logo">
<div class="container">
    <h2>Login</h2>
    <div id="message"></div> <!-- To display error messages -->
    <form id="loginForm">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn-primary">Login</button>
    </form>
</div>

<script>
    // AJAX for handling login
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        
        // Get form data
        var formData = new FormData(this);
        
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "loginData.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        window.location.href = "survey.php"; // Redirect to survey.php on successful login
                    } else {
                        document.getElementById("message").innerHTML = "<p>" + response.message + "</p>"; // Display error message
                    }
                } else {
                    console.error("AJAX request failed");
                }
            }
        };
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.send(formData);
    });
</script>

</body>
</html>
