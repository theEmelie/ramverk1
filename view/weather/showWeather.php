<?php
namespace Anax\View;

// if ($weatherJson["weather"] == "futureWeather") {
//     var_dump($weatherJson["darkSkyData"]->{"daily"}->{"data"});
// } else {
//     var_dump($weatherJson["darkSkyData"][0]->{"daily"}->{"data"});
// }
?>

<h1>Kolla vädret för en plats</h1>

<form method="post">
    <input type="radio" name="weather" value="futureWeather" checked>
    <label for "futureWeather">Kommande väder</label> <br />

    <input type="radio" name="weather" value="pastWeather">
    <label for "pastWeather">Föregående väder (30 dagar)</label><br /><br />

    <label>IP Adress eller Latitude, Longitude: <br />
        <input type="text" name="location" />
        <input type="submit" name="validate" value="Kolla vädret!">
    </label>
</form>

<?php if ($dataExists == true) { ?>
    <div class="locationData">
    <h3>Platsinformation</h3>
    <?php if (property_exists($weatherJson["locationData"], "display_name")) {?>
    <p><?= $weatherJson["locationData"]->{"display_name"}; ?></p>
    <?php } ?>
    </div>
<div id="map" style="width: 100%; height: 350px;"></div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>
<script type="text/javascript">
    <?= $mapCode ?>
    setTimeout(() => {
        if (latitude && longitude) {
            var map = new L.Map('map');
            L.marker([latitude, longitude]).addTo(map);
            var openStreetMapUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            openStreetMapAttr = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            openStreetMap = new L.TileLayer(openStreetMapUrl, { maxZoom: 18, attribution: openStreetMapAttr });
            map.setView(new L.LatLng(latitude, longitude), 13).addLayer(openStreetMap);
        }
    }, 500);
</script>
<?php } ?>

<table>
    <tr>
        <th>Dag</th>
        <th>Datum</th>
        <th>Vädersummering</th>
        <th>Temperatur min-max (c)</th>
        <th>Vind (m/s)</th>
    </tr>
    <?php
    if ($dataExists == true) {
        if ($weatherJson["weather"] == "futureWeather") {
            if (property_exists($weatherJson["darkSkyData"], "daily")) {
                foreach ($weatherJson["darkSkyData"]->{"daily"}->{"data"} as $dailyWeather) { ?>
    <tr>
        <td><?= Date("l", $dailyWeather->{"time"}) ?></td>
        <td><?= Date("d/m/Y", $dailyWeather->{"time"}) ?></td>
        <td><?= property_exists($dailyWeather, "summary") ? $dailyWeather->{"summary"} : "-" ?></td>
        <td align="center"><?= round($dailyWeather->{"temperatureMin"}) . " - " . round($dailyWeather->{"temperatureMax"}) ?></td>
        <td align="center"><?= round($dailyWeather->{"windSpeed"}) ?></td>
    </tr>
                <?php }
            } else {
                ?>
            <tr>
                <td colspan="5" align="center">Daglig användning överskriden för DarkSky</td>
            </tr>
            <?php }
        } else {
            foreach ($weatherJson["darkSkyData"] as $dailyWeather) { ?>
    <tr>
                <?php if (is_object($dailyWeather) && property_exists($dailyWeather, "daily")) { ?>
        <td><?= Date("l", $dailyWeather->{"daily"}->{"data"}[0]->{"time"}) ?></td>
        <td><?= Date("d/m/Y", $dailyWeather->{"daily"}->{"data"}[0]->{"time"}) ?></td>
        <td><?= property_exists($dailyWeather->{"daily"}->{"data"}[0], "summary") ? $dailyWeather->{"daily"}->{"data"}[0]->{"summary"} : "-" ?></td>
        <td align="center"><?= round($dailyWeather->{"daily"}->{"data"}[0]->{"temperatureMin"}) . " - " . round($dailyWeather->{"daily"}->{"data"}[0]->{"temperatureMax"}) ?></td>
        <td align="center"><?= round($dailyWeather->{"daily"}->{"data"}[0]->{"windSpeed"}) ?></td>
    </tr>
                    <?php
                } else {
                    ?>
            <tr>
                <td colspan="5" align="center">Daglig användning överskriden för DarkSky</td>
            </tr>
                <?php }
            }
        }
    } else { ?>
    <tr>
        <td colspan="5" align="center"><?= $status ?></td>
    </tr>
    <?php } ?>
</table>
