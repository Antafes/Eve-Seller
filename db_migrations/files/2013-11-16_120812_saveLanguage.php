<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'added an option to save the users language';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			ALTER TABLE `es_users`
				ADD COLUMN `languageId` INT UNSIGNED NOT NULL DEFAULT "1" AFTER `orderDuration`,
				ADD CONSTRAINT `language` FOREIGN KEY (`languageId`) REFERENCES `es_languages` (`languageId`) ON UPDATE RESTRICT ON DELETE RESTRICT
		');

		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		$result = query_raw('
			ALTER TABLE `es_users`
				DROP COLUMN `languageId`,
				DROP FOREIGN KEY `language`
		');

		return !!$result;

	}

);