<?php
$session = new SNMP(SNMP::VERSION_1, "192.168.0.5", "public");
$fulltree = $session->walk(".");
print_r($fulltree);
$session->close();
?>
