<?php
namespace Anax\View;

?>

<h1>Validera en IP-adress med JSON format</h1>

<form method="post">
    <label>IP Adress:<br />
        <input type="text" name="ip"/>
        <input type="submit" name="validate" value="Validera Ip">
    </label>
</form>

<h3>Testroutes och Användning</h3>
<p>IPV4: <a href="/~emau18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/jsonValidate/apiCheck?ip=8.8.8.8">Google DNS</a><br />
IPV6: <a href="/~emau18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/jsonValidate/apiCheck?ip=2620:119:53::53">Open DNS</a></p>

<div class="line"></div>

<p class="getPost">GET</p>
<div class="codes">
    <code><b>GET</b> /jsonValidate/apiCheck?=[IP ADRESS]</code><br />
    <code><b>GET</b> /jsonValidate/apiCheck?=8.8.8.8</code>
</div>

<p class="getPostResult"><i>Resultat</i></p>
<div class="codes">
    <code>{<br />
    &nbsp;&nbsp; "ip": "8.8.8.8",<br />
    &nbsp;&nbsp; "domain": "dns.google",<br />
    &nbsp;&nbsp; "valid": true,<br />
    &nbsp;&nbsp; "status": "8.8.8.8 är en giltig ipv4 adress."<br />
    &nbsp;&nbsp; "ipStackData": {<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "ip": "8.8.8.8",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "type": "ipv4",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "continent_code": "NA",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "continent_name": "North America",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_code": "US",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_name": "United States",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "region_code": "CA",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "region_name": "California",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "city": "Mountain View",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "zip": "94043",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "latitude": 37.419158935546875,<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "longitude": -122.07540893554688,<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "location": {<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "geoname_id": 5375480,<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "capital": "Washington D.C.",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "languages": [<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "code": "en",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "name": "English",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "native": "English"<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ],<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_flag": "http://assets.ipstack.com/flags/us.svg",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_flag_emoji": "🇺🇸",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_flag_emoji_unicode": "U+1F1FA U+1F1F8",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "calling_code": "1",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "is_eu": false<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br />
    &nbsp;&nbsp; }<br />
    }</code>
</div>

<div class="line"></div>

<p class="getPost">POST</p>
<p>Du måste ange ip adressen i <b>body</b> och se till att <b>x-www-form-urlencoded</b> är satt.</p>
<div class="codes">
    <code><b>POST</b> /jsonValidate</code><br />
    <code><b>POST</b> /jsonValidate {ip: 8.8.8.8} </code>
</div>

<p class="getPostResult"><i>Resultat</i></p>
<div class="codes">
    <code>{<br />
    &nbsp;&nbsp; "ip": "8.8.8.8",<br />
    &nbsp;&nbsp; "domain": "dns.google",<br />
    &nbsp;&nbsp; "valid": true,<br />
    &nbsp;&nbsp; "status": "8.8.8.8 är en giltig ipv4 adress."<br />
    &nbsp;&nbsp; "ipStackData": {<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "ip": "8.8.8.8",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "type": "ipv4",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "continent_code": "NA",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "continent_name": "North America",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_code": "US",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_name": "United States",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "region_code": "CA",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "region_name": "California",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "city": "Mountain View",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "zip": "94043",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "latitude": 37.419158935546875,<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "longitude": -122.07540893554688,<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "location": {<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "geoname_id": 5375480,<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "capital": "Washington D.C.",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "languages": [<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "code": "en",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "name": "English",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "native": "English"<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ],<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_flag": "http://assets.ipstack.com/flags/us.svg",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_flag_emoji": "🇺🇸",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "country_flag_emoji_unicode": "U+1F1FA U+1F1F8",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "calling_code": "1",<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "is_eu": false<br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; }<br />
    &nbsp;&nbsp; }<br />
    }</code>
</div>
