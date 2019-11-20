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
    <label for "pastWeather">Föregående väder</label><br /><br />

    <label>IP Adress eller Latitude, Longitude: <br />
        <input type="text" name="location" />
        <input type="submit" name="validate" value="Kolla vädret!">
    </label>
</form>

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
    foreach ($weatherJson["darkSkyData"] as $dailyWeather) { ?>
    <tr>
        <td><?= Date("l", $dailyWeather->{"daily"}->{"data"}[0]->{"time"}) ?></td>
        <td><?= Date("d/m/Y", $dailyWeather->{"daily"}->{"data"}[0]->{"time"}) ?></td>
        <td><?= property_exists($dailyWeather->{"daily"}->{"data"}[0], "summary") ? $dailyWeather->{"daily"}->{"data"}[0]->{"summary"} : "-" ?></td>
        <td align="center"><?= round($dailyWeather->{"daily"}->{"data"}[0]->{"temperatureMin"}) . " - " . round($dailyWeather->{"daily"}->{"data"}[0]->{"temperatureMax"}) ?></td>
        <td align="center"><?= round($dailyWeather->{"daily"}->{"data"}[0]->{"windSpeed"}) ?></td>
    </tr>
<?php }
}
} else { ?>
    <tr>
        <td colspan="5" align="center"><?= $status ?></td>
    </tr>
<?php } ?>

</table>
