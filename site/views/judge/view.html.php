<?php
/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

jimport('joomla.application.component.view');

class JudgesViewJudge extends JViewLegacy
{
	protected $data;
	protected $params;
	protected $state;
	protected $item;
	
	function display($tpl = null)
	{
		$app  = JFactory::getApplication();
		$this->state   = $this->get('State');
		$this->params  = $app->getParams('com_judges');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		$this->users		= $this->get('Users');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
		}

		parent::display();
	}
	
}
