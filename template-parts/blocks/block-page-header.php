<?php 

$title = get_field('title');
$description = get_field('description');
$image_id = get_field('image');
$title_heading_level = get_field('title_heading_level');

$background_image_id = get_field('background_image');
$background_image = wp_get_attachment_image_src($background_image_id, 'size_full')[0];

?>

<header class="hero hero--image text-white py-4" style="background-image: url('<?php echo $background_image; ?>');" id="<?php echo $block['id']; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto text-center z-index-2">

				<?php if($title): ?>
				<<?php echo $title_heading_level; ?> class="h1 text-white">
					<?php echo $title; ?>
				</<?php echo $title_heading_level; ?>>
				<?php endif; ?>

				<?php if($description): ?>
				<?php echo $description ?>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
</header>