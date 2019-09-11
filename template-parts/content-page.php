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

        <?php if (get_the_post_thumbnail_url('thumbnail')) : ?>
            <img alt="<?php single_post_title(); ?>" src="<?php echo the_post_thumbnail_url('thumbnail'); ?>"/>
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
    </div>
</article>