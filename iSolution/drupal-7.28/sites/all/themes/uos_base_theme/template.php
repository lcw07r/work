<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * UoS Base Theme theme.
 */

 //Adding the current title to the breadcrumb (code picked from https://www.drupal.org/node/64067)
function mytheme_breadcrumb($variables) {
  $sep = ' &gt; ';
  if (count($variables['breadcrumb']) > 0) {
    return implode($sep, $variables['breadcrumb']) . $sep;
  }
  else {
    return t("Home");
  }
}
