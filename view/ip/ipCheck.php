<?php
namespace Anax\View;

?>

<h1>Validera en IP-adress</h1>

<form method="post">
    <label>IP Adress:
        <input type="text" name="ip"/>
        <input type="submit" name="validate" value="Validera Ip">
    </label>
</form>

<p><?= $json["status"] ?><br />
    <?= $json["domain"] ?></p>
