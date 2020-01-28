<?php

get_header();

/**
 * La boucle (The Loop) WordPress nous permet d'accéder aux contenus associés à l'URL
 *
 * @link
 * @link https://developer.wordpress.org/themes/basics/template-tags/#using-template-tags-within-the-loop
 */
// WordPress vérifie qu'il y a des contenus à afficher
if ( have_posts() ) :
    // WordPress exécutera le traitement suivant tant qu'il y aura des contenus à afficher
    while ( have_posts() ) :
        /**
         * Permet de récupérer les contenus de l'article suivant (si on oublie d'exécuter cette fonction dans la boucle WordPress, nous avons une boucle infinie). Les contenus seront accessibles grâce aux Template Tags
         * Initialise toutes les variables nécessaires au bon fonctionnement des Template Tags
         *
         * @link https://developer.wordpress.org/themes/basics/template-tags/
         * @link https://developer.wordpress.org/themes/references/list-of-template-tags/
         */
        the_post();
        ?>
        <main class="right">
            <h1 class="right__title"><?php the_title(); // Affiche le titre de l'article ?></h1>
            <article class="post post--solo">
                <?php the_post_thumbnail( 'medium' ); ?>
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
                <?php the_content(); // Affiche le contenu ?>
                <?php the_category(); // Affiche les catégories du contenu ?>
                <?php the_tags(); // Affiche les étiquettes du contenu ?>

                <a class="post__link" href="<?php echo home_url(); ?>">Back to home</a>
            </article>
        </main>
        <?php
    endwhile;
endif;

get_footer();
