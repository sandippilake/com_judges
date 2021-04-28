<?php
/**
 * @version     1.0.0
 * @package     com_carparts
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      vaishali <vaishali.dubal27@gmail.com> - http://
 */


// no direct access
defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Judges');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
