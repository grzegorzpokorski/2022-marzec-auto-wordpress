<?php 

// menu wallker
require_once 'inc/navwalker.php';

// disable admin bar on page while is login
add_filter('show_admin_bar', '__return_false');

function greg_theme_configuration(){

	// register menu
	register_nav_menus(array(
		'primary_menu' => __('primary menu'),
	));

	// post thumbnails support and sizes
	add_theme_support('post-thumbnails');
	add_image_size('size_full', 1920, '', array('center', 'center'));
	add_image_size('size_large', 1200, '', array('center', 'center'));
	add_image_size('size_medium', 1048, '', array('center', 'center'));
	add_image_size('size_small', 768, '', array('center', 'center'));
	add_image_size('size_thumbnail', 576, '', array('center', 'center'));
}
add_action('after_setup_theme', 'greg_theme_configuration');

function greg_load_css(){
	
	// glightbox
	wp_register_style(
		'glightbox',
		'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css',
		array(),
		false,
		'all'
	);

	if(is_singular( array('oferty') )){
		wp_enqueue_style('glightbox');
	}

	// główny plik css
	wp_register_style(
		'greg-main',
		get_template_directory_uri() . '/dist/css/style.css',
		array(),
		false,
		'all'
	);
	wp_enqueue_style('greg-main');
}
add_action('wp_enqueue_scripts', 'greg_load_css');

