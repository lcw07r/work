<?php

/**
 * @file
 * Theme settings file for the UoS Base Theme theme.
 */

require_once dirname(__FILE__) . '/template.php';

/**
 * Implements hook_form_FORM_alter().
 */
function uos_base_theme_form_system_theme_settings_alter(&$form, $form_state) {
  // You can use this hook to append your own theme settings to the theme
  // settings form for your subtheme. You should also take a look at the
  // 'extensions' concept in the Omega base theme.

  // Custom option for toggling the breadcrumbs.
  $form['theme_settings']['omega_toggle_breadcrumbs'] = array(
    '#type' => 'checkbox',
    '#title' => t('Breadcrumbs'),
    '#description' => t('Toggle the visibility of breadcrumbs.'),
    '#default_value' => omega_theme_get_setting('omega_toggle_breadcrumbs', TRUE),
  );

  // Custom option for toggling css for navigation
  $form['theme_settings']['omega_toggle_navigation_css'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show navigation icons'),
    '#default_value' => omega_theme_get_setting('omega_toggle_navigation_css', TRUE),
  );
  // Custom option for toggling logo position
  $form['theme_settings']['omega_toggle_logo_position'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show logo on the left (Otherwise it will display the logo on the right. If you what to disable the logo, choose the option above.)'),
    '#default_value' => omega_theme_get_setting('omega_toggle_logo_position', TRUE),
  );
}
