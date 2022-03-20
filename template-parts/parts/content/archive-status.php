<?php if(have_posts()): ?>

<main>

	<header class="hero hero--image text-white py-4" style="background-image: url('<?php echo get_template_directory_uri(); ?>/src/img/hero.jpg');">
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
					$fv = get_sub_field('faktura_vat');
				}

				$thumbnail = get_field('gallery')[0];

				?>

				<li class="col-12">
					<div class="shadow row flex-row g-0 bg-white">
						<a href="<?php the_permalink() ?>" class="col-12 col-md-5">
							<figure class="d-block mb-0 archive__image-wrapper">
								<img src="<?php echo $thumbnail['sizes']['size_thumbnail']; ?>" alt="<?php echo $thumbnail['alt']; ?>" width="<?php echo $thumbnail['width']; ?>" height="<?php echo $thumbnail['height']; ?>" loading="lazy" class="archive__image">
							</figure>
						</a>
						<article class="col-12 col-md-7 p-2">
							<header>
								<a href="<?php the_permalink(); ?>">
									<h3>
										<?php the_title(); ?>
									</h3>
								</a>
							</header>
							<?php if(have_rows('parameters')): ?>
						<div class="row">
							<div class="col-12">
								<ul class="list-unstyled custom-content custom-content--col-2">

									<?php while(have_rows('parameters')): the_row(); ?>

									<li class="d-flex flex-row py-05 custom-content__avoid-break">
										<span class="w-50">
											<?php echo get_sub_field('parametr'); ?>:</span>
										<span class="w-50">
											<?php echo get_sub_field('wartosc'); ?>
										</span>
									</li>

									<?php endwhile; ?>
									
								</ul>
							</div>
						</div>
						<?php endif; ?>
							<footer class="d-flex flex-row flex-wrap gap-05 justify-content-center justify-content-md-start">
								<span class="btn btn-blue-secondary text-white pe-none">
									<?php echo $brutto; ?>
								</span>
								<a href="<?php the_permalink(); ?>" class="btn btn-outline-blue-primary">
									Szczegóły
								</a>
							</footer>
						</article>
					</div>
				</li>

				<?php endwhile; ?>

			</ul>
		</div>
	</section>

</main>

<?php endif; ?>