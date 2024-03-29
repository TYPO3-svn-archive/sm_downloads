<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Downloadcenter',
	'downloadcenter'
);

$pluginName='downloadcenter'; // siehe Tx_Extbase_Utility_Extension::registerPlugin
$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_'.$pluginName;
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/setup.xml');
?>