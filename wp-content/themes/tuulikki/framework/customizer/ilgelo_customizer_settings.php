<?php

function wpshout_customizer_preview() {
    wp_enqueue_script('shout-customizer',get_template_directory_uri().'/framework/customizer/js/theme-customizer.js',array( 'jquery','customize-preview' ));
}
add_action('customize_preview_init','wpshout_customizer_preview');

//////////////////////////////////////////////////////////////////
// Customizer - Add Settings
//////////////////////////////////////////////////////////////////


function ilgelo_register_theme_customizer( $wp_customize ) {




	//=======================================================
	//=================== Add Sections  =====================
	//=======================================================

	$wp_customize->add_section( 'ilgelo_new_section_custom_css' , array(
   		'title'      => __('Custom CSS','ilgelo'),
   		'description'=> __('Add your custom CSS which will overwrite the theme CSS','ilgelo'),
   		'priority'   => 17,
	) );

	if(class_exists('WooCommerce')) {
	$wp_customize->add_section( 'ilgelo_new_section_color_e_commece_menu' , array(
   		'title'      => __('Colors: Shop Navigation Bar','ilgelo'),
   		'priority'   => 16,
	) );

	$wp_customize->add_section( 'ilgelo_woocommerce' , array(
		'title'      => __('Woocommerce Settings','ilgelo'),
		'priority'   => 15,
	) );
	}

	$wp_customize->add_section( 'ilgelo_new_section_footer' , array(
   		'title'      => __('Footer Settings','ilgelo'),
   		'priority'   => 14,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_color_sidebar' , array(
   		'title'      => __('Colors: Sidebar','ilgelo'),
   		'priority'   => 13,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_mobile' , array(
		'title'      => __('Colors/Options: Mobile Menu','ilgelo'),
		'priority'   => 12,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_color_slideposts' , array(
   		'title'      => __('Colors: Slide Posts','ilgelo'),
   		'priority'   => 11,
	) );
	
	$wp_customize->add_section( 'ilgelo_new_section_color_below_bar' , array(
   		'title'      => __('Colors: Secondary Navigation Bar','ilgelo'),
   		'priority'   => 10,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_color_topbar' , array(
   		'title'      => __('Colors: Main Navigation Bar','ilgelo'),
   		'priority'   => 9,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_color_general' , array(
   		'title'      => __('Colors: General','ilgelo'),
   		'priority'   => 8,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_post' , array(
   		'title'      => __('Post Settings','ilgelo'),
   		'priority'   => 6,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_social' , array(
   		'title'      => __('Social Media Settings','ilgelo'),
   		'description'=> __('Enter your social media usernames. Icons will not show if left blank.','ilgelo'),
   		'priority'   => 5,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_topbar' , array(
		'title'      => __('Navigation Bar Settings','ilgelo'),
		'priority'   => 4,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_single_page_logo' , array(
   		'title'      => __('Post Page Header Settings','ilgelo'),
   		'priority'   => 3,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_logo_header' , array(
   		'title'      => __('Home Page Header Settings','ilgelo'),
   		'priority'   => 2,
	) );

	$wp_customize->add_section( 'ilgelo_new_section_general' , array(
   		'title'      => __('General Settings','ilgelo'),
   		'priority'   => 1,
	) );






	//=======================================================
	//=================== Add Setting  ======================
	//=======================================================


		// Post Page Header Settings
		$wp_customize->add_setting(
		   'ilgelo_single_logo'
		);

		$wp_customize->add_setting(
	        'ilgelo_retina_single_logo',
	        array(
	            'default'     => ''
	        )
	    );

		$wp_customize->add_setting(
	        'ilgelo_single_logo_padding_top',
	        array(
	            'default'     => ''
	        )
	    );


		// Navigation Bar Settings
		$wp_customize->add_setting(
	        'ilgelo_social_active',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'ilgelo_search_active',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
		   'ilgelo_menu_layout',
		   array(
		       'default'     => 'textaligncenter'
		   )
		);




		// Post Settings

		$wp_customize->add_setting(
	        'ig_post_author',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'ig_post_related',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'ig_post_share',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'ig_post_comment_link',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'ig_post_thumb',
	        array(
	            'default'     => false
	        )
	    );

		$wp_customize->add_setting(
	        'ig_meta_post_date',
	        array(
	            'default'     => false
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_meta_post_author',
	        array(
	            'default'     => false
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_meta_post_cat',
	        array(
	            'default'     => false
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_meta_post_tags',
	        array(
	            'default'     => false
	        )
	    );

	    $wp_customize->add_setting(
	        'ig_post_full_cont',
	        array(
	            'default'     => false
	        )
	    );



		

//=======================================================
//=================== Add Control  ======================
//=======================================================





// ============ General Settings
//=========================================



	$wp_customize->add_setting(
		'ilgelo_favicon'
	);


	$wp_customize->add_setting(
		'ig_responsive'
	);

	$wp_customize->add_setting(
        'ig_home_layout',
        array(
            'default'     => 'full'
        )
    );
	$wp_customize->add_setting(
        'ig_archive_layout',
        array(
            'default'     => 'full'
        )
    );
	$wp_customize->add_setting(
        'ig_infinite_scroll',
        array(
            'default'     => false
        )
    );
	$wp_customize->add_setting(
        'ig_sidebar_homepage',
        array(
            'default'     => false
        )
    );
	$wp_customize->add_setting(
        'ig_sidebar_post',
        array(
            'default'     => false
        )
    );
	$wp_customize->add_setting(
        'ig_sidebar_archive',
        array(
            'default'     => false
        )
    );
	$wp_customize->add_setting(
        'ig_disable_loading',
        array(
            'default'     => false
        )
    );
	$wp_customize->add_setting(
	     'ig_disable_sticky_sider',
	      array(
	          'default'     => false
	      )
	);



		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'favicon',
				array(
					'label'      =>  __('Upload Favicon','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ilgelo_favicon',
					'priority'	 => 1
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'home_layout',
				array(
					'label'    => __('Homepage Layout','ilgelo'),
					'section'        => 'ilgelo_new_section_general',
					'settings'       => 'ig_home_layout',
					'type'           => 'radio',
					'priority'	 => 3,
					'choices'        => array(
						'full'   => 'Classic Post',
						'grid'  => 'Grid Post',
						'full_grid'  => 'First Full Post then Grid',
						'list'  => 'List Post',
						'full_list'  => 'First Full Post then List'
					)
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'archive_layout',
				array(
					'label'    => __('Archive Layout','ilgelo'),
					'section'        => 'ilgelo_new_section_general',
					'settings'       => 'ig_archive_layout',
					'type'           => 'radio',
					'priority'	 => 3,
					'choices'        => array(
						'full'   => 'Classic Post',
						'grid'  => 'Grid Post',
						'full_grid'  => 'First Full Post then Grid',
						'list'  => 'List Post',
						'full_list'  => 'First Full Post then List',
					)
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'infinite_scroll',
				array(
					'label'    => __('Enable Infinite Scroll','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ig_infinite_scroll',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_homepage',
				array(
					'label'    => __('Disable Sidebar on Homepage','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ig_sidebar_homepage',
					'type'		 => 'checkbox',
					'priority'	 => 5
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_post',
				array(
					'label'    => __('Disable Sidebar on Posts','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ig_sidebar_post',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_archive',
				array(
					'label'    => __('Disable Sidebar on Categories/Archives','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ig_sidebar_archive',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'disable_loading',
				array(
					'label'    => __('Disable Loading Pages','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ig_disable_loading',
					'type'		 => 'checkbox',
					'priority'	 => 8
				)
			)
		);



		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'disable_sticky_sider',
				array(
					'label'    => __('Disable Sticky Sidebar','ilgelo'),
					'section'    => 'ilgelo_new_section_general',
					'settings'   => 'ig_disable_sticky_sider',
					'type'		 => 'checkbox',
					'priority'	 => 9
				)
			)
		);



// ============ Home Page Header Settings
//=========================================


	$wp_customize->add_setting(
	'layout_columns',
		array(
				'default'   => ''
		)
	);

	$wp_customize->add_setting(
        'ilgelo_home_bg_logo'
	);

	$wp_customize->add_setting(
        'ilgelo_logo'
     );

	$wp_customize->add_setting(
		'ig_bg_header',
		array(
			'default'     => ''
			)
	);

	$wp_customize->add_setting(
        'ilgelo_retina_logo',
        array(
            'default'     => ''
        )
     );

	$wp_customize->add_setting(
        'ilgelo_header_padding_top',
        array(
            'default'     => ''
        )
     );

	$wp_customize->add_setting(
        'ilgelo_header_padding_bottom',
        array(
            'default'     => ''
        )
     );

     $wp_customize->add_setting(
        'ilgelo_logo_layout',
        array(
            'default'     => 'textaligncenter'
        )
     );


		$wp_customize->add_control(
			'layout_columns',
			array(
				'section'  => 'ilgelo_new_section_logo_header',
				'label'    => __('Homepage Header Layout','ilgelo'),
				'type'     => 'radio',
				'choices'  => array(
						'ig_layout1' => '',
						'ig_layout2' => '',
						'ig_layout3' => ''
				),
					'priority' => 17
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_logo',
				array(
					'label'    => __('Upload Home Logo','ilgelo'),
					'section'    => 'ilgelo_new_section_logo_header',
					'settings'   => 'ilgelo_logo',
					'priority'	 => 18
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'size_logo_retina',
				array(
					'label'    => __('Logo Width','ilgelo'),
					'description' => __( 'Specify the width of the logo. Enter only number value. Please note that for optimal visualization of the logo, you should upload an image that is at least twice the width you intend to use on the website. For example, if you want a 60px-wide logo on your scrollbar, you should upload a 120px-wide picture.' , 'ilgelo' ),
					'section'    => 'ilgelo_new_section_logo_header',
					'settings'   => 'ilgelo_retina_logo',
					'type'		 => 'number',
					'priority'	 => 19
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'header_padding_top',
				array(
					'label'    => __('Logo Padding (Top)','ilgelo'),
					'section'    => 'ilgelo_new_section_logo_header',
					'settings'   => 'ilgelo_header_padding_top',
					'type'		 => 'number',
					'priority'	 => 20
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'header_padding_bottom',
				array(
					'label'    => __('Logo Padding (Bottom)','ilgelo'),
					'section'    => 'ilgelo_new_section_logo_header',
					'settings'   => 'ilgelo_header_padding_bottom',
					'type'		 => 'number',
					'priority'	 => 21
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'logo_layout',
				array(
					'label'    => __('Logo Alignment
','ilgelo'),
					'section'        => 'ilgelo_new_section_logo_header',
					'settings'       => 'ilgelo_logo_layout',
					'type'           => 'radio',
					'priority'	 => 22,
					'choices'        => array(
						'textaligncenter'   => 'Center',
						'textalignleft'  => 'Left',
					)
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_home_bg_logo',
				array(
					'label'    => __('Upload Parallax Image as Header Background','ilgelo'),
					'description' => __( 'The image should not be more than 1600px in width.' , 'ilgelo' ),
					
					'section'    => 'ilgelo_new_section_logo_header',
					'settings'   => 'ilgelo_home_bg_logo',
					'priority'	 => 23
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ig_header_bg',
				array(
					'label'    => __('Header Background Color','ilgelo'),
					'description' => __( 'Note that if you select a background color, it will hide the background parallax image.' , 'ilgelo' ),

					'section'   => 'ilgelo_new_section_logo_header',
					'settings'  => 'ig_bg_header',
					'priority'  => 24
				)
			)
		);





// ============ Post Page Header Settings
//=========================================




		$wp_customize->add_setting(
		'header_single_page',
			array(
					'default'   => 'ig_header_big_logo'
			)
		);

		$wp_customize->add_control(
		'header_single_page',
			array(
				'section'  => 'ilgelo_new_section_single_page_logo',
				'label'    => __('Post Page Header Layout ','ilgelo'),
				'type'     => 'radio',
				'choices'  => array(
						'ig_header_big_logo' => '',
						'ig_header_mini_logo' => ''
				),
					'priority' => 1
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_single_logo',
				array(
					'label'      => 'Upload Logo to Menu Bar',
					'description' => __( 'Upload your own logo (small size). It will replace the title of the blog on the scrollbar above the post.' , 'ilgelo' ),

					'section'    => __('ilgelo_new_section_single_page_logo','ilgelo'),
					'settings'   => 'ilgelo_single_logo',
					'priority'	 => 2
				)
			)
		);

		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'size_single_logo_retina',
				array(
					'label'    => __('Logo Width','ilgelo'),
					'description' => __( 'Specify the width of the logo. Enter only number value. Please note that for optimal visualization of the logo, you should upload an image that is at least twice the width you intend to use on the website. For example, if you want a 60px-wide logo on your scrollbar, you should upload a 120px-wide picture.' , 'ilgelo' ),
					'section'    => 'ilgelo_new_section_single_page_logo',
					'settings'   => 'ilgelo_retina_single_logo',
					'type'		 => 'number',
					'priority'	 => 3
				)
			)
		);



		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'single_logo_padding_top',
				array(
					'label'      => __('Logo Padding','ilgelo'),
					'description' => __( 'To center the logo in the menu bar, specify the distance between the logo and the top of the menu bar.' , 'ilgelo' ),
					'section'    => 'ilgelo_new_section_single_page_logo',
					'settings'   => 'ilgelo_single_logo_padding_top',
					'type'		 => 'number',
					'priority'	 => 4
				)
			)
		);





// ============ Navigation Bar Settings
//=========================================



		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'social_active',
				array(
					'label'      => __('Disable Top Bar Social Icons','ilgelo'),
					'section'    => 'ilgelo_new_section_topbar',
					'settings'   => 'ilgelo_social_active',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'search_active',
				array(
					'label'      => __('Disable Top Bar Search','ilgelo'),
					'section'    => 'ilgelo_new_section_topbar',
					'settings'   => 'ilgelo_search_active',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);
	$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'menu_layout',
				array(
					'label'          => __('Menu Alignment','ilgelo'),
					'section'        => 'ilgelo_new_section_topbar',
					'settings'       => 'ilgelo_menu_layout',
					'type'           => 'radio',
					'priority'	 => 5,
					'choices'        => array(
						'textaligncenter'   => 'Center',
						'textalignleft'  => 'Left',
					)
				)
			)
		);









// ============ Post Settings
//=========================================



		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'meta_post_author',
				array(
					'label'      => __('Hide Author','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_meta_post_author',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'meta_post_cat',
				array(
					'label'      => __('Hide Category','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_meta_post_cat',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'meta_post_date',
				array(
					'label'      => __('Hide Date','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_meta_post_date',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'meta_post_tags',
				array(
					'label'      => __('Hide Tags','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_meta_post_tags',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_share',
				array(
					'label'      => __('Hide Share Buttons','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_post_share',
					'type'		 => 'checkbox',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_comment_link',
				array(
					'label'      => __('Hide Comment Link','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_post_comment_link',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_author',
				array(
					'label'      => __('Hide Author Box','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_post_author',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_related',
				array(
					'label'      => __('Hide Related Posts Box','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_post_related',
					'type'		 => 'checkbox',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_thumb',
				array(
					'label'      => __('Hide featured image from top of post','ilgelo'),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_post_thumb',
					'type'		 => 'checkbox',
					'priority'	 => 9
				)
			)
		);



			$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_full_cont',
				array(
					'label'      => __('Show entire post','ilgelo'),
					'description' => __( 'Note: this is not applicable to grid or list layout' , 'ilgelo' ),
					'section'    => 'ilgelo_new_section_post',
					'settings'   => 'ig_post_full_cont',
					'type'		 => 'checkbox',
					'priority'	 => 11
				)
			)
		);




// ============ Social Media
//=========================================


		$wp_customize->add_setting(
	        'ig_facebook',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_twitter',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_instagram',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_pinterest',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_tumblr',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_bloglovin',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_tumblr',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_google',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_youtube',
	        array(
	            'default'     => ''
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_dribbble',
	        array(
	            'default'     => ''
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_soundcloud',
	        array(
	            'default'     => ''
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_vimeo',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_linkedin',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_rss',
	        array(
	            'default'     => ''
	        )
	    );
	    $wp_customize->add_setting(
	        'ig_snapchat',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_tripadvisor',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'ig_etsy',
	        array(
	            'default'     => ''
	        )
	    );



		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'facebook',
				array(
					'label'      => 'Facebook',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_facebook',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'twitter',
				array(
					'label'      => 'Twitter',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_twitter',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'instagram',
				array(
					'label'      => 'Instagram',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_instagram',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pinterest',
				array(
					'label'      => 'Pinterest',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_pinterest',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bloglovin',
				array(
					'label'      => 'Bloglovin',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_bloglovin',
					'type'		 => 'text',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'google',
				array(
					'label'      => 'Google Plus',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_google',
					'type'		 => 'text',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tumblr',
				array(
					'label'      => 'Tumblr',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_tumblr',
					'type'		 => 'text',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'youtube',
				array(
					'label'      => 'Youtube',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_youtube',
					'type'		 => 'text',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'dribbble',
				array(
					'label'      => 'Dribbble',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_dribbble',
					'type'		 => 'text',
					'priority'	 => 9
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'soundcloud',
				array(
					'label'      => 'Soundcloud',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_soundcloud',
					'type'		 => 'text',
					'priority'	 => 10
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'vimeo',
				array(
					'label'      => 'Vimeo',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_vimeo',
					'type'		 => 'text',
					'priority'	 => 11
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'linkedin',
				array(
					'label'      => 'Linkedin (Use full URL to your Linkedin profile)',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_linkedin',
					'type'		 => 'text',
					'priority'	 => 12
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'rss',
				array(
					'label'      => 'RSS Link',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_rss',
					'type'		 => 'text',
					'priority'	 => 13
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'snapchat',
				array(
					'label'      => 'Snapchat',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_snapchat',
					'type'		 => 'text',
					'priority'	 => 14
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tripadvisor',
				array(
					'label'      => 'Tripadvisor',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_tripadvisor',
					'description' => __( 'insert the URL' , 'ilgelo' ),

					'type'		 => 'text',
					'priority'	 => 15
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tripadvisor',
				array(
					'label'      => 'Etsy',
					'section'    => 'ilgelo_new_section_social',
					'settings'   => 'ig_etsy',
					'description' => __( 'insert the URL' , 'ilgelo' ),

					'type'		 => 'text',
					'priority'	 => 16
				)
			)
		);




// ============ Colors: General
//=============================



	$wp_customize->add_setting(
		'ig_color_body',
		array(
			'default'     => '#fcfcfc'
		)
	);


	$wp_customize->add_setting(
		'ig_color_body_text',
		array(
			'default'     => '#353535'
		)
	);
		
	$wp_customize->add_setting(
		'ig_color_hover',
		array(
			'default'     => '#ef9781'
		)
	);
	
	$wp_customize->add_setting(
		'ig_color_h_text',
		array(
			'default'     => '#353535'
		)
	);


	$wp_customize->add_setting(
		'ig_color_meta_text',
		array(
			'default'     => '#aaaaaa'
		)
	);

	
	$wp_customize->add_setting(
		'ig_color_more_border',
		array(
			'default'     => '#aaaaaa'
		)
	);
	$wp_customize->add_setting(
		'ig_color_more_text',
		array(
			'default'     => '#aaaaaa'
		)
	);
	
	$wp_customize->add_setting(
		'ig_color_more_border_hover',
		array(
			'default'     => '#ef9781'
		)
	);
	$wp_customize->add_setting(
		'ig_color_more_text_hover',
		array(
			'default'     => '#ef9781'
		)
	);
	
	$wp_customize->add_setting(
		'ig_color_divider',
		array(
			'default'     => '#eaeaea'
		)
	);








				$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ig_bg_body',
					array(
						'label'      => __('Body Background','ilgelo'),
						'description' => __( 'Select the body color' , 'ilgelo' ),
						'section'   => 'ilgelo_new_section_color_general',
						'settings'  => 'ig_color_body',
						'priority'  => 1
					)
				)
			);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_body_text',
					array(
						'label'      => __('Body Text','ilgelo'),
						'section'   => 'ilgelo_new_section_color_general',
						'settings'  => 'ig_color_body_text',
						'priority'  => 2
					)
				)
			);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ig_color_hover',
					array(
						'label'      => __('Hover/Active Text','ilgelo'),
						'section'   => 'ilgelo_new_section_color_general',
						'settings'  => 'ig_color_hover',
						'priority'  => 3
					)
				)
			);






			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_h_text',
					array(
						'label'      => __('H Title','ilgelo'),
						'description' => __( 'insert the color tag: h1 h2 h3 h4 h5 h6 ' , 'ilgelo' ),
						'section'   => 'ilgelo_new_section_color_general',
						'settings'  => 'ig_color_h_text',
						'priority'  => 4
					)
				)
			);






			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ig_color_meta',
					array(
						'label'      => __('Meta Text','ilgelo'),
						'section'   => 'ilgelo_new_section_color_general',
						'settings'  => 'ig_color_meta_text',
						'priority'  => 6
					)
				)
			);




			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_more_border',
					array(
						'label'      => __('"Continue Reading" Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_general',
						'settings'   => 'ig_color_more_border',
						'priority'	 => 8
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_more_text',
					array(
						'label'      => __('"Continue Reading" Text ','ilgelo'),
						'section'    => 'ilgelo_new_section_color_general',
						'settings'   => 'ig_color_more_text',
						'priority'	 => 9
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_more_border_hover',
					array(
						'label'      => __('"Continue Reading" Hover Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_general',
						'settings'   => 'ig_color_more_border_hover',
						'priority'	 => 11
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_more_text_hover',
					array(
						'label'      => __('"Continue Reading" Hover Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_general',
						'settings'   => 'ig_color_more_text_hover',
						'priority'	 => 12
					)
				)
			);

	$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_divider',
					array(
						'label'      => __('Post Divider','ilgelo'),
						'section'    => 'ilgelo_new_section_color_general',
						'settings'   => 'ig_color_divider',
						'priority'	 => 13
					)
				)
			);

	




// ============ Colors: Main Navigation Bar
//=========================================

			$wp_customize->add_setting(
				'ig_topbar_bg',
				array(
					'default'     => '#f2f2f2'
				)
			);

			$wp_customize->add_setting(
				'ig_topbar_nav_color',
				array(
					'default'     => '#7f7f7f'
				)
			);

			$wp_customize->add_setting(
				'ig_topbar_nav_color_active',
				array(
					'default'     => '#ef9781'
				)
			);

			$wp_customize->add_setting(
				'ig_drop_bg',
				array(
					'default'     => '#f9f9f9'
				)
			);

			$wp_customize->add_setting(
				'ig_drop_text_hover_bg',
				array(
					'default'     => '#f2f2f2'
				)
			);

			$wp_customize->add_setting(
				'ig_drop_border',
				array(
					'default'     => '#fcfcfc'
				)
			);

			$wp_customize->add_setting(
				'ig_drop_text_color',
				array(
					'default'     => '#b5b5b5'
				)
			);

			$wp_customize->add_setting(
				'ig_drop_text_hover_color',
				array(
					'default'     => '#ef9781'
				)
			);

			$wp_customize->add_setting(
				'ig_topbar_social_color',
				array(
					'default'     => '#999999'
				)
			);
			$wp_customize->add_setting(
				'ig_topbar_social_color_hover',
				array(
					'default'     => '#ef9781'
				)
			);

			$wp_customize->add_setting(
				'ig_topbar_search_magnify',
				array(
					'default'     => '#999999'
				)
			);
			$wp_customize->add_setting(
				'ig_topbar_search_magnify_hover',
				array(
					'default'     => '#ef9781'
				)
			);



			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_bg',
					array(
					     'label'    => __('Top Navigation Bar Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_bg',
						'priority'	 => 1
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_nav_color',
					array(
						'label'    => __('Top Navigation Bar Menu Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_nav_color',
						'priority'	 => 2
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_nav_color_active',
					array(
						'label'    => __('Top Navigation Bar Menu Text Hover/Active/Current','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_nav_color_active',
						'priority'	 => 3
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_bg',
					array(
						'label'    => __('Dropdown Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_drop_bg',
						'priority'	 => 4
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_text_hover_bg',
					array(
						'label'    => __('Dropdown Hover Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_drop_text_hover_bg',
						'priority'	 => 5
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_border',
					array(
						'label'    => __('Dropdown Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_drop_border',
						'priority'	 => 6
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_text_color',
					array(
						'label'    => __('Dropdown Text','ilgelo'),

						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_drop_text_color',
						'priority'	 => 7
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_text_hover_color',
					array(
						'label'    => __('Dropdown Text Hover','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_drop_text_hover_color',
						'priority'	 => 8
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_social_color',
					array(
						'label'    => __('Top Navigation Bar Social Icons','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_social_color',
						'priority'	 => 9
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_social_color_hover',
					array(
						'label'    => __('Top Navigation Bar Social Icons Hover','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_social_color_hover',
						'priority'	 => 10
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_search_magnify',
					array(
						'label'    => __('Top Navigation Bar Icon Search Color','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_search_magnify',
						'priority'	 => 11
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_search_magnify_h',
					array(
						'label'    => __('Top Navigation Bar Icon Search Color Hover','ilgelo'),
						'section'    => 'ilgelo_new_section_color_topbar',
						'settings'   => 'ig_topbar_search_magnify_hover',
						'priority'	 => 12
					)
				)
			);









// ============ Colors: Secondary Navigation Bar
//=========================================


	$wp_customize->add_setting(
		'ig_below_bar_bg',
		array(
			'default'     => '#fcfcfc'
		)
	);

	$wp_customize->add_setting(
		'ig_below_bar_nav_color',
		array(
			'default'     => '#999999'
		)
	);
	$wp_customize->add_setting(
		'ig_below_bar_nav_color_active',
		array(
			'default'     => '#ef9781'
		)
	);

	$wp_customize->add_setting(
		'ig_below_drop_bg',
		array(
			'default'     => '#f9f9f9'
		)
	);
	$wp_customize->add_setting(
		'ig_below_drop_border',
		array(
			'default'     => '#eeeeee'
		)
	);
	$wp_customize->add_setting(
		'ig_below_drop_text_color',
		array(
			'default'     => '#878787'
		)
	);
	$wp_customize->add_setting(
		'ig_below_drop_text_hover_bg',
		array(
			'default'     => '#fcfcfc'
		)
	);
	$wp_customize->add_setting(
		'ig_below_drop_text_hover_color',
		array(
			'default'     => '#ef9781'
		)
	);





			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_bg',
					array(
						'label'      => __('Below Bar Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_bar_bg',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_nav_color',
					array(
						'label'      => __('Below Bar Menu Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_bar_nav_color',
						'priority'	 => 2
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_nav_color_active',
					array(
						'label'      => __('Below Bar Menu Text Hover/Active','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_bar_nav_color_active',
						'priority'	 => 3
					)
				)
			);



			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_drop_bg',
					array(
						'label'      => __('Below Dropdown Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_drop_bg',
						'priority'	 => 4
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_drop_text_hover_bg',
					array(
						'label'      => __('Below Dropdown Hover Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_drop_text_hover_bg',
						'priority'	 => 5
					)
				)
			);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_drop_border',
					array(
						'label'      => __('Below Dropdown Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_drop_border',
						'priority'	 => 6
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_drop_text_color',
					array(
						'label'      => __('Below Dropdown Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_drop_text_color',
						'priority'	 => 7
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'belowbar_drop_text_hover_color',
					array(
						'label'      => __('Below Dropdown Text Hover','ilgelo'),
						'section'    => 'ilgelo_new_section_color_below_bar',
						'settings'   => 'ig_below_drop_text_hover_color',
						'priority'	 => 8
					)
				)
			);









// ============ Colors: Slide Posts
//=========================================


	
	$wp_customize->add_setting(
	   'ig_slideposts_bg',
	   array(
	       'default'     => '243, 244, 244',
	       'sanitize_callback' => 'sanitize_text_field'
	   )
	);

	$wp_customize->add_setting(
				'ig_slideposts_title',
				array(
					'default'     => '#353535'
				)
			);

	$wp_customize->add_setting(
				'ig_slideposts_category',
				array(
					'default'     => '#999999'
				)
			);

	$wp_customize->add_setting(
				'ig_slideposts_date',
				array(
					'default'     => '#999999'
				)
			);



		
	$wp_customize->add_control(
				new WP_Customize_Control(
				$wp_customize,
				'slideposts_bg',
				array(
					'label'      => 'RGB Background',
					'description' => esc_html__( 'Choose background color for meta box.' , 'ilgelo' ),
					'section'    => 'ilgelo_new_section_color_slideposts',
					'settings'   => 'ig_slideposts_bg',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'slideposts_title',
					array(
					     'label'    => __('Title','ilgelo'),
						'section'    => 'ilgelo_new_section_color_slideposts',
						'settings'   => 'ig_slideposts_title',
						'priority'	 => 2
					)
				)
			);



			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'slideposts_category',
					array(
					     'label'    => __('Category','ilgelo'),
						'section'    => 'ilgelo_new_section_color_slideposts',
						'settings'   => 'ig_slideposts_category',
						'priority'	 => 3
					)
				)
			);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'slideposts_date',
					array(
					     'label'    => __('Date','ilgelo'),
						'section'    => 'ilgelo_new_section_color_slideposts',
						'settings'   => 'ig_slideposts_date',
						'priority'	 => 4
					)
				)
			);










// ============ Colors/Options: Mobile Menu
//=============================


	$wp_customize->add_setting(
		'ig_bg_mobile',
		array(
			'default'     => '#f6f6f6'
		)
	);

	$wp_customize->add_setting(
		'ig_hide_mini_logo_mobile',
		array(
			'default'     => ''
		)
	);
	$wp_customize->add_setting(
		'ig_big_logo_mobile',
		array(
			'default'     => ''
		)
	);




			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'mobile_bg',
					array(
						'label'      => __('Mobile Menu BG Color','ilgelo'),
						'section'    => 'ilgelo_new_section_mobile',
						'settings'   => 'ig_bg_mobile',
						'priority'	 => 1
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'hide_mini_logo_mobile',
					array(
						'label'      => __('Hide Mini Logo In responsive','ilgelo'),
						'section'    => 'ilgelo_new_section_mobile',
						'settings'   => 'ig_hide_mini_logo_mobile',
						'type'		 => 'checkbox',
						'priority'	 => 2
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'big_logo_mobile',
					array(
						'label'      => __('Hide Big Logo In responsive','ilgelo'),
						'section'    => 'ilgelo_new_section_mobile',
						'settings'   => 'ig_big_logo_mobile',
						'type'		 => 'checkbox',
						'priority'	 => 3
					)
				)
			);










// ============ Colors: Sidebar
//=============================


	$wp_customize->add_setting(
		'ig_sidebar_bg',
		array(
			'default'     => '#f7f7f7'
		)
	);
	$wp_customize->add_setting(
		'ig_sidebar_border',
		array(
			'default'     => '#efefef'
		)
	);
	$wp_customize->add_setting(
		'ig_color_divider_widget_title',
		array(
			'default'     => '#ef9781'
		)
	);

	
	
	
	


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_title_bg',
					array(
						'label'      => __('Widget Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_sidebar_bg',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_border',
					array(
						'label'      => __('Widget Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_sidebar_border',
						'priority'	 => 2
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_divider_widget_title',
					array(
						'label'      => __('Widget Title Line','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_color_divider_widget_title',
						'priority'	 => 3
					)
				)
			);

// Color widget About Me


$wp_customize->add_setting(
		'ig_wid_about_border',
		array(
			'default'     => '#e5e8ea',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
$wp_customize->add_setting(
		'ig_wid_about_background',
		array(
			'default'     => '#eff0f2',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
$wp_customize->add_setting(
		'ig_wid_about_title',
		array(
			'default'     => '#353535',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
$wp_customize->add_setting(
		'ig_wid_about_sub_title',
		array(
			'default'     => '#a3a3a3',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
$wp_customize->add_setting(
		'ig_wid_about_text',
		array(
			'default'     => '#353535',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
$wp_customize->add_setting(
		'ig_wid_about_social',
		array(
			'default'     => '#353535',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
$wp_customize->add_setting(
		'ig_wid_about_social_hover',
		array(
			'default'     => '#ef9781',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_border',
					array(
						'label'      => esc_html__('"About" Widget Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_border',
						'description' => esc_html__( 'Your can customize the color settings of your "About" widget.' , 'ilgelo' ),

						'priority'	 => 9
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_background',
					array(
						'label'      => esc_html__('"About" Widget Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_background',
						'priority'	 => 10
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_title',
					array(
						'label'      => esc_html__('"About" Widget Title','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_title',
						'priority'	 => 11
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_sub_title',
					array(
						'label'      => esc_html__('"About" Widget Subtitle','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_sub_title',
						'priority'	 => 12
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_text',
					array(
						'label'      => esc_html__('"About" Widget Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_text',
						'priority'	 => 13
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_social',
					array(
						'label'      => esc_html__('"About" Widget Social','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_social',
						'priority'	 => 14
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'wid_about_social_hover',
					array(
						'label'      => esc_html__('"About" Widget Social Hover','ilgelo'),
						'section'    => 'ilgelo_new_section_color_sidebar',
						'settings'   => 'ig_wid_about_social_hover',
						'priority'	 => 15
					)
				)
			);







// ============ Footer
//=========================================


$wp_customize->add_setting(
   'ig_footer_copyright',
   array(
       'default'     => 'Tuulikki - Designed & Developed by <a href="http://ilgelodesign.com">Ilgelo Design</a>'
   )
);

	$wp_customize->add_setting(
		'ig_bg_footer',
		array(
			'default'     => '#ffffff'
		)
	);
	$wp_customize->add_setting(
		'ig_text_footer',
		array(
			'default'     => '#353535'
		)
	);
	$wp_customize->add_setting(
		'ig_hover_footer',
		array(
			'default'     => '#ef9781'
		)
	);

$wp_customize->add_setting(
		'ig_footer_sidebar',
		array(
			'default'     => ''
		)
	);
	$wp_customize->add_setting(
		'ig_bg_footer_sidebar',
		array(
			'default'     => '#f7f7f7'
		)
	);




	$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_copyright',
				array(
					'label'      => 'Copyright Text',
					'section'    => 'ilgelo_new_section_footer',
					'settings'   => 'ig_footer_copyright',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);


	$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'bg_footer',
					array(
						'label'      => __('Background','ilgelo'),
						'section'    => 'ilgelo_new_section_footer',
						'settings'  => 'ig_bg_footer',
						'priority'  => 2
					)
				)
			);


				$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'text_footer',
					array(
						'label'      => __('Text Color','ilgelo'),
						'section'    => 'ilgelo_new_section_footer',
						'settings'  => 'ig_text_footer',
						'priority'  => 3
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'hover_footer',
					array(
						'label'      => __('Active Text Color','ilgelo'),
						'section'    => 'ilgelo_new_section_footer',
						'settings'  => 'ig_hover_footer',
						'priority'  => 4
					)
				)
			);


	$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_sidebar',
				array(
					'label'      => __('Disable footer Sidebar','ilgelo'),
					'section'    => 'ilgelo_new_section_footer',
					'settings'   => 'ig_footer_sidebar',
					'type'		 => 'checkbox',
					'priority'	 => 5
				)
			)
		);


	$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'bg_footer_sidebar',
					array(
						'label'      => __('footer Sidebar Background','ilgelo'),
						'section'    => 'ilgelo_new_section_footer',
						'settings'  => 'ig_bg_footer_sidebar',
						'priority'  => 6
					)
				)
			);













if(class_exists('WooCommerce')) {

//=============================
//  Woocommerce Settings
//=============================



	$wp_customize->add_setting(
	   'ig_woo_sidebar_product',
	   array(
	   		'default'     => true
		  )
	);
    $wp_customize->add_setting(
        'ig_woo_sidebar_shop',
        array(
            'default'     => true
        )
    );



	$wp_customize->add_setting(
	   'ig_woo_shop_layout',
	   array(
	       'default'     => '3'
	   )
	);


	$wp_customize->add_setting(
		'ig_shop_number_product',
		array(
			'default'     => '9'
		)
	);


	$wp_customize->add_setting(
	   'ig_woo_related_prod_layout',
	   array(
	       'default'     => '3'
	   )
	);

	$wp_customize->add_setting(
	   'ilgelo_cart_active',
	   array(
	       'default'     => false
	   )
	);

	$wp_customize->add_setting(
	   'ig_disable_ecom_nav',
	   array(
	       'default'     => false
	   )
	);







			$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woo_sidebar_product',
				array(
					'label'    => __('Disable Sidebar on Product Page','ilgelo'),
					'section'    => 'ilgelo_woocommerce',
					'settings'   => 'ig_woo_sidebar_product',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woo_sidebar_shop',
				array(
					'label'    => __('Disable Sidebar on Shop Page','ilgelo'),
					'section'    => 'ilgelo_woocommerce',
					'settings'   => 'ig_woo_sidebar_shop',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woo_shop_layout',
				array(
					'label'    => __('Shop Layout','ilgelo'),
					'section'        => 'ilgelo_woocommerce',
					'description' => __( 'Show your products in 3 or 4 columns.' , 'ilgelo' ),
					'settings'       => 'ig_woo_shop_layout',
					'type'           => 'radio',
					'priority'	 => 3,
					'choices'        => array(
						'3' => '3',
						'4' => '4',
					)
				)
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shop_number_product',
				array(
					'label'      => 'Number of products per page',
					'description' => __( 'Note: save and refresh page to see new changes.' , 'ilgelo' ),
					'section'    => 'ilgelo_woocommerce',
					'settings'   => 'ig_shop_number_product',
					'type'		 => 'number',
					'priority'	 => 4
				)
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woo_related_prod_layout',
				array(
					'label'    => __('Related Products Layout','ilgelo'),
					'section'        => 'ilgelo_woocommerce',
					'description' => __( 'Show your products in 3 or 4 columns.' , 'ilgelo' ),

					'settings'       => 'ig_woo_related_prod_layout',
					'type'           => 'radio',
					'priority'	 => 5,
					'choices'        => array(
						'3' => '3',
						'4' => '4',
					)
				)
			)
		);


			$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'cart_active',
				array(
					'label'      => __('Disable Cart Icon','ilgelo'),
					'section'    => 'ilgelo_woocommerce',
					'settings'   => 'ilgelo_cart_active',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'disable_ecom_nav',
				array(
					'label'      => __('Disable Woocommerce Navigation','ilgelo'),
					'section'    => 'ilgelo_woocommerce',
					'settings'   => 'ig_disable_ecom_nav',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);




//=========================================
// Colors: Shop Navigation Bar
//=========================================


	$wp_customize->add_setting(
		'ig_e_com_bar_bg',
		array(
			'default'     => '#3c3c42'
		)
	);
	$wp_customize->add_setting(
		'ig_e_com_bar_nav_color',
		array(
			'default'     => '#a3a3a3'
		)
	);
	$wp_customize->add_setting(
		'ig_e_com_bar_nav_color_active',
		array(
			'default'     => '#ef9781'
		)
	);
	$wp_customize->add_setting(
		'ig_e_com_drop_bg',
		array(
			'default'     => '#f9f9f9'
		)
	);
	
	$wp_customize->add_setting(
		'ig_e_com_drop_text_hover_bg',
		array(
			'default'     => '#fcfcfc'
		)
	);
	
	$wp_customize->add_setting(
		'ig_e_com_drop_border',
		array(
			'default'     => '#eeeeee'
		)
	);
	
		
	$wp_customize->add_setting(
		'ig_e_com_drop_text_color',
		array(
			'default'     => '#878787'
		)
	);
	$wp_customize->add_setting(
		'ig_e_com_drop_text_hover_color',
		array(
			'default'     => '#ef9781'
		)
	);
			
	$wp_customize->add_setting(
		'ig_e_com_vertical_divider',
		array(
			'default'     => '#595959'
		)
	);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_bg',
					array(
						'label'      => __('Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_bar_bg',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_nav_color',
					array(
						'label'      => __('Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_bar_nav_color',
						'priority'	 => 2
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_nav_color_active',
					array(
						'label'      => __('Hover/Active Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_bar_nav_color_active',
						'priority'	 => 3
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_drop_bg',
					array(
						'label'      => __('Dropdown Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_drop_bg',
						'priority'	 => 4
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_drop_text_hover_bg',
					array(
						'label'      => __('Dropdown Hover Background','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_drop_text_hover_bg',
						'priority'	 => 5
					)
				)
			);


			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_drop_border',
					array(
						'label'      => __('Dropdown Border','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_drop_border',
						'priority'	 => 6
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_drop_text_color',
					array(
						'label'      => __('Dropdown Text','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_drop_text_color',
						'priority'	 => 7
					)
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_drop_text_hover_color',
					array(
						'label'      => __('Dropdown Text Hover','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_drop_text_hover_color',
						'priority'	 => 8
					)
				)
			);

		

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'e_com_vertical_divider',
					array(
						'label'    => __('Cart Vertical Divider','ilgelo'),
						'section'    => 'ilgelo_new_section_color_e_commece_menu',
						'settings'   => 'ig_e_com_vertical_divider',
						'priority'	 => 10
					)
				)
			);


} //And IF WooCommerce

// ============ Custom CSS
//=============================


$wp_customize->add_setting(
	'ig_custom_css'
);

		$wp_customize->add_control(
			new Customize_CustomCss_Control(
				$wp_customize,
				'custom_css',
				array(
					'label'      => __('Custom CSS','ilgelo'),
					'section'    => 'ilgelo_new_section_custom_css',
					'settings'   => 'ig_custom_css',
					'type'		 => 'custom_css',
					'priority'	 => 1
				)
			)
		);

	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'background_image');

	$wp_customize->get_setting('header_single_page')->transport = 'postMessage';
}
add_action( 'customize_register', 'ilgelo_register_theme_customizer' );






?>