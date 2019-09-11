<?php
get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
        setPostViews(get_the_ID());
        ?>
        <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
            <?php
            get_template_part('template-parts/content', 'single');
            get_template_part('template-parts/content', 'footer');
            ?>
        </main>
    <?php
    endwhile;
else :
    get_template_part('template-parts/content', 'none');
endif;
get_footer();