<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Asset_master
 * @author     mohite sachin c <mohitesachin217@gmail.com>
 * @copyright  Sandip Pilake
 * @license    Spiderweb India Satara
 */

defined('JPATH_BASE') or die;
JFormHelper::loadFieldClass('list');

/**
 * Supports an HTML select list of categories
 *
 * @since  1.6
 */
class JFormFieldUsername extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 * @since    1.6
	 */
	protected $type = 'Username';

	/**
	 * Method to get the field input markup.
	 *
	 * @return   string  The field input markup.
	 *
	 * @since    1.6
	 */
	 protected function getOptions()
	{
		$app 	= JFactory::getApplication();
		$db 	= JFactory::getDBO();
		$value1 = $this->value;
		
		$query = $db->getQuery(true);
		$query = "SELECT distinct c.user_id as value, CONCAT_WS(' ',c.firstname,c.lastname) as text 
				FROM `#__comprofiler` as c 
				WHERE not exists (select j.* from `#__jdg_judges` as j where j.user_id = c.user_id) 
				AND  ( CONCAT_WS(' ',c.firstname,c.lastname) IS NOT NULL OR 
				trim(CONCAT_WS(' ',c.firstname,c.lastname)) != '' )
				ORDER BY c.lastname ASC";

				echo $query;
		$db->setQuery($query);
		$options = $db->loadObjectList();
		array_unshift($options, JHtml::_('select.option', '0', 'Select Users')); 

		//$options[] = JHtml::_('select.option', '0', 'Select Users');
		
		return $options;
		

	}

}
