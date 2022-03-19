<?php 

$title = get_field('title');
$description = get_field('description');
$image_id = get_field('image');
$title_heading_level = get_field('title_heading_level');

$background_image_id = get_field('background_image');
$background_image = wp_get_attachment_image_src($background_image_id, 'size_full')[0];

?>

<header class="hero hero--image text-white pt-5 pb-7" style="background-image: url('<?php echo $background_image; ?>');" id="<?php echo $block['id']; ?>">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 text-center text-md-start mb-1 mb-md-0 hero__content">

				<?php if($title): ?>
				<<?php echo $title_heading_level; ?> class="h1 text-white">
					<?php echo $title; ?>
				</<?php echo $title_heading_level; ?>>
				<?php endif; ?>

				<?php if($description): ?>
				<?php echo $description ?>
				<?php endif; ?>

				<?php if(have_rows('buttons')): ?>
				<div class="d-flex flex-row flex-wrap gap-05 justify-content-center justify-content-md-start">

					<?php while(have_rows('buttons')): the_row(); ?>
					<a href="<?php echo get_sub_field('link'); ?>" class="btn btn-<?php echo get_sub_field('background'); ?> <?php echo 'text-'.get_sub_field('color'); ?>">
						<?php echo get_sub_field('text'); ?>
					</a>
					<?php endwhile; ?>

				</div>
				<?php endif; ?>

			</div>

			<?php if($image_id): ?>
			<figure class="col-md-6 mt-2 mt-md-0 hero__content">
				<?php echo wp_get_attachment_image($image_id, 'size_medium', false, array("class" => "img-fluid")); ?>
			</figure>
			<?php endif; ?>

		</div>
	</div>
</header>