<div id="map" style="width: 100%; height: 70vh;"></div>

<script>

    var map = L.map('map').setView([-5.4, 104.5683], 9);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

</script>
