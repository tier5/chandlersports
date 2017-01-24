<?php
$art_config = parse_ini_file(TEMPLATEPATH."/config.ini", true);

$options = array (
                array(  "name" => "HTML",
                        "desc" => sprintf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>', 'kubrick'), 'a, abbr, acronym, em, b, i, strike, strong, span'),
                        "id" => "art_footer_content",
                        "std" => $art_config['footer']['defaultText'],
                        "type" => "textarea")
          );

remove_action('wp_head', 'wp_generator');
wp_enqueue_script('jquery');

if (class_exists('xili_language')):
define('THEME_TEXTDOMAIN','kubrick');
define('THEME_LANGS_FOLDER','/lang');
else:
    load_theme_textdomain('kubrick', TEMPLATEPATH.'/lang');
endif;

define('WP_VERSION', $wp_version);

require_once(TEMPLATEPATH.'/core/parser.php');
require_once(TEMPLATEPATH.'/core/navigation.php');
require_once(TEMPLATEPATH.'/core/sidebars.php');
require_once(TEMPLATEPATH.'/core/widgets.php');

$art_current_page_template = 'page'; 
function art_page_template($templateName = null){
    global $art_current_page_template;
    if ($templateName !== null) {
        $art_current_page_template = $templateName;
    }
    return $art_current_page_template;
}

$art_template_variables = null;
function art_page_variables($variables = null){
    global $art_template_variables, $art_config;
    if ($art_template_variables == null){
      $art_template_variables = array(
        'template_url' => get_bloginfo('template_url') . '/',
        'logo_url' => get_option('home'),
        'logo_name' => get_bloginfo('name'),
        'logo_description' => get_bloginfo('description'),
        'menu_items' => art_get_menu_auto('primary-menu', $art_config['menu']['source'], $art_config['menu']['showSubitems']),
        'sidebar1' => art_get_sidebar('default'),
        'sidebarTop' => art_get_sidebar('top'),
        'sidebarBottom' => art_get_sidebar('bottom'),
        'sidebar2' => art_get_sidebar('secondary'),
        'sidebarFooter' => art_get_sidebar('footer'),
        'footerRSS' => art_get_footer_rss(),
        'footerText' => art_get_footer_text()
        );
    }
    if (is_array($variables)) {
      $art_template_variables = array_merge($art_template_variables, $variables);
    }
    return $art_template_variables;
}

function art_get_footer_text(){
  global $art_config;
  $result = $art_config['footer']['defaultText'];
  
  $footer_content = get_option('art_footer_content');
  if ($footer_content !== false) {
    $result = stripslashes($footer_content);
  }
  
  return str_replace('%YEAR%', date('Y'), $result);
}


function art_get_footer_rss(){
  global $art_config;
  $result = '';
  
  if($art_config['footer']['rss_show']){
    $result = str_replace(
      array('[rss_url]', '[rss_title]'), 
      array(get_bloginfo('rss2_url'), sprintf(__('%s RSS Feed', 'kubrick'), $name)),
      $art_config['footer']['rss_link']);
  }
  return $result;
}

function art_get_post_thumbnail($post_id = false){
	global $art_config,$post, $id;
    $post_id = (int)$post_id;
    if (!$post_id) $post_id = $id;
	$metadata = $art_config['metadata'];
	$width = $metadata['thumbnail_width'];
	$height = $metadata['thumbnail_height'];
	$result = '';
	$title = get_the_title();
	if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
		ob_start();
		the_post_thumbnail(array($width, $height), array('class' => 'alignleft', 'alt' => '', 'title' => $title));
		$result = ob_get_clean();
	} else {
		$postimage = get_post_meta($post->ID, 'post-image', true);
		if ($postimage) {
			$result = '<img src="'.$postimage.'" alt="" width="'.$width.'" height="'.$height.'" title="'.$title.'" class="wp-post-image alignleft" />';
		} else if ($metadata['thumbnail_auto']) {
            $attachments = get_children(array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));
            if($attachments) {
              $attachment = array_shift($attachments);
              $img = wp_get_attachment_image_src($attachment->ID, array($width, $height));
              if (isset($img[0])) {
                $result = '<img src="'.$img[0].'" alt="" width="'.$img[1].'" height="'.$img[2].'" title="'.$title.'" class="wp-post-image alignleft" />';
              }
            }
        } 
    }  
	if($result !== ''){
		$result = '<a href="'.get_permalink($post->ID).'" title="'.$title.'">'.$result.'</a>';
	}
	return $result;
}

