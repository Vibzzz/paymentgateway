# paymentgateway
1 -  To start project go to project root directory and run this command 
		php artisan serve
2 -  mysql setup

	1 - put db name , host and pwd  in .env file 
	2 -  CREATE DATABASE payment;
	3 - create two tables
		1 - CREATE TABLE `payment_info` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `email` varchar(45) NOT NULL,
			  `first_name` varchar(45) NOT NULL,
			  `last_name` varchar(45) DEFAULT NULL,
			  `mobile` varchar(45) NOT NULL,
			  `product_info` varchar(45) NOT NULL,
			  `amount` float NOT NULL,
			  `name_on_card` varchar(45) NOT NULL,
			  `user_id` varchar(45) NOT NULL,
			  `txn_id` varchar(25) NOT NULL,
			  `created_at` timestamp NULL DEFAULT NULL,
			  `updated_at` timestamp NULL DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

		2 - CREATE TABLE `payment_status` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `txn_id` varchar(25) NOT NULL,
			  `payment_flag` enum('initiate','success','failure','pending') DEFAULT NULL,
			  `amount` float NOT NULL,
			  `user_id` varchar(45) NOT NULL,
			  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `txn_id_UNIQUE` (`txn_id`),
			  KEY `txn_id_idx` (`txn_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

3 - mongo setup
	1 -set mongo details in env file 

4 - card details for testing
	for success response in both debit and credit card
		master card - 
		name on card  - any name
		card no  - 5123456789012346
		cvv - 123
		Expiry: May 2020

	for failure response in both debit and credit card
		visa card - 
		name on card  - any name
		card no  - 4000019562093601
		cvv - 123
		Expiry: 01/2020	