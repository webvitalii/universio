<?php

define('UNIVERSIO_THEME_VERSION', '1.0');


include( 'inc/universio-functions.php' );

include( 'inc/universio-settings.php' );


if ( ! isset( $content_width ) ) {
	$content_width = 1200;
}


if ( ! function_exists( 'universio_enqueue_scripts' ) ) :
	function universio_enqueue_scripts() {
		
		$settings = universio_get_settings();
		if( $settings['use_cdn'] == 1 OR $settings['use_cdn'] == '1' ) {
			$ionicon_path = '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css';
		} else {
			$ionicon_path = get_template_directory_uri() . '/assets/ionicons/css/ionicons.css';
		}
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'universio-script', get_template_directory_uri() . '/assets/js/universio.js', array( 'jquery' ), UNIVERSIO_THEME_VERSION );
		
		wp_enqueue_style( 'universio-ionicons-style', $ionicon_path, array(), UNIVERSIO_THEME_VERSION, 'all' );
		
		wp_enqueue_style( 'universio-flexify-style', get_template_directory_uri() . '/assets/flexify/css/flexify.css', array(), UNIVERSIO_THEME_VERSION, 'all' );
		
		wp_enqueue_style( 'universio-style', get_stylesheet_uri(), array(), UNIVERSIO_THEME_VERSION, 'all' ); // get_stylesheet_directory_uri() . '/style.css'
	}
	add_action( 'wp_enqueue_scripts', 'universio_enqueue_scripts' );
endif;


if ( ! function_exists( 'universio_admin_enqueue_scripts' ) ) :
	function universio_admin_enqueue_scripts() {
		// including the WP media scripts here because they are needed for the image upload field
		wp_enqueue_media();
	}
	add_action( 'admin_enqueue_scripts', 'universio_admin_enqueue_scripts' );
endif;


if ( ! function_exists( 'universio_setup' ) ) :
	function universio_setup() {

		add_filter( 'widget_text', 'do_shortcode' ); // execute shortcodes in sidebar widgets

		load_theme_textdomain( 'universio', get_template_directory() . '/languages' ); // make theme available for translation

		add_editor_style(); // visual editor style match the theme style (add editor-style.css)

		add_theme_support( 'automatic-feed-links' ); // add RSS feed links to <head> for posts and comments

		add_theme_support( 'title-tag' ); // let WordPress manage the document title

		//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat', ) ); // post formats for future

		register_nav_menu( 'primary-nav', __( 'Primary menu', 'universio' ) );

		add_theme_support( 'custom-background' );

		add_theme_support( 'post-thumbnails' ); // featured images
		set_post_thumbnail_size( 1200, 9999 ); // unlimited height, soft crop

		add_theme_support( 'woocommerce' );
		
		$custom_header_args = array(
			'default-image'          => get_template_directory_uri() . '/assets/img/header/office.jpg',
			'random-default'         => true, // random image rotation
			'header-text'            => false, // disable editing styles for text in header

			// set height and width, with a maximum value for the width
			'width'                  => 1200,
			'height'                 => 250,
			'max-width'              => 2000,

			// support flexible height and width
			'flex-height'            => true,
			'flex-width'             => true

		);

		add_theme_support( 'custom-header', $custom_header_args ); // custom header See http://codex.wordpress.org/Custom_Headers

		register_default_headers( array( // default custom headers packaged with the theme (%s is a placeholder for the theme template directory URI)
			'office' => array(
				'url' => '%s/assets/img/header/office.jpg',
				'thumbnail_url' => '%s/assets/img/header/office-thumbnail.jpg',
				'description' => __( 'Office', 'universio' )
			)
		) );


		/* ========== thumbnail size options ========== */
		//add_image_size( 'thumb-400', 400, 999, false );
		//add_image_size( 'thumb-200', 200, 999, false );
		//add_image_size( 'thumb-100', 100, 999, false );
		/*
		to add more sizes, simply copy a line from above and change the dimensions & name.
		As long as you upload a "featured image" as large as the biggest
		set width or height, all the other sizes will be auto-cropped.
		<?php the_post_thumbnail( 'thumb-200' ); ?> - shows the 200x200 sized image
		*/

	}
	add_action( 'after_setup_theme', 'universio_setup' );
