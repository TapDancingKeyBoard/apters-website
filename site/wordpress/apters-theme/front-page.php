<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$email   = apters_setting( 'contact_email' );
$phone   = apters_setting( 'contact_phone' );
$hours   = apters_setting( 'contact_hours' );
$address = apters_setting( 'address' );
$bank    = apters_setting( 'bank_details' );
$fb      = apters_setting( 'facebook_url' );
$ig      = apters_setting( 'instagram_url' );
$map     = apters_setting( 'map_url' );

$team = new WP_Query( array( 'post_type' => 'apters_team', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ) ) );
$sponsors = new WP_Query( array( 'post_type' => 'apters_sponsor', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'title' => 'ASC' ) ) );
$events = apters_upcoming_events( 3 );
?>

<section class="hero">
  <div class="container hero-grid">
    <div class="hero-content">
      <p class="eyebrow">Lusaka, Zambia · Est. 1990</p>
      <h1><?php echo esc_html( apters_setting( 'hero_heading', 'Mobility for every child, made from recycled paper.' ) ); ?></h1>
      <p class="lead"><?php echo esc_html( apters_setting( 'hero_text' ) ); ?></p>
      <div class="hero-actions">
        <a href="#support" class="btn">Sponsor a device</a>
        <a href="#contact" class="btn btn-outline">Get in touch</a>
      </div>
    </div>
    <figure class="hero-photo">
      <img src="<?php echo esc_url( apters_hero_image_url() ); ?>" alt="A child seated in an APTERS device" loading="eager">
    </figure>
  </div>
</section>

<section class="stats" aria-label="Key facts">
  <div class="container stats-grid">
    <div><strong>1990</strong><span>Founded in Lusaka</span></div>
    <div><strong>4,000</strong><span>Items made each year</span></div>
    <div><strong>90%</strong><span>Of parents cannot afford a device</span></div>
    <div><strong>Weekly</strong><span>Measuring clinic, Wednesdays</span></div>
  </div>
</section>

<section id="about" class="section">
  <div class="container split">
    <div>
      <p class="eyebrow">About us</p>
      <h2>Appropriate Paper Technology</h2>
      <p>APTERS (Appropriate Paper Technology) is a Lusaka-based non-profit organization established in 1990. We create low-cost, custom-made mobility and assistive devices out of recycled paper and cardboard.</p>
      <p>Our core mission is to provide affordable mobility aids for children with neurological or physical disabilities, such as cerebral palsy, spina bifida or birth injuries, while offering paid employment and economic empowerment to adults with disabilities and mothers of disabled children.</p>
      <h3>Where we are</h3>
      <p>Our workshop is at the University Teaching Hospital (UTH) in Lusaka, with an additional craft presence around the Pa Mpofu craft market in Bauleni.</p>
      <h3>What we use</h3>
      <p>Recycled paper, cardboard, flour and glue. The result is lightweight, biodegradable equipment.</p>
    </div>
    <figure>
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/making.jpg' ); ?>" alt="A device being covered with layers of white paper in the APTERS workshop" loading="lazy">
    </figure>
  </div>
</section>

<section id="what-we-do" class="section alt">
  <div class="container">
    <p class="eyebrow">What we do</p>
    <h2>From measurement to hand-over</h2>
    <div class="steps">
      <article class="step"><span class="step-num">1</span><h3>Measuring</h3><p>Every child is measured for their chair, standing frame or walking frame at our clinic, held each Wednesday. We allow for growth by adding to measurements and fitting removable footrests.</p></article>
      <article class="step"><span class="step-num">2</span><h3>Cutting</h3><p>Measurements are transferred to strong cardboard board. A template is cut and glued together to form the basic shape, then dried, usually outside in the sun.</p></article>
      <article class="step"><span class="step-num">3</span><h3>Pasting</h3><p>Three layers of recycled white paper, followed by a final layer of brown paper, add strength and leave a smooth surface for painting.</p></article>
      <article class="step"><span class="step-num">4</span><h3>Painting</h3><p>Equipment is painted in APTERS standard blue. Special colours and decoration are possible on request.</p></article>
      <article class="step"><span class="step-num">5</span><h3>Straps and hand-over</h3><p>Children are strapped in for the best position and safety. Parents are taught how to position the child and fasten the straps, then practise under supervision.</p></article>
    </div>
    <figure class="wide">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clinic.jpg' ); ?>" alt="A child being fitted for an APTERS device at the clinic" loading="lazy">
      <figcaption>Clinic day: every device is fitted to the individual child.</figcaption>
    </figure>
  </div>
</section>

<section id="products" class="section">
  <div class="container">
    <p class="eyebrow">Products &amp; services</p>
    <h2>What we make</h2>
    <div class="cards">
      <article class="card"><h3>Mobility aids</h3><p>Special chairs, standing frames and walking frames. Chairs and standing frames are the most in demand.</p><a href="#support" class="text-link">Sponsor one →</a></article>
      <article class="card"><h3>Therapy support</h3><p>Wedges and rollers for therapy exercises.</p><a href="#support" class="text-link">Sponsor one →</a></article>
      <article class="card"><h3>Crafts &amp; fundraising</h3><p>Handmade items such as laptop covers and crafts. Every purchase helps subsidise units for families in need.</p><a href="#crafts" class="text-link">See the crafts →</a></article>
    </div>
  </div>
</section>

