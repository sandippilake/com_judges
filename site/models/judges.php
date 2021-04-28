<?php

defined('_JEXEC') or die('Restricted Access');

jimport('joomla.application.component.modellist');

class JudgesModelJudges extends JModelList {

	public function __construct($config = array())
	{
		$this->context = "judges";
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'j.id',
				'firstname', 'c.firstname',
				'lastname', 'c.lastname',
				'cb_country', 'c.cb_country',
				'cb_state', 'c.cb_state',
				'region', 'r.competitive_region_name',
				'level', 'l.judge_level',
				'ring_instructor', 'school_instructor'
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null)
	{
		$app  = JFactory::getApplication();

		// $list = $app->getUserState($this->context . '.list');
		// $list['limit']     = 0;
		// $list['start']     = 0;
		// $app->setUserState($this->context . '.list', $list);
		// $app->input->set('list', null);

		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', '', 'string');
		$this->setState('filter.search', $search);

		$level = $app->getUserStateFromRequest($this->context . '.filter.level', 'filter_level', '', 'string');
		$this->setState('filter.level', $level);

		$region = $app->getUserStateFromRequest($this->context . '.filter.region', 'filter_region', '', 'string');
		$this->setState('filter.region', $region);

		$ring_instructor = $app->getUserStateFromRequest($this->context . '.filter.ring_instructor', 'filter_ring_instructor', '', 'string');
		$this->setState('filter.ring_instructor', $ring_instructor);

		$school_instructor = $app->getUserStateFromRequest($this->context . '.filter.school_instructor', 'filter_school_instructor', '', 'string');
		$this->setState('filter.school_instructor', $school_instructor);

		$country = $app->getUserStateFromRequest($this->context . '.filter.country', 'filter_country', '', 'string');
		$this->setState('filter.country', $country);

		$state = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
		$this->setState('filter.state', $state);

		$city = $app->getUserStateFromRequest($this->context . '.filter.city', 'filter_city', '', 'string');
		$this->setState('filter.city', $city);

		// List state information.
		parent::populateState($ordering, $direction);

		$this->setState('list.start', 0);
		$this->setState('list.limit', 0);
	}

