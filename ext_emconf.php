<?php

########################################################################
# Extension Manager/Repository config file for ext "miflowplayer".
#
# Auto generated 12-02-2011 23:18
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Flowplayer',
	'description' => 'Upload a FLV, F4V or MP4 file and load it with the flowplayer (www.flowplayer.org).',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.1.9',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/tx_miflowplayer',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Michael Schulze',
	'author_email' => 'info@michael66.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.1.0-4.9.9',
			'lib' => '0.1.0-0.1.0',
			'div' => '0.1.0-0.1.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:29:{s:9:"ChangeLog";s:4:"3a85";s:10:"README.txt";s:4:"9fa9";s:21:"ext_conf_template.txt";s:4:"1ec6";s:12:"ext_icon.gif";s:4:"1a35";s:14:"ext_tables.php";s:4:"bf39";s:13:"locallang.xml";s:4:"cff9";s:16:"locallang_db.xml";s:4:"3522";s:12:"miflowplayer";s:4:"d41d";s:33:"configurations/flexformPlayer.xml";s:4:"2944";s:24:"configurations/setup.txt";s:4:"cb56";s:55:"controllers/class.tx_miflowplayer_controller_player.php";s:4:"60cf";s:58:"controllers/base/class.tx_miflowplayer_controller_base.php";s:4:"59cf";s:14:"doc/manual.sxw";s:4:"8d7a";s:45:"models/class.tx_miflowplayer_model_config.php";s:4:"0cfe";s:26:"res/flowplayer/LICENSE.txt";s:4:"4e25";s:25:"res/flowplayer/README.txt";s:4:"8019";s:35:"res/flowplayer/flowplayer-3.2.2.swf";s:4:"e0a9";s:44:"res/flowplayer/flowplayer.controls-3.2.1.swf";s:4:"b3f5";s:46:"res/flowplayer/example/flowplayer-3.2.2.min.js";s:4:"e85e";s:33:"res/flowplayer/example/index.html";s:4:"d2d6";s:32:"res/flowplayer/example/style.css";s:4:"e2ef";s:30:"res/js/flowplayer-3.2.2.min.js";s:4:"e85e";s:26:"res/js/jquery-1.4.2.min.js";s:4:"65b3";s:24:"templates/showPlayer.php";s:4:"c4fc";s:43:"views/class.tx_miflowplayer_view_header.php";s:4:"86db";s:43:"views/class.tx_miflowplayer_view_player.php";s:4:"649b";s:46:"views/base/class.tx_miflowplayer_view_base.php";s:4:"a94e";s:44:"wiz/class.tx_miflowplayer_player_wizicon.php";s:4:"fd8e";s:35:"wiz/miflowplayer_player_wizicon.gif";s:4:"1d2b";}',
);

?>