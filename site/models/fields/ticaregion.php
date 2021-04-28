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
class JFormFieldticaregion extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 */
	protected $type = 'ticaregion';

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 * @since   1.6
	 */
	protected function getOptions()
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);
		$query = "SELECT `competitive_region_abbreviation` as value, CONCAT(`competitive_region_name`,' ','(',`competitive_region_abbreviation`,')' ) AS text FROM `#__toes_competitive_region` ORDER BY `competitive_region_name` ASC";
		// Get the options.
		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}
