<?php 
// echo '<pre>';
// print_r($wp_query->query_vars);

?>

<?php if(have_posts()): ?>

<main>

	<header class="hero hero--image text-white py-4" style="background-image: url('<?php echo get_template_directory_uri(); ?>/dist/img/hero-1900w.webp');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 mx-auto text-center z-index-2">
					<h1 class="h2 text-white mb-0">
						<?php echo get_the_archive_title(''); ?>
					</h1>
					<?php the_archive_description('<div class="mt-1">', '</div>'); ?>
				</div>
			</div>
		</div>
	</header>

	<section class="py-4">
		<div class="container">
			<ul class="row justify-content-center list-unstyled archive">

				<?php
				
				while(have_posts()): the_post();
				
				while(have_rows('price_box')){
					the_row();
					$brutto = get_sub_field('brutto');
					$waluta = get_sub_field('waluta');
					$fv = get_sub_field('faktura_vat');
				}

				$thumbnail = get_field('gallery')[0];

				?>
				
				<li class="col-12 col-md-6 col-lg-4">
					<article class="d-flex flex-column justify-content-between bg-white shadow h-100 position-relative">

						<?php if($fv): ?>
						<span class="archive__fv z-index-2">
							Faktura VAT
						</span>
						<?php endif; ?>

						<a href="<?php the_permalink(); ?>" class="archive__image-wrapper">
							<?php echo wp_get_attachment_image($thumbnail['id'], 'size_thumbnail', false, array("class" => "archive__image")); ?>
						</a>
						<header class="p-1">
							<a href="<?php the_permalink(); ?>">
								<h3 class="mb-0">
									<?php the_title(); ?>
								</h3>
							</a>
						</header>

						<?php if(have_rows('parameters', get_the_ID())) :?>
            <ul class="px-1 pb-1 archive__list">

              <?php while(have_rows('parameters', get_the_ID())): the_row(); ?>
              <li class="archive__list-item">
                <?php echo get_sub_field('wartosc', get_the_ID()); ?>
              </li>
              <?php endwhile; ?>

            </ul>
            <?php endif; ?>
		                
						<footer class="px-1 pb-1 archive__footer">
							<div class="d-flex flex-column">
								<span class="archive__price"><?php echo $brutto . ' ' . $waluta; ?></span>
								<span class="archive__price-type">brutto</span>
							</div>
							<a href="<?php the_permalink(); ?>" class="btn btn-blue-secondary text-white">
								Szczegóły
							</a>
						</footer>
					</article>
				</li>

				<?php endwhile; ?>

			</ul>
		</div>
	</section>

	<?php if(paginate_links()): ?>
	<nav class="pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<?php greg_pagination(); ?>
				</div>
			</div>
		</div>
	</nav>
	<?php endif; ?>

</main>

<?php endif; ?>