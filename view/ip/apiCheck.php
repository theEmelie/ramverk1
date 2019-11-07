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
<p>IPV4: <a href="/dbwebb-kurser/ramverk1/me/redovisa/htdocs/jsonValidate/apiCheck?ip=8.8.8.8">Google DNS</a><br />
IPV6: <a href="/dbwebb-kurser/ramverk1/me/redovisa/htdocs/jsonValidate/apiCheck?ip=2620:119:53::53">Open DNS</a></p>

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
    }</code>
</div>
