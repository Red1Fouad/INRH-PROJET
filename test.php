<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select2 Example</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // Initialize Select2
        $(document).ready(function () {
            $("#species").select2();
        });
    </script>
</head>
<body>
    <form action="" method="post">
        <select id='species' name="species" style='width: 500px;'>
            <option value='0'>---Choose species</option>
            <?php
            // Read options from species.txt file
            $options = file("species.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($options as $key => $value) {
                $optionValue = $key + 1;
                echo "<option value='$optionValue'>$value</option>";
            }
            ?>
        </select>
    </form>
</body>
</html>
