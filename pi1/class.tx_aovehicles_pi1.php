<?php
/***************************************************************
*  $Id$
*  Copyright notice
*
*  (c) 2004 Andreas Otto (andreas@php4win.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Plugin 'AO Vehicles' for the 'ao_vehicles' extension.
 *
 * @author Andreas Otto <andreas@php4win.de>
 */


require_once(PATH_tslib."class.tslib_pibase.php");

class tx_aovehicles_pi1 extends tslib_pibase {
	var $prefixId = "tx_aovehicles_pi1";		// Same as class name
	var $scriptRelPath = "pi1/class.tx_aovehicles_pi1.php";	// Path to this script relative to the extension dir.
	var $extKey = "ao_vehicles";	// The extension key.

	/**
	 * [Put your description here]
	 */
	function main($content,$conf) {
		switch((string)$conf["CMD"]) {
			case "singleView":
				list($t) = explode(":",$this->cObj->currentRecord);
				$this->internal["currentTable"]=$t;
				$this->internal["currentRow"]=$this->cObj->data;
				$out = $this->pi_wrapInBaseClass($this->singleView($content,$conf));
			break;
			default:
				if (strstr($this->cObj->currentRecord,"tt_content")) {
					$conf["pidList"] = $this->cObj->data["pages"];
					$conf["recursive"] = $this->cObj->data["recursive"];
				}
				$out = $this->pi_wrapInBaseClass($this->listView($content,$conf));
			break;
		}
		// Debugging information
		if ( DEBUG ){
			//debug ( $this->conf );
			//debug ( $this->piVars );
			//debug ( str_replace ( 'tx_aovehicles_vehicles', 'a', $this->cObj->enableFields('tx_aovehicles_vehicles') ) );
		}
		return $out;
	}

