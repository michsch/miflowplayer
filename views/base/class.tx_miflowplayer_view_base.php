<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Michael Schulze <info@michael66.de>
*  GPL
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
 * General view class of mihotel extension.
 *
 * @author	Michael Schulze <info@michael66.de>
 */

tx_div::load('tx_lib_phpTemplateEngine');

class tx_miflowplayer_view_base extends tx_lib_phpTemplateEngine {

	protected $extKey = 'miflowplayer';
	protected $extKeyPrefix = 'tx_miflowplayer';

	/** Will be set by the inherited view class. */
	protected $viewName = 'base';
	
	/**
	 * Gets a localized translation from a locallang file for the given key,
	 * must not be empty.
	 * The path to the locallang file must be set in the controller
	 * configurations 'pathToLanguageFile'.
	 *
	 * @param	string	key in the language file without %%% wrap,
	 * 					must not be empty
	 *
	 * @return	string	localized string for the given key, will not be empty
	 */
	public function translate($languageKey) {
		if ($this->controller
			&& $this->controller->configurations()->get('pathToLanguageFile')
		) {
			$translator = t3lib_div::makeInstance('tx_lib_translator',$this->controller);
			$result = $translator->translate('%%%' . $languageKey . '%%%');
		} else {
			$result = $languageKey;
		}

		return $result;
	}


	/**
	 * Renders the PHP template to populate it with the data and replaces any
	 * %%% locallang markers.
	 *
	 * The parameter can be a key of an element in the $configurations object
	 * that points to a filename.
	 * The parameter can be a filename. The ".php" ending is added if missing.
	 *
	 * Usage:
	 *
	 * 1.) $view->render('exampleTemplateKey');
	 * 2.) $view->render('exampleTemplateFileName.php');
	 *
	 * @param	string		configuration key or filename of a template file
	 *
	 * @return	string		typically an (x)html string
	 *
	 * @see	tx_lib_phpTemplateEngine::render
	 */
	public function render($configurationKeyOrFileName) {
		$rawResult = parent::render($configurationKeyOrFileName);

		$translatorClassName = 'tx_lib_translator';

		if ($this->controller
			&& $this->controller->configurations()->get('pathToLanguageFile')
		) {
			$translator = t3lib_div::makeInstance('tx_lib_translator',$this->controller, $this);
			$result = $translator->translateContent();
		} else {
			$result = $rawResult;
		}

		return $result;
	}
	
	/**
	 * Creates a relative path or path with filename which can be used for links
	 * or other stuff in HTML
	 * The string EXT: would be replaced by the relative path
	 * 
	 * @param string path or filename
	 * 
	 * @return string an relative path or path with filename
	 */
	public function createRelativePath($path) {
		if(str_replace('EXT:', 'typo3conf/ext/', $path)){
			$relPath = str_replace('EXT:', 'typo3conf/ext/', $path);
		}

		return $relPath;
	}

	/**
	 * Creates the _trackPageview for Google Analytics Tracking of links without
	 * a new page load
	 * 
	 * @param string link url (href in A-Tag)
	 * @param array params like css classes or id's. Easy define 'class="boldLink"' or 'name="external2"' and not use onClick events here! 
	 * @param string javascript functions which should be called on an onClick event
	 * @param string tracking path without language path
	 * 
	 * @return string final link as an A-Tag
	 */
	 public function createTrackingLink($url, $params, $jsOnClick, $trackingPath) {
	 	
	 }
}

?>