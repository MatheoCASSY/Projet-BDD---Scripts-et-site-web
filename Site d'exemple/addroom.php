<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <button onclick="window.location.href='home.php';">Retour à l'accueil</button>
    <title>Ajouter un Logement</title>
    <link rel="stylesheet" href="styleaddroom.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-LO0l8rQlmDkTyd-Z_40JzGk5oOVhPSc&libraries=places&callback=initMap" async defer></script>

    <script>
        function determineHomeType(city, state) {
            if (city && (city.toLowerCase().includes("paris") || city.toLowerCase().includes("boulogne-billancourt") || city.toLowerCase().includes("levallois-perret"))) {
                return "Appartement";
            }

            if (city && (city.toLowerCase().includes("nice") || city.toLowerCase().includes("cannes") || city.toLowerCase().includes("monaco") || city.toLowerCase().includes("antibes"))) {
                return "Villa";
            }

            if (city && (city.toLowerCase().includes("aix-en-provence") || city.toLowerCase().includes("marseille") || city.toLowerCase().includes("arles") || city.toLowerCase().includes("avignon"))) {
                return "Maison";
            }

            if (city && (city.toLowerCase().includes("saint-malo") || city.toLowerCase().includes("quimper") || city.toLowerCase().includes("brest"))) {
                return "Chalet";
            }

            if (city && (city.toLowerCase().includes("deauville") || city.toLowerCase().includes("le havre") || city.toLowerCase().includes("rouen"))) {
                return "Maison";
            }

            if (city && (city.toLowerCase().includes("strasbourg") || city.toLowerCase().includes("colmar") || city.toLowerCase().includes("mulhouse"))) {
                return "Appartement";
            }

            if (city && (city.toLowerCase().includes("chamonix") || city.toLowerCase().includes("annecy") || city.toLowerCase().includes("grenoble") || city.toLowerCase().includes("courchevel"))) {
                return "Chalet";
            }

            if (city && (city.toLowerCase().includes("toulouse") || city.toLowerCase().includes("pau") || city.toLowerCase().includes("lourdes"))) {
                return "Maison";
            }

            if (city && (city.toLowerCase().includes("tours") || city.toLowerCase().includes("nantes"))) {
                return "Maison";
            }

            if (city && (city.toLowerCase().includes("lyon") || city.toLowerCase().includes("bordeaux"))) {
                return "Château";
            }

            return "Appartement";
        }

        function initMap() {
            const input = document.getElementById('address');
            const autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                if (place.geometry) {
                    document.getElementById('latitude').value = place.geometry.location.lat();
                    document.getElementById('longitude').value = place.geometry.location.lng();
                }

                let city = '';
                let state = '';
                let country = '';
                
                for (let i = 0; i < place.address_components.length; i++) {
                    const component = place.address_components[i];

                    if (component.types.includes("locality")) {
                        city = component.long_name;
                    }

                    if (component.types.includes("administrative_area_level_1")) {
                        state = component.long_name;
                    }

                    if (component.types.includes("country")) {
                        country = component.long_name;
                    }
                }

                const homeType = determineHomeType(city, state);
                document.getElementById('home_type').value = homeType;
                document.getElementById('city').value = city;
                document.getElementById('state').value = state;
                document.getElementById('country').value = country;
            });
        }

        function toggleOtherHomeType() {
            const homeTypeSelect = document.getElementById('home_type');
            const otherHomeTypeInput = document.getElementById('other_home_type');
            if (homeTypeSelect.value === 'Autre') {
                otherHomeTypeInput.style.display = 'block';
            } else {
                otherHomeTypeInput.style.display = 'none';
            }
        }
    </script>

</head>
<body>

<div class="container">
    <h1>Ajouter un Nouveau Logement</h1>

    <form method="POST">

        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Adresse du logement">
        </div>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <div class="form-group">
            <label for="city">Ville</label>
            <input type="text" name="city" id="city" placeholder="Ville">
        </div>

        <div class="form-group">
            <label for="state">Région</label>
            <input type="text" name="state" id="state" placeholder="État">
        </div>

        <div class="form-group">
            <label for="country">Pays</label>
            <input type="text" name="country" id="country" placeholder="Pays">
        </div>

        <div class="form-group">
            <label for="home_type">Type de Logement</label>
            <select name="home_type" id="home_type" onchange="toggleOtherHomeType()">
                <option value="Appartement">Appartement</option>
                <option value="Maison">Maison</option>
                <option value="Villa">Villa</option>
                <option value="Chalet">Chalet</option>
                <option value="Château">Château</option>
                <option value="Autre">Autre</option>
            </select>
            <input type="text" name="other_home_type" id="other_home_type" placeholder="Type de logement personnalisé" style="display:none;">
        </div>

        <div class="form-group">
            <label for="total_occupancy">Nombre d'occupants possible : </label>
            <input type="number" name="total_occupancy" id="total_occupancy" value="2" placeholder="Nombre d'occupants">
        </div>

        <div class="form-group">
            <label for="summary">Résumé du Description :</label>
            <textarea name="summary" id="summary">Résumé par défaut</textarea>
        </div>

        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="number" name="price" id="price" value="50" placeholder="Prix par nuit">
        </div>

        <div class="form-group">
            <label for="total_bedrooms">Nombre de chambres :</label>
            <input type="number" name="total_bedrooms" id="total_bedrooms" value="1">
        </div>

        <div class="form-group">
            <label for="total_bathrooms">Nombre de salles de bains :</label>
            <input type="number" name="total_bathrooms" id="total_bathrooms" value="1">
        </div>

        <div class="form-group">
            <label for="is_available">Disponibilité :</label>
            <input type="checkbox" name="is_available" id="is_available" checked>
        </div>

        <button type="submit">Ajouter le logement</button>
    </form>
</div>

</body>
</html>
