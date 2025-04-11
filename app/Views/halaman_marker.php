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

    // Buat layer marker (tidak ditampilkan secara otomatis)
    var markerLayer = L.layerGroup([
        L.marker([-5.455886500999952, 104.706195629000035]).bindPopup("Jalur Evakuasi 4"),
        L.marker([-5.455665884999974, 104.705444596000063]).bindPopup("Jalur Evakuasi 1"),
        L.marker([-5.455713263999939, 104.705703349000032]).bindPopup("Jalur Evakuasi 2"),
        L.marker([-5.455767636999951, 104.705968797000082]).bindPopup("Jalur Evakuasi 3")
    ]);

    // Inisialisasi Peta dengan peta satelit sebagai default
    var map = L.map('map', {
        center: [-5.4, 104.5683],
        zoom: 9,
        layers: [petaEsri] // Hanya peta Satelit sebagai default
    });

    // Opsi Basemap
    var baseMaps = {
        "Google Satellite": petaGoogleSat,
        "OpenStreetMap": petaOSM,
        "Topographic Map": petaSat,
        "Google Streets": petaGoogleStreets,
        "ESRI World Imagery": petaEsri,
    };

    // Opsi Overlay
    var overlayMaps = {
        "Jalur Evakuasi": markerLayer
    };

    // Tambahkan Layer Control ke Peta
    L.control.layers(baseMaps, overlayMaps).addTo(map);
</script>