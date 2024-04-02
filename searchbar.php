<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Species Dropdown with Live Search</title>
    <style>
        #search-box {
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Species Dropdown with Live Search</h2>

<!-- Search Box -->
<input type="text" id="search-box" onkeyup="filterSpecies()" placeholder="Search for species..">

<!-- Dropdown Menu -->
<select id="species-dropdown">
    <?php
    // Read species from file
    $species = file('species.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Generate dropdown options
    foreach ($species as $specie) {
        echo "<option value='$specie'>$specie</option>";
    }
    ?>
</select>

<script>
    function filterSpecies() {
        // Declare variables
        var input, filter, select, option, i, txtValue;
        input = document.getElementById('search-box');
        filter = input.value.toUpperCase();
        select = document.getElementById('species-dropdown');
        option = select.getElementsByTagName('option');

        // Loop through all options, hide those that don't match the search query
        for (i = 0; i < option.length; i++) {
            txtValue = option[i].textContent || option[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                option[i].style.display = '';
            } else {
                option[i].style.display = 'none';
            }
        }
    }
</script>

</body>
</html>
