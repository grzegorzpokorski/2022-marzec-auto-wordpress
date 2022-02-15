<nav class="navbar navbar-expand-lg navbar-light bg-white-dark text-primary py-1 py-md-2">
	<div class="container">
		<a href="<?php echo home_url(); ?>" class="navbar-brand mb-0 h1">
			<?php 

				// if(get_field('display_logo_as_image', 'theme_general_setting')){
				// 	echo "<img src='" . get_field('image_logo', 'theme_general_setting') . "' class='d-block' alt='" . get_bloginfo('name') . "'>";
				// }else{
				// 	echo bloginfo('name');
				// }

			?>
			<?php if(get_field('green_part', 'navbar_settings') || get_field('gray_part', 'navbar_settings')): ?>
				
				<?php if(get_field('green_part', 'navbar_settings')): ?>
				<span class="text-green">
					<?php echo get_field('green_part', 'navbar_settings'); ?>
				</span>
				<?php endif; ?>

				<?php echo get_field('gray_part', 'navbar_settings'); ?>
				
			<?php else: echo bloginfo('name');?>
			<?php endif; ?>

		</a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<?php
			wp_nav_menu(array(
				'menu'            => 'primary_menu',
				'theme_location'  => 'primary_menu',
				'container'       => false,
				'menu_id'         => false,
				'menu_class'      => 'navbar-nav ms-auto',
				'depth'           => 2,
				'walker'          => new navwalker()
			));
			?>
		</div>
	</div>
</nav>