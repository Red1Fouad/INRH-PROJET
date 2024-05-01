<!-- stats.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fish Species Statistics</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .chart-container {
            width: 800px;
            height: 400px;
            margin: 0 auto;
        }
        .legend {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            border-radius: 50%;
        }
        .page-title {
            text-align: center;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <button class="back-button" onclick="window.location.href='survey.php'">&lt; Back</button>
    <h1 class="page-title">Fish Species Statistics</h1>
    <div class="chart-container">
        <canvas id="fishChart"></canvas>
    </div>

    <?php
    // Function to generate random color
    function generateRandomColor() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    // Connect to SQLite database
    $db = new PDO('sqlite:database.sqlite');

    // Fetch data from the fish table
    $stmt = $db->query('SELECT species, COUNT(*) as count FROM fish_survey GROUP BY species');
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare data for Chart.js
    $labels = [];
    $counts = [];
    $colors = [];
    foreach ($data as $row) {
        $labels[] = '';
        $counts[] = $row['count'];
        // Generate random color for each species
        $colors[] = generateRandomColor();
    }
    ?>

    <script>
        // JavaScript code to create the column chart
        var ctx = document.getElementById('fishChart').getContext('2d');
        var fishChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Fish Species Count',
                    data: <?php echo json_encode($counts); ?>,
                    backgroundColor: <?php echo json_encode($colors); ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <div class="legend">
        <?php
        // Display legend based on fetched data
        foreach ($data as $index => $row) {
            $color = $colors[$index];
            echo '<div class="legend-item">';
            echo '<div class="legend-color" style="background-color: ' . $color . '"></div>';
            echo '<span>' . $row['species'] . '</span>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