function art_get_the_content($more_link_text = null, $stripteaser = 0) {
	$content = get_the_content($more_link_text, $stripteaser);
	$content = apply_filters('the_content', $content);
	return $content;
}

function art_get_post_content() {
    global $post, $art_config;
    ob_start();
    if(is_single() || is_page()) {
		 echo art_get_the_content(__('Read the rest of this entry &raquo;')); 
		 wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
	} else {
        echo art_get_the_excerpt(__('Read the rest of this entry &raquo;'), get_permalink($post->ID), $art_config['metadata']['excerpt_words'], explode(',',$art_config['metadata']['excerpt_allowed_tags']), $art_config['metadata']['excerpt_min_remainder'],  $art_config['metadata']['excerpt_auto']);
	}
	return ob_get_clean();
}

function art_get_the_excerpt($read_more_tag, $perma_link_to = '', $all_words = 100,  $allowed_tags = array('a', 'img', 'abbr', 'blockquote', 'b', 'cite', 'pre', 'code', 'em', 'label', 'i', 'p', 'span', 'strong', 'ul', 'ol', 'li'), $min_remainder = 5, $auto = false) {
    global $post, $id;
    $more_token = '%%art-more%%';
    $show_more_tag = false;
    if (function_exists('post_password_required') && post_password_required($post)){
      return get_the_excerpt();
    }
    if (has_excerpt($id)) {
        $the_contents = get_the_excerpt();
		$show_more_tag = strlen($post->post_content) > 0;
    } else {
        $the_contents = art_get_the_content($more_token);
        if($the_contents != '') {
            $allowed_tags = '<' .implode('><',$allowed_tags).'>';
            $the_contents = strip_tags($the_contents, $allowed_tags);
            $the_contents = strip_shortcodes($the_contents);
            if (strpos($the_contents, $more_token) !== false) {
                return str_replace($more_token, $read_more_tag, $the_contents);
            }
            if($auto && is_numeric($all_words)) {
              $token = "%art_tag_token%";
              $content_parts = explode($token, str_replace(array('<', '>'), array($token.'<', '>'.$token), $the_contents));
              $content = array();
              $word_count = 0;
              foreach($content_parts as $part)
              {
                if (strpos($part, '<') !== false || strpos($part, '>') !== false){
                  $content[] = array('type'=>'tag', 'content'=>$part);
                } else {
                   $all_chunks = preg_split('/([\s]+)/', $part, -1, PREG_SPLIT_DELIM_CAPTURE);
                   foreach($all_chunks as $chunk) {
                      if('' != trim($chunk)) {
                        $content[] = array('type'=>'word', 'content'=>$chunk);
                        $word_count += 1;
                      } elseif($chunk != '') {
                        $content[] = array('type'=>'space', 'content'=>$chunk);
                      }
                   }
                }
              
              }
              if(($all_words < $word_count) && ($all_words + $min_remainder) <= $word_count) {
                $show_more_tag = true;
                $current_count = 0;
                $the_contents = '';
                foreach($content as $node) {
                  
                  if($node['type'] == 'word') {
                    $current_count += 1;
                  } 
                  $the_contents .= $node['content'];
                  if ($current_count == $all_words){
                    break;
                  }
                }
                
                
              }  
            }
        }
    }
    $the_contents = force_balance_tags($the_contents);
    if ($show_more_tag) {
      $the_contents = $the_contents.' <a class="more-link" href="'.$perma_link_to.'">'.$read_more_tag.'</a>';
    }
    return $the_contents;
}


