<?php

/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

//jimport('joomla.application.component.controllerform');

class JudgesControllerJudge extends JControllerLegacy {

	function __construct() {
		$this->view_list = 'judges';
		parent::__construct();
	}
		
	
}
