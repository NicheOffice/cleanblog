<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div class="mb-2">
    <div class="markup">
        <p class="text-xl font-semibold mt-4" id="yorumlar">
            Yorumlar
        </p>
        <div id="disqus_thread" style="text-align: center;"></div>
        <button onclick="disqus();return false;"
                class="w-full px-3 py-2 bg-blue-100 border-b-5 border-blue-200 text-sm text-gray-700 font-semibold">
            Yorumları Yükle
        </button>
        <script type="text/javascript">
            function disqus() {
                if (!disqus_loaded) {
                    disqus_loaded = !0;
                    var e = document.createElement("script");
                    e.type = "text/javascript", e.async = !0, e.src = "//" + disqus_shortname + ".disqus.com/embed.js", (document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(e)
                }
            }

            var disqus_shortname = "ahmethakanbesel", disqus_url = "<?php the_permalink(); ?>",
                disqus_identifier = "<?php the_permalink(); ?>", disqus_loaded = !1;
        </script>
    </div>
</div>