<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see     template_preprocess()
 * @see     template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html>
<?php if (omega_extension_enabled('compatibility') && omega_theme_get_setting('omega_conditional_classes_html', TRUE)): ?>
<!--[if IEMobile 7]>
<html class="ie iem7" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<![endif]-->
<!--[if lte IE 6]>
<html class="ie lt-ie9 lt-ie8 lt-ie7" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<![endif]-->
<!--[if (IE 7)&(!IEMobile)]>
<html class="ie lt-ie9 lt-ie8" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<![endif]-->
<!--[if IE 8]>
<html class="ie lt-ie9" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]>
<html class="ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<![endif]-->
<![if !IE]>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<![endif]>
<?php else: ?>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<?php endif; ?>

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body<?php print $attributes; ?>>

<?php if ($logo): ?>
  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="site-logo"><img
      src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/></a>
<?php endif; ?>

<?php if ($site_name || $site_slogan): ?>
  <?php if ($site_name): ?>
    <h1 class="site-name"><?php print $site_name; ?> </h1>
  <?php endif; ?>
  <?php if ($site_slogan): ?>
    <h2 class="site-slogan"><?php print $site_slogan; ?></h2>
  <?php endif; ?>
<?php endif; ?>

<?php if ($title): ?><h1><?php print $title; ?></h1><?php endif; ?>

<?php print $messages; ?>
<?php print $content; ?>
<?php print $footer; ?>

</body>
</html>
