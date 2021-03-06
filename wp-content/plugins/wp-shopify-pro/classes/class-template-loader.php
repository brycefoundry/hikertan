<?php

namespace WPS;

if (!defined('ABSPATH')) {
	exit;
}


class Template_Loader extends \WPS\Vendor_Template_Loader_Gamajo {

	// Prefix for filter names.
	protected $filter_prefix = 'wps';


	// Directory name where custom templates for this plugin should be found in the theme.
	protected $theme_template_directory = 'wps-templates';


	/*

	Reference to the root directory path of this plugin.

	Can either be a defined constant, or a relative reference from where the subclass lives.

	In this case, `MEAL_PLANNER_PLUGIN_DIR` would be defined in the root plugin file as:

	~~~
	define( 'MEAL_PLANNER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	~~~

	@since 1.0.0
	@var string

	*/
	protected $plugin_directory = WPS_PLUGIN_DIR_PATH;


	/*

	Directory name where templates are found in this plugin.

	Can either be a defined constant, or a relative reference from where the subclass lives.

	e.g. 'templates' or 'includes/templates', etc.

	@since 1.1.0
	@var string

	*/
	protected $plugin_template_directory = WPS_RELATIVE_TEMPLATE_DIR;





}
