<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'User table';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			CREATE TABLE `es_users` (
				`userId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(255) NOT NULL COLLATE "utf8_general_ci",
				`password` VARCHAR(255) NOT NULL COLLATE "utf8_bin",
				`salt` VARCHAR(255) NOT NULL COLLATE "utf8_bin",
				`email` VARCHAR(255) NOT NULL COLLATE "utf8_bin",
				`active` TINYINT(1) NOT NULL DEFAULT "0",
				`admin` TINYINT(1) NOT NULL DEFAULT "0",
				`deleted` TINYINT(1) NOT NULL,
				PRIMARY KEY (`userId`)
			)
			COLLATE="utf8_bin"
			ENGINE=InnoDB
		');

		$results[] = query_raw('
			INSERT INTO `es_users` (`name`, `password`, `salt`, `email`, `active`, `admin`)
			VALUES ("Admin", "cb2bf6d82e1a5e5eaf78c78e74d8f018", "sdgse5se", "admin@localhost", 1, 1)
		');

		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		$result = query_raw('
			DROP TABLE es_users
		');

		return !!$result;

	}

);