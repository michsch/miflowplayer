<?php

t3lib_extMgm::addStaticFile('miflowplayer', 'configurations', 'Flowplayer');

$TCA['tt_content']['types']['list']['subtypes_excludelist']['tx_miflowplayer_player']='layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist']['tx_miflowplayer_player']='pi_flexform';

t3lib_extMgm::addPlugin(array('LLL:EXT:miflowplayer/locallang_db.xml:tx_miflowplayer_player', 'tx_miflowplayer_player'), 'list_type');
t3lib_extMgm::addPiFlexFormValue('tx_miflowplayer_player', 'FILE:EXT:miflowplayer/configurations/flexformPlayer.xml');

if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_miflowplayer_player_wizicon"] = t3lib_extMgm::extPath('miflowplayer')."wiz/class.tx_miflowplayer_player_wizicon.php";
?>