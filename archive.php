<?php get_header(); ?>

<main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            the_archive_title('<h4 class="page-title">', '</h4>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
            ?>
        </header><!-- .page-header -->

        <?php /* Start the Loop */ ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php

            /*
             * Include the Post-Format-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            get_template_part('template-parts/content', get_post_format());
            ?>

        <?php endwhile; ?>

        <?php posts_navigation(); ?>

    <?php else : ?>

        <?php get_template_part('template-parts/content', 'none'); ?>

    <?php endif; ?>


</main>

<?php get_footer(); ?>
