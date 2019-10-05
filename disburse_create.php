<?php 
include_once 'lib/disburse.php';

$disburse = new disburse();
$param =  array("bank_code"       => "bni",
							  "account_number"  => "1234567890",
							  "amount"          => 10000,
							  "remark"          => "sample remark");

# Disburse a transaction to 3rd party
$disburse->create($param); 