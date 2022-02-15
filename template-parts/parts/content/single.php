<?php if(have_posts()): ?>

	<main>

	<?php while(have_posts()): the_post(); ?>

		<article>
			<header>
				<h1>
					<?php the_title(); ?>		
				</h1>
				<p>
					<?php echo get_the_excerpt(); ?>
				</p>
				<div>
					<time date="<?php echo get_the_date('Y-m-d'); ?>">
						<?php echo get_the_date(); ?>
					</time>
					<?php $categories = get_the_category(); if($categories): ?>
					<?php foreach($categories as $category): ?>
					<a href="<?php echo esc_url(get_tag_link($category->term_id)); ?>">
						<?php echo esc_html($category->name); ?>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</header>

			<?php if(has_post_thumbnail()): ?>
			<figure>
				<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'size_large', "", array("class" => "")); ?>
			</figure>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php $tags = get_the_tags(); if($tags): ?>
			<ul>
			<?php foreach($tags as $tag): ?>

				<li>
					<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
						<?php echo esc_html($tag->name); ?>
					</a>
				</li>

			<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			
		</article>

	<?php endwhile; ?>

	</main>

<?php else : ?>

<!-- brak tresci -->

<?php endif; ?>