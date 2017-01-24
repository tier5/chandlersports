<?php
	global $woocommerce;
?>

	<?php if(!get_theme_mod('ilgelo_cart_active') && class_exists('WooCommerce')) : ?>
		<div id="ig-shopping-login">
			<div class="cart-login">
				<?php if(is_user_logged_in()) : ?>
					<a href="<?php echo ilgelo_woocommerce_get_myaccount_url(); ?>" title="<?php echo __('My Account', 'ilgelo') ?>"><?php echo __('My Account', 'ilgelo') ?></a>
				<?php else: ?>
					<a href="<?php echo ilgelo_woocommerce_get_myaccount_url(); ?>" title="<?php echo __('Log In', 'ilgelo') ?>"><?php echo __('Log In', 'ilgelo') ?></a>
				<?php endif; ?>
			</div>
			<?php if(is_user_logged_in()) : ?>
				<div class="sub-login-menu">
					<ul class="list_menu_account">
						<li class="account_change_Lenguagepw_link"><a href="<?php echo ilgelo_woocommerce_get_changepassword_url(); ?>"><?php echo __("Change Password", "ilgelo"); ?></a></li>
						<li class="account_edit_adress_link"><a href="<?php echo ilgelo_woocommerce_get_editaddress_url(); ?>"><?php echo __("Edit Address", "ilgelo"); ?></a></li>
						<li class="account_view_order_link"><a href="<?php echo ilgelo_woocommerce_get_vieworder_url(); ?>"><?php echo __("View Order", "ilgelo"); ?></a></li>
						<li class="account_logout_link"><a href="<?php echo ilgelo_woocommerce_get_logout_url(); ?>"><?php echo __("Log Out", "ilgelo"); ?></a></li>
					</ul>
				</div>
			<?php endif; ?>
		</div>

		<div id="ig-shopping-cart">
			<div class="cart-border">
				<a class="cart-contents" href="<?php echo ilgelo_woocommerce_get_viewcart_url(); ?>" title="<?php echo __('View your shopping cart', 'ilgelo') ?>">

					<div class="num_items">
						<?php echo ilgelo_woocommerce_get_cart_contents_count(); ?> <?php echo __('Items', 'ilgelo') ?>
					</div><!-- .num_items -->
				</a>


			</div><!-- .cart-border -->

			<?php
				global $woocommerce;
				$items = ilgelo_woocommerce_getcart();
				$subtotal = ilgelo_woocommerce_getcart_subtotal();

				if ($items) {
					echo "<div class='sub-cart-menu'>";
					echo "	<ul class='list_products'>";

					foreach($items as $item => $values) {
						$product_id = $values['product_id'];
						$product = $values['data']->post;
						$product_detail = wc_get_product($product_id);
						$price = $product_detail->get_price_html();
						$image = $product_detail->get_image();
						$link = get_permalink($product_id);

						echo "<li>";
						echo "	<figure>";
						echo "		<a class='ig_bg_images' href='".$link."'>".$image."</a>";
						echo "	</figure>";
						echo "	<div class='ig_cat_product_details'>";
						echo "		<a class='ig_cat_product_title' href='".$link."' title=''>".$product->post_title."</a>";
						echo "		<span>".$values['quantity']." x <b>".$price."</b></span>";
						echo "	</div>";
						echo "	<div class='del_prod'>";
						echo apply_filters(
							"woocommerce_cart_item_remove_link",
								sprintf(
									"<a href='%s' class='ig_remove' title='%s'><i class='fa fa-times'></i></a>",
									esc_url(ilgelo_woocommerce_get_removeproduct_url($item)),
									__('Remove this item', 'woocommerce')
							),
							$item
						);
						echo "	</div>";

						echo "</li>";

					}

					echo "	</ul>";
					echo "	<div class='subtotal_cont'>";
					echo "		".__('Subtotal:', 'ilgelo')." ".$subtotal;
					echo "	</div>";
					echo "	<div class='cont_button_cart textaligncenter'>";
					echo "		<div class='ig-new_buttom margin-10'>";
					echo "			<a class='read-more'  href='".ilgelo_woocommerce_get_viewcart_url()."' title='".__("View Cart", "ilgelo")."'>".__('View Cart', 'ilgelo')."</a>";
					echo "		</div>";
					echo "		<div class='ig-new_buttom'>";
					echo "			<a class='read-more' href='".ilgelo_woocommerce_get_checkout_url()."' title='".__("Checkout", "ilgelo")."'>".__('Checkout', 'ilgelo')."</a>";
					echo "		</div>";
					echo "	</div>";
					echo "</div>";
				} else {
					echo "	<div class='sub-cart-menu'>";
					echo "		<ul>";
					echo "			<li class='no_product_in_cart'>".__('No Products in the Cart', 'ilgelo')."</li>";
					echo "		</ul>";
					echo "	</div>";
				}
			?>
		</div><!-- #ig-shopping-cart -->

	<?php endif; ?>
