<?php
require_once(t3lib_extMgm::extPath('miflowplayer') . 'controllers/base/class.tx_miflowplayer_controller_base.php');

class tx_miflowplayer_controller_player extends tx_miflowplayer_controller_base {
	protected $className = 'tx_miflowplayer_controller_rss';
	protected $extKey = 'miflowplayer';
	protected $extKeyPrefix = 'tx_miflowplayer';
	protected $controllerName = 'player';

	public $defaultDesignator = 'miflowplayer_player';

	public $cssFiles = array(
		#'main' => 'EXT:misc_rssfeeds/templates/css/tx_miscrssfeeds.css',
	);
	public $jsFiles = array(
		'jQuery' => 'EXT:miflowplayer/res/js/jquery-1.4.2.min.js',
		'jQueryFlowplayer' => 'EXT:miflowplayer/res/js/flowplayer-3.2.2.min.js',
	);
	public $pathToFlowplayer = 'EXT:miflowplayer/res/flowplayer/flowplayer-3.2.2.swf';

	/**
	 * Default action to show the Player
	 * 
	 * @return	string	HTML-Snippet for plugin
	 */
	public function displayPlayerAction() {
		$model = $this->newModel('config');
		$config = $model->getConfig();

		$view = $this->newView('header');
		$view->renderHeader($this->jsFiles);

		$view = $this->newView('player');
		$view->set('config', $config);

		return $view->render('showPlayer');
	}
}

?>