endif;


// register sidebars & footer widgets
if ( ! function_exists( 'universio_register_widgets' ) ) :
	function universio_register_widgets() {
		register_sidebar( array(
			'name' => __( 'Right Sidebar', 'universio' ),
			'id' => 'sidebar_right',
			//'description' => 'Right Sidebar.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'Left Sidebar', 'universio' ),
			'id' => 'sidebar_left',
			//'description' => 'Left Sidebar.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'Header Widgetized Area', 'universio' ),
			'id' => 'header_widgets',
			//'description' => '',
			'before_widget' => '<aside id="%1$s" class="fx-column widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'Footer Widgetized Area', 'universio' ),
			'id' => 'footer_widgets',
			//'description' => '',
			'before_widget' => '<aside id="%1$s" class="fx-column widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'Before Content Widgetized Area', 'universio' ),
			'id' => 'before_content_widgets',
			'description' => 'Shown before the content of pages and posts',
			'before_widget' => '<aside id="%1$s" class="fx-column widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'After Content Widgetized Area', 'universio' ),
			'id' => 'after_content_widgets',
			'description' => 'Shown after the content of pages and posts',
			'before_widget' => '<aside id="%1$s" class="fx-column widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'Before List Widgetized Area', 'universio' ),
			'id' => 'before_list_widgets',
			'description' => 'Shown before the list of posts in archive pages',
			'before_widget' => '<aside id="%1$s" class="fx-column widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
		register_sidebar( array(
			'name' => __( 'After List Widgetized Area', 'universio' ),
			'id' => 'after_list_widgets',
			'description' => 'Shown after the list of posts in archive pages',
			'before_widget' => '<aside id="%1$s" class="fx-column widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'universio_register_widgets' );
endif;


if ( ! function_exists( 'universio_list_pages' ) ) :
	function universio_list_pages() {
		?>
		<nav class="fx-menu fx-menu-dark">
			<ul><?php wp_list_pages( 'title_li=' ); ?></ul>
		</nav>
		<?php
	}
endif;


if ( ! function_exists( 'universio_comments' ) ) :
	function universio_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li <?php comment_class('fx-clearfix'); ?> id="comment-<?php comment_ID(); ?>">
					<p>
						<?php
							if( $comment->comment_type == 'pingback' ) {
								_e( 'Pingback:', 'universio' );
							} else {
								_e( 'Trackback:', 'universio' );
							}
						?>
						<?php comment_author_link(); ?>
						<?php edit_comment_link( '<span class="fx-btn"><i class="ionicon ion-edit"></i> '.__( 'Edit', 'universio' ).'</span>', '<span class="edit-link '.$comment->comment_type.'-edit-link">', '</span>' ); ?>
					</p>
					<?php
				break;
			default :
				?>
				<li <?php comment_class('fx-clearfix'); ?> id="comment-<?php comment_ID(); ?>">
					<article>
						<header class="comment-header">
							<div class="comment-author vcard fx-clearfix">
								<?php
								$avatar_size = 50;
								if ( $comment->comment_parent != '0' ){
									$avatar_size = 30; // small image for reply
								}
								$comment_author_url = esc_url( get_comment_author_url() );
								if ( ! empty( $comment_author_url ) ){ // create a link on avatar
									$comment_avatar_url_before = '<a href="'.$comment_author_url.'" title="'.get_comment_author( $comment->comment_ID ).'">';
									$comment_avatar_url_after = '</a>';
								} else {
									$comment_avatar_url_before = '<span title="'.get_comment_author( $comment->comment_ID ).'">';
									$comment_avatar_url_after = '</span>';
								}

								global $post;
								if( $comment->user_id === $post->post_author ) {
									$post_author_label = ' <span class="fx-label fx-label-info">'.__( 'Post author', 'universio' ).'</span>';
								} else {
									$post_author_label = '';
								}
								echo '<div class="comment-avatar">'.$comment_avatar_url_before.get_avatar( $comment, $avatar_size ).$comment_avatar_url_after.'</div>';

								echo '<div class="comment-meta">';
								echo '<span class="comment-meta-item comment-meta-item-author fn"><i class="ionicon ion-ios-person fx-icon fx-icon-20" title="'.esc_attr( __( 'Author', 'universio' ) ).'"></i> '.get_comment_author_link().$post_author_label.'</span> ';
								echo '<span class="comment-meta-item comment-meta-item-date"><i class="ionicon ion-ios-calendar-outline fx-icon fx-icon-20" title="'.esc_attr( __( 'Published', 'universio' ) ).'"></i> <a href="'.esc_url( get_comment_link( $comment->comment_ID ) ).'"><time datetime="'.get_comment_time( 'c' ).'" title="'.get_comment_time().'">'.get_comment_date().'</time></a></span>';

								edit_comment_link( '<span class="fx-btn"><i class="ionicon ion-edit"></i> '.__( 'Edit', 'universio' ).'</span>', '<span class="edit-link comment-edit-link">', '</span>' );

								echo '</div><!-- .comment-meta -->';
								?>
							</div><!-- .comment-author .vcard -->

							<?php if ( $comment->comment_approved == '0' ) : ?>
								<div class="alert alert-warning"><?php _e( 'Your comment is awaiting moderation.', 'universio' ); ?></div>
							<?php endif; ?>

						</header><!-- .comment-meta -->

						<div class="comment-content"><?php comment_text(); ?></div>

						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<span class="fx-btn"><i class="ionicon ion-ios-chatbubble fx-icon fx-icon-20"></i> '.__( 'Reply', 'universio' ).'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</article>

				<?php
				break;
		endswitch;
	}
endif;


if ( ! function_exists( 'universio_post_date' ) ) :
	function universio_post_date() {
		$post_date = '<span class="entry-meta-item entry-meta-date"><i class="ionicon ion-ios-calendar-outline fx-icon fx-icon-20" title="'.esc_attr( __( 'Published', 'universio' ) ).'"></i> '.'<a href="'.esc_url( get_permalink() ).'" title="'.get_the_time().'"><time class="entry-date" datetime="'.get_the_date( 'c' ).'" title="'.get_the_time().'">'.get_the_date().'</time></a></span>'."\n";
		return $post_date;
	}
endif;


if ( ! function_exists( 'universio_post_sticky' ) ) :
	function universio_post_sticky() {
		$post_sticky = '';

		if( is_sticky() ) { // add 'sticky' label to sticky post
			$sticky = ' <i class="ionicon ion-pin fx-icon fx-icon-20"></i><span class="fx-label fx-label-info">'.__( 'Sticky', 'universio' ).'</span>';
			$post_sticky = '<span class="entry-meta-item entry-meta-sticky">'.$sticky.'</span>'."\n";
		}

		return $post_sticky;
	}
endif;


if ( ! function_exists( 'universio_post_author' ) ) :
	function universio_post_author() { // author
		global $authordata;
		if ( !is_object( $authordata ) )
			return false;
		$post_author = '<span class="entry-meta-item entry-meta-author"><i class="ionicon ion-ios-person fx-icon fx-icon-20" title="'.esc_attr( __( 'Author', 'universio' ) ).'"></i> <a href="'.esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ).'" title="'.esc_attr(  __( 'Author', 'universio' ) ).'">'.get_the_author().'</a></span>'."\n";
		return $post_author;
	}
endif;


if ( ! function_exists( 'universio_comments_count' ) ) :
	function universio_comments_count() {
		$post_comments_count = '';
		if ( get_comments_number() != '0' ) {
			$post_comments_count = '<span class="entry-meta-item entry-meta-comments-count"><i class="ionicon ion-ios-chatbubble fx-icon fx-icon-20" title="'.esc_attr( __( 'Comments', 'universio' ) ).'"></i> <a href="'.esc_url( get_permalink() ).'#comments" title="'.__( 'Comments', 'universio' ).'">'.get_comments_number().'</a></span>'."\n";
		}
		return $post_comments_count;
	}
endif;


if ( ! function_exists( 'universio_post_categories' ) ) :
	function universio_post_categories() { // list of categories
		$post_categories = get_the_category_list( __( ', ', 'universio' ) );
		if ( !empty( $post_categories ) ) {
			return '<span class="entry-meta-item entry-meta-categories"><i class="ionicon ion-ios-folder fx-icon fx-icon-20" title="'.esc_attr( __( 'Categories', 'universio' ) ).'"></i> '.$post_categories.'</span>'."\n";
		} else {
			return ''; // no categories
		}
	}
endif;


if ( ! function_exists( 'universio_post_tags' ) ) :
	function universio_post_tags() { // list of tags
		$post_tags = get_the_tag_list( '', __( ', ', 'universio' ), '' );
		if( !empty( $post_tags ) ){
			return '<span class="entry-meta-item entry-meta-tags"><i class="ionicon ion-ios-pricetag fx-icon fx-icon-20" title="'.esc_attr( __( 'Tags', 'universio' ) ).'"></i> '.$post_tags.'</span>'."\n";
		}else{
			return ''; // no tags
		}
	}
endif;


if ( ! function_exists( 'universio_post_meta' ) ) :
	function universio_post_meta() { // post meta
		$post_meta = '<div class="entry-meta-row">'."\n" . universio_post_sticky() . universio_post_author() . universio_post_date() . universio_comments_count() . universio_post_categories() . '</div>'."\n";
		$post_tags = universio_post_tags();
		if( !empty( $post_tags ) && is_single() ){
			$post_meta .= '<div class="entry-meta-row">'."\n" . $post_tags . '</div>'."\n";
		}

		return "\n".'<div class="entry-meta">'."\n".$post_meta.'</div><!-- .entry-meta -->'."\n";
	}
endif;


if ( ! function_exists( 'universio_nav' ) ) :
	function universio_nav() { // show next/prev posts navigation links when needed
		global $wp_query;
		$nav = '';
		$nav_prev = '';
		$nav_next = '';
		if ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive and search pages
			if ( get_previous_posts_link() ) :
				$nav_prev = '<div class="nav-previous">'.get_previous_posts_link().'</div>';
			endif;
			if ( get_next_posts_link() ) :
				$nav_next = '<div class="nav-next">'.get_next_posts_link().'</div>';
			endif;
		endif;
		if ( get_previous_posts_link() || get_next_posts_link() ) { // do not show empty markup
			$nav = "\n".'<nav class="site-nav-posts nav-links fx-grid"><div class="fx-col-sm-6">'.$nav_prev.'</div><div class="fx-col-sm-6">'.$nav_next.'</div></nav><!-- .site-nav-posts -->'."\n";
		}
		return $nav;
	}
endif;


if ( ! function_exists( 'universio_nav_comments' ) ) :
	function universio_nav_comments() { // show next/prev comments navigation links when needed
		$nav = '';
		$nav_prev = '';
		$nav_next = '';
		if ( get_comment_pages_count() > 1 ) {
			$prev_link = get_previous_comments_link( __( 'Older comments' ) );
			$next_link = get_next_comments_link( __( 'Newer comments' ) );

			if ( $prev_link ) {
				$nav_prev = '<div class="nav-previous">' . $prev_link . '</div>';
			}

			if ( $next_link ) {
				$nav_next = '<div class="nav-next">' . $next_link . '</div>';
			}

			$nav = "\n".'<nav class="site-nav-comments nav-links fx-grid"><div class="fx-col-sm-6">'.$nav_prev.'</div><div class="fx-col-sm-6">'.$nav_next.'</div></nav><!-- .site-nav-comments -->'."\n";
		}

		return $nav;
	}
endif;


if ( ! function_exists( 'universio_excerpt_more' ) ) :
	function universio_excerpt_more( $more ) { // "more-link" is bad for seo and for usability - http://web-profile.net/web/web-principles/more-link/
		return '...';
	}
	add_filter('excerpt_more', 'universio_excerpt_more');
endif;


if ( ! function_exists( 'universio_is_homepage' ) ) :
	function universio_is_homepage() {
		global $paged;
		// if( is_home() || is_front_page() ){} // simple way
		$show_on_front = get_option( 'show_on_front' ); // page or posts
		$page_on_front = get_option( 'page_on_front' ); // 0 or page_id
		$page_for_posts = get_option( 'page_for_posts' ); // 0 or page_id
		if ( ( $show_on_front == 'page' ) || ( $page_on_front != 0 ) ){
			if( is_front_page() ){
				return true;
			}
		} elseif ( ( $show_on_front == 'posts' ) || ( $page_for_posts == 0 ) ) {
			if( is_home() && $paged < 2 ) { // show link to homepage from paged pages
				return true;
			}
		} else {
			return false;
		}
	}
endif;


if ( ! function_exists( 'universio_rss_button' ) ) :
	function universio_rss_button() { // output content to the footer section
		$output = '';
		if ( is_category() ) {
			$output = '<a href="'.get_category_feed_link( get_query_var( 'cat' ) ).'" class="rss-feed-link" title="'.esc_attr( __( 'Category RSS feed', 'universio' ) ).'"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>';
		} elseif ( is_tag() ) {
			$output = '<a href="'.get_tag_feed_link( get_query_var( 'tag_id' ) ).'" class="rss-feed-link" title="'.esc_attr( __( 'Tag RSS feed', 'universio' ) ).'"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>';
		} elseif ( is_author() ) {
			$output = '<a href="'.get_author_feed_link( get_the_author_meta( 'ID' ) ).'" class="rss-feed-link" title="'.esc_attr( __( 'Author RSS feed', 'universio' ) ).'"><i class="ionicon ion-social-rss fx-icon fx-icon-20"></i></a>';
		}
		return $output;
	}
endif;


if ( ! function_exists( 'universio_wp_head' ) ) :
	function universio_wp_head() { // output content to the head section

		$settings = universio_get_settings();
		$code_head = $settings['code_head'];
		$max_width = $settings['max_width'];
		
		if ( ! empty( $max_width ) ) {
			echo "\n".'<!-- Universio settings -->'."\n";
			echo '<style type="text/css">'."\n";
			echo '.site-container {'."\n";
			echo '	max-width: '.$max_width.'px;'."\n";
			echo '}'."\n";
			echo '</style>'."\n";
			echo "\n".'<!-- end of Universio settings -->'."\n";
		}
		
		if ( ! empty( $code_head ) ) {
			echo "\n".'<!-- Universio head code -->'."\n";
			echo $code_head;
			echo "\n".'<!-- end of Universio head code -->'."\n";
		}
		
	}
	add_action( 'wp_head', 'universio_wp_head' );
endif;


if ( ! function_exists( 'universio_wp_footer' ) ) :
	function universio_wp_footer() { // output content to the footer section

		$settings = universio_get_settings();
		$code_footer = $settings['code_footer'];
		
		$ga_code = $settings['ga_code'];
		$ga_code_hide_if_loggedin = $settings['ga_code_hide_if_loggedin'];
		
		if ( ! empty( $code_footer ) ) {
			echo "\n".'<!-- Universio footer code -->'."\n";
			echo $code_footer;
			echo "\n".'<!-- end of Universio footer code -->'."\n";
		}
		
		
		if ( ! empty( $ga_code ) ) {
			if( !is_user_logged_in() || ( is_user_logged_in() && !$ga_code_hide_if_loggedin ) ) {
				echo "\n".'<!-- Universio Google Analytics code -->'."\n";
				?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $ga_code; ?>', 'auto');
  ga('send', 'pageview');
</script>
				<?php
				echo "\n".'<!-- end of Universio Google Analytics code -->'."\n";
			}
		}

	}
	add_action( 'wp_footer', 'universio_wp_footer' );
endif;