# paymentgateway
1 -  To start project go to project root directory and run this command 
		php artisan serve
2 -  mysql setup

	1 - put db name , host and pwd  in .env file 
	2 -  CREATE DATABASE payment;
	3 - create two tables
		1 - CREATE TABLE `payment_info` (
		  `payment_info_id` int(11) NOT NULL AUTO_INCREMENT,
		  `email` varchar(45) NOT NULL,
		  `first_name` varchar(45) NOT NULL,
		  `last_name` varchar(45) DEFAULT NULL,
		  `mobile` varchar(45) NOT NULL,
		  `product_info` varchar(45) NOT NULL,
		  `amount` varchar(45) NOT NULL,
		  `name_on_card` varchar(45) NOT NULL,
		  `user_id` varchar(45) NOT NULL,
		  `txn_id` varchar(25) NOT NULL,
		  PRIMARY KEY (`payment_info_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1

		2 - CREATE TABLE `payment_status` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `txn_id` varchar(25) NOT NULL,
			  `payment_flag` enum('initiate','success','failure','pending') DEFAULT NULL,
			  `amount` float NOT NULL,
			  `user_id` varchar(45) NOT NULL,
			  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1

3 - mongo setup
	1 -set mongo details in env file 