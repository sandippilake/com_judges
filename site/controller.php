<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_compare
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
class JudgesController extends JControllerLegacy {

	public function display($cachable = false, $urlparams = false) {

		require_once JPATH_COMPONENT.'/helpers/judges.php';
		
		$view	= JFactory::getApplication()->input->getCmd('view', 'judges');
        JFactory::getApplication()->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}

	public function judgesave()
	{

		$app = JFactory::getApplication();
		$model = $this->getModel('judge');
		$db = JFactory::getDBO();
		require_once(JPATH_BASE . '/components/com_judges/models/judge.php');
		$other_model = $this->getInstance('judge', 'JudgeModel');
		$post = $_POST['jform'];
		$return = $model->save($post);

		$app->redirect(JRoute::_('index.php?option=com_judges'));
	}

	public function deletejudge()
	{
		$app    = JFactory::getApplication();
        $judge_id = $app->input->getInt('id');
        $db = JFactory::getDBO();
        $query = "update #__jdg_judges set `judgestatus` = '2' where id = ".$judge_id;
        $db->setQuery($query);
        $db->query();
        $app->close();
	}
	
	public function getUsers() {
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$search = $app->input->get('search');
		
		$query = $db->getQuery(true);
		$query->select('c.*');
		$query->from('#__comprofiler as c');
		$query->where('CONCAT_WS(" ", c.firstname, c.lastname) LIKE LOWER("%'.$search.'%")');
		$query->where('c.user_id NOT IN (select user_id from #__jdg_judges)');
		$query->where('c.banned = 0');

		$db->setQuery($query);
		$users = $db->loadObjectList();
		echo '{';
		echo '"items" : [';	
		if($users)
		{
			foreach ($users as $user) {
				echo '{';
				echo '"id" : "'.$user->user_id.'",';
				echo '"text" : "'.$user->firstname.' '.$user->lastname.'"';
				echo '}';
				if(end($users) !== $user) {
					echo ',';
				}
			}
		}
		echo ']';
		echo '}';
		$app->close();		
	}

	public function getuserdetails()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$id = $app->input->get('id');
		
		$query = $db->getQuery(true);
		$query->select('c.*, u.email');
		$query->from('#__comprofiler as c');
		$query->join('LEFT','#__users as u ON c.id = u.id');
		$query->where('c.user_id ='.$db->quote($id));
		$db->setQuery($query);
		$userdetails = $db->loadObject();
		
		if($userdetails)
		{
			echo "{$userdetails->firstname}|{$userdetails->middlename}|{$userdetails->lastname}|{$userdetails->cb_phonenumber}|{$userdetails->email}|{$userdetails->cb_address1}|{$userdetails->cb_address2}|{$userdetails->cb_address3}|{$userdetails->cb_city}|{$userdetails->cb_state}|{$userdetails->cb_zip}|{$userdetails->cb_country}|{$userdetails->cb_tica_region}|{$userdetails->cb_airport}";
		}
		else
			echo '';
		$app->close();
		
	}

	public function ajaxApprove()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$user_id = $app->input->get('user_id');
		$query = $db->getQuery(true);
		$query->select('c.cb_judge_profile_picture');
		$query->from('#__comprofiler as c');
		$query->where('c.user_id='.$user_id);
		$db->setQuery($query);
		$judge_profile = $db->loadResult();
		
		$src = JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'comprofiler'.DIRECTORY_SEPARATOR.$judge_profile;
		$dest_path = JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'judges'.DIRECTORY_SEPARATOR.$judge_profile;
		//copy image to judges folder
		JFile::copy($src, $dest_path);
		
		$query1 = $db->getQuery(true);
		$fields = array(
			$db->quoteName('photo') . ' = ' . $db->quote($judge_profile),
		);
		$conditions = array(
			$db->quoteName('user_id') . ' = '.$db->quote($user_id),
		);	
		$query1->update($db->quoteName('#__jdg_judges'))->set($fields)->where($conditions);
		$db->setQuery($query1);
		$db->query();
		
		$query = "update `#__comprofiler` set `cb_judge_profile_picture` = NULL where `user_id`=".$user_id;
		$db->setQuery($query);
		$db->query();
		echo '1';
		$app->close();
	}

	public function ajaxReject()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$user_id = $app->input->get('user_id');
		$query = "update `#__comprofiler` set `cb_judge_profile_picture` = NULL where `user_id`=".$user_id;
		$db->setQuery($query);
		$db->query();
		echo '1';
		$app->close();
	}
}
