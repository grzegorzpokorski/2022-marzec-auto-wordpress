<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php
		if(is_archive()){
			single_term_title();
			echo ' - ';
			bloginfo('name');
		}else{
			wp_title('');
			if(wp_title('', false)){
				echo ' - ';
			}
			bloginfo('name');
		}
		?>
		
	</title>
	
	<?php wp_head(); ?>

</head>
<body>

	<?php get_template_part('template-parts/parts/navbar/navbar'); ?>