function greg_load_scripts(){

	wp_register_script(
		'glightbox',
		'https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js',
		array(),
		false,
		true
	);
	
	if(is_singular( array('oferty') )){
		wp_enqueue_script('glightbox');
	}

	wp_register_script(
		'greg-main',
		get_template_directory_uri() . '/dist/js/bundle.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('greg-main');
}
add_action('wp_enqueue_scripts', 'greg_load_scripts');

// allowed blocks depending on post type - different for pages and posts
function greg_allowed_block_types($block_editor_context, $editor_context){
	
	if($editor_context->post->post_type === 'post'){
		return array(
			'core/paragraph',
			'core/image',
			'core/heading',
			'core/list',
			'core/quote',
		);
	}
	
	if($editor_context->post->post_type === 'page'){
		return array(
			'acf/hero-main',
			'acf/hero-features',
			'acf/section-with-features',
			'acf/banner',
			'acf/page-header',
			'acf/page-content',
		);
	}

	return $block_editor_context;
}

add_filter('allowed_block_types_all', 'greg_allowed_block_types', 10, 2);

// acf blocks registration
function greg_acf_blocks_registration(){
	if(function_exists('acf_register_block_type')){

		// hero-main
		acf_register_block_type(array(
			'name'              => 'hero-main',
			'title'             => __('hero-main'),
			'description'       => __('hero-main'),
			'render_callback'   => 'greg_acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'hero-main block' ),
			'enqueue_assets'    => 'greg_block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

		// hero-features
		acf_register_block_type(array(
			'name'              => 'hero-features',
			'title'             => __('hero-features'),
			'description'       => __('hero-features'),
			'render_callback'   => 'greg_acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'hero-features block' ),
			'enqueue_assets'    => 'greg_block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

		// section-with-features
		acf_register_block_type(array(
			'name'              => 'section-with-features',
			'title'             => __('section-with-features'),
			'description'       => __('section-with-features'),
			'render_callback'   => 'greg_acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'section-with-features block' ),
			'enqueue_assets'    => 'greg_block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

		// banner
		acf_register_block_type(array(
			'name'              => 'banner',
			'title'             => __('banner'),
			'description'       => __('banner'),
			'render_callback'   => 'greg_acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'banner block' ),
			'enqueue_assets'    => 'greg_block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

		// page-header
		acf_register_block_type(array(
			'name'              => 'page-header',
			'title'             => __('page-header'),
			'description'       => __('page-header'),
			'render_callback'   => 'greg_acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'page-header block' ),
			'enqueue_assets'    => 'greg_block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

		// page-content
		acf_register_block_type(array(
			'name'              => 'page-content',
			'title'             => __('page-content'),
			'description'       => __('page-content'),
			'render_callback'   => 'greg_acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'page-content block' ),
			'enqueue_assets'    => 'greg_block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

	}
}
add_action('acf/init', 'greg_acf_blocks_registration');

// google maps api configuration for acf
function greg_acf_map_configuration() {
	// acf_update_setting('google_api_key', 'KEY');
	// acf_update_setting('google_api_key', 'KEY');
}
add_action('acf/init', 'greg_acf_map_configuration');

// load assets to block
function greg_block_assets(){
	// if(is_admin()){
	// 	wp_enqueue_style('block', get_template_directory_uri() . '/dist/css/style.css');
	// }
}

// load render file for acf block
function greg_acf_block_render_callback($block){
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/blocks" folder
	if( file_exists( get_theme_file_path("template-parts/blocks/block-{$slug}.php") ) ) {
		include( get_theme_file_path("template-parts/blocks/block-{$slug}.php") );
	}
}

// load block assets for admin area
function greg_add_block_editor_assets(){
	wp_enqueue_style('block_editor_css', get_template_directory_uri() . '/dist/css/style.css');
}
add_action('enqueue_block_editor_assets','greg_add_block_editor_assets');

// custom function to recieve image data by id
// function greg_get_image($id){
// 	$meta =  wp_get_attachment_metadata($id);

// 	// return $meta;

// 	$data['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
// 	$data['width'] = $meta['width'];
// 	$data['height'] = $meta['height'];

// 	$image_sizes = array_keys($meta['sizes']);

// 	foreach($image_sizes as $value){
// 		// $data['url'][$value] = get_the_post_thumbnail_url(null, $value);
// 		$data['url'][$value] = wp_get_attachment_image_src($id, $value)[0];
// 	}

// 	return $data;
// }

// custom toolbar for wysiwyg editior in acf
function greg_my_toolbars($toolbars){

	// Uncomment to view format of $toolbars
	
	// echo '<pre>';
	// 	print_r($toolbars);
	// echo '< /pre >';
	// die;
	
	$toolbars['Very Simple'] = array();
	$toolbars['Very Simple'][1] = array('bold' , 'italic' , 'underline', 'link');

	$toolbars['oferta content'] = array();
	$toolbars['oferta content'][1] = array(
		'formatselect',
		'bold',
		'italic',
		'underline',
		'link',
		'bullist',
		'numlist',
		'blockquote',
	);

	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'greg_my_toolbars');

// remove add media in wysiwyg field with default-content tolbar
// function greg_change_post_content_type($field){ 
// 	if($field['type'] == 'wysiwyg') {
// 		$field['tabs'] = 'visual';
// 	}
// 	return $field;
// }
// add_filter('acf/get_valid_field', 'greg_change_post_content_type');

// custom options pages with acf
function greg_add_options_pages(){

	if(function_exists('acf_add_options_page')){
		
		// main options page
		acf_add_options_page(array(
			'page_title' 	=> 'Ustawienia oraz dane witryny',
			'menu_title'	=> 'Ustawienia oraz dane witryny',
			'menu_slug' 	=> 'theme-general-settings',
			'post_id' 		=> 'general_setting',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		// setting page for socal media
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Navbar',
			'menu_title'	=> 'Navbar',
			'parent_slug'	=> 'theme-general-settings',
			'post_id' => 'navbar_settings',
		));

		// setting page for footer
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Footer',
			'menu_title'	=> 'Footer',
			'parent_slug'	=> 'theme-general-settings',
			'post_id' => 'footer_settings',
		));
	}
}
add_action('acf/init', 'greg_add_options_pages');

// functions that display all enqueued scripts and styles
// function get_all_stylesheets() {
//     global $wp_styles;
  
// 	echo '<pre>Style:<br><br>';
//     print_r( $wp_styles->queue );
// 	echo '</pre>';
// }
// add_action( 'wp_print_styles', 'get_all_stylesheets' );

// function get_all_scripts() {
//     global $wp_scripts;
  
// 	echo '<pre>Skrypty:<br><br>';
//     print_r( $wp_scripts->queue );
// 	echo '</pre>';
// }
// add_action( 'wp_print_scripts', 'get_all_scripts' );

// remove assets - delivered by plugins, themes etc
function greg_remove_plugin_assets(){

	// styles
	wp_dequeue_style(array( 
		// 'wp-block-library', 
		// 'wc-block-style',
		// 'global-styles',
		// 'contact-form-7',
	)); 

	// scripts
	// wp_dequeue_script(array());
}
add_action('wp_enqueue_scripts', 'greg_remove_plugin_assets', 999);

function greg_archive_title($title){
	if(is_category()){
		$title = single_cat_title('', false);
	}elseif(is_tag()){
		$title = single_tag_title('', false);
	}elseif(is_search()){
		$title = the_search_query();
	}elseif(is_post_type_archive()){
		$title = post_type_archive_title('', false);
	}elseif(is_tax()){
		$title = single_term_title('', false);
	}
  
	return $title;
}
add_filter('get_the_archive_title', 'greg_archive_title');

add_filter( 'wpcf7_autop_or_not', '__return_false' );

?>