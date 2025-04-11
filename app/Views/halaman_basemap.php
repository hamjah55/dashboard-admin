<div id="map" style="width: 100%; height: 70vh;"></div>

<script>
    
    var petaOSM = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        });

        var petaSat = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenTopoMap contributors'
        });

        var petaGoogleSat = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps'
        });

        var petaGoogleStreets = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps'
        });

        var petaEsri = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; Esri & Contributors'
        });

        // Inisialisasi Peta dengan peta satelit sebagai default
        var map = L.map('map', {
            center: [-5.4, 104.5683],
            zoom: 9,
            layers: [petaGoogleSat] // Peta Satelit sebagai default
        });

        // Opsi Basemap
        var baseMaps = {
            "OpenStreetMap": petaOSM,
            "Topographic Map": petaSat,
            "Google Satellite": petaGoogleSat,
            "Google Streets": petaGoogleStreets,
            "ESRI World Imagery": petaEsri,
        };

        // Tambahkan Layer Control ke Peta
        L.control.layers(baseMaps).addTo(map);
</script>



