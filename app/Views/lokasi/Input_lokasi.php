<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
    <div class="col-sm-8">
        <div id="map" style="width: 100%; height: 70vh;"></div>
    </div>

    <div class="col-sm-4">
        <div class="row">
            <?= form_open_multipart('lokasi/insertData'); ?>

            <div class="form-group">
                <label>Nama Lokasi</label>
                <input class="form-control" name="nama_lokasi" value="<?= old('nama_lokasi'); ?>">
                <p class="text-danger"><?= validation_show_error('nama_lokasi'); ?></p>
            </div>

            <div class="form-group">
                <label>Latitude</label>
                <input class="form-control" name="latitude" id="latitude" value="<?= old('latitude'); ?>">
                <p class="text-danger"><?= validation_show_error('latitude'); ?></p>
            </div>

            <div class="form-group">
                <label>Longitude</label>
                <input class="form-control" name="longitude" id="longitude" value="<?= old('longitude'); ?>">
                <p class="text-danger"><?= validation_show_error('longitude'); ?></p>
            </div>

            <div class="form-group">
                <label>Upload GeoJSON</label>
                <input type="file" class="form-control" name="geojson_file" accept=".geojson" required>
            </div>

            <div class="form-group mt-3"> 
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-success">Reset</button>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- SweetAlert Flash Message -->
<script>
    <?php if(session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success') ?>',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>

    <?php if(session()->getFlashdata('errors')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `<?= implode('<br>', array_map('esc', session()->getFlashdata('errors'))) ?>`,
            confirmButtonText: 'Oke'
        });
    <?php endif; ?>
</script>

<!-- Leaflet Map -->
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

    var map = L.map('map', {
        center: [-5.4, 104.5683],
        zoom: 9,
        layers: [petaGoogleSat]
    });

    var baseMaps = {
        "OpenStreetMap": petaOSM,
        "Topographic Map": petaSat,
        "Google Satellite": petaGoogleSat,
        "Google Streets": petaGoogleStreets,
        "ESRI World Imagery": petaEsri,
    };

    L.control.layers(baseMaps).addTo(map);

    var curLocation = [-5.4, 104.5683];

    var marker = L.marker(curLocation, { draggable: true }).addTo(map);

    function updateLatLng(position) {
        document.getElementById("latitude").value = position.lat;
        document.getElementById("longitude").value = position.lng;
    }

    marker.on('dragend', function(e) {
        updateLatLng(marker.getLatLng());
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng).openPopup();
        updateLatLng(e.latlng);
    });

    updateLatLng(curLocation);
</script>
