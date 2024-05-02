<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INRH SURVEY</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // Initialize Select2
        $(document).ready(function () {
            $("#species").select2();
        });
    </script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .fish-fields {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .fish-fields h5 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.2rem;
            color: #007bff;
        }
        .fish-image {
            max-width: 100px;
            height: auto;
            margin-top: 10px;
            border-radius: 4px;
        }
        .grid-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
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
        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 150px; /* Adjust as needed */
            height: auto; /* Maintain aspect ratio */
        }
        .survey-header {
            position: relative;
            margin-bottom: 20px; /* Adjust spacing between header and content */
        }
        .survey-header .btn {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <img src="inrh_logo.png" alt="INRH Logo" class="logo">
    <div class="survey-header">
        <a href="sts.php" class="btn btn-primary">Stats</a>
    </div>
    <div class="container">
        <h2 class="text-center mb-4">INRH SURVEY</h2>
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
                    <th>Essentiel</th>
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
                    echo "<td><input type='radio' name='table1_answers[$row]' value='Essentiel'></td>";
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
        
            <!-- Submit Fish button -->
            <button id="submitFishButton" type="button" class="btn btn-primary mt-3" onclick="saveFishData()" disabled>
                Submit Fish
            </button>
    
        </form>
    </div>

    <script>


function saveFish(button) {
    var fishField = button.parentNode;
    var categories = fishField.querySelectorAll('input[name^="category"]');
    var previousValue = null;
    var isValid = true;

    categories.forEach(function(input) {
        var categoryNumber = input.name.split("_")[1];
        var value = parseInt(input.value);
        if (!isNaN(value)) {
            if (previousValue !== null && value > previousValue) {
                isValid = false;
                // Show error message
                alert(`Category ${categoryNumber} should not be bigger than the previous category.`);
                return;
            }
            previousValue = value;
        }
    });

    if (!isValid) {
        return; // Abort save action if any category is bigger than the previous one
    }

    // If all categories are valid, proceed with saving the fish data
    var inputs = fishField.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        if (input.nodeName !== 'BUTTON') {
            input.disabled = true;
        }
    });
    // Disable save button and enable edit button
    button.disabled = true;
    fishField.querySelector('.btn-warning').disabled = false;

    // Hide delete buttons for categories
    var deleteCategoryButtons = fishField.querySelectorAll('.delete-category');
    deleteCategoryButtons.forEach(function(button) {
        button.style.display = 'none';
    });

    // Check if all fish fields are saved, and enable "Submit Fish" button accordingly
    updateSubmitFishButton();
}


function editFish(button) {
    var fishField = button.parentNode;
    // Enable all input fields in the fish field
    var inputs = fishField.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
    // Enable save button and disable edit button
    fishField.querySelector('.btn-success').disabled = false;
    button.disabled = true;

    // Show delete buttons for categories
    var deleteCategoryButtons = fishField.querySelectorAll('.delete-category');
    deleteCategoryButtons.forEach(function(button) {
        button.style.display = 'inline'; // Or whatever the initial display property was
    });

    // Check if all fish fields are saved, and enable "Submit Fish" button accordingly
    updateSubmitFishButton();
}

// Disable edit buttons initially
document.querySelectorAll('.btn-warning').forEach(function(button) {
    button.disabled = true;
});

function deleteFish(button) {
    var fishField = button.parentNode;
    var fishContainer = fishField.parentNode;
    // Remove the fish field from the DOM
    fishField.parentNode.removeChild(fishField);
    // Reorganize the remaining fish fields if needed and update fish count
    var fishFields = fishContainer.querySelectorAll('.fish-fields');
    fishFields.forEach(function(field, index) {
        var fishNumber = index + 1;
        field.querySelector('h5').textContent = 'Fish ' + fishNumber;
        // Update input names with the new fish number
        var inputs = field.querySelectorAll('input, select, textarea');
        inputs.forEach(function(input) {
            var name = input.getAttribute('name');
            if (name) {
                input.setAttribute('name', name.replace(/\d+/, fishNumber));
            }
        });
    });
}

var fishCount = 1;
// Object to store the number of categories for each fish
var categoryCounts = {};

