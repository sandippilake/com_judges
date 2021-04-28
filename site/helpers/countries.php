<?php
defined('_JEXEC') or die ;

class CompareHelperCountries 
{
	public static function getCountries()
	{
		$db= JFactory::getDbo();
		$query="select `country`,`id`,`default` from #__cmp_countries where state=1 order by high_pripority DESC,country ASC";
		//echo $query;die;
		$db->setQuery($query);
		$countries=$db->loadObjectList();
		return $countries;
		}
	}
?>
