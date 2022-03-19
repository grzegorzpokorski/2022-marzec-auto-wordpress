<?php $item_desktop_class = 'col-lg-' . (12 / get_field('how_many_items_in_row_on_desktop')); ?>

<?php if(have_rows('items')): ?>

<section class="text-center text-md-start hero-features" id="<?php echo $block['id']; ?>">
	<div class="container">
		<ul class="row d-flex flex-column flex-lg-row justify-content-center list-unstyled">

			<?php while(have_rows('items')): the_row(); ?>

			<li class="col-12 <?php echo $item_desktop_class; ?> p-2 <?php echo 'bg-'.get_sub_field('background_color'); ?> d-flex flex-column flex-lg-row gap-lg-1 align-items-center z-index-2">
				
				<?php if(get_sub_field('number')): ?>
				<span class="h1 mb-0 text-white">
					<?php echo get_sub_field('number'); ?>
				</span>
				<?php endif; ?>

				<?php if(get_sub_field('number')): ?>
				<h3 class="text-white fw-normal">
					<?php echo get_sub_field('content'); ?>
				</h3>
				<?php endif; ?>

			</li>

			<?php endwhile; ?>
			
		</ul>
	</div>
</section>

<?php endif; ?>