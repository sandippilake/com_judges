<?php
/**
 * @version    2.8.x
 * @package    K2
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2017 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

function JudgesBuildRoute(&$query)
{
	// Initialize
	$segments = array();

	if (isset($query['view']))
	{
		switch ($query['view'])
		{
			case 'judge':
				$segments[] = $query['view'];
				if (isset($query['id']))
				{
					$segments[] = 'edit';
					$segments[] = $query['id'];
					unset($query['id']);
				} else {
					$segments[] = 'add';
				}
			break;	
			default: 
			break;
		}
		unset($query['view']);
	}
	unset($query['layout']);
	
	return $segments;
}

function JudgesParseRoute($segments)
{
	// Initialize
	$vars = array();
		
	switch ($segments[0])
	{
		case 'judge':
			$vars['view'] = 'judge';
			if($segments[1] == 'edit') {
				$vars['id'] = $segments[2];
			} else if($segments[1] == 'add') {
				$vars['id'] = 0;
			}
		break;
		default: 
			$vars['view'] = 'judges';
		break;			
	}	
	
	return $vars;
}