	/**
	 * [Put your description here]
	 */
	function listView($content,$conf) {
		$this->conf=$conf;		// Setting the TypoScript passed to this function in $this->conf
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();		// Loading the LOCAL_LANG values
		//$this->pi_USER_INT_obj=1;	// Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!
		$lConf = $this->conf["listView."];	// Local settings for the listView function

		if ($this->piVars["showUid"]) {	// If a single element should be displayed:
			$this->internal["currentTable"] = "tx_aovehicles_vehicles";
			$queryParts['SELECT'] = '
									a.uid,
									b.type,
									c.brand,
									a.model,
									d.body,
									a.price,
									a.initial_registration,
									a.mileage,
									e.gears,
									f.doors,
									a.cubic_capacity,
									g.colour,
									a.metallic,
									h.gear_shift,
									i.fuel,
									j.seats,
									a.power,
									a.notes,
									a.contact,
									a.equipment AS list_equipment,
									a.image,
									a.tstamp AS date_updated,
									a.crdate AS date_added
									';
			$queryParts['FROM'] = '
									tx_aovehicles_vehicles a,
									tx_aovehicles_type b,
									tx_aovehicles_brand c,
									tx_aovehicles_body d,
									tx_aovehicles_gears e,
									tx_aovehicles_doors f,
									tx_aovehicles_colour g,
									tx_aovehicles_gear_shift h,
									tx_aovehicles_fuel i,
									tx_aovehicles_seats j
									';
			$queryParts['WHERE'] = sprintf	(
											'a.uid = %s AND
											a.type = b.uid AND
											a.brand = c.uid AND
											a.body = d.uid AND
											a.gears = e.uid AND
											a.doors = f.uid AND
											a.colour = g.uid AND
											a.gear_shift = h.uid AND
											a.fuel = i.uid AND
											a.seats = j.uid
											%s',
											$this->piVars['showUid'],
											str_replace ( 'tx_aovehicles_vehicles', 'a', $this->cObj->enableFields('tx_aovehicles_vehicles') )
											);
			$queryParts['GROUPBY'] = '';
			$queryParts['ORDERBY'] = '';
			$queryParts['LIMIT'] = '';
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
														$queryParts['SELECT'],
														$queryParts['FROM'],
														$queryParts['WHERE'],
														$queryParts['GROUPBY'],
														$queryParts['ORDERBY'],
														$queryParts['LIMIT']
													);
			$this->internal["currentRow"] = $GLOBALS['TYPO3_DB']->sql_fetch_assoc( $res );
			$this->internal["res_count"] = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
			$content = $this->singleView($content,$conf);
			return $content;
		} else {
			$items=array(
				"1"=> $this->pi_getLL("list_mode_1","Mode 1"),
				"2"=> $this->pi_getLL("list_mode_2","Mode 2"),
				"3"=> $this->pi_getLL("list_mode_3","Mode 3"),
			);
			if (!isset($this->piVars["pointer"])) $this->piVars["pointer"]=0;
			if (!isset($this->piVars["mode"])) $this->piVars["mode"]=1;

			// Initializing the query parameters:
			list($this->internal["orderBy"],$this->internal["descFlag"]) = explode(":",$this->piVars["sort"]);
			$this->internal["results_at_a_time"]=t3lib_div::intInRange($lConf["results_at_a_time"],0,1000,3);		// Number of results to show in a listing.
			$this->internal["maxPages"]=t3lib_div::intInRange($lConf["maxPages"],0,1000,2);;		// The maximum number of "pages" in the browse-box: "Page 1", "Page 2", etc.
			$this->internal["searchFieldList"]="model,price,mileage,cubic_capacity,power,notes,contact";
			$this->internal["orderByList"]="uid,model,price,mileage,cubic_capacity,power";

			// Get number of records:
			$res = $this->pi_exec_query("tx_aovehicles_vehicles",1);
			list($this->internal["res_count"]) = $GLOBALS['TYPO3_DB']->sql_fetch_row($res);

			// Make listing query, pass query to SQL database:
			$queryParts['SELECT'] = '
									a.uid,
									b.type,
									c.brand,
									a.model,
									d.body,
									a.price,
									a.initial_registration,
									a.mileage,
									e.gears,
									f.doors,
									a.cubic_capacity,
									g.colour,
									a.metallic,
									h.gear_shift,
									i.fuel,
									j.seats,
									a.power,
									a.notes,
									a.contact,
									a.equipment AS list_equipment,
									a.image,
									a.tstamp,
									a.crdate
									';
			$queryParts['FROM'] = '
									tx_aovehicles_vehicles a,
									tx_aovehicles_type b,
									tx_aovehicles_brand c,
									tx_aovehicles_body d,
									tx_aovehicles_gears e,
									tx_aovehicles_doors f,
									tx_aovehicles_colour g,
									tx_aovehicles_gear_shift h,
									tx_aovehicles_fuel i,
									tx_aovehicles_seats j
									';
			$queryParts['WHERE'] = sprintf (
									'a.type = b.uid AND
									a.brand = c.uid AND
									a.body = d.uid AND
									a.gears = e.uid AND
									a.doors = f.uid AND
									a.colour = g.uid AND
									a.gear_shift = h.uid AND
									a.fuel = i.uid AND
									a.seats = j.uid
									%s',
									str_replace ( 'tx_aovehicles_vehicles', 'a', $this->cObj->enableFields('tx_aovehicles_vehicles') )
									);
			$queryParts['GROUPBY'] = '';
			$queryParts['ORDERBY'] = 'a.tstamp ASC';
			$queryParts['LIMIT'] = '';
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
														$queryParts['SELECT'],
														$queryParts['FROM'],
														$queryParts['WHERE'],
														$queryParts['GROUPBY'],
														$queryParts['ORDERBY'],
														$queryParts['LIMIT']
													);
			$this->internal["currentTable"] = "tx_aovehicles_vehicles";
			$this->internal["res_count"] = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
				// Put the whole list together:
			$fullTable="";	// Clear var;
			//$fullTable.=t3lib_div::view_array($this->piVars);	// DEBUG: Output the content of $this->piVars for debug purposes. REMEMBER to comment out the IP-lock in the debug() function in t3lib/config_default.php if nothing happens when you un-comment this line!

