<?php
/**
 * Fichier de configuration du thème
 *
 * /https://developer.wordpress.org/themes/basics/including-css-javascript/
 */

function onews_theme_setup() {
    /**
     * Je délègue à WordPress la création de la balise <title>
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/
     */
    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );
}

/**
 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
add_action( 'after_setup_theme', 'onews_theme_setup' );


function onews_register_nav_menus() {
    /**
     * Je crée des emplacements de menu dans mon thème
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     * @link https://developer.wordpress.org/reference/functions/register_nav_menu/
     */
    register_nav_menus([
        'main-menu'   => 'Menu principal',
        'footer-menu' => 'Menu du pied de page',
    ]);
}

add_action( 'init', 'onews_register_nav_menus' );

/**
 * Permet d'ajouter une feuille de style CSS
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link https://developer.wordpress.org/reference/functions/get_stylesheet_uri/
 * @link https://developer.wordpress.org/reference/functions/get_theme_file_uri/
 */

function onews_enqueue_scripts() {
    wp_enqueue_style(
        'onews-reset-style', // Nom interne à WordPress de ma feuille de style
        get_theme_file_uri( 'reset.css' ) // URL vers un fichier de mon thème
    );

    wp_enqueue_style(
        'onews-style',
        get_stylesheet_uri()
    );

    wp_add_inline_style(
        'onews-style',
        '
            .left {
                background-image: url(' . get_theme_file_uri( 'images/student.jpg' ) . ');
            }

            .left__title {
                background-image: url(' . get_theme_file_uri( 'images/onews.svg' ) . ');
            }
        '
    );
}

/**
 * WordPress exécute des hooks tout au long de son exécution. Ils nous permettent d'ajouter nos propres traitements à WordPress. Par exemple, ici, nous ajouter des feuilles de style à notre front-office.
 *
 * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 * @link https://developer.wordpress.org/reference/functions/add_action/
 * @link https://www.php.net/manual/fr/language.types.callable.php
 */
add_action( 'wp_enqueue_scripts', 'onews_enqueue_scripts' );

/**
 * Je supprime un traitement de WordPress sans toucher à son code source grâce au système de hooks
 *
 * @link https://developer.wordpress.org/reference/functions/remove_action/
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Un hook de type filter modifie une donnée qu'il faut renvoyer à la fin de la fonction avec un return
 *
 * @param array $classes List item HTML element class list
 *
 * @return array Updated list item HTML element class list
 */
function onews_nav_menu_li_class($classes) {
    // J'ajoute la classe ciblée par mon CSS à la liste des classes du <li>
    $classes[] = 'left__nav-item';

    return $classes;
}

/**
 * Permet d'ajouter une classe CSS dans l'attribut HTML class
 *
 * @link https://developer.wordpress.org/reference/hooks/nav_menu_css_class/
 */
add_filter( 'nav_menu_css_class', 'onews_nav_menu_li_class' );


/**
 * On ajoute la classe utilisée par notre intégration aux éléments HTML <a> des menus générés par WordPress
 *
 * @param array $attributes <a> HTML attributes list
 *
 * @return array Updated <a> HTML attributes list
 */
function onews_nav_menu_a_attributes($attributes) {
    // Si l'attribut class n'existe pas, je le crée
    if ( empty( $attributes['class'] ) ) {
        $attributes['class'] = '';
    }

    // J'ajoute ma classe à mon attribut class
    $attributes['class'] .= ' left__nav-link';

    /**
     * Supprime les caractères invisibles à gauche
     *
     * @link http://php.net/ltrim
     */
    $attributes['class'] = ltrim( $attributes['class'] );

    return $attributes;
}

/**
 * @link https://developer.wordpress.org/reference/hooks/nav_menu_link_attributes/
 */
add_filter( 'nav_menu_link_attributes', 'onews_nav_menu_a_attributes' );
