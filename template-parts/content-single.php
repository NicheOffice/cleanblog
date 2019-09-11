<article class="mb-8">
    <div class="mb-5" style="
        height: 6px;
        background-color: #f16563;
        box-shadow: 0 3px 0 #f16563dd, 0 3px 0 #000;
        "></div>
    <header class="mb-6">
        <h1 class="max-w-lg text-2xl md:text-3xl font-extrabold leading-tight mb-1">
            <?php single_post_title(); ?>
        </h1>

        <?php if (get_the_post_thumbnail_url()) : ?>
            <img alt="<?php single_post_title(); ?>" src="<?php echo the_post_thumbnail_url('full'); ?>"/>
        <?php endif; ?>

        <p class="text-sm text-gray-700">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <?php the_time('j F Y'); ?>
            </a>
            - <?php echo getPostViews(get_the_ID()); ?> görüntüleme
            – <?php read_time(str_word_count(get_the_content())); ?>
        </p>
    </header>
    <div class="markup leading-relaxed">
        <?php echo the_content(); ?>
        <?php wp_link_pages(); ?>
    </div>

    <div class="mb-4">
        <div class="markup">
            <p class="text-xl font-semibold mt-4">
                Benzer içerikler bul
            </p>
            <?php
            $tags_list = str_replace('rel="tag"', 'rel="tag" class="px-3 py-2 bg-blue-100 border-b-3 border-blue-200 text-xs text-gray-700 font-semibold"', get_the_tag_list(null, ' '));
            if ($tags_list) {
                echo $tags_list;
            }
            ?>
        </div>
    </div>
</article>

<?php get_template_part('comments'); ?>