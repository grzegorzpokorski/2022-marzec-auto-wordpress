<?php 

require_once 'inc/navwalker.php';

add_filter('show_admin_bar', '__return_false');

function theme_configuration(){

	// rejestracja menu
	register_nav_menus(array(
		'primary_menu' => __('primary menu'),
	));

	// thumbnails support and sizes
	add_theme_support('post-thumbnails');
	add_image_size('size_full', 1920, '', array('center', 'center'));
	add_image_size('size_large', 1200, '', array('center', 'center'));
	add_image_size('size_medium', 922, '', array('center', 'center'));
	add_image_size('size_small', 768, '', array('center', 'center'));
	add_image_size('size_thumbnail', 768, 512, array('center', 'center'), true);
}
add_action('after_setup_theme', 'theme_configuration');

function load_css(){

	// główny plik css
	wp_register_style(
		'main',
		get_template_directory_uri() . '/dist/css/style.css',
		array(),
		false,
		'all'
	);
	wp_enqueue_style('main');

}
add_action('wp_enqueue_scripts', 'load_css');

function load_scripts(){

	wp_register_script(
		'main',
		get_template_directory_uri() . '/dist/js/bundle.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('main');

}
add_action('wp_enqueue_scripts', 'load_scripts');

function allowed_block_types($block_editor_context, $editor_context){
	
	if($editor_context->post->post_type === 'post'){
		return array(
			'core/paragraph',
			'core/image',
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/quote',
		);
	}
	
	if($editor_context->post->post_type === 'page'){
		return array(
			'acf/hero',
			'acf/section-with-accordion',
			'acf/banner',
			'acf/section-with-features',
			'acf/section-with-cards',
			'acf/section-with-timeline',
			'acf/section-with-list',
			'acf/section-with-recent-projects',
			'acf/section-with-elastic-content',
			'acf/section-with-flexible-content',
		);
	}

	return $block_editor_context;
}

add_filter('allowed_block_types_all', 'allowed_block_types', 10, 2);

// acf blocks registration
function acf_blocks_registration(){
	if(function_exists('acf_register_block_type')){

		// hero
		acf_register_block_type(array(
			'name'              => 'hero',
			'title'             => __('hero'),
			'description'       => __('hero'),
			'render_callback'   => 'acf_block_render_callback',
			'category'          => 'Sections',
			'icon'              => 'block-default',
			'align_content'     => false,
			'keywords'          => array( 'hero block' ),
			'enqueue_assets'    => 'block_assets',
			'mode'              => 'edit',
			'supports'          => array(
				'align'     => false,
			),
		));

	}
}
add_action('acf/init', 'acf_blocks_registration');

function acf_map_configuration() {
	// acf_update_setting('google_api_key', 'KEY');
	// acf_update_setting('google_api_key', 'KEY');
}
add_action('acf/init', 'acf_map_configuration');

// load assets to block
function block_assets(){
	// if(is_admin()){
	// 	wp_enqueue_style('block', get_template_directory_uri() . '/dist/css/style.css');
	// }
}

// load render file for block
function acf_block_render_callback($block){
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/blocks" folder
	if( file_exists( get_theme_file_path("template-parts/blocks/block-{$slug}.php") ) ) {
		include( get_theme_file_path("template-parts/blocks/block-{$slug}.php") );
	}
}

function add_block_editor_assets(){
	wp_enqueue_style('block_editor_css', get_template_directory_uri() . '/dist/css/style.css');
}
add_action('enqueue_block_editor_assets','add_block_editor_assets');

function get_image($id){
	$meta =  wp_get_attachment_metadata($id);

	// return $meta;

	$data['alt'] = get_post_meta($id, '_wp_attachment_image_alt', true);
	$data['width'] = $meta['width'];
	$data['height'] = $meta['height'];

	$image_sizes = array_keys($meta['sizes']);

	foreach($image_sizes as $value){
		// $data['url'][$value] = get_the_post_thumbnail_url(null, $value);
		$data['url'][$value] = wp_get_attachment_image_src($id, $value)[0];
	}

	return $data;
}

function my_toolbars($toolbars){
	// Uncomment to view format of $toolbars
	// echo '<pre>';
	// 	print_r($toolbars);
	// echo '</pre>';
	// die;
	

	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['default-content' ] = array();
	$toolbars['default-content' ][1] = array('formatselect', 'bold', 'italic', 'bullist', 'numlist', 'blockquote', 'alignleft', 'aligncenter', 'alignright', 'link', 'fullscreen');

	// echo '<pre>';
	// 	print_r($toolbars);
	// echo '</pre>';
	// die;

	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'my_toolbars');

// remove add media in wysiwyg field with default-content tolbar
function change_post_content_type($field){ 
    if($field['type'] == 'wysiwyg') {
        $field['tabs'] = 'visual';
        $field['toolbar'] = 'default-content';
        $field['media_upload'] = 0;
    }
    return $field;
}
add_filter('acf/get_valid_field', 'change_post_content_type');

function add_opions_pages(){

	if(function_exists('acf_add_options_page')){
		
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
add_action('acf/init', 'add_opions_pages');

?>