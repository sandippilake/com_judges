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
 * Methods supporting a list of status records.
 */
class JudgesModelStatus extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                
            );
        }

        parent::__construct($config);
    }
 
    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
		$db		= $this->getDbo();

		$query	= $db->getQuery(true);
		
		$query->select('s.judge_status_id, s.judge_status');
		$query->from('#__jdg_judge_status AS s');
		
		$query->order($db->escape('s.judge_status_id asc'));
		return $query;
	}

	public function getItems() {
        $items = parent::getItems();
       
        return $items;
    }

}
