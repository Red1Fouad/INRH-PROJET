<!DOCTYPE html>
<html>
<head>
    <title>Multiple Choice Grid</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>

<form method="post">
    <h2>Table 1</h2>
    <?php
    // Table 1 data
    $table1_rows = array(
        "Identification",
        "Calibre ou taille commerciale",
        "Qualité du poisson"
    );

    $table1_columns = array(
        "Toutes",
        "L'essentiel",
        "Aucun"
    );

    // Function to generate the multiple choice grid for Table 1
    function generateTable1($rows, $columns) {
        echo "<table>";
        echo "<tr><th></th>";
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "</tr>";
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>$row</td>";
            foreach ($columns as $column) {
                $name = "table1_answers[$row]";
                echo "<td><input type='radio' name='$name' value='$column'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // Display Table 1
    generateTable1($table1_rows, $table1_columns);
    ?>

    <h2>Table 2</h2>
    <?php
    // Table 2 data
    $table2_rows = array(
        "Espèce",
        "Taille",
        "Qualité"
    );

    $table2_columns = array(
        "Formation professionnelle",
        "Par expérience"
    );

    // Function to generate the multiple choice grid for Table 2
    function generateTable2($rows, $columns) {
        echo "<table>";
        echo "<tr><th></th>";
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "</tr>";
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>$row</td>";
            foreach ($columns as $column) {
                $name = "table2_answers[$row]";
                echo "<td><input type='radio' name='$name' value='$column'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // Display Table 2
    generateTable2($table2_rows, $table2_columns);
    ?>

    <input type="submit" value="Submit">
</form>

</body>
</html>
