<?php
/*
 * Next & previous page links
 */
function posts_navigation()
{
    // Don't print empty markup if there's only one page.
    if ($GLOBALS['wp_query']->max_num_pages < 2) {
        return;
    }
    ?>
    <ul class="pagination">
        <?php if (get_previous_posts_link()) : ?>
            <li class="page-item">
                <?php
                echo str_replace('<a', '<a class="page-link"', get_previous_posts_link());
                ?>
            </li>
        <?php endif; ?>
        <?php if (get_next_posts_link()) : ?>
            <li class="page-item">
                <?php
                echo str_replace('<a', '<a class="page-link"', get_next_posts_link());
                ?>
            </li>
        <?php endif; ?>
    </ul>
    <?php
}

/*
 * Calculate read time
 */
function read_time($words)
{
    $words = (int)$words;
    $minutes = $words / 100;
    if ($minutes < 1) {
        echo $minutes * 60 . " saniyede okunabilir.";
    } else {
        echo (int)$minutes . " dakikada okunabilir.";
    }
}

/*
 * Remove unwanted codes
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links');
remove_action('wp_head', 'feed_links_extra');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('set_comment_cookies', 'wp_set_comment_cookies');
remove_action('um_post_registration_approved_hook', 'um_post_registration_approved_hook');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
wp_dequeue_style('wp-block-library');
remove_action('wp_enqueue_scripts', 'generate_color_scripts');
remove_action('wp_enqueue_scripts', 'generate_spacing_scripts');
remove_action('wp_enqueue_scripts', 'generate_typography_scripts');
remove_action('wp_enqueue_scripts', 'generate_secondary_color_scripts');
remove_action('wp_enqueue_scripts', 'generate_background_scripts');

/*
 * Defer Javascript
 */
add_filter('clean_url', function ($url) {
    if (FALSE === strpos($url, '.js')) { // not our file
        return $url;
    }
    // Must be a ', not "!
    return "$url' defer='defer";
}, 11, 1);

/*
 * Remove Query Strings
 */
function _remove_script_version($src)
{
    $parts = explode('?ver', $src);
    return $parts[0];
}

add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);

/**
 * Get category link by name
 */
function create_category_link($category_name)
{
    $category_id = get_cat_ID($category_name);
    $category_link = get_category_link($category_id);
    $html_code = '<a class="kategori" href="' . $category_link . '" title="' . $category_name . '">' . $category_name . '</a>';
    return $html_code;
}

/**
 * Affialite Linking
 */
/* function replace_text_wps($text){
  $replace = array(
  // 'WORD TO REPLACE' => 'REPLACE WORD WITH THIS'
  'php' => '<a href="http://ahmethakanbesel.com.tr/konu/php" itemprop="url">PHP</a>',
  'PHP' => '<a href="http://ahmethakanbesel.com.tr/konu/php" itemprop="url">PHP</a>',
  'html' => '<a href="http://ahmethakanbesel.com.tr/konu/html" itemprop="url">HTML</a>'
  );
  $text = str_replace(array_keys($replace), $replace, $text);
  return $text;
}
 
add_filter('the_content', 'replace_text_wps'); */

/**
 * Auto META tags
 */
function create_meta_desc()
{
    global $post;
    if (!is_single()) {
        return;
    }
    $meta = filter_var($post->post_content, FILTER_SANITIZE_STRING);
    $meta = filter_var(strip_shortcodes($post->post_content), FILTER_SANITIZE_STRING);
    $meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
    $meta = substr($meta, 0, 160);
    $meta = strip_tags($meta);
    $baslik = filter_var(strip_tags($post->post_title), FILTER_SANITIZE_STRING);
    $resim = get_the_post_thumbnail_url();
    $link = get_post_permalink();
    $yazar = 'Ahmet Hakan Beşel';
    echo '<meta name="description" content="' . $meta . '"/>';
    echo '<meta property="og:description" content="' . $meta . '"/>';
    echo "<meta name='author' content='$yazar' />";
    echo "<meta name='twitter:card' content='summary_large_image' />";
    echo "<meta property='twitter:title' content='$baslik' />";
    echo '<meta name="twitter:description" content="' . $meta . '"/>';
    echo "<meta name='twitter:image:src' content='$resim' />";
    echo "<meta property='og:url' content='$link' />";
    echo "<meta property='og:type' content='article' />";
    echo "<meta property='og:title' content='$baslik' />";
    echo "<meta property='og:image' content='$resim' />";
    echo "<meta property='og:site_name' content='ahmethakanbesel.com.tr' />";
}

add_action('wp_head', 'create_meta_desc');

/**
 * Remove meta generator tag
 */
remove_action('wp_head', 'wp_generator');

/**
 * Auto JPG Compressing
 */
/*
add_filter( 'jpeg_quality', 'smashing_jpeg_quality' );
function smashing_jpeg_quality() {
return 50;
}
*/

/**
 * Count post views
 */
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count . ' ';
}

function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Remove issues with prefetching adding extra views
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * Clean Blog functions and definitions
 *
 *
 */

