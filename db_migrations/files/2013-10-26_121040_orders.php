<?php

$DB_MIGRATION = array(

	'description' => function () {
		return 'Orders creation and displaying';
	},

	'up' => function ($migration_metadata) {

		$results = array();

		$results[] = query_raw('
			CREATE TABLE `es_orders` (
				`orderId` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
				`userId` INT(10) UNSIGNED NOT NULL,
				`item` VARCHAR(255) NOT NULL COLLATE "utf8_bin",
				`amount` INT(11) NOT NULL,
				`amountSold` INT(11) NOT NULL,
				`price` DECIMAL(15,2) NOT NULL,
				`sellingForUser` VARCHAR(255) NOT NULL COLLATE "utf8_bin",
				`createDatetime` DATETIME NOT NULL,
				`endDatetime` DATETIME NOT NULL,
				`deleted` TINYINT(1) NOT NULL,
				PRIMARY KEY (`orderId`),
				INDEX `userId` (`userId`),
				INDEX `item` (`item`),
				INDEX `userId_sellingForUser` (`userId`, `sellingForUser`)
			)
			COLLATE="utf8_bin"
			ENGINE=InnoDB
			AUTO_INCREMENT=3
		');

		$results[] = query_raw('
			UPDATE `es_translations` SET `key`="orders", `value`="Aufträge" WHERE  `translationId`=39
		');

		$results[] = query_raw('
			UPDATE `es_translations` SET `key`="orders", `value`="Orders" WHERE  `translationId`=40
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (71, 1, "item", "Gegenstand", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (72, 2, "item", "Item", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (73, 1, "singlePrice", "Einzelpreis", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (74, 2, "singlePrice", "Single price", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (75, 1, "amount", "Menge", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (76, 2, "amount", "Amount", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (77, 1, "sum", "Summe", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (78, 2, "sum", "Sum", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (79, 1, "sellingFor", "Verkauf für", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (80, 2, "sellingFor", "Selling for", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (81, 1, "noOrders", "Keine Aufträge gefunden", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (82, 2, "noOrders", "No orders found", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (83, 1, "createDatetime", "Erstellt am", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (84, 2, "createDatetime", "Created on", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (85, 1, "endDatetime", "Endet am", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (86, 2, "endDatetime", "Ends on", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (87, 1, "datetimeFormat", "d.m.Y H:i:s", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (88, 2, "datetimeFormat", "d/m/Y h:i:s a", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (89, 1, "emptyFields", "Bitte fülle alle Felder aus.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (90, 2, "emptyFields", "Please fill in all fields.", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (91, 1, "orderCreated", "Auftrag erstellt", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (92, 2, "orderCreated", "Created order", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (93, 1, "setMyself", "Mich eintragen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (94, 2, "setMyself", "Set myself", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (95, 1, "createOrder", "Auftrag erstellen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (96, 2, "createOrder", "Create order", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (97, 1, "duration", "Dauer", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (98, 2, "duration", "Duration", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (99, 1, "oneDay", "1 Tag", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (100, 2, "oneDay", "1 day", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (101, 1, "threeDays", "3 Tage", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (102, 2, "threeDays", "3 days", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (103, 1, "oneWeek", "1 Woche", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (104, 2, "oneWeek", "1 week", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (105, 1, "twoWeeks", "2 Wochen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (106, 2, "twoWeeks", "2 weeks", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (107, 1, "oneMonth", "1 Monat", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (108, 2, "oneMonth", "1 month", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (109, 1, "threeMonths", "3 Monate", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (110, 2, "threeMonths", "3 months", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (111, 1, "setCorporation", "Corporation eintragen", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (112, 2, "setCorporation", "Set corporation", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (113, 1, "filter", "Filter", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (114, 2, "filter", "Filter", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (115, 1, "decimalSign", ",", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (116, 2, "decimalSign", ".", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (117, 1, "thousandsSeparator", ".", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (118, 2, "thousandsSeparator", ",", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (119, 1, "offeredAmount", "Angebotene Menge", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (120, 2, "offeredAmount", "Offered amount", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (121, 1, "markAsSold", "Als verkauft markieren", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (122, 2, "markAsSold", "Mark as sold", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (127, 1, "all", "Alle", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (128, 2, "all", "All", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (129, 1, "saveSettings", "Einstellungen speichern", 0)
		');

		$results[] = query_raw('
			INSERT INTO `es_translations` (`translationId`, `languageId`, `key`, `value`, `deleted`) VALUES (130, 2, "saveSettings", "Save settings", 0)
		');

		$results[] = query_raw('
			ALTER TABLE `es_users`
				ADD COLUMN `orderDuration` ENUM("P1D","P3D","P1W","P2W","P1M","P3M") NOT NULL AFTER `admin`
		');

		return !in_array(false, $results);

	},

	'down' => function ($migration_metadata) {

		$result = query_raw('
			DROP TABLE es_orders
		');

		return !!$result;

	}

);