function art_get_post_title() {
    return parse_template("post_title", array(
		'post_link' => get_permalink($post->ID),
	    'post_link_title' => sprintf(__('Permanent Link to %s', 'kubrick'), the_title_attribute('echo=0')),
	    'post_title' => get_the_title(),
	    'template_url'=> get_bloginfo('template_url')
	    ));
}

function art_get_post_icon($name){
    global $art_config;
    return str_replace('[template_url]', get_bloginfo('template_url'), $art_config['metadata'][$name]);
}

if (!function_exists('get_the_date')) {
	function get_the_date($format = 'F jS, Y') {
		return get_the_time(__($format, 'kubrick'));
	}
}

function art_get_post_metadata($name) {
    global $art_config;
    $list = $art_config['metadata'][$name];
    $title = ($name == 'header' && $art_config['metadata']['title']);
    if (!$title && $list == "") return;
    $list_array =  explode(",", $list);
    $result = array();
    for($i = 0; $i < count($list_array); $i++){
        $icon = $list_array[$i];
        switch($icon){
            case 'date':
                if(is_page()) break;
                $result[] = art_get_post_icon($icon) . get_the_date();
            break;
            case 'author':
                 if(is_page()) break;
                 ob_start();
                 the_author_posts_link();
                 $result[] = art_get_post_icon($icon) . __('Author', 'kubrick') .' '. ob_get_clean();
            break;
            case 'category':
                if(is_page()) break;
                 $result[] = art_get_post_icon($icon) .sprintf(__('Posted in %s', 'kubrick'), get_the_category_list(', '));
            break;
            case 'tag':
                if(is_page() || !get_the_tags()) break;
                ob_start();
                the_tags(__('Tags:', 'kubrick') . ' ', ', ', ' ');
                $result[] = art_get_post_icon($icon) . ob_get_clean();
            break;
            case 'comments':
            if(is_page() || is_single()) break;
                ob_start();
                comments_popup_link(__('No Comments &#187;', 'kubrick'), __('1 Comment &#187;', 'kubrick'), __('% Comments &#187;', 'kubrick'), '', __('Comments Closed', 'kubrick') );
                $result[] = art_get_post_icon($icon) . ob_get_clean();
            break;
            case 'edit':
                if (!current_user_can('edit_post', $post->ID)) break;
                ob_start();
                 edit_post_link(__('Edit', 'kubrick'), '');
                $result[] = art_get_post_icon($icon) . ob_get_clean();
            break;
        }
    }
    if (!($title ||  count($result) > 0)) return '';
    return   parse_template("post_metadata".$name, array(
        'post_title' => art_get_post_title(),
        'post'.$name.'icons' => implode($art_config['metadata']['separator'], $result))) ;
}

function art_post(){
    the_post(); 
	echo parse_template("post", array(
	    'post_thumbnail' => (is_single() || is_page() ? '' : art_get_post_thumbnail()),
		'post_title' => art_get_post_title(),
		'post_metadataheader' =>art_get_post_metadata('header'),
		'post_content' => art_get_post_content(),
		'post_metadatafooter' => art_get_post_metadata('footer')
		));
}

function art_post_box($title, $content){
    if ($title != "") $title = '<h2 class="art-postheader">'. $title . '</h2>';
	echo parse_template("post", array(
		'post_thumbnail' => '',
		'post_title' => $title,
		'post_metadataheader' =>'',
		'post_content' => $content,
		'post_metadatafooter' => ''));
}

function art_get_block($title, $content, $id = '', $class = '' , $name = "block"){
    $find = 'block"';
    $replace = 'block';
    if ($class != "") $replace .=   ' '.$class;
    if ($id != "" )  $replace .= '" id="' .$id;
    $replace .= '"';
    $content = parse_template($name, array(
		'caption' => $title,
	    'content' => $content,
	   ));
	if ($id != "" || $class != "") $content = str_replace($find, $replace, $content);
	return $content;
}