if (!function_exists('cleanblog_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function cleanblog_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Clean Blog, use a find and replace
         * to change 'cleanblog' to the name of your theme in all the template files
         */
        //load_theme_textdomain('cleanblog', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'cleanblog'),
            'sidebar' => esc_html__('Sidebar Menu', 'cleanblog'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        //	add_theme_support( 'post-formats', array(
        //		'aside',
        //		'image',
        //		'video',
        //		'quote',
        //		'link',
        //	) );

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('cleanblog_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('small-sqaure-thumbnail');
        set_post_thumbnail_size(50, 50, true);
    }
endif; // cleanblog_setup
add_action('after_setup_theme', 'cleanblog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cleanblog_content_width()
{
    $GLOBALS['content_width'] = apply_filters('cleanblog_content_width', 750);
}

add_action('after_setup_theme', 'cleanblog_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function cleanblog_scripts()
{

    wp_enqueue_style('cleanblog-style', get_stylesheet_uri());
    //wp_enqueue_script('dark-mode', get_template_directory_uri() . '/js/darkmode.js');
    /*
    wp_enqueue_style('cleanblog-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('cleanblog-fontawesome', get_template_directory_uri() . '/css/font.css');
    wp_enqueue_style('cleanblog-lora', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
    wp_enqueue_style('cleanblog-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
    wp_enqueue_script('cleanblog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20150803', true);
    wp_enqueue_script('cleanblog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150803', true);
    wp_enqueue_script('cleanblog-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '20150803', true);
    wp_enqueue_script('cleanblog-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20150803', true);
    */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'cleanblog_scripts');

/**
 * Modify Wordpress Default Menu
 */
function header_menu()
{
    echo strip_tags(wp_nav_menu(array(
        'echo' => false,
        'theme_location' => 'primary',
        'container' => false,
        'link_after' => '<span class="text-gray-300"> / </span>'
    )), '<a><span>');
}

function sidebar_menu()
{
    echo str_replace(array('<ul>', 'current_page_item'), array('<ul class="text-gray-700 mb-6">', 'font-bold text-black exact-active'), wp_nav_menu(array(
            'echo' => false,
            'theme_location' => 'sidebar',
            'menu_class' => 'border-r border-gray-200 px-8 mb-16'
        )
    ));
}

function sidebar_mobile_menu()
{
    echo str_replace(array('<ul>', 'current_page_item'), array('<ul class="text-gray-700 mb-2 md:mb-6">', 'font-bold text-black exact-active'), wp_nav_menu(array(
            'echo' => false,
            'theme_location' => 'sidebar',
            'menu_class' => 'mobile-menu | pt-4 text-right leading-loose'
        )
    ));
}

/**
 * Customizing the excerpt
 */

// Customize the excerpt length
function custom_excerpt_length($length)
{
    return 60;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

// Add a Read More link to the end of the excerpt
function custom_excerpt_more($more)
{
    return ' ... <a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'cleanblog') . '</a>';
}

add_filter('excerpt_more', 'custom_excerpt_more');

// Add a class to the <p> wrap around the excerpt
function add_class_to_excerpt($excerpt)
{
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}

add_filter("the_excerpt", "add_class_to_excerpt");

/**
 * Require Github Updater plugin for theme update checks
 */
//require get_template_directory() . '/inc/install-github-updater.php';

/*
 * Minify HTML
 */

class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;

    // Variables
    protected $html;

    public function __construct($html)
    {
        if (!empty($html)) {
            $this->parseHTML($html);
        }
    }

    public function __toString()
    {
        return $this->html;
    }

    protected function bottomComment($raw, $compressed)
    {
        $raw = strlen($raw);
        $compressed = strlen($compressed);

        $savings = ($raw - $compressed) / $raw * 100;

        $savings = round($savings, 2);

        //return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
        return '<!--#1 Numaralı Wordpress SEO Eklentisi https://goo.gl/0Rr12h-->';
    }

    protected function minifyHTML($html)
    {
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;
        // Variable reused for output
        $html = '';
        foreach ($matches as $token) {
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;

            $content = $token[0];

            if (is_null($tag)) {
                if (!empty($token['script'])) {
                    $strip = $this->compress_js;
                } else if (!empty($token['style'])) {
                    $strip = $this->compress_css;
                } else if ($content == '<!--wp-html-compression no compression-->') {
                    $overriding = !$overriding;

                    // Don't print the comment
                    continue;
                } else if ($this->remove_comments) {
                    if (!$overriding && $raw_tag != 'textarea') {
                        // Remove any HTML comments, except MSIE conditional comments
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            } else {
                if ($tag == 'pre' || $tag == 'textarea') {
                    $raw_tag = $tag;
                } else if ($tag == '/pre' || $tag == '/textarea') {
                    $raw_tag = false;
                } else {
                    if ($raw_tag || $overriding) {
                        $strip = false;
                    } else {
                        $strip = true;

                        // Remove any empty attributes, except:
                        // action, alt, content, src
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);

                        // Remove any space before the end of self-closing XHTML tags
                        // JavaScript excluded
                        $content = str_replace(' />', '/>', $content);
                    }
                }
            }

            if ($strip) {
                $content = $this->removeWhiteSpace($content);
            }

            $html .= $content;
        }

        return $html;
    }

    public function parseHTML($html)
    {
        $this->html = $this->minifyHTML($html);

        if ($this->info_comment) {
            $this->html .= "\n" . $this->bottomComment($html, $this->html);
        }
    }

    protected function removeWhiteSpace($str)
    {
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n", '', $str);
        $str = str_replace("\r", '', $str);

        while (stristr($str, '  ')) {
            $str = str_replace('  ', ' ', $str);
        }

        return $str;
    }
}

function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}

add_action('get_header', 'wp_html_compression_start');