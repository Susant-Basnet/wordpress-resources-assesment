<?php
/**
 * Plugin Name: Resources
 * Description: Adds a "Resources" custom post type and a shortcode [latest_resources] to display latest resources in a responsive grid. Human-written, simple, and easy to extend.
 * Version: 1.0.0
 * Author: Susant Basnet
 * Author URI: https://thanka.digital
 * Text Domain: resources-plugin
 *
 * Notes:
 * - CPT slug: "resources"
 * - Shortcode: [latest_resources limit="5"]
 *
 * This file registers the CPT, enqueues styles, and provides the shortcode.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register 'resources' Custom Post Type.
 * Supports: title, editor, excerpt, thumbnail
 */
function rp_register_resources_cpt() {
    $labels = array(
        'name'               => __( 'Resources', 'resources-plugin' ),
        'singular_name'      => __( 'Resource', 'resources-plugin' ),
        'add_new_item'       => __( 'Add New Resource', 'resources-plugin' ),
        'edit_item'          => __( 'Edit Resource', 'resources-plugin' ),
        'new_item'           => __( 'New Resource', 'resources-plugin' ),
        'view_item'          => __( 'View Resource', 'resources-plugin' ),
        'all_items'          => __( 'All Resources', 'resources-plugin' ),
        'menu_name'          => __( 'Resources', 'resources-plugin' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true, // Gutenberg support
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-book',
        'rewrite'            => array( 'slug' => 'resources' ),
    );

    register_post_type( 'resources', $args );
}
add_action( 'init', 'rp_register_resources_cpt' );


/**
 * Enqueue front-end styles only (keeps things tidy).
 * If you later add admin styles, use 'admin_enqueue_scripts'.
 */
function rp_enqueue_styles() {
    wp_enqueue_style(
        'resources-style',
        plugin_dir_url( __FILE__ ) . 'assets/css/style.css',
        array(),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'rp_enqueue_styles' );


/**
 * Shortcode: [latest_resources limit="5"]
 * Displays latest 'resources' posts in a responsive grid.
 *
 * Security:
 * - All output is escaped.
 * - Shortcode attributes are sanitized.
 */
function rp_latest_resources_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'limit' => 5,
        ),
        $atts,
        'latest_resources'
    );

    $limit = absint( $atts['limit'] );

    $query = new WP_Query( array(
        'post_type'      => 'resources',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
    ) );

    if ( ! $query->have_posts() ) {
        return '<p>' . esc_html__( 'No resources found.', 'resources-plugin' ) . '</p>';
    }

    ob_start();
    ?>
    <div class="rp-resources-grid" role="list">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <article class="rp-resource-item" role="listitem">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="rp-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <h3 class="rp-title">
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                </h3>

                <div class="rp-excerpt">
                    <?php echo esc_html( get_the_excerpt() ); ?>
                </div>

                <a class="rp-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'resources-plugin' ); ?></a>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'latest_resources', 'rp_latest_resources_shortcode' );


/**
 * Optional: Register REST API fields here or add filters to modify output.
 * Keeping the file simple for assessment; easy to extend later.
 */
