<?php
/**
 *	Application top
 *
 *	Initialize necessary files. This script is dependent on,
 *	general functions in the meantime.
 *
 *	October 19, 2012
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

// setup database
$dbconfig = array('HOST' => $db->host,
				  'USERNAME' => $db->user,
				  'PASSWORD' => $db->pw,
				  'DATABASE' => $db->db);
require_once(dirname(__FILE__) . '/classes/class.database.php');
$_mysqli = new Database($dbconfig);
