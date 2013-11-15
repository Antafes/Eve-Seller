<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'foreign keys and indices';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			ALTER TABLE `es_translations`
				ADD CONSTRAINT `languageId` FOREIGN KEY (`languageId`) REFERENCES `es_languages` (`languageId`) ON UPDATE CASCADE ON DELETE CASCADE
		');

		$results[] = query_raw('
			ALTER TABLE `es_orders`
				ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `es_users` (`userId`) ON UPDATE CASCADE ON DELETE CASCADE
		');

		$results[] = query_raw('
			ALTER TABLE `es_languages`
				ADD INDEX `iso2code` (`iso2code`)
		');



		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		return true;

	}

);