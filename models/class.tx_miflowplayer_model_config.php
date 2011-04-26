<?php
require_once(PATH_t3lib . 'class.t3lib_page.php');

class tx_miflowplayer_model_config extends tx_lib_object {
	protected $extKey = 'miflowplayer';
	protected $extKeyPrefix = 'tx_miflowplayer';
	protected $modelName = 'config';

	public $config = array(
		'video' => array(
			'url' => "/video.flv",
			'width' => "400",
			'height' => "300",
		),
		'param' => array(
			'clip' => array(
				'autoPlay' => "true"
			)
		),
		'playlist' => array(
			0 => array(
				'url' => "/video.flv",
				'scaling' => "'fit'"
			)
		),
		'startscreen' => array(
			'url' => "/start.jpg",
			'scaling' => "'fit'",
			'autoPlay' => "true"
		)
	);

	public function getConfig() {
		//t3lib_div::debug($this->controller->configurations->get('config.'));
		$this->tsConfig = $this->getTsConfig($this->controller->configurations->get('config.'));

		unset($this->config);
		$this->config = $this->createConfig();

		return $this->config;
	}

	private function createConfig() {
		$config = $this->compareConfig('',$this->tsConfig);
		//t3lib_div::debug($config);

		$this->url = '';
		$this->getUrl();

		//sets the correct path for video file
		$config['video']['url'] = $this->url."uploads/".$this->extKeyPrefix."/".$config['video']['url'];

		// sets the playlist for startscreen
		if ($config['startscreen']['url']) {
			//sets the correct path for startscreen file
			$config['startscreen']['url'] = "'".$this->url."uploads/".$this->extKeyPrefix."/".$config['startscreen']['url']."'";
			$config['video']['url'] = "'".$config['video']['url']."'";

			foreach ($config['startscreen'] as $key => $value) {
				$config['playlist'][0][$key] = $value;
			};
			$config['playlist'][1]['url'] = $config['video']['url'];
			$i = 0;
			foreach ($config['param']['clip'] as $key => $value) {
				$config['playlist'][1][$key] = $value;
				$i++;
				//if ($i==2) break;
			}
		}

		return $config;
		}

	/**
	 * Compares the data in TS and Flexform and creates a full config array
	 * 
	 * @return	array()	final config array
	 */
	private function compareConfig($tsKey, $tsConfig) {
		foreach($tsConfig as $key => $value){
			if(is_array($value)) {
				$config[$key] = $this->compareConfig($tsKey.$key,$value);
			} else {
				if($this->controller->configurations->get($tsKey.$key)) {
					$config[$key] = $this->controller->configurations->get($tsKey.$key);
				} else {
					if($value) $config[$key] = $value;
				}
			}
		}

		return $config;
	}

	/** Creates a real array from TS-Setup
	 * 
	 * @param	array()	an array with TS-Setup (including the dot)
	 * 
	 * @return array()	an array without dots in the keys
	 */
	private function getTsConfig($array) {
		$newArray = array();

		foreach($array as $key => $value) {
			if(is_array($value)){
				$newArray[substr($key, 0, -1)] = $this->getTsConfig($value);
			} else {
				$newArray[$key] = $value; 
			}
		}

		return $newArray;
	}

	/**
	 * Get's the absRefPrefix or baseURL if set
	 * 
	 * @return String URL
	 */
	private function getUrl(){
		if ($GLOBALS['TSFE']->absRefPrefix) {
			$this->url = $GLOBALS['TSFE']->absRefPrefix;
			return true;
		} else if ($GLOBALS['TSFE']->config['config']['baseURL']) {
			$this->url = $GLOBALS['TSFE']->config['config']['baseURL'];
			return true;
		} else {
			return false;
		}
	}
}
?>
