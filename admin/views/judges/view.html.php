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
 * View class for a list of judges.
 */
class JudgesViewJudges extends JViewLegacy
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
        
		JudgesHelper::addSubmenu('judges');
        
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

		$state	= $this->get('State');
		$canDo	= JudgesHelper::getActions();

		JToolBarHelper::title(JText::_('COM_JUDGES_TITLE_JUDGES'), 'judges.png');

		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('judge.add','JTOOLBAR_NEW');
		}

		if ($canDo->get('core.edit') && isset($this->items[0])) {
			JToolBarHelper::editList('judge.edit','JTOOLBAR_EDIT');
		}

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'judges.delete','JTOOLBAR_DELETE');
            }

			if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('judges.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_judges');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_judges&view=judges');
        
        $this->extra_sidebar = '';
	}
    
	protected function getSortFields()
	{
		return array(
		'j.id' => JText::_('COM_JUDGES_JUDGE_ID_LABEL'),
		'j.lastname' => JText::_('COM_JUDGES_LAST_NAME_LABEL'),
		'j.firstname' => JText::_('COM_JUDGES_FIRST_NAME_LABEL'),
		's.status' => JText::_('COM_JUDGES_STATUS_LABEL'),
		);
	}
}
