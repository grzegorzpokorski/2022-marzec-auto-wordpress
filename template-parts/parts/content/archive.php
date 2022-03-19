<?php if(have_posts()): ?>

<main>

	<header class="hero hero--image text-white py-4" style="background-image: url('./dist/img/hero-1900w.webp');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 mx-auto text-center z-index-2">
					<h1 class="h2 text-white mb-0">
						<?php wp_title(''); ?>
					</h1>
				</div>
			</div>
		</div>
	</header>

	<section>

		<ul>

			<?php while(have_posts()): the_post(); ?>

			<li>

				<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>">
					<figure>
						<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'size_thumbnail', "", array("class" => "")); ?>
					</figure>
				</a>
				<?php endif; ?>

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
				<a href="<?php the_permalink(); ?>">
					<h3>
						<?php echo get_the_title(); ?>
					</h3>
				</a>
				<p>
					<?php echo wp_trim_words(get_the_excerpt(), 30, ' [...]'); ?>
				</p>
			</li>

			<?php endwhile; ?>
			
		</ul>

		<nav>
			<?php if(get_next_posts_link()): ?>
			<a href="<?php echo get_next_posts_page_link(); ?>">
				Starsze
			</a>
			<?php endif; if(get_previous_posts_link()): ?>
			<a href="<?php echo get_previous_posts_page_link(); ?>">
				Nowsze
			</a>
			<?php endif; ?>
		</nav>

	</section>

</main>

<?php endif; ?>