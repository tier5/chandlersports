<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php
	$gtc = get_the_content();
	$tmp = preg_match("~(http(s)?\://(www\.)?youtube.com/watch\?v\=[a-zA-Z0-9_\-]+)~", $gtc, $m );
	$content = preg_replace( "~[\r\n]+~", "", $gtc );
	$content = trim( strip_tags( preg_replace("~(http(s)?\://(www\.)?youtube.com/watch\?v\=[a-zA-Z0-9_\-]+.+)~", "", $content ) ) );
	$video_link = preg_replace("~(/watch\?v\=)~", "/embed/", $m[0] );
?>

<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'twentyten' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'twentyten' ),
								'href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
			<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
				<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
				<span class="meta-sep">|</span>
			<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'twentyten' ) ) ) : ?>
				<a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'twentyten' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
				<span class="meta-sep">|</span>
			<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'twentyten' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php twentyten_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->
<?php /* How to display posts of the VIDEO format. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) ) || in_category( _x( 'videos', 'videos category slug', 'twentyten' ) )  ) : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="col-sm-12" style="margin-bottom: 20px;">
			<?php if( !$content ): ?>
				<header>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
				</header>
			<?php endif; ?>

			<main>
				<?php if( $content ): ?>
                <div class="col-sm-4">
					<div class="video">
						<iframe width="100%" height="200px" frameborder="0" allowfullscreen="" src="<?=$video_link?>?feature=oembed"></iframe>
					</div>
                </div>
                <div class="col-sm-8">    
					<div class="blog_right_d">
                    <div class="content">
						<h1 class="entry-title category "><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<h3><?php the_date(); ?></h3>

						<div class="blogcontent">
							<p><?=$content?></p>
						</div>
						<div class="right_r">
						<a href="<?php the_permalink(); ?>" class="blogmore">Read more </a>
					    </div>
                    </div>
				<?php else: ?>
					<iframe width="100%" height="330px" frameborder="0" allowfullscreen="" src="<?=$video_link?>?feature=oembed"></iframe>
				<?php endif; ?>
                </div>
                </div>
			</main>

			<?php if( !$content ): ?>
				<footer>
					<div class="align-left">
						<p class="postcode"><?php the_date(); ?></p>
					</div>

					<div class="align-right">
						<a href="<?php the_permalink(); ?>" class="blogmore">Read more </a>
					</div>
				</footer>
			<?php endif; ?>
            </div>
		</article><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>

		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(),'large'); ?>
		<?php if(is_search()): ?>
			<div class="post searchresults">
				
				<div class="search-img">
					<?php if($image[0] != NULL): ?>
						<img src="<?=site_url("thumb.php"); ?>?src=<?php echo $image[0]; ?>&w=170&zc=3&a=c&s=1" alt="<?php echo get_the_title(); ?>" />
					<?php endif; ?>
				</div>
				
				<div class="search-info">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</div>
				
			</div>
		<?php else: ?>
	
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="col-sm-12" style="margin-bottom: 20px;">
				<div class="col-sm-4">
					<div class="bli_i">
					<?php if($image[0] != NULL): ?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>"  /></a>
					<?php endif; ?>
                    </div>
				</div>
			
				<div class="col-sm-8">
                <div class="blog_right_d">
					<h1 class="entry-title test"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<h3><?php the_date(); ?></h3>
					<div class="blogcontent">
						<?php the_excerpt(); ?>
					</div>
					<div class="right_r">
					<a href="<?php the_permalink(); ?>" class="blogmore">Read more </a>
                    </div>
				</div>
                </div>
            </div>
			</div><!-- #post-## -->
	
			<?php comments_template( '', true ); ?>
		
		<?php endif; ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
<?php
	//if (  $wp_query->max_num_pages > 1 ){
	//	pagination( $wp_query->max_num_pages );
	//}
?>