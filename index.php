<?php
/**
 * Charge le template header.php
 *
 * @link https://developer.wordpress.org/reference/functions/get_header/
 */
get_header();
?>
<main class="right">
<!-- emmet: h2+article*6>a+h3+div(img+strong+time)+p+a -->
<?php
/**
 * Les Conditonnal Tags nous permettent d'affiner nos affichage en fonction d'informations (par exemple le type de la page qu'on est en train de traiter)
 *
 * Ici, on affiche le titre de la categorie si nous sommes sur la page d'une page d'une catégorie
 *
 * @link https://developer.wordpress.org/themes/basics/conditional-tags/
 */
if ( is_category() ) :
?>
    <h1 class="right__title"><?php echo single_cat_title(); ?></h1>
<?php else : ?>
    <h2 class="right__title">Latest News</h2>
<?php endif; ?>
    <div class="posts">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>
                <article <?php post_class( 'post' ); ?>>
                    <a href="" class="post__category post__category--color-team">team</a>
                    <h3><?php the_title(); ?></h3>
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                    <div class="post__meta">
                        <?php
                        // Je récupère l'ID de l'auteur de l'article
                        $user_id = get_the_author_meta( 'ID' );
                        // J'affiche l'avatar associé à l'auteur (avateur géré par Gravatar)
                        echo get_avatar(
                            $user_id,
                            16,
                            '',
                            '',
                            [
                                'class' => 'post__author-icon'
                            ]
                        );
                        ?>
                        <strong class="post__author"><?php the_author(); // Affiche l'auteur du contenu ?></strong>
                        <time datetime="<?php the_time( 'Y-m-d' ); ?>">le <?php the_time( get_option( 'date_format' ) ); ?></time>
                    </div>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="post__link">Continue reading</a>
                </article>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</main>
<?php
/**
 * Charge le template footer.php
 *
 * @link https://developer.wordpress.org/reference/functions/get_footer/
 */
get_footer();
?>
