<?php

namespace RPurinton\Discommand;

require_once(__DIR__ . '/../vendor/autoload.php');

$sql = new MariaDB();

$result = $sql->query("DESCRIBE `apps`;");
print_r($result);
