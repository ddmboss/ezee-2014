<?php

// Set up the content width value based on the theme's design
if ( ! isset( $content_width ) ) {
	$content_width = 636;
}

if ( ! function_exists( 'ezeeradio_setup' ) ) :
function ezeeradio_setup() {
	
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 820, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1260, 700, true );
	
	// Removes the secondary navigation in the left sidebar
	unregister_nav_menu( 'secondary' );

}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'ezeeradio_setup', 11 );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function ezeeradio_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'ezeeradio_content_width', 12 );

// Unregister the left TwentyFourteen sidebar
function remove_left_sidebar(){
	unregister_sidebar( 'sidebar-1' );
}
add_action( 'widgets_init', 'remove_left_sidebar', 13 );

// Adds "Read more link" for custom & automatic excerpts
function ezeeradio_read_more_link($output) {
    global $post;
    return $output . "<p><a class='more-link' href='". get_permalink() ."'>Continue reading <span class='meta-nav'>&rarr;</span></a></p>";
}
 
add_filter('the_excerpt', 'ezeeradio_read_more_link');

// Removes the "[]" in automatic excerpts
function ezeeradio_excerpt_more( $more ) {
    return '…';
}
add_filter('excerpt_more', 'ezeeradio_excerpt_more');

?>