<?php

/**
 * @file
 * Contains a pre-process hook for 'html'.
 */

/**
 * Implements hook_preprocess_html().
 */
function uos_base_theme_preprocess_html(&$variables, $hook) {

  // Add css for navigation based on omega_toggle_navigation_css
  if (omega_theme_get_setting('omega_toggle_navigation_css')) {
    drupal_add_css(drupal_get_path('theme', 'uos_base_theme') . '/css/conditional/navigation-icons.css',
      array('type' => 'file'));
  }
}
