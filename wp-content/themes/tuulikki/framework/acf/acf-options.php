<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_authors',
		'title' => __('Authors', 'ilgelo'),
		'fields' => array (
			array (
				'key' => 'field_55daf68a9324a',
				'label' => __('Author facebook link', 'ilgelo'),
				'name' => 'author_facebook_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55daf67d93249',
				'label' => __('Author twitter link', 'ilgelo'),
				'name' => 'author_twitter_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55daf63f93248',
				'label' => __('Author instagram link', 'ilgelo'),
				'name' => 'author_instagram_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55daf6979324b',
				'label' => __('Author pinterest link', 'ilgelo'),
				'name' => 'author_pinterest_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55db81141426a',
				'label' => __('Author google + link', 'ilgelo'),
				'name' => 'author_google_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_user',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_category-pages',
		'title' => 'Category Pages',
		'fields' => array (
			array (
				'key' => 'field_55db8c3d455bf',
				'label' => __('Category image', 'ilgelo'),
				'name' => 'category_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_featured-image-size',
		'title' => 'Featured Image Position',
		'fields' => array (
			array (
				'key' => 'field_55f969bd3f920',
				'label' => __('Featured image positioning options', 'ilgelo'),
				'name' => 'featured_image_size_options',
				'type' => 'select',
				'choices' => array (
					'top-featured' => 'Top of the Post',
					'in-featured' => 'In to Post',
					'none-featured' => 'None',
				),
				'default_value' => 'in-featured',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-about',
		'title' => 'Page About',
		'fields' => array (
		
			array (
				'key' => 'field_55eeeca207057',
				'label' => __('Author Image ', 'ilgelo'),
				'name' => 'author_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		
			array (
				'key' => 'field_55ef236fe5310',
				'label' => 'Facebook Url',
				'name' => 'facebook_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55ef23a4e5311',
				'label' => 'Twitter Url',
				'name' => 'twitter_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55ef23bbe5312',
				'label' => 'Pinterest Url',
				'name' => 'pinterest_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55ef23d5e5313',
				'label' => 'Instagram Url',
				'name' => 'instagram_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-page-about-1.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-page-about-2.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			
			
			
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_pages',
		'title' => __('Page Settings', 'ilgelo'),
		'fields' => array (
			array (
				'key' => 'field_55f02bd2144ce',
				'label' => __('Page Subtitle', 'ilgelo'),
				'name' => 'page_subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55f02bed144cf',
				'label' => __('Show Page Title', 'ilgelo'),
				'name' => 'visible_title',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 1,
			),
			array (
				'key' => 'field_55ef26582770a',
				'label' => __('Page Image', 'ilgelo'),
				'name' => 'image_header_page',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-page-full.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-page-sidebar-right.php',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-options',
		'title' => __('Additional Post Features', 'ilgelo'),
		'fields' => array (
			array (
				'key' => 'field_55c9d58720b41',
				'label' => __('Post Intro', 'ilgelo'),
				'instructions' => 'This paragraph will appear below the subtitle. It will be highlighted to catch the attention of your readers.',
				'name' => 'story_intro',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
					),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	
	
	
	
	
	
	
	
	
	register_field_group(array (
		'id' => 'acf_slide-posts',
		'title' => __('Slide Posts', 'ilgelo'),
		'fields' => array (
			array (
				'key' => 'field_55cf72045ea36',
				'label' => __('Do you want to activate Post Slider in Blog Page?', 'ilgelo'),
				'name' => 'activate_post_slider',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			
			
				array (
			'key' => 'field_56db29246aee2',
			'label' => 'Full-Width Slide',
			'name' => 'slide_full',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
	

			
			
			
			
			array (
				'key' => 'field_56c0881e5d769',
				'label' =>  esc_html__('Select Slide Style', 'ilgelo'),
				'name' => 'select_slide_style',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_55cf72045ea36',
								'operator' => '==',
								'value' => '1',
							),
						),
						'allorany' => 'all',
					),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'1_post' =>  esc_html__('1 Post', 'ilgelo'),
					'3_post' =>  esc_html__('3 Posts', 'ilgelo'),
					'4_post' =>  esc_html__('4 Posts', 'ilgelo'),
				),
				'default_value' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),

			
			
			
			
			
			
			
			
			
			array (
				'key' => 'field_55cf728834d8a',
				'label' => __('How do you want to select posts to show in Post Slider?', 'ilgelo'),
				'name' => 'select_post_mode',
				'type' => 'select',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55cf72045ea36',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'manual' => __('Manually', 'ilgelo'),
					'per_category' => __('By Category', 'ilgelo'),
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_55cf6ca316273',
				'label' => __('Select Posts', 'ilgelo'),
				'name' => 'select_posts',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55cf728834d8a',
							'operator' => '==',
							'value' => 'manual',
						),
						array (
							'field' => 'field_55cf72045ea36',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_55cf6cb916274',
						'label' => __('Add posts one by one using the button on the right.', 'ilgelo'),
						'name' => 'select_the_posts',
						'type' => 'post_object',
						'column_width' => '',
						'post_type' => array (
							0 => 'post',
							1 => 'product',
						),
						'taxonomy' => array (
							0 => 'all',
						),
						'allow_null' => 0,
						'multiple' => 0,
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Post',
			),
			array (
				'key' => 'field_55cf6c21bcba3',
				'label' => __('Post Categories', 'ilgelo'),
				'name' => 'categorys_post',
				'type' => 'taxonomy',
				'instructions' => __('You can select multiple categories. Posts will appear in chronological order.', 'ilgelo'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55cf728834d8a',
							'operator' => '==',
							'value' => 'per_category',
						),
						array (
							'field' => 'field_55cf72045ea36',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			
			array (
				'key' => 'field_55cf7435c8b8d',
				'label' => __('Posts Number', 'ilgelo'),
				'name' => 'number_post',
				'type' => 'number',
				'instructions' => __('How many posts do you want to see in Post Slider? Enter a number (minimum 4).', 'ilgelo'),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55cf72045ea36',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55cf728834d8a',
							'operator' => '==',
							'value' => 'per_category',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 4,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 6,
				'step' => 1,
			),
		),
		
		
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-slide-posts',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	
	
		register_field_group(array (
		'id' => 'acf_slider-margin',
		'title' => __('Slider Margin', 'ilgelo'),
		'fields' => array (
			array (
				'key' => 'field_561540a349fee',
				'label' => __('Indicate the number of pixels for the top margin (the space between Post Slider and Header).', 'ilgelo'),
				'name' => 'slider_margin',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-slide-posts',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	/* === Slide Shortcode ===*/
	
		register_field_group(array (
		'id' => 'acf_shortcode-slide',
		'title' => __('Slide Shortcode', 'ilgelo'),
		'fields' => array (
			array (
				'key' => 'field_561540a349fe5tee',
				'label' => __('If you prefer to use a plugin for the slide, such as Revolution Slider or Layer Slider, you can enter here the short code).', 'ilgelo'),
				'name' => 'slide_shortcode',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-slide-posts',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	
	
		register_field_group(array (
		'id' => 'acf_promotional-box',
		'title' => 'Promotional Box',
		'fields' => array (
			array (
				'key' => 'field_56153775daf1c',
				'label' => 'Do you want activate the Promotional Box?',
				'name' => 'activate_promotional_box',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_561536ebb6c52',
				'label' => 'Promo Box 1',
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_561536505a097',
				'label' => 'Box 1 Image',
				'name' => 'image_box_1',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_561536715a098',
				'label' => 'Box 1 Text',
				'name' => 'text_box_1',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5615367f5a099',
				'label' => 'Box 1 Link',
				'name' => 'link_box_1',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5615371ab6c53',
				'label' => 'Promo Box 2',
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5615369188668',
				'label' => 'Box 2 Image',
				'name' => 'image_box_2',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5615369b88669',
				'label' => 'Box 2 Text',
				'name' => 'text_box_2',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_561536a18866a',
				'label' => 'Box 2 Link',
				'name' => 'link_box_2',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56153720b6c54',
				'label' => 'Promo Box 3',
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_561536ac31e63',
				'label' => 'Box 3 Image',
				'name' => 'image_box_3',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_561536b331e64',
				'label' => 'Box 3 Text',
				'name' => 'text_box_3',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_561536ba31e65',
				'label' => 'Link Box 3',
				'name' => 'link_box_3',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_56153775daf1c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-First-ful-grid-sidebar.php',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-First-ful-grid.php',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-First-ful-list-sidebar.php',
					'order_no' => 0,
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-First-ful-list.php',
					'order_no' => 0,
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-classic-sidebar.php',
					'order_no' => 0,
					'group_no' => 5,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-classic.php',
					'order_no' => 0,
					'group_no' => 6,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-grid-sidebar.php',
					'order_no' => 0,
					'group_no' => 7,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-grid.php',
					'order_no' => 0,
					'group_no' => 8,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-list-sidebar.php',
					'order_no' => 0,
					'group_no' => 9,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/TEMPLATE-list.php',
					'order_no' => 0,
					'group_no' => 10,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/template-page-full.php',
					'order_no' => 0,
					'group_no' => 11,
				),
			),
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template/template-page-sidebar-right.php',
					'order_no' => 0,
					'group_no' => 12,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	
	if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_home-page-promotional-box',
		'title' => 'Home Page Promotional Box',
		'fields' => array (
			array (
				'key' => 'field_5626752770a75',
				'label' => 'Do you want activate the Promotional Box?',
				'name' => 'activate_promotional_box-home',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5626756b70a76',
				'label' => 'Promo Box 1',
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5626752770a75',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5626758670a77',
				'label' => 'Box 1 Image',
				'name' => 'image_box_1_home',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_562675b370a78',
				'label' => 'Box 1 Text',
				'name' => 'text_box_1_home',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_562675ce70a79',
				'label' => 'Box 1 Link',
				'name' => 'link_box_1_home',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_562675e970a7a',
				'label' => 'Promo Box 2',
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5626752770a75',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_562675ff833c9',
				'label' => 'Box 2 Image',
				'name' => 'image_box_2_home',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_56267604833ca',
				'label' => 'Box 2 Text',
				'name' => 'text_box_2_home',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56267608833cb',
				'label' => 'Box 2 Link',
				'name' => 'link_box_2_home',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_562676551294a',
				'label' => 'Promo Box 3',
				'name' => '',
				'type' => 'tab',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5626752770a75',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_5626767617210',
				'label' => 'Box 3 Image',
				'name' => 'image_box_3_home',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5626768117211',
				'label' => 'Box 3 Text',
				'name' => 'text_box_3_home',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5626768a17212',
				'label' => 'Box 3 Link',
				'name' => 'link_box_3_home',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-promo-box',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

	
	
	
	
	
}


?>