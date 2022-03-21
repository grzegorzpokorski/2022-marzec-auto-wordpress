<?php 

$args = array(
  'posts_per_page' => 3,
  'post_type' => 'samochody',
  'orderby' => 'rand',
  'tax_query' => array(
    array(
      'taxonomy' => 'status',
      'terms' => 21,
    ),
  ),
);              

$the_query = new WP_Query($args);
if($the_query->have_posts()): ?>

  <section class="py-4 pb-2 border-top">
    <div class="container">
      <div class="row justify-content-center">
        <header class="col-md-8 order-1">
          <h2 class="text-blue-primary">
            Zobacz polecane modele
          </h2>
        </header>
        <div class="col order-2 order-md-3">
          <ul class="row justify-content-center list-unstyled mb-md-0 mt-2 archive">

          <?php while($the_query->have_posts()): $the_query->the_post(); ?>

            <?php

            while(have_rows('price_box', get_the_ID())){
              the_row();
              $brutto = get_sub_field('brutto', get_the_ID());
              $fv = get_sub_field('faktura_vat', get_the_ID());
            }

            $thumbnail = get_field('gallery', get_the_ID())[0];

            ?>

            <li class="col-12 col-md-6 col-lg-4">
              <article class="d-flex flex-column justify-content-between bg-white shadow h-100">
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
                <ul class="px-1 pb-1 archive__list">
                  <li class="archive__list-item">2013</li>
                  <li class="archive__list-item">430 KM</li>
                  <li class="archive__list-item">156 000 km</li>
                  <li class="archive__list-item">benzyna</li>
                </ul>
                <footer class="px-1 pb-1 archive__footer">
                  <div class="d-flex flex-column">
                    <span class="archive__price"><?php echo $brutto; ?></span>
                    <span class="archive__price-type">brutto</span>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="btn btn-blue-secondary text-white">
                    Szczegóły
                  </a>
                </footer>
              </article>
            </li>

          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
          
          </ul>
        </div>
        <div class="col-md-4 order-3 order-md-2 bg-primary text-center text-md-end">
          <a href="#" class="btn btn-blue-secondary text-white mt-2 mt-md-0">
            Zobacz całą ofertę
          </a>
        </div>
      </div>
    </div>
  </section>

<?php else: endif; ?>