// Add Category Functionality
function addCategoryField(fishNumber) {
    var container = document.getElementById(`categories_${fishNumber}`);
    var numCategories = container.querySelectorAll('.category-field').length + 1;
    if (numCategories <= 7) { // Limiting to 7 categories
        var categoryField = document.createElement("div");
        categoryField.classList.add("category-field");
        var categoryNumber = numCategories; // Start with the highest number
        categoryField.innerHTML = `
            <label for="category">Category ${categoryNumber}: <button type="button" class="btn btn-danger btn-sm delete-category">X</button></label>
            <input type="number" name="category_${fishNumber}[]" class="form-control" required>
        `;
        container.appendChild(categoryField);
        // Decrement category number for the next category
        numCategories--;
    } else {
        alert("Maximum 7 categories allowed.");
    }
    // Re-setup the event handlers for delete buttons
    setupDeleteCategoryButtons();
}


document.addEventListener('click', function(event) {
    if (event.target && event.target.matches('.delete-category')) {
        deleteCategory(event.target);
    }
});

function setupDeleteCategoryButtons() {
    document.querySelectorAll('.categories-container').forEach(container => {
        container.addEventListener('click', function(event) {
            if (event.target && event.target.matches('.delete-category')) {
                deleteCategory(event.target);
            }
        });
    });
}

function deleteCategory(button) {
    var categoryField = button.parentNode.parentNode; // Navigate up to the parent div that contains both label and input
    var categoryContainer = categoryField.parentNode;
    categoryContainer.removeChild(categoryField); // Remove the parent div

    // After deletion, update the data-category-index attribute of the remaining delete buttons
    var deleteButtons = categoryContainer.querySelectorAll('.delete-category');
    deleteButtons.forEach(function(deleteButton, index) {
        deleteButton.setAttribute('data-category-index', index + 1);
    });
}

// Function to toggle measurement input field visibility
function toggleMeasurementField(select) {
    var measurementField = select.closest('.fish-fields').querySelector('.measurement-field');
    if (select.value === "taille_cm" || select.value === "poids_g" || select.value === "moule") {
        measurementField.style.display = "block";
    } else {
        measurementField.style.display = "none";
    }
}

// Function to add a new fish field
function addFishField() {
    var container = document.getElementById("fishContainer");
    var fishField = document.createElement("div");
    fishField.classList.add("fish-fields");
    fishField.innerHTML = `
        <input type="hidden" name="fishCount" value="${fishCount}"> <!-- Add hidden input for fishCount -->
        <h5>Fish ${fishCount}</h5>
        <label for="species">Species:</label>
        <form action="" method="post">
            <select class='speciesSelect' name="species" style='width: 500px;' onchange="showFishImage(this)">
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
        
        <img class="fish-image" src="" alt="Fish Image">
        
        <br> <!-- Line break for spacing -->
        <br> <!-- Line break for spacing -->

        <label>Processing:</label><br>
        <input type="radio" name="processing_${fishCount}[]"  value="Entier"> Entier
        <span style="margin-right: 10px;"></span>
        <input type="radio" name="processing_${fishCount}[]"  value="Traité"> Traité<br>
        
        <label>Additional processing:</label><br>
        <span style="margin-left: 20px;">
            <input type="checkbox" name="processing_eviscere_${fishCount}[]" value="Eviscéré" disabled> Eviscéré
            <input type="checkbox" name="processing_etete_${fishCount}[]" value="Etêté" disabled> Etêté
            <input type="checkbox" name="processing_equete_${fishCount}[]" value="Equeté" disabled> Equeté
        </span><br>

        <br>
        <label for="classes">Classes de tailles dans le marché local</label><br>
        <label>Classification adoptée ou à adopter au sein des halles au poissons</label><br>
        <label></label><br>
        
        <label for="measurementType">Type de Mesure:</label><br>
        <select name="measurementType[]" class="form-control" required onchange="toggleMeasurementField(this)">
            <option value="">Sélectionnez le type de mesure</option>
            <option value="taille_cm">Taille (cm)</option>
            <option value="poids_g">Poids (g)</option>
            <option value="moule">Moule</option>
        </select><br>
        <div class="measurement-field" style="display: none;">
            <label for="measurementValue">Valeur:</label><br>
            <input type="number" name="measurementValue[]" class="form-control" required><br>
        </div>

        <!-- Inside the fish field template -->
        <div class="form-group">
            <label>Classes de tailles dans le marché local</label><br>
            <div id="categories_${fishCount}">
                <div class="category-field">
                    <label for="category">Catégorie 1: <button type="button" class="btn btn-danger btn-sm" onclick="deleteCategory(this)">X</button></label>
                    <input type="number" name="category_${fishCount}[]" class="form-control" required>
                </div>
                <div class="category-field">
                    <label for="category">Catégorie 2: <button type="button" class="btn btn-danger btn-sm" onclick="deleteCategory(this)">X</button></label>
                    <input type="number" name="category_${fishCount}[]" class="form-control" required>
                </div>
                <div class="category-field">
                    <label for="category">Catégorie 3: <button type="button" class="btn btn-danger btn-sm" onclick="deleteCategory(this)">X</button></label>
                    <input type="number" name="category_${fishCount}[]" class="form-control" required>
                </div>
            </div>
            <button type="button" class="btn btn-info btn-sm mt-2" onclick="addCategoryField(${fishCount})">Add Category</button>
        </div>

        <!-- New field for Valeur minimal -->
        <label for="valeur_minimal">Valeur minimal:</label><br>
        <input type="number" name="valeur_minimal[]" class="form-control" required><br>

        <!-- Buttons for saving, editing, and deleting -->
        <button class="btn btn-success" onclick="saveFish(this)">Save</button>
        <button class="btn btn-warning" onclick="editFish(this)">Edit</button>
        <button class="btn btn-danger" onclick="deleteFish(this)">Delete</button>
    `;
    container.appendChild(fishField);

    var editButton = fishField.querySelector('.btn-warning');
    editButton.disabled = true;
    updateSubmitFishButton();
    // Initialize Select2
    $(document).ready(function () {
        $(".speciesSelect").select2();
    });
    fishCount++;

    var selectElement = fishField.querySelector(".speciesSelect");
    updateSpeciesOptions(selectElement); // Initial update

    var selectedSpecies = new Set();

    selectElement.addEventListener('change', function() {
        if (this.value === '') {
            // If species is deselected, remove it from selectedSpecies
            selectedSpecies.delete(this.value);
        } else {
            selectedSpecies.add(this.value);
        }
    });

    var processingRadios = fishField.querySelectorAll(`input[name="processing_${fishCount - 1}[]"]`);
    processingRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            var additionalProcessingCheckboxes = fishField.querySelectorAll(`input[name^="processing_eviscere_${fishCount - 1}"], input[name^="processing_etete_${fishCount - 1}"], input[name^="processing_equete_${fishCount - 1}"]`);
            if (this.value === 'Traité') {
                additionalProcessingCheckboxes.forEach(function(checkbox) {
                    checkbox.disabled = false;
                });
            } else {
                additionalProcessingCheckboxes.forEach(function(checkbox) {
                    checkbox.disabled = true;
                    checkbox.checked = false;
                });
            }
        });
    });

}

