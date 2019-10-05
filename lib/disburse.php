<?php 
include_once 'api.php';
include_once 'database.php';

class disburse{ 
	var $seller_id = 1;
	var $transaction_id = 1;

	function __construct(){
		$this->api = new api();
		$this->db = new database();
	}

	function create($param){
		$disburse = $this->api->call('POST', API_URL.'disburse', json_encode($param));
		$response = json_decode($disburse, true);

		if(array_key_exists('errors', $response)){
			die("Something went wrong!");
		}

		$sql = "INSERT INTO `flip-development`.`disbursements` (`transaction_id`, `foreign_disbursement_id`, `status`, `beneficiary_name`, `remark`, `receipt`, `time_served`, `fee`) 
						VALUES (".$this->transaction_id.", '".$response['id']."', '".$response['status']."', '".$response['beneficiary_name']."', '".$response['remark']."', NULL, NOW(), ".$response['fee'].");";

		if (mysqli_query($this->db->connect(), $sql)) {
		  echo "Data disbursement successfully inserted \n";
		} else {
		  echo "Error: " . mysqli_error($this->db);
		}
	}

	function status($transaction_id){
		$disburse = $this->api->call('GET', API_URL.'disburse/'.$transaction_id);
		$response = json_decode($disburse, true);

		if(array_key_exists('errors', $response)){
			die("Something went wrong!");
		}

		$sql = "UPDATE `flip-development`.`disbursements` 
						SET `receipt` = '".$response['receipt']."', `time_served` = '".$response['time_served']."', `status` = '".$response['status']."' 
						WHERE `foreign_disbursement_id` = '".$transaction_id."'";

		if (mysqli_query($this->db->connect(), $sql)) {
		  echo "Status Transaction ID #".$transaction_id." : '". $response['status']."'";
		} else {
		  echo "Error: " . mysqli_error($this->db);
		}
	}

}	