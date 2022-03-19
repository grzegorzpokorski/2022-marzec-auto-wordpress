	<footer class="py-2 bg-gray text-white">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="">
						<?php $footer_content = get_field('content', 'footer_settings'); ?>
						<?php echo bloginfo('name'); ?> &copy; 2022. <?php echo ($footer_content) ? $footer_content : ''; ?>
					</p>
				</div>
			</div>
		</div>
	</footer>
	
	<?php wp_footer(); ?>

</body>
</html>