<?php
//tx_div::load('tx_lib_phpTemplateEngine');
require_once(t3lib_extMgm::extPath('miflowplayer') . 'views/base/class.tx_miflowplayer_view_base.php');

class tx_miflowplayer_view_player extends tx_miflowplayer_view_base {

	protected $extKey = 'miflowplayer';
	protected $extKeyPrefix = 'tx_miflowplayer';

	/** Will be set by the inherited view class. */
	protected $viewName = 'player';

	/** Gets all configurations and creates an array of them
	 * 
	 * @return	array()	all master configurations in an array
	 */
	public function getConfig() {
		$tsConfig = $this->tsToRealArray($this->controller->configurations->get('config.'));

		$this->config = $this->compareConfig('',$tsConfig);
		//t3lib_div::debug($this->config);

		return true;
	}

	public function createContainer($id) {
		$slashContent = '';

		$containerElements = array(
			'tag' => $this->controller->configurations->get('views.container.tag.single'),
			'attributes' => array(
				'id' => $id,
				'class'	=> $this->controller->configurations->get('views.container.class'),
				'style'	=> 'display:block;'.$this->getWidthHeight()
			)
		);

		if(is_array($this->config['playlist'])){
			$containerElements['tag'] = $this->controller->configurations->get('views.container.tag.playlist');
		} else {
			$containerElements['attributes']['href'] = $this->config['video']['url'];
		}

		$container = '<'.$containerElements['tag'].' ';
		foreach($containerElements['attributes'] as $att => $value) {
			$container .= $att.'="'.$value.'" ';
		}
		$container .= '>'.$slashContent.'</'.$containerElements['tag'].'>';

		return $container;
	}

	/**
	 * Create all the configs for the flowplayer
	 * 
	 * @return string	All configs in a string for javascript
	 */
	public function createConfigString() {
		$this->configString = $this->arrayToConfString($this->config['param'],1);

		// Create playlist
		if($this->config['startscreen']['url'] && $this->config['param']['clip']['autoPlay']=='false' && is_array($this->config['playlist']) && $this->createPlaylist()) {
			// Adds the comma so the adding of playlist will work fine
			$this->configString .= ",\n".$this->playlistString;
		}

		// Add manual flowplayer config
		if ($this->config['configstring']) {
			$this->configString .= ",\n".$this->config['configstring']."\n";
		}

		return $this->configString;
	}

	/**
	 * Compares the data in TS and Flexform ans creates a full config array
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
					$config[$key] = $value;
				}
			}
		}

		return $config;
	}

	private function createPlaylist() {
		if (is_array($this->config['playlist'])) {
			$firstCounter = 1;
			// build playlist
			$this->playlistString = "playlist: [\n";
			foreach ($this->config['playlist'] as $key => $item) {
				$secondCounter = 1;
				$this->playlistString .= "\t{\n";
				foreach ($item as $attr => $value) {
					if($secondCounter != count($item)) {
						$this->playlistString .= "\t\t".$attr.": ".$value.",\n";
					} else {
						$this->playlistString .= "\t\t".$attr.": ".$value."\n";
					}
					$secondCounter++;
				}
				if($firstCounter != count($this->config['playlist'])) {
					$this->playlistString .= "\t},\n";
				} else {
					$this->playlistString .= "\t}\n";
				}
				$firstCounter++;
			}
			$this->playlistString .= "]\n";

			return true;
		} else {
			return false;
		};
	}

	private function getWidthHeight() {
		$styleTag = 'width:'.$this->config['video']['width'].'px;height:'.$this->config['video']['height'].'px;';
		
		return $styleTag;
	}

	/**
	 * Creates a real array from TS-Setup
	 * 
	 * @param	array()	an array with TS-Setup (including the dot)
	 * 
	 * @return array()	an array without dots in the keys
	 */
	private function tsToRealArray($array) {
		$newArray = array();

		foreach($array as $key => $value) {
			if(is_array($value)){
				$newArray[substr($key, 0, -1)] = $this->tsToRealArray($value);
			} else {
				$newArray[$key] = $value; 
			}
		}

		return $newArray;
	}	

	/**
	 * Creates the string to use in javascript and needs an array
	 * 
	 * @param	array	Array with all configs
	 * 
	 * @return	string	configs in a string for the template
	 */
	private function arrayToConfString($array, $depth) {
		$configString = '';
		$tab = "\t";
		for ($i=0; $i<$depth; $i++) { $tabs .= $tab; };
		
		$counter = 1;

		foreach($array as $key => $value) {
			if(is_array($value)) {
				$configString .= $tabs.$key.": {\n";
				$configString .= $this->arrayToConfString($value,$depth++);
				if($counter != count($array)) {
					$configString .= $tabs."},\n";
				} else {
					$configString .= $tabs."}\n";
				}
			} else {
				if($counter != count($array)) {
					$configString .= $tabs.$tab.$key.": ".$value.",\n";
				} else {
					$configString .= $tabs.$tab.$key.": ".$value."\n";
				}
			}
			$counter++;
		}

		return $configString;
	}

	/**
	 * Gets a valid integer
	 * 
	 * @param	string	key from the flexform
	 * @param	string	key from the ts alternativ value
	 * 
	 * @return int	a valid integer
	 */
	private function getValidInt($flexKey, $tsKey) {
		if ($this->controller->configurations->get($flexKey)>0 && is_numeric($this->controller->configurations->get($flexKey))) {
			$value = $this->controller->configurations->get($flexKey);
		} else {
			$value = $this->controller->configurations->get($tsKey);
		}

		return $value;
	}
	
}

?>