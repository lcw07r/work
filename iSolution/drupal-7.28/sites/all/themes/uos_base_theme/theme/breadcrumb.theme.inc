<?php

/**
 * @file
 * Contains the theme function override for 'breadcrumb'.
 */

/**
 * Returns HTML for a breadcrumb trail.
 *
 * @ingroup themeable
 */
function uos_base_theme_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  // Check theme setting for breadcrumb, NULL if not displayed
  if (!omega_theme_get_setting('omega_toggle_breadcrumbs')) {
    $breadcrumb = NULL;
  }

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    // Override Drupal core breadcrumb item imploding (no arrow).
    $output .= '<ul class="breadcrumb"><li>' . implode('</li><li>', $breadcrumb) . '</li></ul>';
    return $output;
  }
}
