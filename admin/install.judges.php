<?php

/**
* @version 3.0.10
* @package Joomla 3.x
* @subpackage Compare
* @copyright Copyright (C) 2006 DTH Development
* @copyright contact dthdev@dthdevelopment.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
class com_judgesInstallerScript {
	function install($parent) { com_install(); }
	function update($parent) { com_install(); }
	function uninstall($parent) { com_uninstall(); }
	function preflight($type, $parent) { return true; }
	function postflight($type, $parent) { return true; }
}
define('DS',DIRECTORY_SEPARATOR);
function com_install() {
	echo "<b>Judges component has been successfully Installed.</b>";
}
function com_uninstall()
{
	echo "<b>Judges component has been successfully Uninstalled.</b>";
}
?>
