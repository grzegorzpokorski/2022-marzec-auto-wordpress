<?php 

$display_header = get_field('display_header');

if($display_header){
	while(have_rows('header')){
		the_row();

		$header_title = get_sub_field('title');
		$title_heading_level = get_field('title_heading_level');
	}
}

?>

<section class="py-4" id="<?php echo $block['id']; ?>">
	<div class="container">


		<?php if($display_header): ?>
		<header class="row pb-4">
			<div class="col-md-8 mx-auto text-center">

				<?php if($header_title): ?>
				<<?php echo $title_heading_level; ?> class="mb-0">
					<?php echo $header_title; ?>
				</<?php echo $title_heading_level; ?>>
				<?php endif; ?>

			</div>
		</header>
		<?php endif; ?>


		<?php if(have_rows('items')): ?>
		<ul class="row justify-content-center list-unstyled features">
			
			<?php while(have_rows('items')): the_row(); ?>
			<li class="col-md-6 col-xl-4">
				<article>
					<h3>
						<?php if(get_sub_field('icon')): ?>
						<span class="fa <?php echo get_sub_field('icon'); ?> me-1 text-blue-secondary" aria-hiden="true"></span>
						<?php endif; ?>

						<?php if(get_sub_field('title')): ?>
							<?php echo get_sub_field('title'); ?>
						<?php endif; ?>
					</h3>

					<?php if(get_sub_field('content')): ?>
					<p>
						<?php echo get_sub_field('content'); ?>
					</p>
					<?php endif; ?>

				</article>
			</li>
			<?php endwhile; ?>

		</ul>
		<?php endif; ?>

	</div>
</section>