function art_get_page_title() {
        $name = get_bloginfo('name');
        $cat =  single_cat_title( '' ,   false);
        $post = single_post_title('', false); 
        $result = "";
        if (is_home () ) { 
            $result .= $name;
        }  elseif ( is_category() )  { 
            $result .= $cat;
            if($name != "")  $result .=' - ' ; 
            $result  .= $name;
        } elseif (is_single() )  { 
            $result .= $post;
        } elseif (is_page() )  {
            $result .= $name;
            if($name != "")  $result .= ': '; 
             $result .= $post;
        } else {
               $result .= wp_title('',false); 
        }
        return $result;
}

	
function art_get_search() {
    return parse_template("search", 
        array(
            'url' =>  get_bloginfo('url'),
            'button' => __('Search', 'kubrick'),
            'query' => get_search_query()
        ));
}
		
function art_page_navi($title = '', $comment = false) {
    $prev_link = null;
    $next_link = null;
    if($comment){
        $prev_link = get_previous_comments_link(__('Newer Entries &raquo;', 'kubrick'));
        $next_link = get_next_comments_link(__('&laquo; Older Entries', 'kubrick'));
    } elseif (is_single() || is_page()) {
        $next_link = get_previous_post_link('&laquo; %link');
        $prev_link = get_next_post_link('%link &raquo;');
    } else {
        $prev_link = get_previous_posts_link(__('Newer Entries &raquo;', 'kubrick'));
        $next_link = get_next_posts_link(__('&laquo; Older Entries', 'kubrick'));
    }
    
    $content = '';
    if ($prev_link || $next_link) {
        $content = parse_template("pagination", 
            array(
                'next_link' =>  $next_link,
                'prev_link' => $prev_link
            ));
    }
    if (!$content && !$title) return;
    art_post_box($title, $content);
}

if (!function_exists('get_previous_comments_link')) {
	function get_previous_comments_link($label)
	{
		ob_start();
		previous_comments_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_next_comments_link')) {
	function get_next_comments_link($label)
	{
		ob_start();
		next_comments_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_previous_posts_link')) {
	function get_previous_posts_link($label)
	{
		ob_start();
		previous_posts_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_next_posts_link')) {
	function get_next_posts_link($label)
	{
		ob_start();
		next_posts_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_previous_post_link')) {
	function get_previous_post_link($label)
	{
		ob_start();
		previous_post_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_next_post_link')) {
	function get_next_post_link($label)
	{
		ob_start();
		next_post_link($label);
		return ob_get_clean();
	}
}

function art_get_comment_author_link(){
    ob_start();
    comment_author_link();    
    return ob_get_clean();
}

function art_get_edit_comment_link(){
    ob_start();
    edit_comment_link('('.__('Edit', 'kubrick').')','  ','');
    return  ob_get_clean();
}

function art_get_comment_text(){
    ob_start();
    comment_text();
    return  ob_get_clean();
}

function art_get_comment_reply_link($args){
    ob_start();
    comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
    return  ob_get_clean();
}


function art_comment($comment, $args, $depth)
{
	 $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
<?php  art_post_box('',  parse_template("comment", array(
		'get_avatar' => get_avatar($comment, $size='48'),
		'comment_author_link' =>art_get_comment_author_link(),
		'status' => $comment->comment_approved == '0' ?  '<em>' . __('Your comment is awaiting moderation.') . '</em><br />' : '',
		'get_comment_link' =>  htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ,
		'get_comment_date' => sprintf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()),
		'edit_comment_link' => art_get_edit_comment_link(),
		'comment_text' => art_get_comment_text(),
		'comment_reply_link' => art_get_comment_reply_link($args)))); ?>      
     </div>
<?php
}

add_filter('comments_template', 'legacy_comments');  
function legacy_comments($file) {  
    if(!function_exists('wp_list_comments')) : // WP 2.7-only check  
    $file = TEMPLATEPATH.'/legacy.comments.php';  
    endif;  
    return $file;  
} 

if ( function_exists('add_theme_support') ) {
	add_theme_support('post-thumbnails');
    add_theme_support('nav-menus');
    add_theme_support('automatic-feed-links');
}

if (function_exists('register_nav_menus')) {
    register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' )
		)
	);
}
 

function art_add_admin() {
	global $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    if($value['type'] != 'multicheck'){
                        art_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            art_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
                foreach ($options as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) { art_update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); }
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) ) { art_update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); }
                        }
                    }
                }
                header("Location: themes.php?page=functions.php&saved=true");
                die;
        } 
    }

    add_theme_page("Footer", "Footer", 'edit_themes', basename(__FILE__), 'art_admin');

}

