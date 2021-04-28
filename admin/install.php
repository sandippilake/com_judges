<?php

use SBBCodeParser\Exception;
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component.
 *
 * The name of this class is dependent on the component being installed.
 * The class name should have the component's name, directly followed by
 * the text InstallerScript (ex:. com_helloWorldInstallerScript).
 *
 * This class will be called by Joomla!'s installer, if specified in your component's
 * manifest file, and is used for custom automation actions in its installation process.
 *
 * In order to use this automation script, you should reference it in your component's
 * manifest file as follows:
 * <scriptfile>script.php</scriptfile>
 *
 * @package     Joomla.Administrator
 * @subpackage  com_judges
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
class com_judgesInstallerScript
{
	/**
	 * This method is called after a component is installed.
	 *
	 * @param  \stdClass $parent - Parent object calling this method.
	 *
	 * @return void
	 */
	public function install($parent) 
	{
		//$parent->getParent()->setRedirectURL('index.php?option=com_judges');
	}

	/**
	 * This method is called after a component is uninstalled.
	 *
	 * @param  \stdClass $parent - Parent object calling this method.
	 *
	 * @return void
	 */
	public function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_JUDGES_UNINSTALL_TEXT') . '</p>';

		$db = JFactory::getDbo();
		
		try {
			$db->transactionStart();
			$query = $db->getQuery(true);
			$query->delete('#__comprofiler_tabs')
				->where('title = ' . $db->quote('Judge Tab'))
				;
			$db->setQuery($query);
			$db->execute();

			$cbfields = array( 
				'cb_judge_profile_picture', 
				'cb_judge_abbreviation', 
				'cb_judgestatus', 
				'cb_judgelevel', 
				'cb_licensed', 
				'cb_licensed_until', 
				'cb_airport', 
				'cb_judge_of_merit', 
				'cb_judge_emeritus', 
				'cb_distinguished_judge', 
				'cb_ring_instructor', 
				'cb_school_instructor', 
				'cb_genetics_instructor', 
				'cb_judges_other'
			);	
			
			foreach ($cbfields as $field) {
				$query = $db->getQuery(true);
				$query->delete('#__comprofiler_fields')
				->where('name = ' . $db->quote($field))
				;
				$db->setQuery($query);
				$db->execute();
			}

			$tablecolumns = array(
					'cb_judge_profile_picture',
					'cb_judge_profile_pictureapproved',
					'cb_airport');

			foreach ($tablecolumns as $column) {
				$query = "ALTER TABLE `#__comprofiler` DROP ".$column;
				$db->setQuery($query);
				$db->execute();
			}
		} catch(Exception $e){

			$db->transactionRollback();
			echo '<p>' . JText::_('COM_JUDGES_INSTALL_ERROR') . ' <br/>'.$e->getMessage().'</p>';
		}
	}

	/**
	 * This method is called after a component is updated.
	 *
	 * @param  \stdClass $parent - Parent object calling object.
	 *
	 * @return void
	 */
	public function update($parent) 
	{
		echo '<p>' . JText::sprintf('COM_JUDGES_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
	}

	/**
	 * Runs just before any installation action is preformed on the component.
	 * Verifications and pre-requisites should run in this function.
	 *
	 * @param  string    $type   - Type of PreFlight action. Possible values are:
	 *                           - * install
	 *                           - * update
	 *                           - * discover_install
	 * @param  \stdClass $parent - Parent object calling object.
	 *
	 * @return void
	 */
	public function preflight($type, $parent) 
	{
		$app = JFactory::getApplication();
		if (!JComponentHelper::getComponent('com_comprofiler', true)->enabled)
		{
			$app->enqueueMessage('Community Builder muct be installed before using of this component','error');
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Runs right after any installation action is preformed on the component.
	 *
	 * @param  string    $type   - Type of PostFlight action. Possible values are:
	 *                           - * install
	 *                           - * update
	 *                           - * discover_install
	 * @param  \stdClass $parent - Parent object calling object.
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		$db = JFactory::getDbo();
		
		try {
			$db->transactionStart();

			$query = $db->getQuery(true);
			$query->select('tabid')
				->from('#__comprofiler_tabs')
				->where('title = ' . $db->quote('Judge Tab'))
				;
			$db->setQuery($query);
			$tab_id = $db->loadResult();

			if(!$tab_id) {
				$query = $db->getQuery(true);
				$fields = array(
					$db->quoteName('title') . ' = ' . $db->quote('Judge Tab'),
					$db->quoteName('description') . ' = ' .  $db->quote(''),
					$db->quoteName('ordering') . ' = ' . 11,
					$db->quoteName('ordering_edit') . ' = ' . 11,
					$db->quoteName('ordering_register') . ' = ' . 11,
					$db->quoteName('width') . ' = ' . $db->quote('.5'),
					$db->quoteName('enabled') . ' = 1',
					$db->quoteName('pluginclass') . ' = ' . $db->quote(''),
					$db->quoteName('pluginid') . ' = NULL',
					$db->quoteName('fields') . ' = 1',
					$db->quoteName('params') . ' = NULL',
					$db->quoteName('sys') . ' = 0',
					$db->quoteName('displaytype') . ' = ' . $db->quote('menu'),
					$db->quoteName('position') . ' = ' . $db->quote('canvas_main_middle'),
					$db->quoteName('viewaccesslevel') . ' = 7',
					$db->quoteName('cssclass') . ' = ' . $db->quote(''),
				);
				$query->insert($db->quoteName('#__comprofiler_tabs'))->set($fields);
				
				$db->setQuery($query);
				$db->execute();
				$tab_id = $db->insertid();
			}

			$query = $db->getQuery(true);
			$query->select('id')
				->from('#__comprofiler_plugin')
				->where('element = ' . $db->quote('cbqueryfield'))
				;
			$db->setQuery($query);
			$query_plugin_id = $db->loadResult();

			//INSERT INTO `p5wz7_comprofiler_fields` (`fieldid`, `name`, `tablecolumns`, `table`, `title`, `description`, `type`, `maxlength`, `size`, `required`, `tabid`, `ordering`, `cols`, `rows`, `value`, 
			//`default`, `published`, `published`, `edit`, `profile`, `readonly`, `searchable`, `calculated`, `sys`, `pluginid`, `cssclass`, `params`) VALUES
			$cbfields = array(
				array(
					'name' => 'cb_judge_profile_picture', 
					'tablecolumns' => 'cb_judge_profile_picture,cb_judge_profile_pictureapproved', 
					'table' => '#__comprofiler', 
					'title' => 'Judge Profile Picture', 
					'description' => '', 
					'type' => 'image', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 1, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 1, 
					'profile' => 1, 
					'readonly' => 0, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => 1, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"image_allow_uploads\":\"1\",\"avatarResizeAlways\":\"\",\"avatarHeight\":\"\",\"avatarWidth\":\"\",\"avatarSize\":\"\",\"thumbHeight\":\"\",\"thumbWidth\":\"\",\"avatarMaintainRatio\":\"\",\"avatarUploadApproval\":\"\",\"image_client_resize\":\"1\",\"image_allow_gallery\":\"0\",\"image_gallery_path\":\"\",\"imageStyle\":\"roundedbordered\",\"pendingDefaultAvatar\":\"\",\"defaultAvatar\":\"\",\"altText\":\"\",\"altTextCustom\":\"\",\"titleText\":\"\",\"titleTextCustom\":\"\",\"image_terms\":\"0\",\"terms_output\":\"url\",\"terms_type\":\"TERMS_AND_CONDITIONS\",\"terms_url\":\"\",\"terms_text\":\"\",\"terms_display\":\"modal\",\"terms_width\":\"400\",\"terms_height\":\"200\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_judge_abbreviation', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Judge Abbreviation', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 2, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"SELECT `judge_abbreviation` FROM `#__jdg_judges` WHERE `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_judgestatus', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Judge Status', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 3, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"SELECT `s`.`judge_status` FROM `p5wz7_jdg_judge_status` AS `s` LEFT JOIN  `#__jdg_judges` AS `j` ON `j`.`judgestatus` = `s`.`judge_status_id` WHERE `j`.`user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Please select judge status\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_judgelevel', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Judge Level', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 4, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"SELECT `judge_level` FROM `p5wz7_jdg_judge_level` AS `l` LEFT JOIN  `#__jdg_judges` AS `j` ON `j`.`judgelevel` = `l`.`judge_level_id` WHERE `j`.`user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"SELECT `judge_level_id` AS `id`, `judge_level` AS `value` FROM `p5wz7_judge_level` WHERE 1\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_licensed', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Licensed', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 5, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select `licensed` FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_licensed_until', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Licensed Until', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 6, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select `licensed_until` FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\",\"cbconditional_conditioned\":\"0\",\"cbconditional_conditions\":[{\"condition\":[{\"field\":\"83,cb_judgelevel\",\"field_custom\":\"\",\"field_custom_translate\":\"0\",\"operator_viewaccesslevels\":\"0\",\"field_viewaccesslevels\":\"\",\"operator_usergroups\":\"0\",\"field_usergroups\":\"\",\"operator_languages\":\"12\",\"field_languages\":\"\",\"operator_moderators\":\"0\",\"operator_users\":\"12\",\"field_users\":\"\",\"operator\":\"0\",\"delimiter\":\"\",\"value\":\"6\",\"value_translate\":\"0\",\"location_registration\":\"1\",\"location_profile_edit\":\"1\",\"location_profile_view\":\"1\",\"location_userlist_search\":\"0\",\"location_userlist_view\":\"1\"}]}],\"cbconditional_debug\":\"0\"}'
				),
				array(
					'name' => 'cb_airport', 
					'tablecolumns' => 'cb_airport', 
					'table' => '#__comprofiler', 
					'title' => 'Airport', 
					'description' => '', 
					'type' => 'text', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 7, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 1, 
					'profile' => 1, 
					'readonly' => 0, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => 1, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"fieldPlaceholder\":\"\",\"fieldMinLength\":\"0\",\"fieldValidateExpression\":\"\",\"pregexp\":\"\\/^.*$\\/\",\"pregexperror\":\"Not a valid input\",\"fieldValidateForbiddenList_register\":\"http:,https:,mailto:,\\/\\/.[url],<a,<\\/a>,&#\",\"fieldValidateForbiddenList_edit\":\"\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_judge_of_merit', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Judge of Merit', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 8, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select IF(`judge_of_merit` = 1, \'Yes\', \'No\') FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_judge_emeritus', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Judge Emeritus', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 9, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select IF(`judge_emeritus` = 1, \'Yes\', \'No\') FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_distinguished_judge', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Distinguished Judge', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 10, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select IF(`distinguished_judge` = 1, \'Yes\', \'No\') FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_ring_instructor', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Ring Instructor', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 11, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select IF(`ring_instructor` = 1, \'Yes\', \'No\') FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_school_instructor', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'School Instructor', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 12, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select IF(`school_instructor` = 1, \'Yes\', \'No\') FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_genetics_instructor', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Genetics Instructor', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 13, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select IF(`genetics_instructor` = 1, \'Yes\', \'No\') FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
				array(
					'name' => 'cb_judges_other', 
					'tablecolumns' => '', 
					'table' => '#__comprofiler', 
					'title' => 'Other', 
					'description' => '', 
					'type' => 'query', 
					'maxlength' => 0, 
					'size' => 0, 
					'required' => 0, 
					'tabid' => $tab_id, 
					'ordering' => 14, 
					'cols' => NULL, 
					'rows' => NULL, 
					'value' => NULL, 
					'default' => '', 
					'published' => 1, 
					'registration' => 0, 
					'edit' => 0, 
					'profile' => 1, 
					'readonly' => 1, 
					'searchable' => 0, 
					'calculated' => 0, 
					'sys' => 0, 
					'pluginid' => $query_plugin_id, 
					'cssclass' => '', 
					'params' => '{\"fieldLayout\":\"\",\"fieldLayoutEdit\":\"\",\"fieldLayoutList\":\"\",\"fieldLayoutSearch\":\"\",\"fieldLayoutRegister\":\"\",\"fieldLayoutContentPlugins\":\"0\",\"fieldLayoutIcons\":\"\",\"qry_query\":\"Select `other` FROM `#__jdg_judges` where `user_id` = [user_id]\",\"qry_mode\":\"0\",\"qry_host\":\"\",\"qry_username\":\"\",\"qry_password\":\"\",\"qry_database\":\"\",\"qry_charset\":\"\",\"qry_prefix\":\"\",\"qry_output\":\"0\",\"qry_columns\":\"0\",\"qry_display\":\"0\",\"qry_delimiter\":\"0\",\"qry_custom\":\"\",\"qry_header\":\"\",\"qry_row\":\"\",\"qry_footer\":\"\",\"qry_template\":\"default\",\"qry_validate\":\"0\",\"qry_validate_query\":\"\",\"qry_validate_mode\":\"0\",\"qry_validate_host\":\"\",\"qry_validate_username\":\"\",\"qry_validate_password\":\"\",\"qry_validate_database\":\"\",\"qry_validate_charset\":\"\",\"qry_validate_prefix\":\"\",\"qry_validate_on\":\"0\",\"qry_validate_success\":\"\",\"qry_validate_error\":\"Not a valid input.\",\"qry_validate_ajax\":\"0\"}'
				),
			);

			foreach ($cbfields as $field) {
				$query = $db->getQuery(true);
				$query->select('fieldid')
					->from('#__comprofiler_fields')
					->where('name = ' . $db->quote($field['name']))
					;
				$db->setQuery($query);
				$fieldid = $db->loadResult();
		
				if(!$fieldid) {
					$query = $db->getQuery(true);
					$fields = array();
					foreach ($field as $key => $value) {
						$fields[] = $db->quoteName($key) . ' = ' . $db->quote($value);
					}
					$query->insert($db->quoteName('#__comprofiler_fields'))->set($fields);
					
					$db->setQuery($query);
					$db->execute();

					$config = JFactory::getConfig();

					if($field['tablecolumns']) {
						$columns = explode(',',$field['tablecolumns']);
						foreach ($columns as $column) {
							$query = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='".$config->get('db')."' AND TABLE_NAME='#__comprofiler' and column_name='".$column."';";
							$db->setQuery($query);
							$col = $db->loadResult();

							if(!$col) {
								$query = "ALTER TABLE ".$field['table']." ADD ".$column." VARCHAR(255)";
								$db->setQuery($query);
								$db->execute();
							}
						}
					}
				}
			}

			$query = "UPDATE `#__comprofiler` AS `c` LEFT JOIN `#__jdg_judges` AS `j` ON `j`.`user_id` = `c`.`user_id` SET `c`.`cb_airport` = `j`.`airport`";
			$db->setQuery($query);
			$db->execute();

			$db->transactionCommit();
		} catch(Exception $e){

			$db->transactionRollback();
			echo '<p>' . JText::_('COM_JUDGES_INSTALL_ERROR') . ' <br/>'.$e->getMessage().'</p>';
			return false;
		}
		return true; 
	}
}