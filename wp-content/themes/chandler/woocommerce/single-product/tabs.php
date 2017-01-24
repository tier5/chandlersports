<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

// Get tabs
ob_start();

do_action('woocommerce_product_tabs');

$tabs = trim( ob_get_clean() );

if ( ! empty( $tabs ) ) : ?>
	<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 woocommerce_tabs">
		<ul class="tabs">
			<?php echo $tabs; ?>
			<li class="delivery_tab"><a href="#tab-delivery">Delivery Options</a></li>
			<li class="delivery_tab hiretab"><a href="#tab-hire">Hire</a></li>
		</ul>
		<?php do_action('woocommerce_product_tab_panels'); ?>

		<div class="panel entry-content" id="tab-delivery" style="display: block;">
			<div id="page">
			<div class="table-responsive">
				<?php the_field('delivery_options', 'option'); ?>
			</div>
			</div>
		</div>

		<div class="panel entry-content" id="tab-hire" style="display: block;">
			<div id="page">

			<?php if(get_field('hire_per_week_price') != NULL): ?>
		<p id="hire-title">OR HIRE FROM <?php echo get_field('hire_per_week_price'); ?> p/w</p>

        <?php if(get_field('hire_terms') != NULL): ?>
            <div id="hirebox">

                <?php the_field('hire_terms'); ?>

                <?php chandler_hireform(); ?>

				<!--
                <br style="clear: both;" />

                <div class="ahire">
                    <form method="post" action="/equipment-hire/">
                        <input type="hidden" id="proname" name="proname" value="<?php echo get_the_title(); ?>" />
                        <input type="hidden" id="proprice" name="proprice" value="<?php echo get_field('hire_per_week_price'); ?>" />
                        <input type="submit" id="subhire" name="subhire" value="Hire" />
                    </form>
                </div>
				-->
            </div>
        <?php endif; ?>

	<?php endif; ?>

			</div>
		</div>

	</div>
<?php endif; ?>
