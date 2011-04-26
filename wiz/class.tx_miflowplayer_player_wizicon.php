<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Michael Schulze (info@michael66.de)
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
 * Class that adds the wizard icon.
 *
 * @author	Michael Schulze <info@michael66.de>
 */

class tx_miflowplayer_player_wizicon {
	function proc($wizardItems)	{
		global $LANG;

		$LL = $this->includeLocalLang();

		$wizardItems["plugins_tx_miflowplayer_player"] = array(
			"icon"=>t3lib_extMgm::extRelPath("miflowplayer")."wiz/miflowplayer_player_wizicon.gif",
			"title"=>$LANG->getLLL('tx_miflowplayer_player.title',$LL),
			"description"=>$LANG->getLLL('tx_miflowplayer_player.description',$LL),
			"params"=>"&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=tx_miflowplayer_player"
		);

		return $wizardItems;
	}


	function includeLocalLang()	{
		$llFile = t3lib_extMgm::extPath('miflowplayer').'locallang_db.xml';
		$LOCAL_LANG = t3lib_div::readLLXMLfile($llFile, $GLOBALS['LANG']->lang);

		return $LOCAL_LANG;
	}

}

if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/miflowplayer/wiz/class.tx_miflowplayer_player_wizicon.php"])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/miflowplayer/wiz/class.tx_miflowplayer_player_wizicon.php"]);
}

?>