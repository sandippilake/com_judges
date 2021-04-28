<?php

/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Brand controller class.
 */
class JudgesControllerJudge extends JControllerForm {

	function __construct() {
		$this->view_list = 'judges';
		parent::__construct();
	}
	
	public function getuserdetails()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$id = $app->input->get('id');
		
		$query = $db->getQuery(true);
		$query->select('c.*,u.email');
		$query->from('#__comprofiler as c');
		$query->join('LEFT','#__users as u ON c.id = u.id');
		$query->where('c.user_id='.$db->quote($id));
		
		$db->setQuery($query);
		
		$userdetails = $db->loadObject();
		
		$avatar = $userdetails->avatar;
		
		$useravatar = 'tn'.$avatar;
		
		if($userdetails)
		{
			echo "{$useravatar}|{$userdetails->firstname}|{$userdetails->middlename}|{$userdetails->lastname}|{$userdetails->cb_phonenumber}|{$userdetails->cb_address1}|{$userdetails->cb_address2}|{$userdetails->cb_address3}|{$userdetails->cb_city}|{$userdetails->cb_state}|{$userdetails->cb_zip}|{$userdetails->cb_country}|{$userdetails->cb_tica_region}|{$userdetails->email}|{$userdetails->cb_judgestatus}|{$userdetails->cb_airport}|{$userdetails->cb_judgelevel}|{$userdetails->cb_licensed}|{$userdetails->cb_judge_abbreviation}|{$userdetails->cb_distinguished}|{$userdetails->cb_instructor}|{$userdetails->cb_merit}|{$userdetails->cb_emeritus}";
		}
		else
			echo '';
		$app->close();
	}
	
	
}
