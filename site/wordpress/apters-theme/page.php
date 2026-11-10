<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post(); ?>
<section class="section">
  <div class="container narrow">
    <p class="eyebrow">APTERS</p>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="wide"><?php the_post_thumbnail( 'large' ); ?></figure>
    <?php endif; ?>
    <div class="page-content"><?php the_content(); ?></div>
  </div>
</section>
<?php endwhile;
get_footer();
