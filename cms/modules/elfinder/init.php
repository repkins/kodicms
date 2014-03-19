<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

Assets_Package::add('elfinder')
	->js('elfinder.lib', ADMIN_RESOURCES . 'libs/elfinder/js/elfinder.min.js', 'global')
	->js('elfinder.'.I18n::lang(), ADMIN_RESOURCES . 'libs/elfinder/js/i18n/elfinder.'.I18n::lang().'.js', 'elfinder.lib')
	->css('elfinder.lib', ADMIN_RESOURCES . 'libs/elfinder/css/elfinder.min.css')
	->css('elfinder', ADMIN_RESOURCES . 'css/elfinder.css', 'elfinder.lib');