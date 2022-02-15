	<footer class="bg-gray text-white py-2">
		<div class="container">
			<div class="row">
				<div class="col-md-9 me-auto text-center text-md-start">
					<p class="mb-0">
						<?php 

							if(get_field('green_part', 'navbar_settings') || get_field('gray_part', 'navbar_settings')){
								$title = get_field('green_part', 'navbar_settings') . ' ' . get_field('gray_part', 'navbar_settings');
							}else{
								$title = bloginfo('name');
							}

							$content = get_field('content', 'footer_settings');

						?>

						&copy; 2022 <?php echo $title; ?>. <?php echo ($content) ? $content : ''; ?>

					</p>
				</div>

				<?php if(get_field('display_social_media', 'footer_settings') && (get_field('social_media', 'general_setting'))): ?>
				<ul class="col-md-auto m-0 mt-1 mt-md-0 d-flex flex-row gap-1 list-unstyled justify-content-center">

					<?php while(have_rows('social_media', 'general_setting')): the_row(); ?>
					<li>
						<a href="<?php echo get_sub_field('link'); ?>" class="text-white">
							<span class="sr-only">
								<?php echo get_sub_field('title'); ?>
							</span>
							<span class="fab fa-<?php echo get_sub_field('icon'); ?>" aria-hidden="true"></span>
						</a>
					</li>
					<?php endwhile; ?>

				</ul>
				<?php endif; ?>

			</div>
		</div>
	</footer>
	
	<?php wp_footer(); ?>

</body>
</html>