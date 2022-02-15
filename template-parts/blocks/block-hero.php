<?php 

$title = get_field('title');
$content = get_field('content');
$display_buttons = get_field('display_buttons');
$image = get_field('image');

$padding['top'] = 'pt-' . get_field('padding_top_on_mobile');
$padding['bottom'] = 'pb-' . get_field('padding_bottom_on_mobile');
$padding['top_md'] = 'pt-md-' . get_field('padding_top_on_desktop');
$padding['bottom_md'] = 'pb-md-' . get_field('padding_bottom_on_desktop');
$padding_classes = implode(' ', $padding);

$section_background = 'bg-' . get_field('background');

?>

<section class="<?php echo $section_background . ' ' . $padding_classes; ?>" id="<?php echo $block['id']; ?>">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-md-5 me-auto text-center text-md-start">
				
				<?php if($title): ?>
				<h2 class="mb-1">
					<?php echo $title; ?>
				</h2>
				<?php endif; ?>

				<?php if($content): ?>
				<p class="mb-1">
					<?php echo $content; ?>
				</p>
				<?php endif; ?>

				<?php if($display_buttons): ?>
					<div class="d-flex gap-05 justify-content-center justify-content-md-start">
					<?php while(have_rows('buttons')): the_row(); ?>
						<?php $text_color = (get_sub_field('color') ? 'text-' . get_sub_field('color') : ''); ?>
						<a href="<?php echo get_sub_field('link'); ?>" class="btn btn-<?php echo get_sub_field('background') . ' ' . $text_color; ?> rounded-pill">
							<?php echo get_sub_field('title'); ?>
						</a>
					<?php endwhile; ?>
					</div>
				<?php endif; ?>

			</div>
			<div class="col-12 col-md-7 mt-2 mt-md-auto">
				<?php if($image){
					echo wp_get_attachment_image($image, 'size_full', "", array("class" => "img-fluid"));
				}?>
			</div>
		</div>
	</div>
</section>