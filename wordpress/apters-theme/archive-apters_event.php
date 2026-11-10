<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<section class="section">
  <div class="container">
    <p class="eyebrow">Events &amp; education</p>
    <h1>Events</h1>
    <?php if ( have_posts() ) : ?>
      <div class="cards">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="card">
            <?php if ( get_the_post_thumbnail_url( null, 'apters-card' ) ) : ?>
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'apters-card' ); ?></a>
            <?php endif; ?>
            <p class="event-meta"><?php echo esc_html( apters_event_meta_line( get_the_ID() ) ); ?></p>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <p>No events are listed yet. Please check back soon.</p>
    <?php endif; ?>
  </div>
</section>
<?php
get_footer();
