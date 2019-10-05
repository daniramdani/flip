<?php 

include_once 'lib/database.php';

$db = new database();

# Drop app DB
$db->drop(); 