<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	'/test' => 'test#index',
	'/' => 'index#index',
	'/new' => 'create#index',
	'/create' => 'create#create',
	'/update-state' => 'update#updateState',
	'/edit' => 'update#index',
	'/update' => 'update#updateTask',
	'/delete' => 'index#delete'

);
