<?php
/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of status.
 */
class JudgesViewStatus extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		
		$this->items		= $this->get('items');
		$this->state		= $this->get('State');
        $this->pagination	= $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		JudgesHelper::addSubmenu('status');
        
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/judges.php';

		$canDo	= JudgesHelper::getActions();

		JToolBarHelper::title(JText::_('COM_JUDGES_TITLE_STATUS'), 'status.png');

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_judges');
		}
		
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_judges&view=judges');
        
        $this->extra_sidebar = '';
	}
}
