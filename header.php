<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="font-sans text-black">
    <div class="max-w-xl md:max-w-4xl mx-auto">
        <header class="mt-8 md:mt-12 mb-8 sm:mb-12 md:mb-16 px-4 md:px-8 leading-tight">
            <div class="md:flex items-end">
                <figure class="w-12 inline-block mb-1 md:mb-0 md:mr-3">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="Freek.dev">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/murzicoon.svg" class="w-full"
                             alt="Freek.dev logotype">
                    </a>
                </figure>
                <div>
                    <h1 class="text-lg uppercase tracking-wider font-extrabold">
                        <?php if (is_front_page() && is_home()) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        <?php endif; ?>
                    </h1>
                    <p class="text-sm font-bold text-gray-600">
                        <?php header_menu(); ?>
                    </p>
                </div>
            </div>
            <nav class="md:hidden relative">
                <input class="hidden" type="checkbox" id="mobile-menu-toggle">
                <label for="mobile-menu-toggle"
                       class="absolute bg-gray-700 border-b-3 border-gray-900 text-white uppercase tracking-wider font-semibold p-2 pb-1"
                       style="top: -6rem; right: 0">
                    Menü
                </label>
                <?php sidebar_mobile_menu(); ?>
            </nav>
        </header>
        <div class="md:flex pb-12">
            <div class="hidden md:block w-1/4 lg:w-1/5 text-right leading-loose">
                <?php sidebar_menu(); ?>
                <div class="mb-8">
                    <div class="markup">
                        <p class="text-lg font-bold">Popüler içerikler</p>
                        <?php
                        $popular = new WP_Query(array('posts_per_page' => 10, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'));
                        while ($popular->have_posts()) : $popular->the_post(); ?>
                            <div class="mb-2 text-sm">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <!--
                                        <img alt="<?php the_title(); ?>" class="mx-auto"
                                             src="<?php echo the_post_thumbnail_url('thumbnail'); ?>">
                                             -->
                                    </div>
                                    <div>
                                        <a class="font-semibold"
                                           href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                        wp_tag_cloud(array(
                            'number' => 10,
                            'orderby' => 'count'
                        ));
                        ?>
                    </div>
                </div>
            </div>