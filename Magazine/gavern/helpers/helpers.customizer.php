<?php

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');	

/**
 *
 * Code used to implement theme customizer
 *
 **/
function gavern_init_customizer() {
	global $tpl;
	global $wp_customize;
	
	// read the template styles
	$json_data = $tpl->get_json('config', 'styles');
	// iterate through all menus in the file
	foreach ($json_data as $styles) {
		// get option value
		$template_style = get_option($tpl->name . '_template_style_'.($styles->family), '');
		// styles array
		$styles_array = array();
		// iterate through styles
		foreach($styles->styles as $style) {
			$styles_array[(string)$style->value] = (string)$style->name;
		}
		// create setting
		$wp_customize->add_setting( 
			$tpl->name . '_template_style_'.($styles->family), 
			array(
		    	'default' => $template_style,
		    	'type'	=> 'option',
		    	'capability' => 'edit_theme_options',
		    	'priority' => 1
			) 
		);
		// create control
		$wp_customize->add_control( 
			$tpl->name . '_template_style_'.($styles->family), 
			array(
			    'label'   => $styles->family_desc,
			    'section' => 'colors',
			    'type'    => 'select',
			    'choices' => $styles_array,
			    'priority' => 1
			) 
		);
	}	
	// creating the sections for other options
	$wp_customize->add_section( 
		$tpl->name . '_rwd', 
		array(
	    	'title' => __('Responsive Web Design', GKTPLNAME),
		    'priority' => 35
		) 
	);
	
	$wp_customize->add_section( 
		$tpl->name . '_dimensions', 
		array(
	    	'title' => __('Dimensions', GKTPLNAME),
		    'priority' => 36
		) 
	);
	
	$wp_customize->add_section( 
		$tpl->name . '_layout', 
		array(
	    	'title' => __('Layout', GKTPLNAME),
		    'priority' => 37
		) 
	);
	//
	// creating the necessary settings
	//
	$wp_customize->add_setting( 
		$tpl->name . '_content_position', 
		array(
	    	'default' => 'left',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_sidebar_position', 
		array(
	    	'default' => 'right',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_inset_position', 
		array(
	    	'default' => 'right',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_inner_inset_position', 
		array(
	    	'default' => 'right',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_sidebar_width', 
		array(
	    	'default' => '22',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_inset_width', 
		array(
	    	'default' => '27',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_template_width', 
		array(
	    	'default' => '1230',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_tablet_width', 
		array(
	    	'default' => '1030',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_small_tablet_width', 
		array(
	    	'default' => '820',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	
	$wp_customize->add_setting( 
		$tpl->name . '_mobile_width', 
		array(
	    	'default' => '580',
	    	'type'	=> 'option',
	    	'capability' => 'edit_theme_options'
		) 
	);
	//
	// adding necessary controls
	//
	$wp_customize->add_control( 
		$tpl->name . '_content_position', 
		array(
		    'label'   => __('Content position', GKTPLNAME),
		    'section' => $tpl->name . '_layout',
		    'type'    => 'select',
		    'choices'    => array(
		        "left" => __("Left", GKTPLNAME),
		        "center"=> __("Center", GKTPLNAME)
		    ),
		    'priority' => 1
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_sidebar_position', 
		array(
		    'label'   => __('Sidebar position', GKTPLNAME),
		    'section' => $tpl->name . '_layout',
		    'type'    => 'select',
		    'choices'    => array(
		        "left" => __("Sidebar on the left", GKTPLNAME),
		        "right"=> __("Sidebar on the right", GKTPLNAME),
		        "none" => __("Sidebar disabled", GKTPLNAME)
		    ),
		    'priority' => 2
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_inset_position', 
		array(
		    'label'   => __('Inset position', GKTPLNAME),
		    'section' => $tpl->name . '_layout',
		    'type'    => 'select',
		    'choices'    => array(
		        "left" => __("Inset on the left", GKTPLNAME),
		        "right"=> __("Inset on the right", GKTPLNAME),
		        "none" => __("Inset disabled", GKTPLNAME)
		    ),
		    'priority' => 3
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_template_width', 
		array(
		    'label'   => __('Theme width', GKTPLNAME),
		    'section' => $tpl->name . '_rwd',
		    'type'    => 'text',
		    'priority' => 4
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_tablet_width', 
		array(
		    'label'   => __('Tablet width', GKTPLNAME),
		    'section' => $tpl->name . '_rwd',
		    'type'    => 'text',
		    'priority' => 5
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_small_tablet_width', 
		array(
		    'label'   => __('Small Tablet width', GKTPLNAME),
		    'section' => $tpl->name . '_rwd',
		    'type'    => 'text',
		    'priority' => 6
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_mobile_width', 
		array(
		    'label'   => __('Mobile width', GKTPLNAME),
		    'section' => $tpl->name . '_rwd',
		    'type'    => 'text',
		    'priority' => 7
		) 
	);	
	
	$wp_customize->add_control( 
		$tpl->name . '_sidebar_width', 
		array(
		    'label'   => __('Sidebar % width', GKTPLNAME),
		    'section' => $tpl->name . '_dimensions',
		    'type'    => 'text',
		    'priority' => 8
		) 
	);
	
	$wp_customize->add_control( 
		$tpl->name . '_inset_width', 
		array(
		    'label'   => __('Inset % width', GKTPLNAME),
		    'section' => $tpl->name . '_dimensions',
		    'type'    => 'text',
		    'priority' => 9
		) 
	);
}

add_action('customize_register', 'gavern_init_customizer');

// EOF