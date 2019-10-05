<?php 
 
 include_once 'config/vars.php';

# Database Library Function
class database{ 
	var $host = DB_HOST;
	var $username = DB_USERNAME;
	var $password = DB_PASSWORD;
	var $db_name = DB_NAME;

	# Connect to Database
	function connect(){
		return mysqli_connect($this->host, $this->username, $this->password);;
	}

	# Create database
	function create(){
		$sql = "CREATE DATABASE `".$this->db_name."`";

		if (mysqli_query($this->connect(), $sql)) {
		  echo "Database ".$this->db_name." successfully created \n";
		} else {
		  echo "Error creating database: " . mysqli_error($this->connect());
		}
	}

	# Create some tables
	function migrate(){
		$this->migrate_sellers();
		$this->migrate_transactions();
		$this->migrate_disbursements();
	}

	# Remove database
	function drop(){
		$sql = "DROP DATABASE `".$this->db_name."`";

		if (mysqli_query($this->connect(), $sql)) {
		  echo "Database ".$this->db_name." successfully droped \n";
		} else {
		  echo "Error droping database: " . mysqli_error($this->connect());
		}
	}

	# Prepare data sample
	function seed(){
		$sql = "INSERT INTO `flip-development`.`sellers` (`name`, `bank_code`, `account_number`) VALUES ('Muhammad', 'bni', '12345678');";

		if (mysqli_query($this->connect(), $sql)) {
		  echo "Data seed successfully inserted \n";
		} else {
		  echo "Error Seed: " . mysqli_error($this->connect());
		}

		$sql = "INSERT INTO `flip-development`.`transactions` (`seller_id`, `amount`) VALUES ('1', '2000000');";

		if (mysqli_query($this->connect(), $sql)) {
		  echo "Data seed successfully inserted \n";
		} else {
		  echo "Error Seed: " . mysqli_error($this->connect());
		}
	}
	
	# Get sample transaction
	function get_sample_transaction(){
		$sql = "SELECT * FROM `flip-development`.`disbursements` LIMIT 1";
		$result = mysqli_query($this->connect(), $sql);

		if ($result) {
		  return mysqli_fetch_assoc($result);
		} else {
		  echo "Error getting data: " . mysqli_error($this->connect());
		}
	}


		# Create sellers table
		private function migrate_sellers(){
			$table_name = "sellers";
			$sql_seller = "CREATE TABLE `flip-development`.`sellers` (
								    `id` INT NOT NULL AUTO_INCREMENT,
								    `name` VARCHAR(30) NULL,
									  `bank_code` VARCHAR(10) NOT NULL,
									  `account_number` VARCHAR(20) NOT NULL,
									  `created_at` DATETIME NULL DEFAULT NOW(),
									  `modified_at` DATETIME NULL,
									  PRIMARY KEY (`id`));";

			if (mysqli_query($this->connect(), $sql_seller)) {
			  echo "Table ".$table_name." successfully migrated \n";
			} else {
			  echo "Error migrating database: " . mysqli_error($this->connect());
			}
		}

		# Create transactions table
		private function migrate_transactions(){
			$table_name = "transactions";
			$sql_seller = "CREATE TABLE `flip-development`.`transactions` (
								    `id` INT NOT NULL AUTO_INCREMENT,
								    `seller_id` INT(11) NOT NULL,
									  `amount` FLOAT NOT NULL,
									  `created_at` DATETIME NULL DEFAULT NOW(),
									  `modified_at` DATETIME NULL,
									  PRIMARY KEY (`id`));";

			if (mysqli_query($this->connect(), $sql_seller)) {
			  echo "Table ".$table_name." successfully migrated \n";
			} else {
			  echo "Error migrating database: " . mysqli_error($this->connect());
			}
		}

		# Create disbursements table
		private function migrate_disbursements(){
			$table_name = "disbursements";
			$sql_seller = "CREATE TABLE `flip-development`.`disbursements` (
								    `id` INT NOT NULL AUTO_INCREMENT,
								    `foreign_disbursement_id` VARCHAR(20) NOT NULL,
								    `transaction_id` INT(11) NOT NULL,
								    `status` VARCHAR(10) NOT NULL,
									  `beneficiary_name` VARCHAR(20) NULL,
									  `remark` TEXT NULL,
									  `receipt` TEXT NULL,
									  `time_served` DATETIME NULL,
									  `fee` FLOAT NULL,
									  `created_at` DATETIME NULL DEFAULT NOW(),
									  `modified_at` DATETIME NULL,
									  PRIMARY KEY (`id`));";

			if (mysqli_query($this->connect(), $sql_seller)) {
			  echo "Table ".$table_name." successfully migrated \n";
			} else {
			  echo "Error migrating database: " . mysqli_error($this->connect());
			}
		}



} 