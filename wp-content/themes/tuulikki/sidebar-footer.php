<?php
/**
 * Footer widget
 * based on bootstrap 3
*/

// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
// default
$footergrid = "col-md-12";
// if only one
if ($footerwidgets == "1") {
$footergrid = "col-md-4 col-md-offset-4 center";
// if two, split in half
} elseif ($footerwidgets == "2") {
$footergrid = "col-xs-12 col-sm-6 col-md-6 col-lg-6";
// if three, divide in thirds
} elseif ($footerwidgets == "3") {
$footergrid = "col-xs-12 col-sm-12 col-md-4 col-lg-4";
// if four, split in fourths
} elseif ($footerwidgets == "4") {
$footergrid = "col-xs-12 col-sm-6 col-md-3 col-lg-3";
}

?>

<?php if ($footerwidgets) : ?>

<?php if (is_active_sidebar('first-footer-widget-area')) : ?>
<div class="<?php echo esc_attr($footergrid);?>">
	<?php dynamic_sidebar('first-footer-widget-area'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('second-footer-widget-area')) :
$last = ($footerwidgets == '2' ? ' last' : false);?>

<div class="<?php echo esc_attr($footergrid.$last);?>">
	  <?php dynamic_sidebar('second-footer-widget-area'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('third-footer-widget-area')) :
$last = ($footerwidgets == '3' ? ' last' : false);?>

<div class="<?php echo esc_attr($footergrid.$last);?>">
	  <?php dynamic_sidebar('third-footer-widget-area'); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar('fourth-footer-widget-area')) :
$last = ($footerwidgets == '4' ? ' last' : false);?>

<div class="<?php echo esc_attr($footergrid.$last);?>">
		  <?php dynamic_sidebar('fourth-footer-widget-area'); ?>
</div>
<?php endif;?>

<div class="clear"></div>

<?php endif;?>