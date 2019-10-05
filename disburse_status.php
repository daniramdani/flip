<?php 
include_once 'lib/disburse.php';
include_once 'lib/database.php';

$db = new database();

# Get a sample disbursement record
$transaction = $db->get_sample_transaction();

$disburse = new disburse();

# Check status of disbursement by disbursement ID from 3rd party
$disburse->status($transaction['foreign_disbursement_id']); 