<?php 

include_once 'lib/database.php';

$db = new database();

# Prepare Database (name, table & data)
$db->create();
$db->migrate(); 
$db->seed();