			// Adds the mode selector.
			// $fullTable.=$this->pi_list_modeSelector($items);

			// Adds the whole list table
			if ( $this->internal['res_count'] > 0 ) {
				$fullTable.=$this->makelist($res);
			}else{
				$fullTable .= $this->cObj->stdWrap ( $this->pi_getLL ( 'noResult' ), $this->conf['common.']['noResultWrap.'] );
			}
			// Adds the search box:
			// $fullTable.=$this->pi_list_searchBox();

			// Adds the result browser:
			// $fullTable.=$this->pi_list_browseresults();

			// Returns the content from the plugin.
			return $fullTable;
		}
	}
	/**
	 * [Put your description here]
	 */
	function makelist($res) {
		$items=Array();
		// Make list table rows
		while($this->internal["currentRow"] = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$items[]=$this->makeListItem();
		}

		$out = sprintf ('
		<div%s>
			%s
		</div>',
			$this->pi_classParam ( 'listrow' ),
			$this->cObj->stdWrap ( implode( chr ( 10 ),$items ), $this->conf['listView.']['resultWrap.'] )
		);
		return $out;
	}

	/**
	 * [Put your description here]
	 */
	function makeListItem() {
		$out = '';
		$this->templateCode = $this->cObj->fileResource ( $this->conf['templateFile'] );
		$template = $this->cObj->getSubpart ( $this->templateCode, '###LIST_VIEW###' );
		$markerArray = array();
		$markerArray['###type###']		= $this->cObj->stdWrap ( $this->getFieldContent ( 'type' ), $this->conf['listView.']['cellDataWrap.'] );
		$markerArray['###brand###']		= $this->cObj->stdWrap ($this->getFieldContent ( 'brand' ), $this->conf['listView.']['cellDataWrap.'] );
		$markerArray['###model###']		= $this->cObj->stdWrap ($this->getFieldContent ( 'model' ), $this->conf['listView.']['cellDataWrap.'] );
		$markerArray['###mileage###']	= $this->cObj->stdWrap ($this->getFieldContent ( 'mileage' ), $this->conf['listView.']['cellDataWrap.'] );
		$markerArray['###price###']		= $this->cObj->stdWrap ($this->getFieldContent ( 'price' ), $this->conf['listView.']['cellDataWrap.'] );
		$out = $this->cObj->stdWrap ($this->cObj->substituteMarkerArrayCached ( $template, $markerArray ), $this->conf['listView.']['rowWrap.'] );
		return $out;
	}
	/**
	 * [Put your description here]
	 */
	function singleView($content,$conf) {
		$this->conf=$conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		$this->pi_USER_INT_obj=1;	// Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!

			// This sets the title of the page for use in indexed search results:
		if ($this->internal["currentRow"]["title"])	$GLOBALS["TSFE"]->indexedDocTitle=$this->internal["currentRow"]["title"];
		/**
		<p>'.$this->pi_list_linkSingle($this->pi_getLL("back","Back"),0).'</p></div>'.
		$this->pi_getEditPanel();
		*/

		$out = '';
		if ( $this->internal['res_count'] > 0 ) {
			$head = $this->cObj->stdWrap ( sprintf ( '%s %s', $this->getFieldContent ( 'brand' ), $this->getFieldContent ( 'model' ) ), $this->conf['singleView.']['titleWrap.'] );
			$this->templateCode = $this->cObj->fileResource ( $this->conf['templateFile'] );
			$template = $this->cObj->getSubpart ( $this->templateCode, '###SINGLE_VIEW###' );
			$markerArray = array();
			$markerArray['###image###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'image' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_type###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'type' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###type###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'type' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_body###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'body' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###body###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'body' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_price###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'price' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###price###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'price' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_initial_registration###']	= $this->cObj->stdWrap ($this->getFieldHeader ( 'initial_registration' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###initial_registration###']			= $this->cObj->stdWrap ($this->getFieldContent ( 'initial_registration' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_mileage###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'mileage' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###mileage###']						= $this->cObj->stdWrap ($this->getFieldContent ( 'mileage' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_cubic_capacity###']			= $this->cObj->stdWrap ($this->getFieldHeader ( 'cubic_capacity' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###cubic_capacity###']				= $this->cObj->stdWrap ($this->getFieldContent ( 'cubic_capacity' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_power###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'power' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###power###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'power' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_gears###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'gears' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###gears###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'gears' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_seats###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'seats' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###seats###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'seats' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_doors###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'doors' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###doors###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'doors' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_gear_shift###']				= $this->cObj->stdWrap ($this->getFieldHeader ( 'gear_shift' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###gear_shift###']					= $this->cObj->stdWrap ($this->getFieldContent ( 'gear_shift' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_colour###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'colour' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###colour###']						= $this->cObj->stdWrap ($this->getFieldContent ( 'colour' ).$metallic, $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_fuel###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'fuel' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###fuel###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'fuel' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_notes###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'notes' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###notes###']							= $this->cObj->stdWrap ($this->getFieldContent ( 'notes' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_contact###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'contact' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###contact###']						= $this->cObj->stdWrap ($this->getFieldContent ( 'contact' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_equipment###']				= $this->cObj->stdWrap ($this->getFieldHeader ( 'equipment' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###equipment###']						= $this->cObj->stdWrap ($this->getFieldContent ( 'equipment' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_tstamp###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'tstamp' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###tstamp###']						= $this->cObj->stdWrap ($this->getFieldContent ( 'date_updated' ), $this->conf['singleView.']['cellDataWrap.'] );
			$markerArray['###label_crdate###']					= $this->cObj->stdWrap ($this->getFieldHeader ( 'crdate' ), $this->conf['singleView.']['cellHeadWrap.'] );
			$markerArray['###crdate###']						= $this->cObj->stdWrap ($this->getFieldContent ( 'date_added' ), $this->conf['singleView.']['cellDataWrap.'] );
			$out = $this->cObj->stdWrap ($this->cObj->substituteMarkerArrayCached ( $template, $markerArray ), $this->conf['singleView.']['resultWrap.'] );
		}else{
			$out = $this->cObj->stdWrap ( $this->pi_getLL ( 'noResult' ), $this->conf['common.']['noResultWrap.'] );
		}
		$out .= $this->cObj->stdWrap ( $this->pi_list_linkSingle ( $this->pi_getLL ( 'back' ),0 ), $this->conf['singleView.']['backLinkWrap.'] );
		$out = $head . $out;
		$out .= $this->pi_getEditPanel();
		return $out;
	}
	/**
	 * [Put your description here]
	 */
	function getFieldContent($fN) {
		switch($fN) {
			case 'model':
				if ( $this->piVars["showUid"] ) {
					return $this->internal["currentRow"][$fN];
				}else{
					return $this->pi_list_linkSingle($this->internal["currentRow"][$fN],$this->internal["currentRow"]["uid"],1);	// The "1" means that the display of single items is CACHED! Set to zero to disable caching.
				}
			break;
			case 'price':
				return $this->cObj->stdWrap ( number_format ( $this->internal["currentRow"][$fN], 2, ',', '' ), $this->conf['common.']['currencyWrap.'] );
			break;
			case 'cubic_capacity':
				return $this->cObj->stdWrap ( $this->internal["currentRow"][$fN], $this->conf['common.']['cubicCapacityWrap.'] );
			break;
			case 'mileage':
				return $this->cObj->stdWrap ( $this->internal["currentRow"][$fN], $this->conf['common.']['mileageWrap.'] );
			break;
			case 'power':
				$power = $this->cObj->stdWrap ( $this->internal["currentRow"][$fN], $this->conf['common.']['powerWrapKW.'] );
				$power .= $this->cObj->stdWrap ( number_format ( $this->internal["currentRow"][$fN] * 1.36, 0, ',', '' ), $this->conf['common.']['powerWrapPS.'] );
				return $power;
			break;
			case 'colour':
				if ( $this->internal['currentRow']['metallic'] == 1 ) {
					return sprintf ( '%s metallic', $this->internal["currentRow"][$fN] );
				} else {
					return $this->internal["currentRow"][$fN];
				}
			break;
			case 'initial_registration':
				// For a numbers-only date, use something like: %d-%m-%y
				$this->date_added = $this->internal["currentRow"]['date_added'];
				$this->date_updated = $this->internal["currentRow"]['date_updated'];
				return strftime ( '%d.%m.%Y', $this->internal["currentRow"][$fN] );
			break;
			case 'date_updated':
				// For a numbers-only date, use something like: %d-%m-%y
				return strftime ( '%d.%m.%Y', $this->date_updated );
			break;
			case 'date_added':
				// For a numbers-only date, use something like: %d-%m-%y
				return strftime ( '%d.%m.%Y', $this->date_added );
			break;
			case 'equipment':
				if ( $this->internal["currentRow"]['list_equipment'] > 0 ) {
					$queryParts['SELECT']	= 'b.equipment AS list_equipment';
					$queryParts['FROM']		= '
												tx_aovehicles_vehicles_equipment_mm a,
												tx_aovehicles_equipment b
												';
					$queryParts['WHERE']	= sprintf ( 'a.uid_local = %s AND a.uid_foreign = b.uid', $this->internal['currentRow']['uid'] );
					$queryParts['GROUPBY']	= '';
					$queryParts['ORDERBY']	= 'b.equipment ASC';
					$queryParts['LIMIT']	= '';

					$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
												$queryParts['SELECT'],
												$queryParts['FROM'],
												$queryParts['WHERE'],
												$queryParts['GROUPBY'],
												$queryParts['ORDERBY'],
												$queryParts['LIMIT']
											);
					while ( $this->internal["currentRow"] = $GLOBALS['TYPO3_DB']->sql_fetch_assoc( $res ) ) {
						$items[] = $this->getFieldContent ( 'list_equipment' );
					}
					$items = implode ( ', ', $items );
				}else{
					$items = '';
				}
				return $items;
			break;
			case 'image':
				$titleText = sprintf ( '%s %s', $this->getFieldContent ( 'brand' ), $this->getFieldContent ( 'model' ) );
				$imgCode = $this->conf['vehicleImageCObject.'];
				$imgCode['titleText'] = $titleText;
				$imgCode['altText'] = $titleText;
				$imgCode['file'] = sprintf ( 'uploads/%s/%s', substr ( $this->prefixId, 0, -4 ), $this->internal["currentRow"][$fN] );
				return $this->cObj->IMAGE ( $imgCode );
			break;
			default:
				return $this->internal["currentRow"][$fN];
			break;
		}
	}
	/**
	 * [Put your description here]
	 */
	function getFieldHeader($fN) {
		switch($fN) {
			default:
				return $this->pi_getLL ( 'listFieldHeader_' . $fN, '[' . $fN . ']' );
			break;
		}
	}

	/**
	 * [Put your description here]
	 */
	function getFieldHeader_sortLink($fN) {
		return $this->pi_linkTP_keepPIvars($this->getFieldHeader($fN),array("sort"=>$fN.":".($this->internal["descFlag"]?0:1)));
	}
}



if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/ao_vehicles/pi1/class.tx_aovehicles_pi1.php"])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/ao_vehicles/pi1/class.tx_aovehicles_pi1.php"]);
}

?>