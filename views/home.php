
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/logo.png">
    <!-- Author Meta -->
    <meta name="author" content="">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Peta Penyebaran Covid-19 Wilayah Kota Banjarmasin</title>


    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Roboto:400,400i,500" rel="stylesheet">
    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/hexagons.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/vendor/leaflet/leaflet.css">
    <style>
        #main {
            margin-top: 80px;
        }
        #maps { height: 600px; }
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
            color: #000;
        }

        .info b {
            color: #000;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }
    </style>
</head>

<body>
<!-- start header Area -->
<header id="header" class="header-scrolled">
    <div class="container main-menu text-center">
        <div class="row align-items-center justify-content-center d-flex">
            <div id="logo" class="text-center">
                <a href="{{ '/' }}" class="text-center">
                    <h4>Peta Penyebaran Covid-19 Wilayah Kota Banjarmasin</h4>
                </a>
            </div>
        </div>
    </div>
</header>
<main id="main">
    <div class="container mt-5">
        <div class="section mb-5">
            <h2 class="section-title text-center my-3">
                Peta Persebaran
            </h2>
            <div id="maps"></div>
        </div>

        <div class="section">
            <h2 class="section-title text-center my-3">
                Table Kelurahan Berserta Jumlah Pasien
            </h2>
            <table class="table table-striped table-condensed mt-4">
                <thead>
                <tr>
                    <th>Nama Kelurahan</th>
                    <th>Dirawat</th>
                    <th>Sembuh</th>
                    <th>Meninggal Dunia</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($results as $row) { ?>
                    <tr>
                        <td>
                            <strong><?php echo $row['kelurahan']; ?></strong>
                        </td>
                        <td><?php echo $row['dirawat']; ?></td>
                        <td><?php echo $row['sembuh']; ?></td>
                        <td><?php echo $row['meninggal']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer class="my-5 text-center">
    <strong class="text-center my-5">Kelompok 1 4N Reguler Pagi Banjarmasin</strong>
</footer>

<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="assets/js/tilt.jquery.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/easing.min.js"></script>
<script src="assets/js/hoverIntent.js"></script>
<script src="assets/js/superfish.min.js"></script>
<script src="assets/js/jquery.ajaxchimp.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl-carousel-thumb.min.js"></script>
<script src="assets/js/hexagons.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/vendor/jquery.counterup.min.js"></script>
<script src="assets/vendor/datatables/datatables.min.js"></script>
<script src="assets/vendor/leaflet/leaflet.js"></script>
<script src="assets/vendor/leaflet/leaflet-provider.js"></script>

<script>
    $(function() {
        $('table').DataTable();
        $('.counter').counterUp({
            delay: 10,
            time: 3000
        });
    });
</script>

<script>
    $(function () {

        var markers = <?php echo json_encode($results); ?>;

        var map = L.map('maps').setView([-3.3172521, 114.5949685], 13);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

        var greenIcon = new L.Icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var redIcon = new L.Icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        for(var i = 0; i < markers.length; i++)
        {
            console.log(markers[i]);
            if (markers[i].positif==0)
            {
                var d = L.marker(([markers[i].latitude, markers[i].longitude]), {icon: greenIcon}).addTo(map);
                d.bindPopup(`<b style='color:black;'>Titik Ini Mencakup Keseluruhan Data Dari Area Kelurahan </b><b style='color:green;'>${markers[i].kelurahan}</b>.<br><b style='color:black;'>Positif : ${markers[0].positif}</b>`);
            } else if (markers[i].positif>0) {
                var d = L.marker(([markers[i].latitude, markers[i].longitude]), {icon: redIcon}).addTo(map);
                d.bindPopup(`<b style='color:black;'>Titik Ini Mencakup Keseluruhan Data Dari Area Kelurahan </b><b style='color:red;'>${markers[i].kelurahan}</b>.<br><b style='color:black;'>Positif : ${markers[0].positif}</b>`);
            };
        }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }
        }

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            //bind click
            layer.on({
                clicked: zoomToFeature,
                mouseover: highlightFeature,
                mouseout: resetHighlight
            });
        }
    })
</script>

</body>
</html>
