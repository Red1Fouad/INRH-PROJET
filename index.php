<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        .fish-fields {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
        }
        .fish-fields label {
            font-weight: bold;
            flex-basis: 100%;
            margin-bottom: 5px;
        }
        .fish-fields select {
            flex: 0 1 calc(70% - 10px);
            margin-right: 10px;
        }
        .fish-fields .fish-image {
            flex: 0 1 30px;
            width: 200px;
            height: 200px;
        }
        .grid-table {
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
            width: 100%;
        }
        .grid-table th, .grid-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }
        .grid-table th {
            background-color: #f8f9fa;
        }
        .grid-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .grid-table tr:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Create Survey Database</h2>
        <form method="post" action="save_survey.php">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="port">Port:</label>
                <select name="port" class="form-control" required>
                    <option value="">Select Port</option>
                    <option value="Nador">Nador</option>
                    <option value="Tanger">Tanger</option>
                    <option value="Casablanca">Casablanca</option>
                    <option value="Safi">Safi</option>
                    <option value="Agadir">Agadir</option>
                    <option value="Boujdour">Boujdour</option>
                    <option value="Laayoune">Laayoune</option>
                    <option value="Dakhla">Dakhla</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="enqueteur">Nom et prénom de l'enquêté (facultatif):</label>
                <input type="text" id="enqueteur" name="enqueteur" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="entreprise">Entreprise/Organisation:</label>
                <input type="text" id="entreprise" name="entreprise" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="adresse">Sise à:</label>
                <input type="text" id="adresse" name="adresse" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="telephone">N° téléphone:</label>
                <input type="text" id="telephone" name="telephone" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="qualite">Qualité Enquêté:</label>
                <select name="qualite" class="form-control" required>
                    <option value="">Select Qualité</option>
                    <option value="Patron Pêche/Marin">Patron Pêche/Marin</option>
                    <option value="Classificateur">Classificateur</option>
                    <option value="Mareyeur">Mareyeur</option>
                    <option value="Exportateur">Exportateur</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="duree">Durée d'exercice dans le secteur de la pêche (nb d'an):</label><br>
                <div>
                    <label><input type="radio" name="duree" value="1"> 1</label>
                    <label><input type="radio" name="duree" value="2"> 2</label>
                    <label><input type="radio" name="duree" value="3"> 3</label>
                    <label><input type="radio" name="duree" value="4"> 4</label>
                    <label><input type="radio" name="duree" value="5"> 5</label>
                    <label><input type="radio" name="duree" value="6"> 6</label>
                    <label><input type="radio" name="duree" value="7"> 7</label>
                    <label><input type="radio" name="duree" value="8"> 8</label>
                    <label><input type="radio" name="duree" value="9"> 9</label>
                    <label><input type="radio" name="duree" value="10"> 10</label>
                    <label><input type="radio" name="duree" value="11"> 11</label>
                    <label><input type="radio" name="duree" value="12"> 12</label>
                    <label><input type="radio" name="duree" value="13"> 13</label>
                    <label><input type="radio" name="duree" value="14"> 14</label>
                    <label><input type="radio" name="duree" value="15"> 15</label>
                    <label><input type="radio" name="duree" value="15+"> 15+</label>
                </div>
            </div>
            
            <!-- Grid for Table 1 -->
            <h6>Maitrisez-vous l'identification, la classification en taille ou calibre et la qualité du poisson pour les espèces commercialisées au Maroc :</h6>
            <table class="grid-table">
                <tr>
                    <th></th>
                    <th>Toutes</th>
                    <th>L'essentiel</th>
                    <th>Aucun</th>
                </tr>
                <?php
                // Table 1 data
                $table1_rows = array(
                    "Identification",
                    "Calibre ou taille commerciale",
                    "Qualité du poisson"
                );

                foreach ($table1_rows as $row) {
                    echo "<tr>";
                    echo "<td>$row</td>";
                    echo "<td><input type='radio' name='table1_answers[$row]' value='Toutes'></td>";
                    echo "<td><input type='radio' name='table1_answers[$row]' value='L'essentiel'></td>";
                    echo "<td><input type='radio' name='table1_answers[$row]' value='Aucun'></td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <!-- Grid for Table 2 -->
            <h6>Comment avez vous appris la classification?</h6>
            <table class="grid-table">
                <tr>
                    <th></th>
                    <th>Formation professionnelle</th>
                    <th>Par expérience</th>
                </tr>
                <?php
                // Table 2 data
                $table2_rows = array(
                    "Espèce",
                    "Taille",
                    "Qualité"
                );

                foreach ($table2_rows as $row) {
                    echo "<tr>";
                    echo "<td>$row</td>";
                    echo "<td><input type='radio' name='table2_answers[$row]' value='Formation professionnelle'></td>";
                    echo "<td><input type='radio' name='table2_answers[$row]' value='Par expérience'></td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <div class="form-group">
                <label for="clients">Quels sont vos principaux clients:</label>
                <div>
                    <label><input type="checkbox" name="clients[]" value="Marché local"> Marché local</label><br>
                    <label><input type="checkbox" name="clients[]" value="Industries locales"> Industries locales</label><br>
                    <label><input type="checkbox" name="clients[]" value="UE"> UE</label><br>
                    <label><input type="checkbox" name="clients[]" value="JAPON"> JAPON</label><br>
                    <label><input type="checkbox" name="clients[]" value="USA"> USA</label><br>
                    <label><input type="checkbox" name="clients[]" id="autresCheckbox" value="Autres"> Autres à préciser:</label>
                    <input type="text" id="autresText" name="autres_clients" class="form-control" disabled>
                </div>
            </div>
                
            <div id="fishContainer"></div>
    
            <button type="button" class="btn btn-primary mb-3" onclick="addFishField()">
                <i class="fas fa-plus"></i> Add Fish
            </button><br>
    
        </form>
    </div>

    <script>
        var fishCount = 1;

        function addFishField() {
    var container = document.getElementById("fishContainer");
    var fishField = document.createElement("div");
    fishField.classList.add("fish-fields");
    fishField.innerHTML = `
        <h5>Fish ${fishCount}</h5>
        <label for="species">Species:</label>
        <select name="species[]" class="form-control" onchange="showFishImage(this)" required>
            <option value="">Select Species</option>
        </select>
        
        <img class="fish-image" src="" alt="Fish Image">
        
        <label>Processing:</label><br>
        <input type="radio" name="processing_entier_${fishCount}[]" value="Entier"> Entier
        <span style="margin-right: 10px;"></span>
        <input type="radio" name="processing_traite_${fishCount}[]" value="Traité"> Traité<br>
        
        <label>Additional processing:</label><br>
        <span style="margin-left: 20px;">
            <input type="checkbox" name="processing_eviscere_${fishCount}[]" value="Eviscéré"> Eviscéré
            <input type="checkbox" name="processing_etete_${fishCount}[]" value="Etêté"> Etêté
            <input type="checkbox" name="processing_equete_${fishCount}[]" value="Equeté"> Equeté
        </span><br>

        <br>
        <label for="classes">Classes de tailles dans le marché local</label><br>
        <label>Classification adoptée ou à adopter au sein des halles au poissons</label><br>
        <label></label><br>
        
        <label for="unit">Unité de mesure:</label><br>
        Taille (cm): <input type="number" name="size_cm[]" class="form-control" required><br>
        Poids (g): <input type="number" name="size_g[]" class="form-control" required><br>
        <label></label><br>

        <label for="category">Catégorie:</label><br>
        Catégorie 1: <input type="text" name="category[]" class="form-control" required><br>
        Catégorie 2: <input type="text" name="category[]" class="form-control" required><br>
        Catégorie 3: <input type="text" name="category[]" class="form-control" required><br>
        Catégorie 4: <input type="text" name="category[]" class="form-control" required><br>
        
        <button type="button" class="btn btn-primary mt-3" onclick="saveFishData(${fishCount})">
            Submit Fish
        </button>
    `;
    container.appendChild(fishField);
    fishCount++;

    // Fetch species options from the server
    var selectElement = fishField.querySelector("select[name='species[]']");
    fetch("species.txt")
        .then(response => response.text())
        .then(data => {
            data.trim().split("\n").forEach(species => {
                var option = document.createElement("option");
                option.value = species.trim();
                option.textContent = species.trim();
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error("Error fetching species:", error));
}



        
function saveFishData(fishNumber) {
    var formData = new FormData(document.querySelector('form'));

    fetch('save_survey.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log(data); // This will log the response from save_survey.php
        // Optionally, you can perform actions after successful saving
    })
    .catch(error => {
        console.error('Error:', error);
        // Optionally, you can handle errors here
    });
}







// Helper functions to get data from the form
function getTable1Answers() {
    var answers = {};
    document.querySelectorAll('input[name^="table1_answers"]').forEach(function(input) {
        var question = input.name.replace('table1_answers[', '').replace(']', '');
        answers[question] = input.value;
    });
    return answers;
}

function getTable2Answers() {
    var answers = {};
    document.querySelectorAll('input[name^="table2_answers"]').forEach(function(input) {
        var question = input.name.replace('table2_answers[', '').replace(']', '');
        answers[question] = input.value;
    });
    return answers;
}

function getSelectedClients() {
    var clients = [];
    document.querySelectorAll('input[name="clients[]"]:checked').forEach(function(input) {
        clients.push(input.value);
    });
    return clients;
}

function getFishProcessing(fishNumber) {
    var processing = [];
    document.querySelectorAll('input[name="processing[]"]:checked').forEach(function(input) {
        // Check if the current input belongs to the current fish
        if (input.closest('.fish-fields').querySelector('select[name="species[]"]').selectedIndex === fishNumber - 1) {
            processing.push(input.value);
        }
    });
    return processing;
}


function getFishCategory(fishNumber) {
    var category = [];
    document.querySelectorAll('input[name="category[]"]').forEach(function(input) {
        category.push(input.value);
    });
    return category;
}


        function showFishImage(select) {
            var selectedOption = select.value;
            var fishImage = select.parentNode.querySelector(".fish-image");
            switch (selectedOption) {
                case "Sardine":
                    fishImage.src = "fish.webp";
                    break;
                case "Shark":
                    fishImage.src = "fish2.jpg";
                    break;
                case "Merlo":
                    fishImage.src = "fish3.jpg";
                    break;
                default:
                    fishImage.src = "fish.webp"; // Clear image if no species is selected
            }
        }
        // Enable/disable text field based on checkbox selection
    document.getElementById("autresCheckbox").addEventListener("change", function() {
        var autresText = document.getElementById("autresText");
        autresText.disabled = !this.checked;
        if (!this.checked) {
            autresText.value = "";
        }
    });
    </script>
</body>
</html>
