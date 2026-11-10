<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post(); ?>
<section class="section">
  <div class="container narrow">
    <p class="eyebrow"><?php echo esc_html( apters_event_meta_line( get_the_ID() ) ); ?></p>
    <h1><?php the_title(); ?></h1>
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="wide"><?php the_post_thumbnail( 'large' ); ?></figure>
    <?php endif; ?>
    <div class="page-content"><?php the_content(); ?></div>
    <p><a href="<?php echo esc_url( get_post_type_archive_link( 'apters_event' ) ); ?>" class="text-link">← All events</a></p>
  </div>
</section>
<?php endwhile;
get_footer();
