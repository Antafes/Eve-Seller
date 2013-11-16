<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'create and fill item database';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			ALTER TABLE `es_orders`
				CHANGE COLUMN `item` `itemId` INT NOT NULL COLLATE "utf8_bin" AFTER `userId`,
				DROP INDEX `item`,
				ADD INDEX `itemId` (`itemId`),
				ADD CONSTRAINT `itemId` FOREIGN KEY (`itemId`) REFERENCES `invtypes` (`typeID`) ON UPDATE CASCADE ON DELETE CASCADE
		');

		$results[] = query_raw('
			ALTER TABLE `es_orders`
				ADD COLUMN `eveOrderId` INT(11) NOT NULL AFTER `itemId`
		');

		$results[] = query_raw('
			ALTER TABLE `es_users`
				CHANGE COLUMN `orderDuration` `orderDuration` ENUM("P1D","P3D","P7D","P14D","P30D","P90D") NOT NULL COLLATE "utf8_bin" AFTER `admin`
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (131, 1, "marketImport", "Marktimport", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (132, 2, "marketImport", "Market import", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (133, 1, "noFileSpecified", "Keine Datei angegeben.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (134, 2, "noFileSpecified", "No file specified.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (135, 1, "ordersTotal", "Aufträge gesamt", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (136, 2, "ordersTotal", "Orders total", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (137, 1, "ordersCreated", "Aufträge erstellt", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (138, 2, "ordersCreated", "Orders created", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (139, 1, "ordersUpdated", "Aufträge aktualisiert", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (140, 2, "ordersUpdated", "Orders updated", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (141, 1, "file", "Marktlog", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (142, 2, "file", "Market log", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (143, 1, "import", "Importieren", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (144, 2, "import", "Import", 0)
		');

		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			ALTER TABLE `es_orders`
				CHANGE COLUMN `itemId` `item` VARCHAR(255) NOT NULL AFTER `userId`,
				DROP INDEX `itemId`,
				ADD INDEX `item` (`item`),
				DROP FOREIGN KEY `itemId`
		');

		$results[] = query_raw('
			ALTER TABLE `es_orders`
				DROP COLUMN `eveOrderId`
		');

		$results[] = query_raw('
			ALTER TABLE `es_users`
				CHANGE COLUMN `orderDuration` `orderDuration` ENUM("P1D","P3D","P1W","P2W","P1M","P3M") NOT NULL COLLATE "utf8_bin" AFTER `admin`
		');

		return !in_array(false, $results);

	}

);