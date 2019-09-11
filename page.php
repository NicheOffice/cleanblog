<?php get_header(); ?>
    <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
        <?php while (have_posts()) : the_post(); ?>
            <?php setPostViews(get_the_ID()); ?>
            <?php get_template_part('template-parts/content', 'page'); ?>
        <?php endwhile; ?>
    </main>
<?php get_footer(); ?>