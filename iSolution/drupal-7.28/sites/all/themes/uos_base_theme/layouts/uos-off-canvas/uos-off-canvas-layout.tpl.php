<!-- Main Grid Container -->
<div class="container" <?php print $attributes; ?>>

  <!-- Region: Accessibility -->
  <div class="accessibility">
    <!-- Print: R.Accessibility -->
    <?php print render($page['accessibility']); ?>
  </div>
  <!-- /Region: Accessibility -->

  <!-- Region: Branding -->
  <div class="branding">

    <!-- Print: Branding -->
    <?php print render($page['branding']); ?>

    <!-- branding-subarea-1 -->
    <div class="branding-subarea-1<?php if (!drupal_is_front_page()): ?> branding-subarea-1-not-front<?php endif; ?>">
      <!-- Menu button -->
      <div class="menu-btn">
        <a href="#menu-btn" class="toggle">Show menu</a>
      </div>
      <!-- Print: Logo -->
      <?php if ($logo): ?>
        <?php if (omega_theme_get_setting('omega_toggle_logo_position')): ?>
          <div class="logo logo-left">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="site-logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
            </a>
          </div>
        <?php endif; ?>
      <?php endif; ?>
      <?php print render($page['branding-subarea-1']); ?>
    </div>

    <!-- branding-subarea-2 -->
    <div class="branding-subarea-2">
      <?php if ($site_slogan): ?>
        <h2 class="site-slogan"><?php print $site_slogan; ?></h2>
      <?php endif; ?>
      <?php print render($page['branding-subarea-2']); ?>
    </div>

    <!-- branding-subarea-3 -->
    <div class="branding-subarea-3">
      <!-- Print: Logo -->
      <?php if ($logo): ?>
        <?php if (!omega_theme_get_setting('omega_toggle_logo_position')): ?>
          <div class="logo logo-right">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="site-logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
            </a>
          </div>
        <?php endif; ?>
      <?php endif; ?>
      <?php print render($page['branding-subarea-3']); ?>
    </div>
  </div>
  <!-- /Region: Branding -->

  <!-- Region: Header -->
	<!-- <div class="header<?php if (!drupal_is_front_page()): ?> header-front<?php endif; ?>"> -->
	<div class="header header-front">
    <?php print render($page['header']); ?>
  </div>
  <!-- /Region: header -->

  <!-- Region: Header Title -->  
	<!-- move the title section in to under the breadcrumb -->
	<?php /*
		  <div class="header-title">

			<?php if (drupal_is_front_page()): ?>
			  <?php if ($site_name): ?>
				<h1 class="site-name"><?php print $site_name; ?></h1>
			  <?php endif; ?>
			<?php endif; ?>
			<?php if (!drupal_is_front_page()): ?>
			  <?php if ($title): ?>
				<h1>
				  <?php print $title; ?>
				</h1>
			  <?php endif; ?>
			<?php endif; ?>
		  </div>
	*/?>
  <!-- /Region: Header Title -->

  <!-- Region: Left Sidebar -->
  <div class="left-sidebar">
    <?php print render($page['sidebar_first']); ?>
  </div>
  <!-- /Region: Left Sidebar -->

  <!-- Region: Content -->
  <div class="main-container">
		
	<?php  //only display breadcrumb if it is not the home page
	if (!drupal_is_front_page()): 
		print $breadcrumb . $title;
		echo "<hr>";
	endif; 
	?>

    <!-- Region: Title -->  
		  <div class="header-title">

			<?php  if (drupal_is_front_page()): ?>
			  <?php if ($site_name): ?>
				<h1 class="site-name"><?php print $site_name; ?></h1>
			  <?php endif; ?>
			<?php endif;  ?>
			<?php  if (!drupal_is_front_page()): ?>
			  <?php if ($title): ?>
				<h1>
				  <?php print $title; ?>
				</h1>
			  <?php endif; ?>
			<?php endif; ?>
				
		  </div>
	
    <!-- /Region: Title -->

  


    <!-- invisible link to jump here using Skip to main content, by pressing tab -->
    <a id="main-content"></a>

    <!-- Print: Drupal messages -->
    <?php print $messages; ?>

    <!-- Print: Editing tabs -->
    <?php print render($tabs); ?>

    <!-- Print: render main content -->
    <?php print render($page['content']); ?>

    <?php
    // No use variables, keep them for debugging reasons
    // print $feed_icons;
    // print render($title_prefix);
    // print render($title_suffix);
    // print render($page['help']);
    // print render($action_links);
    ?>
  </div>
  <!-- /Region: Content -->

  <!-- Region: Right Sidebar -->
  <div class="right-sidebar">
    <?php print render($page['sidebar_second']); ?>
  </div>
  <!-- /Region: Right Sidebar -->

  <!-- Dummy div, needed for sticky footer -->
  <div class="container-footer-overflow"></div>

</div>
<!-- /Main Grid Container -->

<!-- Create a second container with the same scss just to include the footer.
     Needed for sticky footer -->
<!-- Footer Grid Container -->
<div class="footer-container">

  <!-- Region: Footer -->
  <div class="footer">
    <!-- <div class="footer-logo"></div> -->
    <?php print render($page['footer']); ?>
  </div>
  <!-- /Region: Footer -->

</div>
<!-- /Footer Grid Container -->
