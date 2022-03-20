
<?php 

$parent_cat = 11;
$taxonomy = 'oferta';
$categories = get_term_children($parent_cat, $taxonomy);

foreach($categories as $category){
	$link = get_category_link($category);
	$category_object = get_term($category, $taxonomy);
}

?>

<main>

	<header class="hero hero--image text-white py-4" style="background-image: url('<?php echo get_template_directory(); ?>/dist/img/hero-1900w.webp');">
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

	<section class="py-4">
		<div class="container">
			<ul class="row justify-content-center list-unstyled features">

				<?php foreach($categories as $category): $category_object = get_term($category, $taxonomy);?>

				<li class="col-12 col-md-4">
					<a href="<?php echo get_category_link($category); ?>" class="d-flex align-items-center justify-content-between text-blue-primary fw-bold p-2 shadow features__cat-link">
						<?php echo $category_object->name; ?>
						<span class="bg-blue-primary text-white py-05 px-1">
							<?php echo $category_object->count; ?>
						</span>
					</a>
				</li>

				<?php endforeach; ?>

			</ul>
		</div>
	</section>

</main>