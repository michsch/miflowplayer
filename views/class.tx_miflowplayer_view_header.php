<?php
/*
 * Created on 12.07.2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

//tx_div::load('tx_lib_phpTemplateEngine');
require_once(t3lib_extMgm::extPath('miflowplayer') . 'views/base/class.tx_miflowplayer_view_base.php');

class tx_miflowplayer_view_header extends tx_miflowplayer_view_base {

	protected $extKey = 'miflowplayer';
	protected $extKeyPrefix = 'tx_miflowplayer';

	/** Will be set by the inherited view class. */
	protected $viewName = 'header';

	/**
	 * Creates the header informations and includes the extension css- and js-files
	 * 
	 * @param array all stylesheet-files that should be included (default settings)
	 * @param array all js-files that should be included (default settings)
	 * 
	 * @return true
	 */
	public function renderHeader($jsFiles) {
		/*
		foreach ($jsFiles as $key => $value) {
			$GLOBALS['TSFE']->additionalHeaderData[$key] = '<script type="text/javascript" src="'.$this->createRelativePath($value).'"></script>';
		}
		*/
		
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['miflowplayer']);

		if (!$extConf['disableJsFramework']) {
				$GLOBALS['TSFE']->additionalHeaderData['miflowplayer_jquery'] = '	<script type="text/javascript" src="'.$this->createRelativePath($jsFiles['jQuery']).'"></script>';
		}
		/** Check extConf['enablejQueryEasing']: If flag is set, use jQuery easing */
		if (!$extConf['disableFlowplayerJs']) {
				$GLOBALS['TSFE']->additionalHeaderData['miflowplayer_flowplayer'] = '	<script type="text/javascript" src="'.$this->createRelativePath($jsFiles['jQueryFlowplayer']).'"></script>';
		}

		return @true;
	}
}
?>
