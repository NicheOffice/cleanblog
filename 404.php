<?php get_header(); ?>
    <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
        <h1 class="max-w-lg text-2xl md:text-3xl font-extrabold leading-tight mb-1">Aradığınız sayfa bulunamadı.</h1>
        <form method="get" action="<?php echo home_url('/'); ?>" class="flex flex-col md:flex-row items-stretch mb-3">
            <input type="text" name="s" required="required" placeholder="Arama terimi girin"
                   class="flex-1 px-3 py-2 bg-gray-100 focus:outline-none focus:border-gray-400 border-y-3 border-t-transparent mb-2 md:mb-0">
            <button type="submit"
                    class="px-3 py-2 text-sm text-white bg-orange-500 font-semibold border-y-3 border-orange-700 border-t-transparent">
                Ara
            </button>
        </form>
        <a href="<?php echo home_url('/'); ?>"
           class="px-3 py-2 text-sm text-white bg-orange-500 font-semibold border-y-3 border-orange-700 border-t-transparent">Ana
            sayfaya dön</a>
    </main>
<?php get_footer(); ?>