<?php
/** $Id$ */
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_vehicles=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_type=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_brand=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_body=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_gears=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_doors=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_colour=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_gear_shift=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_fuel=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_seats=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_aovehicles_equipment=1
');

  ## Extending TypoScript from static template uid=43 to set up userdefined tag:
t3lib_extMgm::addTypoScript($_EXTKEY,"editorcfg","
	tt_content.CSS_editor.ch.tx_aovehicles_pi1 = < plugin.tx_aovehicles_pi1.CSS_editor
",43);


t3lib_extMgm::addPItoST43($_EXTKEY,"pi1/class.tx_aovehicles_pi1.php","_pi1","list_type",0);


t3lib_extMgm::addTypoScript($_EXTKEY,"setup","
	tt_content.shortcut.20.0.conf.tx_aovehicles_vehicles = < plugin.".t3lib_extMgm::getCN($_EXTKEY)."_pi1
	tt_content.shortcut.20.0.conf.tx_aovehicles_vehicles.CMD = singleView
",43);
?>