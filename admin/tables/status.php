<?php

/**
 * @version     1.0.0
 * @package     com_judges
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * brand Table class
 */
class JudgesTableStatus extends JTable {

    /**
     * Constructor
     *
     * @param JDatabase A database connector object
     */
    public function __construct(&$db) {
		
        parent::__construct('#__jdg_judge_status', 'id', $db);
    }
}
