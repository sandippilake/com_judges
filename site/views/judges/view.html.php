<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_compare
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class JudgesViewJudges extends JViewLegacy
{
	protected $data;
	protected $params;
	protected $state;
	
	function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->state = $this->get('State');
		$this->guestjudges = $this->get('Guestjudges');
		$this->photoapprovals = $this->get('Photoapprovals');

		$this->filterForm = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
		
		parent::display();
	}
}
