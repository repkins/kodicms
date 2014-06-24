<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

Observer::observe('view_setting_plugins', function($plugin) {
	echo View::factory('maintenance/settings_page', array(
		'plugin' => $plugin
	));
}, $plugin);

Observer::observe('save_settings', function($post, $plugin) {

	if ( ! empty($post['plugin']['maintenance_mode']) 
		AND isset($post['plugin']['maintenance_mode']))
	{
		$plugin->set('maintenance_mode', $post['plugin']['maintenance_mode']);
	}

	$plugin->save_settings();
}, $plugin);
