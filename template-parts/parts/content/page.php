<?php if(have_posts()): ?>

<main>

<?php while(have_posts()): the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; ?>

</main>

<?php else : ?>

<!-- brak tresci -->

<?php endif; ?>