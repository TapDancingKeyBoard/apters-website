<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="container nav-wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="APTERS home">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.jpg' ); ?>" alt="APTERS – Appropriate Paper Technology" class="brand-logo">
    </a>
    <button class="nav-toggle" aria-expanded="false" aria-controls="nav" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
    <nav id="nav" class="nav" aria-label="Main">
      <?php
      if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false ) );
      } else {
          echo '<a href="' . esc_url( home_url( '/#about' ) ) . '">About</a>';
          echo '<a href="' . esc_url( home_url( '/#what-we-do' ) ) . '">What we do</a>';
          echo '<a href="' . esc_url( home_url( '/#products' ) ) . '">Products</a>';
          echo '<a href="' . esc_url( home_url( '/#team' ) ) . '">Team</a>';
          echo '<a href="' . esc_url( get_post_type_archive_link( 'apters_event' ) ) . '">Events</a>';
      }
      ?>
      <a href="<?php echo esc_url( home_url( '/#support' ) ); ?>" class="btn btn-small">Support us</a>
    </nav>
  </div>
</header>
<main id="top">
