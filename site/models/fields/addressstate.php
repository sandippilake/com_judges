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
class JFormFieldAddressstate extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 */
	protected $type = 'addressstate';

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

		$params = JComponentHelper::getParams('com_judges');
		$judge_group_id = $params->get('judgegroup');

		$query = $db->getQuery(true)
			->select('distinct(c.cb_state) AS value, c.cb_state AS text')
			->from('#__comprofiler AS c')
			->join('left', '#__user_usergroup_map AS ug ON ug.user_id = c.user_id')
			->where('ug.group_id = '.$judge_group_id)
			->where('( TRIM(c.cb_state) != "" AND c.cb_state IS NOT NULL )')
			->order('c.cb_state ASC');

		$country = $app->getUserState('judges.filter.country');

		if($country) {
			$query->where('c.cb_country LIKE '.$db->quote($country));
		}

		// Get the options.
		$db->setQuery($query);
		$options = $db->loadObjectList();

		array_unshift($options, JHtml::_('select.option', '', JText::_($this->label)));

		return $options;
	}
}
