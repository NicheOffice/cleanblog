<?php
get_header();
$search_term = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['s']);
if (have_posts()) :
    ?>
    <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
        <h1 class="max-w-lg text-2xl md:text-3xl leading-tight mb-1"><span
                    class="font-extrabold"><?php echo $search_term; ?></span> için sonuçlar</h1>
        <form method="get" action="<?php echo home_url('/'); ?>" class="flex flex-col md:flex-row items-stretch mb-3">
            <input type="text" name="s" required="required" value="<?php echo $search_term; ?>"
                   placeholder="Arama terimi girin"
                   class="flex-1 px-3 py-2 bg-gray-100 focus:outline-none focus:border-gray-400 border-y-3 border-t-transparent mb-2 md:mb-0">
            <button type="submit"
                    class="px-3 py-2 text-sm text-white bg-orange-500 font-semibold border-y-3 border-orange-700 border-t-transparent">
                Ara
            </button>
        </form>
        <?php
        while (have_posts()) : the_post();
            setPostViews(get_the_ID());
            get_template_part('template-parts/content', 'search');
        endwhile; ?>
    </main>
<?php
else :
    get_template_part('template-parts/content', 'none');
endif;
get_footer();
?>