function updateSubmitFishButton() {
    var allFieldsSaved = document.querySelectorAll('.fish-fields button.btn-success:disabled').length === document.querySelectorAll('.fish-fields').length;
    var submitFishButton = document.getElementById('submitFishButton');
    submitFishButton.disabled = !allFieldsSaved;
}

// Function to update species options
function updateSpeciesOptions(selectElement) {
    fetch("species.txt")
        .then(response => response.text())
        .then(data => {
            var speciesArray = data.trim().split("\n");
            selectElement.innerHTML = "<option value=''>Select Species</option>";
            speciesArray.forEach(species => {
                var option = document.createElement("option");
                option.value = species.trim();
                option.textContent = species.trim();
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error("Error fetching species:", error));
}
        
function saveFishData() {
    var formData = new FormData(document.querySelector('form'));

    // Extract species data from select elements and add them to the formData
    document.querySelectorAll('.speciesSelect').forEach(function(select, index) {
        formData.append('species[]', select.value);
    });

    // Extract measurement data and add them to the formData
    document.querySelectorAll('select[name="measurementType[]"]').forEach(function(select, index) {
        var measurementType = select.value;
        var measurementValue = select.closest('.fish-fields').querySelector('input[name="measurementValue[]"]').value;
        formData.append('measurementType[]', measurementType);
        formData.append('measurementValue[]', measurementValue);
    });

    // Extract processing data and add them to the formData
    document.querySelectorAll('input[name^="processing"]').forEach(function(input) {
        if (input.checked) {
            formData.append(input.name, input.value);
        }
    });

    // Extract categories data and add them to the formData
    document.querySelectorAll('input[name^="category"]').forEach(function(input) {
        formData.append(input.name, input.value);
    });

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


function showFishImage(selectElement) {
    var speciesIndex = selectElement.value;
    var imageElement = selectElement.closest('.fish-fields').querySelector('.fish-image');
    var imagePath = "images/species/" + speciesIndex + ".jpg";
    
    // Check if the image exists
    var image = new Image();
    image.onload = function() {
        // If the image exists, set the image source
        imageElement.src = imagePath;
    };
    image.onerror = function() {
        // If the image does not exist, set a fallback image source
        imageElement.src = "images/404.jpg";
    };
    image.src = imagePath;
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