<?php if(have_posts()): ?>

<main>

<?php while(have_posts()): the_post(); ?>

	<?php $images = get_field('gallery'); if( $images ): ?>
		<section class="gallery py-1">
			<div class="container position-relative">
				<div class="d-flex justify-content-between gallery__controls">
					<button class="gallery__nav-item">
						<span class="fa fa-chevron-left"></span>
					</button>
					<button class="gallery__nav-item">
						<span class="fa fa-chevron-right"></span>
					</button>
				</div>
				<ul class="row g-0 g-md-1 list-unstyled gallery__content">

					<?php foreach( $images as $image ): ?>
					<li class="col-12 col-md-5 mt-0">
						<a href="<?php echo esc_url($image['url']); ?>" class="gallery__thumbnail-wrapper glightbox">
							<img src="<?php echo esc_url($image['sizes']['size_thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="gallery__thumbnail">
						</a>
					</li>
					<?php endforeach; ?>

				</ul>
			</div>
		</section>
	<?php endif; ?>

	<article class="pb-3 bg-white-dark single">
		<div class="container">
			<div class="row d-flex flex-row-reverse">


				<?php 
				while(have_rows('price_box')){
					the_row();
					$netto = get_sub_field('netto');
					$brutto = get_sub_field('brutto');
					$fv = get_sub_field('faktura_vat');
				}
				?>
				<aside class="col-12 col-md-5">
					<div class="single__content shadow bg-blue-secondary text-white position-sticky single__price-box">
						<table class="table text-white">

							<?php if($brutto): ?>
							<tr>
								<td>
									<p>Cena brutto:</p>
								</td>
								<td>
									<p class="fw-bold text-end"><?php echo $brutto; ?></p>
								</td>
							</tr>
							<?php endif; ?>

							<?php if($netto): ?>
							<tr>
								<td>
									<p>Cena netto:</p>
								</td>
								<td>
									<p class="fw-bold text-end"><?php echo $netto; ?></p>
								</td>
							</tr>
							<?php endif; ?>

						</table>
						<div class="d-flex flex-row flex-wrap gap-05 justify-content-center justify-content-md-start">
							<?php if($fv): ?>
							<span class="btn btn-sm btn-white pe-none">
								Faktura VAT
							</span>
							<?php endif; ?>

							<?php if(get_field('telefon', 'navbar_settings')): ?>
							<a href="tel:<?php echo get_field('telefon', 'navbar_settings'); ?>" class="btn btn-sm btn-white">
								<span class="fw-bold">Zadzwoń: </span>
								<?php echo get_field('telefon', 'navbar_settings'); ?>
							</a>
							<?php endif; ?>

						</div>
					</div>
				</aside>

				<div class="col-12 col-md-7 single__column">
					<div class="shadow single__content">
						<h1 class="h3">
							<?php the_title(); ?>
						</h1>
						<div class="row">
							<div class="col-12 col-md-6">
								<table class="table table-borderless mb-0">
									<tr>
										<td>Rok produkcji</td>
										<td>2013</td>
									</tr>
									<tr>
										<td>Moc silnika</td>
										<td>430 KM</td>
									</tr>
									<tr>
										<td>Pojemność</td>
										<td>4.3 L</td>
									</tr>
									<tr>
										<td>Przebieg</td>
										<td>39 000 km</td>
									</tr>
									<tr>
										<td>kolor nadwozia</td>
										<td>czarna perła</td>
									</tr>
								</table>
							</div>
							<div class="col-12 col-md-6">
								<table class="table table-borderless mb-0">
									<tr>
										<td>Typ nadwozia</td>
										<td>limuzyna</td>
									</tr>
									<tr>
										<td>Paliwo</td>
										<td>benzyna</td>
									</tr>
									<tr>
										<td>Liczba miejsc</td>
										<td>5</td>
									</tr>
									<tr>
										<td>Faktura VAT</td>
										<td>tak</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<?php if(get_field('content')): ?>
					<div class="shadow single__content custom-content">
						<?php echo get_field('content'); ?>
					</div>
					<?php endif; ?>

				</div>
				
			</div>
		</div>
	</article>

<?php endwhile; ?>

</main>

<?php else : ?>

<!-- brak tresci -->

<?php endif; ?>