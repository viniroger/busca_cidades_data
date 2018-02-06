<?php
function connectToDB($namedb) {
    $hostdb = 'IP_OU_HOST'; // MySQl host
    $userdb = 'NOME_USUARIO';  // MySQL username
    $passdb = 'SENHA';  // MySQL password
    $link = mysql_connect ($hostdb, $userdb, $passdb);
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    $db_selected = mysql_select_db($namedb);
    if (!$db_selected) {
        die ('Can\'t use database : ' . mysql_error());
    }
    return $link;
}
?>
