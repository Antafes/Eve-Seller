<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'Options page';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`) VALUES (1, "change", "Ändern")
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`, `deleted`) VALUES (2, "change", "Change", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (63, 1, "emptyGeneralOptions", "Bitte fülle alle Felder aus.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`, `deleted`) VALUES (2, "emptyGeneralOptions", "Please fill in all fields.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`) VALUES (1, "emptyPasswordOptions", "Bitte fülle alle Felder aus.")
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`, `deleted`) VALUES (2, "emptyPasswordOptions", "Please fill in all fields.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`) VALUES (1, "generalSuccess", "Daten geändert.")
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`, `deleted`) VALUES (2, "generalSuccess", "Data changed.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`) VALUES (1, "passwordSuccess", "Passwort geändert.")
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`languageId`, `key`, `value`, `deleted`) VALUES (2, "passwordSuccess", "Password changed.", 0)
		');

		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		return true;

	}

);