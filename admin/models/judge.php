<?php
/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Judge model.
 */
class JudgesModelJudge extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_JUDGES';


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Judge', $prefix = 'JudgesTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_judges.judge', 'judge', array('control' => 'jform', 'load_data' => $loadData));
        
        
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_judges.edit.judge.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$id = $app->input->get('id');
		$query = $db->getQuery(true);
		$query->select('`j`.`id`, `j`.`user_id`, `j`.`photo`,`j`.`judgestatus`, `j`.`judgelevel`, `j`.`judge_abbreviation`');
		$query->select('`j`.`distinguished_judge`, `j`.`licensed`, `j`.`licensed_until`, `j`.`judge_of_merit`, `j`.`judge_emeritus`');
		$query->select('`j`.`school_instructor`, `j`.`ring_instructor`, `j`.`genetics_instructor`, `j`.`international`, `j`.`other`');
		$query->select('`c`.`firstname`, `c`.`middlename`, `c`.`lastname`, `c`.`cb_phonenumber`, `u`.`email`');
		$query->select('`c`.`cb_address1`, `c`.`cb_address2`, `c`.`cb_address3`, `c`.`cb_city`, `c`.`cb_state`, `c`.`cb_country`');
		$query->select('`c`.`cb_zip`, `r`.`competitive_region_name`, `r`.`competitive_region_abbreviation`,`c`.`cb_airport`');
					
		$query->from('`#__jdg_judges` AS `j`');
		$query->join('LEFT', '`#__comprofiler` AS `c` ON `j`.`user_id` = `c`.`user_id`');
		$query->join('LEFT', '`#__users` AS `u` ON `j`.`user_id` = `u`.`id`');
		$query->join('LEFT','`#__toes_competitive_region` AS `r` ON `r`.`competitive_region_abbreviation` = `c`.`cb_tica_region`');
		$query->where('`j`.`id` =' . $db->quote($id));
		$db->setQuery($query);
		$item = $db->loadObject();
		return $item;
	}
	
	function getImages(){
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		$id = $app->input->getInt('id');
		$images = [];
		if($id){
			$db->setQuery("select photo from `#__jdg_judges` where `id`= ".$id);
			$images = $db->loadObject();	
			
		}
		return $images;
	}
	
	public function save($data)
	{
		
		//var_dump($_POST);die;
		if(!$data['user_id'])
		{
			$data['user_id'] = $_POST['user_id'];
		}
		$app = JFactory::getApplication();
		/*assign group to user if not assign*/
		$params = JComponentHelper::getParams('com_judges');
		$judgegroup = $params->get('judgegroup');
		
		$user = JFactory::getUser();
		$user = JFactory::getUser($data['user_id']);
		
		$usergroup = $user->groups;
		
		if(!in_array($judgegroup,$usergroup))
		{
			JUserHelper::addUserToGroup ($data['user_id'], $judgegroup);
		}
		$db = JFactory::getDBO();
		$avatar_random = JUserHelper::genRandomPassword(10);
		if(!$data['photo'])
		{
			$data['photo'] = $_POST['photo'];
		}
		$data['photo'] = $_FILES['jform']['name']['photo'];
		
		$judgephoto = $data['photo'];
	
		$judgeimage_dir = JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'judges'.DIRECTORY_SEPARATOR;
	
		move_uploaded_file($_FILES['jform']['tmp_name']['photo'], $judgeimage_dir.basename($_FILES['jform']['name']['photo']));
		if($data['photo'])
		{
			$file = JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'judges'.DIRECTORY_SEPARATOR.$_FILES['jform']['name']['photo'];
		}
		else
		{
			$file = $_POST['photo'];
		}
		
		$dest_path = JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'judges';
		
		$fname = basename($file);
		if(!file_exists($dest_path))
		mkdir($dest_path, 0777, true);
		$filename = array_shift(explode(".", $fname));
		
		$ext = pathinfo($file,PATHINFO_EXTENSION);
		
		$med_img = $dest_path. DIRECTORY_SEPARATOR .$data['user_id'].'_'.$avatar_random.'.'.$ext;
		
		$small_img = $dest_path. DIRECTORY_SEPARATOR .'tn'.$data['user_id'].'_'.$avatar_random.'.'.$ext;
		copy($file,$med_img);
		
		imagefill($med_img,0,0,0x7fff0000);
		require_once( JPATH_ROOT.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.
							'com_judges'.DIRECTORY_SEPARATOR.'thumbnail.inc.php'); 
		$jvthumbl = new JVThumbnail($file);
		
		$jvthumbl->JVThumbnail($file);
		$jvthumbl->resize(225,225);    
		$jvthumbl->show(100,$med_img);
		
		copy($file,$small_img);
		imagefill($small_img,0,0,0x7fff0000);
		$jvthumb2 = new JVThumbnail($file);
		
		$jvthumb2->JVThumbnail($file);
		$jvthumb2->resize(100,100);    
		$jvthumb2->show(100,$small_img);
		
		$query = $db->getQuery(true);
		$judge_image = $data['user_id'].'_'.$avatar_random.'.'.$ext;

		if (!$data['id']) {
			
			$query = $db->getQuery(true);
			// $query = "INSERT INTO `#__jdg_judges` (`user_id`, `email`, `photo`,`international`,`other`)
			// 		VALUES (" . $db->quote($data['user_id']) . "," . $db->quote($data['email']) . "," . $db->quote($judge_image) . "," . $db->quote($data['international']) . "," . $db->quote($data['other']) . ")";
			//echo $query;

			$fields = array(
				$db->quoteName('user_id') . ' = ' . $db->quote($data['user_id']),
				//$db->quoteName('photo') . ' = ' .  $db->quote($judge_image),
				$db->quoteName('international') . ' = ' . $db->quote($data['international']),
				$db->quoteName('other') . ' = ' . $db->quote($data['other']),
				//$db->quoteName('airport') . ' = ' . $db->quote($data['airport']),
				$db->quoteName('judgestatus') . ' = ' . $db->quote($data['judgestatus']),
				$db->quoteName('judgelevel') . ' = ' . $db->quote($data['judgelevel']),
				$db->quoteName('licensed') . ' = ' . $db->quote($data['licensed']),
				$db->quoteName('judge_abbreviation') . ' = ' . $db->quote($data['judge_abbreviation']),
				$db->quoteName('distinguished_judge') . ' = ' . $db->quote($data['distinguished_judge']),
				$db->quoteName('school_instructor') . ' = ' . $db->quote($data['school_instructor']),
				$db->quoteName('ring_instructor') . ' = ' . $db->quote($data['ring_instructor']),
				$db->quoteName('judge_of_merit') . ' = ' . $db->quote($data['judge_of_merit']),
				$db->quoteName('judge_emeritus') . ' = ' . $db->quote($data['judge_emeritus']),
				$db->quoteName('genetics_instructor') . ' = ' . $db->quote($data['genetics_instructor']),
				$db->quoteName('licensed_until') . ' = ' . $db->quote($data['licensed_until']),
			);
			if ($data['photo']) {
				$fields[] = $db->quoteName('photo') . ' = ' . $db->quote($judge_image);
			}
			$query->insert($db->quoteName('#__jdg_judges'))->set($fields);//->where($conditions1);
			$db->setQuery($query);
			$db->query();
			$judge_id	=	$db->insertid();
			$app->redirect('index.php?option=com_judges&view=judge&layout=edit&id='.$judge_id,'saved successfully');

		} else { 
			if (!$data['user_id']) {
				$data['user_id'] = $_POST['user_id'];
			}

			$fields = array(
				$db->quoteName('user_id') . ' = ' . $db->quote($data['user_id']),
				//$db->quoteName('photo') . ' = ' .  $db->quote($judge_image),
				$db->quoteName('international') . ' = ' . $db->quote($data['international']),
				$db->quoteName('other') . ' = ' . $db->quote($data['other']),
				//$db->quoteName('airport') . ' = ' . $db->quote($data['airport']),
				$db->quoteName('judgestatus') . ' = ' . $db->quote($data['judgestatus']),
				$db->quoteName('judgelevel') . ' = ' . $db->quote($data['judgelevel']),
				$db->quoteName('licensed') . ' = ' . $db->quote($data['licensed']),
				$db->quoteName('judge_abbreviation') . ' = ' . $db->quote($data['judge_abbreviation']),
				$db->quoteName('distinguished_judge') . ' = ' . $db->quote($data['distinguished_judge']),
				$db->quoteName('school_instructor') . ' = ' . $db->quote($data['school_instructor']),
				$db->quoteName('ring_instructor') . ' = ' . $db->quote($data['ring_instructor']),
				$db->quoteName('judge_of_merit') . ' = ' . $db->quote($data['judge_of_merit']),
				$db->quoteName('judge_emeritus') . ' = ' . $db->quote($data['judge_emeritus']),
				$db->quoteName('genetics_instructor') . ' = ' . $db->quote($data['genetics_instructor']),
				$db->quoteName('licensed_until') . ' = ' . $db->quote($data['licensed_until']),
			);
			if ($data['photo']) {
				$fields[] = $db->quoteName('photo') . ' = ' . $db->quote($judge_image);
			}
			$conditions = array(
				$db->quoteName('id') . ' = ' . $data['id']
			);
			$query->update($db->quoteName('#__jdg_judges'))->set($fields)->where($conditions);
			
			$db->setQuery($query);
			$db->query();
			$app->redirect('index.php?option=com_judges&view=judge&layout=edit&id='.$data['id'],'saved successfully');
		}
	}
}
