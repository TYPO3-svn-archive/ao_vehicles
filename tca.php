<?php
/** $Id$ */
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

$TCA["tx_aovehicles_vehicles"] = Array (
	"ctrl" => $TCA["tx_aovehicles_vehicles"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,starttime,endtime,fe_group,model,image,type,brand,body,price,initial_registration,mileage,cubic_capacity,power,gears,seats,doors,gear_shift,colour,metallic,fuel,notes,contact,equipment"
	),
	"feInterface" => $TCA["tx_aovehicles_vehicles"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"starttime" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.starttime",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"default" => "0",
				"checkbox" => "0"
			)
		),
		"endtime" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.endtime",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"checkbox" => "0",
				"default" => "0",
				"range" => Array (
					"upper" => mktime(0,0,0,12,31,2020),
					"lower" => mktime(0,0,0,date("m")-1,date("d"),date("Y"))
				)
			)
		),
		"fe_group" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.fe_group",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("", 0),
					Array("LLL:EXT:lang/locallang_general.php:LGL.hide_at_login", -1),
					Array("LLL:EXT:lang/locallang_general.php:LGL.any_login", -2),
					Array("LLL:EXT:lang/locallang_general.php:LGL.usergroups", "--div--")
				),
				"foreign_table" => "fe_groups"
			)
		),
		"model" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.model",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "50",
				"eval" => "required,trim",
			)
		),
		"image" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.image",
			"config" => Array (
				"type" => "group",
				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],
				"max_size" => 500,
				"uploadfolder" => "uploads/tx_aovehicles",
				"show_thumbs" => 1,
				"size" => 3,
				"minitems" => 0,
				"maxitems" => 3,
			)
		),
		"type" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.type",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_type",
				"foreign_table_where" => "AND tx_aovehicles_type.pid=###CURRENT_PID### ORDER BY tx_aovehicles_type.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"brand" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.brand",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_brand",
				"foreign_table_where" => "AND tx_aovehicles_brand.pid=###CURRENT_PID### ORDER BY tx_aovehicles_brand.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"body" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.body",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_body",
				"foreign_table_where" => "AND tx_aovehicles_body.pid=###CURRENT_PID### ORDER BY tx_aovehicles_body.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"price" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.price",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "7",
				"eval" => "required,int",
			)
		),
		"initial_registration" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.initial_registration",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"checkbox" => "0",
				"default" => "0"
			)
		),
		"mileage" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.mileage",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "7",
				"eval" => "required,int",
			)
		),
		"cubic_capacity" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.cubic_capacity",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "5",
				"eval" => "required,int",
			)
		),
		"power" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.power",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "3",
				"eval" => "required,int",
			)
		),
		"gears" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.gears",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_gears",
				"foreign_table_where" => "AND tx_aovehicles_gears.pid=###CURRENT_PID### ORDER BY tx_aovehicles_gears.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"seats" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.seats",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_seats",
				"foreign_table_where" => "AND tx_aovehicles_seats.pid=###CURRENT_PID### ORDER BY tx_aovehicles_seats.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"doors" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.doors",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_doors",
				"foreign_table_where" => "AND tx_aovehicles_doors.pid=###CURRENT_PID### ORDER BY tx_aovehicles_doors.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"gear_shift" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.gear_shift",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_gear_shift",
				"foreign_table_where" => "AND tx_aovehicles_gear_shift.pid=###CURRENT_PID### ORDER BY tx_aovehicles_gear_shift.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"colour" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.colour",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_colour",
				"foreign_table_where" => "AND tx_aovehicles_colour.pid=###CURRENT_PID### ORDER BY tx_aovehicles_colour.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"metallic" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.metallic",
			"config" => Array (
				"type" => "check",
			)
		),
		"fuel" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.fuel",
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_aovehicles_fuel",
				"foreign_table_where" => "AND tx_aovehicles_fuel.pid=###CURRENT_PID### ORDER BY tx_aovehicles_fuel.uid",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"notes" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.notes",
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "6",
			)
		),
		"contact" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.contact",
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "4",
			)
		),
		"equipment" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_vehicles.equipment",
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_aovehicles_equipment",
				"foreign_table_where" => "AND tx_aovehicles_equipment.pid=###CURRENT_PID### ORDER BY tx_aovehicles_equipment.uid",
				"size" => 10,
				"minitems" => 0,
				"maxitems" => 50,
				"MM" => "tx_aovehicles_vehicles_equipment_mm",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, model, image, type, brand, body, price, initial_registration, mileage, cubic_capacity, power, gears, seats, doors, gear_shift, colour, metallic, fuel, notes, contact, equipment")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "starttime, endtime, fe_group")
	)
);



$TCA["tx_aovehicles_type"] = Array (
	"ctrl" => $TCA["tx_aovehicles_type"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,type"
	),
	"feInterface" => $TCA["tx_aovehicles_type"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"type" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_type.type",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "10",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, type")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_brand"] = Array (
	"ctrl" => $TCA["tx_aovehicles_brand"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,brand"
	),
	"feInterface" => $TCA["tx_aovehicles_brand"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"brand" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_brand.brand",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "50",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, brand")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_body"] = Array (
	"ctrl" => $TCA["tx_aovehicles_body"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,body"
	),
	"feInterface" => $TCA["tx_aovehicles_body"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"body" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_body.body",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "30",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, body")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_gears"] = Array (
	"ctrl" => $TCA["tx_aovehicles_gears"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,gears"
	),
	"feInterface" => $TCA["tx_aovehicles_gears"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"gears" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_gears.gears",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "2",
				"eval" => "required,int,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, gears")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_doors"] = Array (
	"ctrl" => $TCA["tx_aovehicles_doors"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,doors"
	),
	"feInterface" => $TCA["tx_aovehicles_doors"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"doors" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_doors.doors",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "2",
				"eval" => "required,int,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, doors")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_colour"] = Array (
	"ctrl" => $TCA["tx_aovehicles_colour"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,colour"
	),
	"feInterface" => $TCA["tx_aovehicles_colour"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"colour" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_colour.colour",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "15",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, colour")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_gear_shift"] = Array (
	"ctrl" => $TCA["tx_aovehicles_gear_shift"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,gear_shift"
	),
	"feInterface" => $TCA["tx_aovehicles_gear_shift"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"gear_shift" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_gear_shift.gear_shift",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "25",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, gear_shift")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_fuel"] = Array (
	"ctrl" => $TCA["tx_aovehicles_fuel"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,fuel"
	),
	"feInterface" => $TCA["tx_aovehicles_fuel"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"fuel" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_fuel.fuel",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "25",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, fuel")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_seats"] = Array (
	"ctrl" => $TCA["tx_aovehicles_seats"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,seats"
	),
	"feInterface" => $TCA["tx_aovehicles_seats"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"seats" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_seats.seats",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "2",
				"eval" => "required,int,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, seats")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_aovehicles_equipment"] = Array (
	"ctrl" => $TCA["tx_aovehicles_equipment"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,equipment"
	),
	"feInterface" => $TCA["tx_aovehicles_equipment"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"equipment" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:ao_vehicles/locallang_db.php:tx_aovehicles_equipment.equipment",
			"config" => Array (
				"type" => "input",
				"size" => "30",
				"max" => "50",
				"eval" => "required,trim,unique",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, equipment")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);
?>