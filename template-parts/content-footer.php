<div class="mt-2">
    <div class="markup">
        <p class="text-xl font-semibold">İlginizi çekebilir</p>
        <?php
        global $post;
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
            $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 10,
                'caller_get_posts' => 1
            );
            $my_query = new wp_query($args);
            if ($my_query->have_posts()) {
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <div class="mb-6 text-sm">
                        <div class="flex items-center">
                            <div class="mr-2">
                                <img alt="<?php the_title(); ?>" class="h-8 w-8 rounded-full mx-auto"
                                     src="<?php echo the_post_thumbnail_url('thumbnail'); ?>">
                            </div>
                            <div>
                                <a class="font-semibold" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
            }
            wp_reset_query();
        }
        ?>
    </div>
</div>
<div class="md:hidden relative mb-8">
    <div class="markup">
        <h3>Popüler içerikler</h3>
        <?php
        $popular = new wp_query(array(
            'posts_per_page' => 10,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        while ($popular->have_posts()) : $popular->the_post(); ?>
            <div class="mb-6 text-sm">
                <div class="flex items-center">
                    <div class="mr-2">
                        <!--
                        <img alt="<?php the_title(); ?>" class="h-8 w-8 rounded-full mx-auto"
                             src="<?php echo the_post_thumbnail_url('thumbnail'); ?>">-->
                    </div>
                    <div>
                        <a class="font-semibold" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    </div>
                </div>
            </div>
        <?php endwhile;
        wp_reset_postdata();
        ?>
    </div>
</div>