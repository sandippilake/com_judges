<?php

/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Judge records.
 */
class JudgesModelJudges extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'j.id',
				'firstname', 'c.firstname',
				'middlename', 'c.middlename',
				'lastname', 'c.lastname',
				'licensed','j.licensed',
				'email', 'u.email',
				//'airport', 'j.airport',
                'international', 'j.international',
                's.judge_status', 'l.judge_level'
			);
		}

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = 'c.firstname', $direction = 'asc') {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // Load the parameters.
        $params = JComponentHelper::getParams('com_judges');
        $this->setState('params', $params);

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
		$where='';
		$db		= $this->getDbo();
		
		if ($this->getState('filter.search') !== '' && $this->getState('filter.search') !== null)
		{
			// Escape the search token.
			$token = $db->quote('%' . $db->escape($this->getState('filter.search')) . '%');

			// Compile the different search clauses.
			$searches = array();
			$searches[] = ' CONCAT(c.firstname," ",IF(c.middlename,CONCAT(c.middlename," "),""),c.lastname) LIKE ' . $token;
			$searches[] = ' u.email LIKE ' . $token;

			// Add the clauses to the query.
			$where= implode(' OR ', $searches);
		}

		$query = $db->getQuery(true);
				
		$query->select('`j`.`id`, `j`.`photo`, `j`.`international`, `j`.`other`, `j`.`judgestatus`, `j`.`judgelevel`');
		$query->select('`j`.`distinguished_judge`, `j`.`licensed`, `j`.`judge_of_merit`, `j`.`judge_emeritus`');//, `j`.`airport`
		$query->select('`j`.`school_instructor`, `j`.`ring_instructor`, `j`.`genetics_instructor`, `j`.`licensed_until`');
		$query->select('`s`.`judge_status`, `l`.`judge_level`');
		$query->select('`c`.`firstname`, `c`.`middlename`, `c`.`lastname`, `u`.`email`');
		$query->select('`c`.`cb_address1`, `c`.`cb_address2`, `c`.`cb_address3`, `c`.`cb_city`, `c`.`cb_state`, `c`.`cb_country`');
		$query->select('`c`.`cb_zip`, `r`.`competitive_region_name`, `r`.`competitive_region_abbreviation`');
		
		$query->from('`#__jdg_judges` AS `j`');
        $query->join('LEFT','`#__comprofiler` AS `c` ON `j`.`user_id` = `c`.`user_id`');
        $query->join('LEFT','`#__users` AS `u` ON `j`.`user_id` = `u`.`id`');
		$query->join('LEFT','`#__jdg_judge_level` AS `l` ON `l`.`judge_level_id` = `j`.`judgelevel`');
		$query->join('LEFT','`#__jdg_judge_status` AS `s` ON `s`.`judge_status_id` = `j`.`judgestatus`');
		$query->join('LEFT','`#__toes_competitive_region` AS `r` ON `r`.`competitive_region_abbreviation` = `c`.`cb_tica_region`');
		
		if($where) {
			$query->where($where);
		}
		
		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'c.firstname');
		$orderDirn = $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}


	public function getItems() {
        $items = parent::getItems();
        return $items;
    }
}
