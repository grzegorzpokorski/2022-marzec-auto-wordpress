<?php 

$content = get_field('content');
$display_buttons = get_field('display_buttons');
$image_id = get_field('image');

$background_image_id = get_field('background_image');
$background_image = wp_get_attachment_image_src($background_image_id, 'size_full')[0];

?>

<section class="mt-md-7 banner banner--image text-center text-md-start" style="background-image: url('<?php echo $background_image; ?>');" id="<?php echo $block['id']; ?>">
	<div class="container">
		<div class="row position-relative">
			
			<?php if($image_id): ?>
			<div class="d-none d-md-block col-12 col-md-4 z-index-2 banner__image-wrapper">
				<?php echo wp_get_attachment_image($image_id, 'size_medium', false, array("class" => "banner__image")); ?>
			</div>
			<?php endif; ?>

			<header class="col-12 col-md-8 ms-auto py-4 z-index-2">
				
				<?php if($content): ?>
				<h2 class="text-white">
					<?php echo $content; ?>
				</h2>
				<?php endif; ?>

				<?php if($display_buttons): ?>
				<div class="d-flex flex-row flex-wrap gap-05 justify-content-center justify-content-md-start">

					<?php while(have_rows('buttons')): the_row(); ?>
					<?php $text_color = (get_sub_field('color') ? 'text-' . get_sub_field('color') : ''); ?>
					<a href="<?php echo get_sub_field('link'); ?>" class="btn btn-<?php echo get_sub_field('background') . ' ' . $text_color; ?>">
						<?php echo get_sub_field('title'); ?>
					</a>
					<?php endwhile; ?>

				</div>
				<?php endif; ?>

			</header>
		</div>
	</div>
</section>