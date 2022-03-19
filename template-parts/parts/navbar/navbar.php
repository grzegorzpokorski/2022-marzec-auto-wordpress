<?php

$logo = 0;

if(have_rows('logo', 'navbar_settings')){

	$logo = 1;

	while(have_rows('logo', 'navbar_settings')){
		the_row();

		$first_part = get_sub_field('first_part');
		$second_part = get_sub_field('second_part');

		$first_color = 'text-' . get_sub_field('first_color');
		$second_color = 'text-' . get_sub_field('second_color');
	}
}

if(get_field('telefon', 'navbar_settings')){
	$telefon = get_field('telefon', 'navbar_settings');
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-white py-1 py-md-2">
	<div class="container">
		<a href="<?php echo home_url(); ?>" class="navbar-brand mb-0 fw-bold">

			<?php echo (is_front_page()) ? '<h1 class="mb-0 navbar__title">' : ''; ?>

			<?php if($logo): ?>
				
				<?php if($first_part): ?>
					<span class="<?php echo $first_color; ?>">
						<?php echo $first_part; ?>
					</span>
				<?php endif; ?>
				
				<?php if($second_part): ?>
					<span class="<?php echo $second_color; ?>">
						<?php echo $second_part; ?>
					</span>
				<?php endif; ?>
				
			<?php else: ?>
				<?php echo bloginfo('name'); ?>
			<?php endif; ?>

			<?php echo (is_front_page()) ? '</h1>' : ''; ?>

		</a>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<?php
			if(has_nav_menu('primary_menu')){
				wp_nav_menu(array(
					'menu'            => 'primary_menu',
					'theme_location'  => 'primary_menu',
					'container'       => false,
					'menu_id'         => false,
					'menu_class'      => 'navbar-nav ms-auto',
					'depth'           => 2,
					'walker'          => new navwalker()
				));
			}
			?>
			<?php if($telefon): ?>
				<a href="tel:<?php echo $telefon; ?>" class="btn btn-outline-blue-primary px-1 ms-auto">
					<?php echo $telefon; ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</nav>