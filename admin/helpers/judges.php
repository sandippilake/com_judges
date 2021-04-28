<?php
/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Judges helper.
 */
class JudgesHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_JUDGES_TITLE_JUDGES'),
			'index.php?option=com_judges',
			$vName == 'judges'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JUDGES_TITLE_STATUS'),
			'index.php?option=com_judges&view=status',
			$vName == 'status'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_JUDGES_JUDGE_LEVEL'),
			'index.php?option=com_judges&view=levels',
			$vName == 'levels'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_judges';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
