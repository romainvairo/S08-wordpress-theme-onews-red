<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php
    /**
     * Permet à WordPress d'exécuter tous ses traitements de la balise <head> comme ajouter les balises <link rel="stylesheet">
     *
     * @link https://codex.wordpress.org/Function_Reference/wp_head
     * @link https://developer.wordpress.org/reference/functions/wp_head/
     */

    wp_head();
    ?>
</head>
<body <?php body_class(); ?>>
    <div class="wrapper">
      <!-- emmet: header>h1+p+nav>ul>li*3>a -->
      <header class="left">
        <?php if ( is_home() ) : ?>
            <h1 class="left__title">O'Clock Students News</h1>
        <?php else :  ?>
            <a href="<?php echo home_url(); ?>" class="left__title">O'Clock Students News</a>
        <?php endif; ?>
        <div class="left__paragraph">
          <h2 class="left__subtitle"><strong class="left__subtitle-strong">Latest news</strong> from our students</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque scelerisque suscipit nibh quis porttitor. Integer iaculis mi urna, a pulvinar quam adipiscing ut. Vivamus vel vestibulum mauris.
          </p>
        </div>
        <?php
        /**
         * Affiche le contenu d'un menu (défini dans le backoffice) associé à l'emplacement main-menu
         *
         * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/
         */
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'container'      => 'nav',
            'menu_class'     => 'left__nav',
        ] ); ?>
        <!--<nav>
          <ul class="left__nav">
            <li class="left__nav-item"><a href="" class="left__nav-link">Plan du site</a></li>
            <li class="left__nav-item"><a href="" class="left__nav-link">Mentions légales</a></li>
            <li class="left__nav-item"><a href="" class="left__nav-link">Contact</a></li>
          </ul>
        </nav>-->
      </header>
