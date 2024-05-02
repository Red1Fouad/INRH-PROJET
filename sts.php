<!DOCTYPE html>
<html>
<head>
    <title>Species Visualization</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: calc(100% - 20px);
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
        .btn-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .btn {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        #chart_div {
            width: 100%;
            height: 400px;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .back-button {
            position: absolute;
            top: 25px;
            left: 25px;
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
    <div class="container">
        <h2>Select a Port</h2>
        <div class="btn-container">
            <!-- PHP code to generate buttons for each port -->
            <?php
            $ports = array("Nador", "Tanger", "Casablanca", "Safi", "Agadir", "Boujdour", "Laayoune", "Dakhla");
            foreach ($ports as $port) {
                echo "<button class='btn' onclick=\"location.href='sts.php?port=$port';\">$port</button>";
            }
            ?>
        </div>

        <!-- Div to hold the chart -->
        <div id="chart_div"></div>
    </div>

    <!-- Load Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Species', 'Count'],
                <?php
                // PHP code to fetch species data and prepare it for visualization
                try {
                    $db = new PDO('sqlite:database.sqlite');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Fetch species data for the selected port
                    $port = $_GET['port'];
                    $stmt = $db->prepare("SELECT species, COUNT(*) AS count FROM fish_survey JOIN main_survey ON fish_survey.main_survey_id = main_survey.id WHERE main_survey.port = ? GROUP BY species");
                    $stmt->execute([$port]);
                    $species_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($species_data as $row) {
                        echo "['" . $row['species'] . "', " . $row['count'] . "],";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            ]);

            var options = {
                title: 'Species Distribution',
                legend: {position: 'none'},
                chartArea: {width: '80%', height: '80%'},
                vAxis: {title: 'Species'},
                colors: ['#007bff'],
                backgroundColor: '#f0f0f0',
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>
