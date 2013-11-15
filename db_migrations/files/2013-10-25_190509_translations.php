<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'Translations';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			CREATE TABLE es_languages (
				languageId INT UNSIGNED NOT NULL AUTO_INCREMENT,
				language VARCHAR(255) NOT NULL COLLATE "utf8_general_ci",
				iso2code CHAR(2) NOT NULL COLLATE "utf8_bin",
				deleted TINYINT(1) NOT NULL,
				PRIMARY KEY (`languageId`)
			)
			COLLATE="utf8_bin"
			ENGINE=MyISAM
		');

		$results[] = query_raw('
			CREATE TABLE es_translations (
				translationId INT UNSIGNED NOT NULL AUTO_INCREMENT,
				languageId INT UNSIGNED NOT NULL,
				`key` VARCHAR(255) NOT NULL COLLATE "utf8_general_ci",
				`value` TEXT NOT NULL COLLATE "utf8_general_ci",
				deleted TINYINT(1) NOT NULL,
				PRIMARY KEY (`translationId`)
			)
			COLLATE="utf8_bin"
			ENGINE=MyISAM
		');

		$results[] = query_raw('
			INSERT INTO es_languages (languageId, language, iso2code)
			VALUES (1, "german", "de"), (2, "english", "en")
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (1, 1, "german", "Deutsch", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (2, 2, "german", "Deutsch", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (3, 1, "english", "English", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (4, 2, "english", "English", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (5, 1, "title", "Eve Seller", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (6, 2, "title", "Eve Seller", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (7, 1, "username", "Benutzername", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (8, 2, "username", "Username", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (9, 1, "password", "Passwort", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (10, 2, "password", "Password", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (11, 1, "login", "Login", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (12, 2, "login", "Login", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (13, 1, "register", "Registrieren", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (14, 2, "register", "Register", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (15, 1, "invalidLogin", "Die eingegebenen Logindaten sind nicht bekannt.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (16, 2, "invalidLogin", "The entered login data are not known.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (17, 1, "emptyLogin", "Bitte fülle alle Felder aus.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (18, 2, "emptyLogin", "Please fill in all fields.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (19, 1, "logout", "Logout", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (20, 2, "logout", "Logout", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (21, 1, "repeatPassword", "Passwort wiederholen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (22, 2, "repeatPassword", "Repeat password", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (25, 1, "registerEmpty", "Bitte fülle alle Felder aus.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (26, 2, "registerEmpty", "Pleas fill in all fields.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (27, 1, "passwordsDontMatch", "Die eingegebenen Passwörter stimmen nicht überein.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (28, 2, "passwordsDontMatch", "The entered passwords don"t match.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (29, 1, "usernameAlreadyInUse", "Der Benutzername wird bereits verwendet.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (30, 2, "usernameAlreadyInUse", "The username is already in use.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (31, 1, "registrationSuccessful", "Die Registrierung war erfolgreich.<br />Du erhältst eine E-Mail sobald du freigeschalten wurdest.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (32, 2, "registrationSuccessful", "The registration was successful.<br />You will receive an email on activation.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (33, 1, "imprint", "Impressum", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (34, 2, "imprint", "Imprint", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (35, 1, "email", "E-Mail", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (36, 2, "email", "Email", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (37, 1, "addOrder", "Auftrag hinzufügen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (38, 2, "addOrder", "Add order", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (39, 1, "ownOrders", "Eigene Aufträge", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (40, 2, "ownOrders", "Own orders", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (41, 1, "corporationOrders", "Corporation Aufträge", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (42, 2, "corporationOrders", "Corporation orders", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (43, 1, "options", "Einstellungen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (44, 2, "options", "Options", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (45, 1, "admin", "Admin", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (46, 2, "admin", "Admin", 0)
		');

		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		$result = array();
		$result[] = query_raw('
			DROP TABLE es_translations
		');
		$result[] = query_raw('
			DROP TABLE es_languages
		');

		return !in_array(false, $results);

	}

);