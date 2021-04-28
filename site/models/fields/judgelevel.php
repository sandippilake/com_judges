<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_judges
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_judges
 */
class JFormFieldJudgelevel extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 */
	protected $type = 'judgelevel';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 * @since   1.6
	 */
	protected function getOptions()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDbo();

		$this->label =$this->getAttribute('label', '');
		$user = JFactory::getUser();
		$params = JComponentHelper::getParams('com_judges');
		$judge_group_id = $params->get('judgegroup');
		$admingroup = $params->get('admingroup');
		
		$query = $db->getQuery(true)
			->select('judge_level_id AS value, judge_level AS text')
			->from('#__jdg_judge_level')
			->order('judge_level ASC');
		$query->where('`judge_level` != "Guest Judge"');
		
		if(!in_array($admingroup, $user->groups)) { 
			//$query->where('`judge_level` != "Guest Judge"');
			$query->where('`judge_level` != "Licensed Guest Judge"');
		}
	
		// Get the options.
		$db->setQuery($query);
		$options = $db->loadObjectList();

		array_unshift($options, JHtml::_('select.option', '', JText::_($this->label)));

		return $options;
	}
}
