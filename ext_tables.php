<?php
/** $Id$ */
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

// Displays all vehicles as a list in the page module
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables'] = Array (
	'tx_aovehicles_vehicles' => Array (
		'0' => Array (
			'fList' => 'type,brand,model',
			'icon'=>'1',
		),
	),
);

t3lib_extMgm::addToInsertRecords("tx_aovehicles_vehicles");

$TCA["tx_aovehicles_vehicles"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles",
		"label" => "model",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
			"starttime" => "starttime",
			"endtime" => "endtime",
			"fe_group" => "fe_group",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_vehicles.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, starttime, endtime, fe_group, model, image, type, brand, body, price, initial_registration, mileage, cubic_capacity, power, gears, seats, doors, gear_shift, colour, metallic, fuel, notes, contact, equipment",
	)
);

$TCA["tx_aovehicles_type"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_type",
		"label" => "type",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_type.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, type",
	)
);

$TCA["tx_aovehicles_brand"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_brand",
		"label" => "brand",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_brand.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, brand",
	)
);

$TCA["tx_aovehicles_body"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_body",
		"label" => "body",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_body.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, body",
	)
);

$TCA["tx_aovehicles_gears"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_gears",
		"label" => "gears",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_gears.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, gears",
	)
);

$TCA["tx_aovehicles_doors"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_doors",
		"label" => "doors",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_doors.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, doors",
	)
);

$TCA["tx_aovehicles_colour"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_colour",
		"label" => "colour",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_colour.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, colour",
	)
);

$TCA["tx_aovehicles_gear_shift"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_gear_shift",
		"label" => "gear_shift",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_gear_shift.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, gear_shift",
	)
);

$TCA["tx_aovehicles_fuel"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_fuel",
		"label" => "fuel",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_fuel.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, fuel",
	)
);

$TCA["tx_aovehicles_seats"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_seats",
		"label" => "seats",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_seats.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, seats",
	)
);

$TCA["tx_aovehicles_equipment"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_equipment",
		"label" => "equipment",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_aovehicles_equipment.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, equipment",
	)
);

$tempColumns = Array (
	"tx_aovehicles_mode" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode",
		"config" => Array (
			"type" => "select",
			"items" => Array (
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.0", "0"),
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.1", "1"),
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.2", "2"),
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.3", "3"),
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.4", "4"),
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.5", "5"),
				Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.tx_aovehicles_mode.I.6", "6"),
			),
		)
	),
);

t3lib_div::loadTCA("tt_content");
t3lib_extMgm::addTCAcolumns("tt_content",$tempColumns,1);


t3lib_div::loadTCA("tt_content");
$TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="layout,select_key";
$TCA["tt_content"]["types"]["list"]["subtypes_addlist"][$_EXTKEY."_pi1"]="tx_aovehicles_mode;;;;1-1-1";


t3lib_extMgm::addPlugin(Array("LLL:EXT:ao_vehicles/locallang_db.php:tt_content.list_type_pi1", $_EXTKEY."_pi1"),"list_type");


t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","AO Vehicles");


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_aovehicles_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY)."pi1/class.tx_aovehicles_pi1_wizicon.php";
?>