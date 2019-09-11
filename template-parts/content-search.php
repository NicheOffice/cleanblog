<article class="mb-6 md:mb-8" id="post-<?php the_ID(); ?>">
    <div class="mb-5" style="
        height: 6px;
        background-color: #f16563;
        box-shadow: 0 3px 0 #f16563dd, 0 3px 0 #000;
        "></div>
    <header class="mb-6">
        <h2 class="max-w-lg text-2xl md:text-3xl font-extrabold leading-tight mb-1">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <?php the_title(); ?>
            </a>
        </h2>

        <p class="text-sm text-gray-700">
            <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> önce
            -
            <?php
            $categories = get_the_category();
            $cat_name = $categories[0]->cat_name;
            echo create_category_link($cat_name);
            ?>
            -
            <span><?php echo getPostViews(get_the_ID()); ?> görüntüleme</span>
        </p>
    </header>
    <div class="markup leading-relaxed">
        <p><?php echo str_replace('Read More', '', strip_tags(get_the_excerpt())); ?></p>
        <p class="mt-6">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                Devamını oku</a>
        </p>
    </div>
</article>