	public function getListQuery() {
		$db = JFactory::getDbo();
		$user = JFactory::getUser();

		$params = JComponentHelper::getParams('com_judges');
		$admingroup = $params->get('admingroup');

		$query = $db->getQuery(true);
		
		$query->select('`j`.`id`, `j`.`photo`, `j`.`international`, `j`.`other`, `j`.`judgestatus`, `j`.`judgelevel`, `j`.`own_region_only`');
		$query->select('`j`.`distinguished_judge`, `j`.`licensed`, `j`.`judge_of_merit`, `j`.`judge_emeritus`');//`j`.`airport`,
		$query->select('`j`.`school_instructor`, `j`.`ring_instructor`, `j`.`genetics_instructor`, `j`.`licensed_until`');
		$query->select('`s`.`judge_status`, `l`.`judge_level`');
		$query->select('`c`.`firstname`, `c`.`middlename`, `c`.`lastname`, `u`.`email`');
		$query->select('`c`.`cb_address1`, `c`.`cb_address2`, `c`.`cb_address3`, `c`.`cb_city`, `c`.`cb_state`, `c`.`cb_country`');
		$query->select('`c`.`cb_zip`, `r`.`competitive_region_name`, `r`.`competitive_region_abbreviation`,`c`.`cb_privacy`,`c`.`cb_phonenumber`,`c`.`cb_airport`');
		
		$query->from('`#__jdg_judges` AS `j`');
		$query->join('LEFT','`#__comprofiler` AS `c` ON `j`.`user_id` = `c`.`user_id`');
		$query->join('LEFT','`#__users` AS `u` ON `j`.`user_id` = `u`.`id`');
		$query->join('LEFT','`#__jdg_judge_level` AS `l` ON `l`.`judge_level_id` = `j`.`judgelevel`');
		$query->join('LEFT','`#__jdg_judge_status` AS `s` ON `s`.`judge_status_id` = `j`.`judgestatus`');
		$query->join('LEFT','`#__toes_competitive_region` AS `r` ON `r`.`competitive_region_abbreviation` = `c`.`cb_tica_region`');
		
		$query->where('`l`.`judge_level` != "Guest Judge"');
		if(!in_array($admingroup, $user->groups)) { 
			$query->where('`s`.`judge_status` = "Active"');
			$query->where('`l`.`judge_level` != "Guest Judge"');
			//$query->where('`l`.`judge_level` != "Licensed Guest Judge"');
		}

		$search = $this->state->get('filter.search');
		if($search) {
			$keyword = '%'.$search.'%';
			$query->where('( c.firstname LIKE '.$db->quote($keyword).' OR c.middlename LIKE '.$db->quote($keyword). ' OR c.lastname LIKE '.$db->quote($keyword).' )');
		}

		$level = $this->state->get('filter.level');
		if($level) {
			$query->where('l.judge_level_id = '.$level);
		}

		$region = $this->state->get('filter.region');
		if($region) {
			$query->where('r.competitive_region_abbreviation = '.$db->quote($region));
		}

		$ring_instructor = $this->state->get('filter.ring_instructor');
		if($ring_instructor == '1') {
			$query->where('j.ring_instructor = 1');
		} else if($ring_instructor == '0') {
			$query->where('j.ring_instructor = 0');
		}

		$school_instructor = $this->state->get('filter.school_instructor');
		if($school_instructor == '1') {
			$query->where('j.school_instructor = 1');
		} else if($school_instructor == '0') {
			$query->where('j.school_instructor = 0');
		}

		$country = $this->state->get('filter.country');
		if($country) {
			$query->where('c.cb_country = '.$db->quote($country));
		}

		$state = $this->state->get('filter.state');
		if($state) {
			$query->where('c.cb_state = '.$db->quote($state));
		}

		$city = $this->state->get('filter.city');
		if($city) {
			$query->where('c.cb_city = '.$db->quote($city));
		}

		// Add the list ordering clause.
		//$orderCol  = $this->state->get('list.ordering', 'c.firstname');
		$orderCol  = $this->state->get('list.ordering', 'c.lastname');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}
		//$query->order('`c`.`firstname` ASC');
		//echo $query;
		//echo str_replace("#__", "p5wz7_", nl2br($query));
		return $query;
		
	}

	public function getItems() {
		return parent::getItems();
	}

	public function getPhotoapprovals() {
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);
		$query = "SELECT `c`.`cb_judge_profile_picture`, `c`.`user_id`, `c`.`id`, `c`.`firstname`, `c`.`middlename`, `c`.`lastname` 
				FROM `#__comprofiler` AS `c` 
				WHERE `c`.`cb_judge_profile_picture` IS NOT NULL";
			
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	
	public function getGuestjudges()
	{
		$db = JFactory::getDBO();
		$user = JFactory::getUser();

		$params = JComponentHelper::getParams('com_judges');
		$admingroup = $params->get('admingroup');
		
		$query = $db->getQuery(true);
		
		$query->select('`j`.`id`, `j`.`photo`, `j`.`international`, `j`.`other`, `j`.`judgestatus`, `j`.`judgelevel`');
		$query->select('`j`.`distinguished_judge`, `j`.`licensed`, `j`.`judge_of_merit`, `j`.`judge_emeritus`');//`j`.`airport`,
		$query->select('`j`.`school_instructor`, `j`.`ring_instructor`, `j`.`genetics_instructor`, `j`.`licensed_until`');
		$query->select('`s`.`judge_status`, `l`.`judge_level`');
		$query->select('`c`.`firstname`, `c`.`middlename`, `c`.`lastname`, `u`.`email`');
		$query->select('`c`.`cb_address1`, `c`.`cb_address2`, `c`.`cb_address3`, `c`.`cb_city`, `c`.`cb_state`, `c`.`cb_country`');
		$query->select('`c`.`cb_zip`, `r`.`competitive_region_name`, `r`.`competitive_region_abbreviation`,`c`.`cb_privacy`,`c`.`cb_phonenumber`,`c`.`cb_airport`');
		
		$query->from('`#__jdg_judges` AS `j`');
		$query->join('LEFT','`#__comprofiler` AS `c` ON `j`.`user_id` = `c`.`user_id`');
		$query->join('LEFT','`#__users` AS `u` ON `j`.`user_id` = `u`.`id`');
		$query->join('LEFT','`#__jdg_judge_level` AS `l` ON `l`.`judge_level_id` = `j`.`judgelevel`');
		$query->join('LEFT','`#__jdg_judge_status` AS `s` ON `s`.`judge_status_id` = `j`.`judgestatus`');
		$query->join('LEFT','`#__toes_competitive_region` AS `r` ON `r`.`competitive_region_abbreviation` = `c`.`cb_tica_region`');
		
		if(in_array($admingroup, $user->groups)) { 
			$query->where('`l`.`judge_level` = "Guest Judge"');
		}
		else
		{
			$query->where('`s`.`judge_status` != "Active"');
			$query->where('`l`.`judge_level`  != "Guest Judge"');
			$query->where('`l`.`judge_level`  != "Licensed Guest Judge"');
			$query->where('`l`.`judge_level`  != "Provisional Allbreed"');
			$query->where('`l`.`judge_level`  != "Approved Allbreed"');
			$query->where('`l`.`judge_level`  != "Probationary Specialty"');
			$query->where('`l`.`judge_level`  != "Trainee"');
			$query->where('`l`.`judge_level`  != "Approved Specialty"');
		}
		
		$db->setQuery($query);
		$guestjudge = $db->loadObjectList();
		return $guestjudge;
	}
}
