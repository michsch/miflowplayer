<?php
require_once(t3lib_extMgm::extPath('div') . 'class.tx_div.php');

require_once(t3lib_extMgm::extPath('lib') . 'class.tx_lib_controller.php');
require_once(t3lib_extMgm::extPath('lib') . 'class.tx_lib_translator.php');

class tx_miflowplayer_controller_base extends tx_lib_controller {
	protected $className = 'tx_miflowplayer_controller_base';
	protected $extKey = 'miflowplayer';
	protected $extKeyPrefix = 'tx_miflowplayer';
	protected $controllerName = 'base';

	public $defaultDesignator = 'miflowplayer_base';

	protected function newView($viewName) {
		$view = null;
		// Get class name.
		$className = $this->extKeyPrefix.'_view_'.$viewName;
		// Determine class file name from class name.
		$classFile = t3lib_extMgm::extPath($this->extKey).'views/'
			.'class.'.$className.'.php';

		// Check if class file exists.
		if (file_exists($classFile)) {
			require_once($classFile);		

			// Create new view object.
			$view = t3lib_div::makeInstance($className);

			$view->controller($this);

			// Set default designator for creating links with tx_xxx[nn] prefix
			// in GET/POST parameters.
			$view->setDefaultDesignator($this->getDesignator());

			$path = $this->configurations()->get('templatePath');
			$view->setPathToTemplateDirectory('EXT:'.$this->extKey.'/'.$path);

		}
		return $view;
	}

	protected function newModel($modelName) {
		$className = $this->extKeyPrefix.'_model_'.$modelName;
		$classFile = t3lib_extMgm::extPath($this->extKey).'models/'
			.'class.'.$className.'.php';

		if (file_exists($classFile)) {
			require_once($classFile);
			$model = t3lib_div::makeInstance($className);

			$model->controller($this);
		}
		return $model;
	}
}
?>