add_action('admin_menu', 'art_add_admin');

     
	
function art_update_option($key, $value){
	update_option($key, (get_magic_quotes_gpc()) ? stripslashes($value) : $value);
}


function art_admin() {
    global $art_config, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$art_config['theme']['name'].' settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>Footer</h2>

	<form method="post">

		<table class="optiontable" style="width:100%;">

<?php foreach ($options as $value) {
   
    switch ( $value['type'] ) {
        case 'text':
        option_wrapper_header($value);
        ?>
                <input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
        <?php
        option_wrapper_footer($value);
        break;
       
        case 'select':
        option_wrapper_header($value);
        ?>
                <select style="width:70%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                    <?php foreach ($value['options'] as $option) { ?>
                    <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                    <?php } ?>
                </select>
        <?php
        option_wrapper_footer($value);
        break;
       
        case 'textarea':
        $ta_options = $value['options'];
        option_wrapper_header($value);
        ?>
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:100%;height:100px;"><?php
                if( get_settings($value['id']) !== false) {
                        echo stripslashes(get_settings($value['id']));
                    }else{
                        echo $value['std'];
                }?></textarea>
        <?php
        option_wrapper_footer($value);
        break;

        case "radio":
        option_wrapper_header($value);
       
        foreach ($value['options'] as $key=>$option) {
                $radio_setting = get_settings($value['id']);
                if($radio_setting != ''){
                    if ($key == get_settings($value['id']) ) {
                        $checked = "checked=\"checked\"";
                        } else {
                            $checked = "";
                        }
                }else{
                    if($key == $value['std']){
                        $checked = "checked=\"checked\"";
                    }else{
                        $checked = "";
                    }
                }?>
                <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
        <?php
        }
        
        option_wrapper_footer($value);
        break;
       
        case "checkbox":
        option_wrapper_header($value);
                        if(get_settings($value['id'])){
                            $checked = "checked=\"checked\"";
                        }else{
                            $checked = "";
                        }
                    ?>
                    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
        <?php
        option_wrapper_footer($value);
        break;

        case "multicheck":
        option_wrapper_header($value);
       
        foreach ($value['options'] as $key=>$option) {
                 $pn_key = $value['id'] . '_' . $key;
                $checkbox_setting = get_settings($pn_key);
                if($checkbox_setting != ''){
                    if (get_settings($pn_key) ) {
                        $checked = "checked=\"checked\"";
                        } else {
                            $checked = "";
                        }
                }else{
                    if($key == $value['std']){
                        $checked = "checked=\"checked\"";
                    }else{
                        $checked = "";
                    }
                }?>
                <input type="checkbox" name="<?php echo $pn_key; ?>" id="<?php echo $pn_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $pn_key; ?>"><?php echo $option; ?></label><br />
        <?php
        }
        
        option_wrapper_footer($value);
        break;
       
        case "heading":
        ?>
        <tr valign="top">
            <td colspan="2" style="text-align: center;"><h3><?php echo $value['name']; ?></h3></td>
        </tr>
        <?php
        break;
       
        default:

        break;
    }
}
?>

		</table>

		<p class="submit">
			<input name="save" type="submit" value="Save changes" />
			<input type="hidden" name="action" value="save" />
		</p>
	</form>
</div>
<?php
}

function option_wrapper_header($values){
    ?>
    <tr valign="top">
        <th scope="row" style="width:1%;white-space: nowrap;"><?php echo $values['name']; ?>:</th>
        <td>
    <?php
}

function option_wrapper_footer($values){
    ?>
        </td>
    </tr>
    <tr valign="top">
        <td>&nbsp;</td><td><small><?php echo $values['desc']; ?></small></td>
    </tr>
    <?php
}