<section id="crafts" class="section alt">
  <div class="container split reverse">
    <figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/crafts.jpg' ); ?>" alt="Handmade paper crafts made by APTERS" loading="lazy"></figure>
    <div>
      <p class="eyebrow">Crafts &amp; shop</p>
      <h2>Shop handmade, support a child</h2>
      <p>Our paper crafts are made by the same team that builds the mobility devices. Proceeds help subsidise equipment for families who cannot pay.</p>
      <a href="#contact" class="btn">Ask about crafts</a>
    </div>
  </div>
</section>

<?php if ( $events->have_posts() ) : ?>
<section id="events" class="section">
  <div class="container">
    <p class="eyebrow">Coming up</p>
    <h2>Upcoming events</h2>
    <div class="cards">
      <?php while ( $events->have_posts() ) : $events->the_post(); ?>
        <article class="card">
          <p class="event-meta"><?php echo esc_html( apters_event_meta_line( get_the_ID() ) ); ?></p>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <?php the_excerpt(); ?>
        </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <p class="note"><a href="<?php echo esc_url( get_post_type_archive_link( 'apters_event' ) ); ?>" class="text-link">All events →</a></p>
  </div>
</section>
<?php endif; ?>

<?php if ( $team->have_posts() ) : ?>
<section id="team" class="section alt">
  <div class="container">
    <p class="eyebrow">Our team</p>
    <h2>The people behind APTERS</h2>
    <div class="people">
      <?php while ( $team->have_posts() ) : $team->the_post(); ?>
        <article class="person">
          <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'apters-card', array( 'style' => 'border-radius:10px;margin-bottom:1rem' ) ); endif; ?>
          <h3><?php the_title(); ?></h3>
          <?php $role = get_post_meta( get_the_ID(), '_apters_role', true ); if ( $role ) : ?><p class="role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
          <div><?php the_content(); ?></div>
        </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section id="support" class="section support">
  <div class="container">
    <p class="eyebrow">Support us</p>
    <h2>Sponsor a device for a child</h2>
    <p class="intro">90% of parents cannot afford the device their child needs. Your sponsorship pays for one. Each donor receives a certificate with the child's name.</p>
    <?php if ( $sponsors->have_posts() ) : ?>
    <div class="cards prices">
      <?php while ( $sponsors->have_posts() ) : $sponsors->the_post(); $price = get_post_meta( get_the_ID(), '_apters_price', true ); ?>
        <article class="card price">
          <h3><?php the_title(); ?></h3>
          <?php if ( $price ) : ?><p class="amount">KW <?php echo esc_html( $price ); ?></p><?php endif; ?>
          <div><?php the_content(); ?></div>
        </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php endif; ?>
    <div class="support-ways">
      <div><h3>Donate materials</h3><p>Paper, cardboard and other useful items.</p></div>
      <div><h3>Volunteer</h3><p>Bring your skills to the workshop or the clinic.</p></div>
      <div><h3>Fundraise</h3><p>Organise an event in support of APTERS.</p></div>
      <div><h3>Give a donation</h3><p><?php echo $bank ? nl2br( esc_html( $bank ) ) : 'Contact us for bank details.'; ?></p></div>
    </div>
  </div>
</section>

<section id="awards" class="section">
  <div class="container split">
    <div>
      <p class="eyebrow">Recognition</p>
      <h2>Awards</h2>
      <p>APTERS has received many awards from various institutions for its work.</p>
    </div>
    <figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/awards.jpg' ); ?>" alt="APTERS receiving an award" loading="lazy"></figure>
  </div>
</section>

<section class="section partners">
  <div class="container">
    <p class="eyebrow">Partners &amp; friends</p>
    <ul class="partner-list">
      <li>G. Fox</li><li>Mimosa</li><li>JICA</li><li>Japanese Embassy</li><li>SES</li><li>Nomads Zambia</li><li>Caledonian Society</li><li>Zambian Society Trust</li>
    </ul>
  </div>
</section>

<section id="contact" class="section alt">
  <div class="container contact-grid">
    <div>
      <p class="eyebrow">Contact &amp; connect</p>
      <h2>Get in touch</h2>
      <p>Looking for a device for a child, want to donate materials, or want to volunteer or collaborate? Let us know and we will share the right next steps.</p>
      <ul class="contact-list">
        <?php if ( $email ) : ?><li><strong>Email:</strong> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li><?php endif; ?>
        <?php if ( $phone ) : ?><li><strong>Phone:</strong> <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li><?php endif; ?>
        <?php if ( $hours ) : ?><li><strong>Hours:</strong> <?php echo esc_html( $hours ); ?></li><?php endif; ?>
        <?php if ( $address ) : ?><li><strong>Location:</strong> <?php echo esc_html( $address ); ?></li><?php endif; ?>
      </ul>
      <?php if ( $map ) : ?>
      <a class="map-link" href="<?php echo esc_url( $map ); ?>" target="_blank" rel="noopener">
        <span class="map-pin" aria-hidden="true">📍</span>
        <span><strong>Find us on Google Maps</strong><br><?php echo esc_html( $address ); ?></span>
      </a>
      <?php endif; ?>
      <div class="social">
        <?php if ( $fb ) : ?><a href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener">Facebook</a><?php endif; ?>
        <?php if ( $ig ) : ?><a href="<?php echo esc_url( $ig ); ?>" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
      </div>
    </div>
    <div>
      <?php
      // Contact form uses the Contact Form 7 plugin if installed; otherwise shows the email address.
      if ( shortcode_exists( 'contact-form-7' ) ) {
          echo do_shortcode( '[contact-form-7 title="Contact"]' );
      } elseif ( $email ) {
          echo '<p>Write to us at <a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>.</p>';
      }
      ?>
    </div>
  </div>
</section>

<?php
get_footer();
