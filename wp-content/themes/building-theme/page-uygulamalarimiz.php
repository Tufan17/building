<?php
/**
 * Template Name: Uygulamalarımız Sayfası
 */

get_header(); ?>

<main class="w-full bg-background-dark min-h-screen">
    <!-- Hero Section -->
    <section class="relative w-full py-24 md:py-32 lg:py-40 flex flex-col items-center justify-center bg-background-dark border-b border-white/5"
             style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-background-dark pointer-events-none"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto flex flex-col gap-6">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="h-[1px] w-12 bg-primary"></div>
                <span class="text-primary tracking-[0.2em] text-xs font-semibold uppercase">Deneyim & Vizyon</span>
                <div class="h-[1px] w-12 bg-primary"></div>
            </div>
            <h1 class="font-serif-heading text-5xl md:text-7xl lg:text-8xl font-normal text-white leading-tight">
                Uygulama <span class="italic text-white/90">Galerisi</span>
            </h1>
            <p class="text-gray-400 font-light text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                İşçilikteki mükemmellik ve teknik detayların estetikle buluştuğu anlar.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="mx-auto max-w-[1440px] px-6 lg:px-12 py-16 lg:py-24">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $apps_query = new WP_Query(array(
            'post_type'      => 'uygulamalar',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'post_status'    => 'publish',
        ));

        if ($apps_query->have_posts()) :
            $all_app_media = array();
            $index = 0;
        ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-20 lg:gap-y-32">
                <?php while ($apps_query->have_posts()) : $apps_query->the_post();
                    $index++;
                    $video_url = get_post_meta(get_the_ID(), '_application_video_url', true);
                    if (!empty($video_url)) {
                        $video_url = str_replace('http://', 'https://', $video_url);
                    }
                    $is_video = preg_match('/\.(mp4|webm|ogg)$/i', $video_url) || strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false || strpos($video_url, 'vimeo.com') !== false;

                    // Store for lightbox
                    $all_app_media[] = array(
                        'title' => get_the_title(),
                        'url'   => !empty($video_url) ? $video_url : str_replace('http://', 'https://', get_the_post_thumbnail_url(get_the_ID(), 'full')),
                        'type'  => (!empty($video_url) && $is_video) ? 'video' : 'image',
                        'desc'  => get_the_content()
                    );

                    $is_offset = ($index % 2 === 0);
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                    <article class="group flex flex-col gap-6 cursor-pointer app-item-trigger <?php echo $is_offset ? 'md:mt-24' : ''; ?>"
                             data-index="<?php echo ($index - 1); ?>">

                        <!-- Media Container -->
                        <div class="overflow-hidden rounded-lg aspect-[4/3] relative bg-navy-dark">
                            <?php if ($is_video && !empty($video_url)) : ?>
                                <?php if (preg_match('/\.(mp4|webm|ogg)$/i', $video_url)) : ?>
                                    <video src="<?php echo esc_url($video_url); ?>" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-700 group-hover:scale-105" muted loop playsinline></video>
                                <?php else : ?>
                                    <?php if ($thumb) : ?>
                                        <img src="<?php echo esc_url($thumb); ?>" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-700 group-hover:scale-105">
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if ($thumb) : ?>
                                    <img src="<?php echo esc_url($thumb); ?>" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-all duration-700 group-hover:scale-105">
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors z-10"></div>

                            <!-- Floating Icon -->
                            <div class="absolute bottom-6 right-6 z-20 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                                <div class="size-12 rounded-full bg-primary flex items-center justify-center text-background-dark shadow-lg">
                                    <span class="material-icons"><?php echo $is_video ? 'play_arrow' : 'zoom_in'; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-start border-b border-white/10 pb-4 mb-2 group-hover:border-primary/50 transition-colors duration-500">
                                <h3 class="font-serif-heading text-3xl md:text-4xl text-white group-hover:text-primary transition-colors">
                                    <?php the_title(); ?>
                                </h3>
                                <span class="text-sm font-mono text-gray-500 pt-2">
                                    <?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>
                                </span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="h-px w-8 bg-primary/30 group-hover:w-12 transition-all duration-500"></span>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-primary font-bold">Detayı İncele</span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Lightbox Script Data -->
            <script>
                window.appMedia = <?php echo json_encode($all_app_media); ?>;
            </script>

            <!-- Pagination -->
            <div class="mt-32 flex justify-center">
                <?php
                echo paginate_links(array(
                    'total'        => $apps_query->max_num_pages,
                    'current'      => $paged,
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'list',
                    'prev_next'    => true,
                    'prev_text'    => '<span class="material-icons">chevron_left</span>',
                    'next_text'    => '<span class="material-icons">chevron_right</span>',
                    'class'        => 'flex items-center gap-2',
                ));
                ?>
            </div>

            <style>
                .pagination ul { display: flex; align-items: center; gap: 0.5rem; }
                .pagination li a, .pagination li span {
                    width: 3rem; height: 3rem; display: flex; align-items: center; justify-content: center; border-radius: 9999px; border: 1px solid rgba(255,255,255,0.1); font-size: 0.75rem; font-weight: 700; transition: all 0.3s; color: rgba(255,255,255,0.5);
                }
                .pagination li a:hover { border-color: #C6A85A; color: #C6A85A; background: rgba(198,168,90,0.05); }
                .pagination li span.current { background: #C6A85A; border-color: #C6A85A; color: white; }
            </style>

        <?php else : ?>
            <div class="inner-container text-center py-24">
                <span class="material-icons text-6xl text-gray-600 mb-4 block">image_not_supported</span>
                <p class="text-gray-500 uppercase tracking-widest text-sm">Henüz uygulama eklenmemiş.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </section>
</main>

<!-- Custom App Lightbox -->
<div id="app-lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-background-dark/95 backdrop-blur-xl"></div>

    <div class="relative w-full max-w-6xl aspect-video bg-black shadow-2xl rounded-sm overflow-hidden border border-white/10 group">
        <!-- Header -->
        <div class="absolute top-0 left-0 w-full p-6 flex justify-between items-center z-20 bg-gradient-to-b from-black/80 to-transparent">
            <h2 id="lightbox-title" class="text-white font-serif text-xl"></h2>
            <button id="close-lightbox" class="text-white/50 hover:text-white transition-colors duration-300">
                <span class="material-icons text-3xl">close</span>
            </button>
        </div>

        <!-- Navigation -->
        <button id="prev-app" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-primary text-white transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
            <span class="material-icons">chevron_left</span>
        </button>
        <button id="next-app" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-primary text-white transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
            <span class="material-icons">chevron_right</span>
        </button>

        <!-- Content -->
        <div id="lightbox-content" class="w-full h-full flex items-center justify-center"></div>

        <!-- Counter -->
        <div id="lightbox-counter" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 text-white/40 text-xs uppercase tracking-widest"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById('app-lightbox');
    const content = document.getElementById('lightbox-content');
    const titleEl = document.getElementById('lightbox-title');
    const counterEl = document.getElementById('lightbox-counter');
    const closeBtn = document.getElementById('close-lightbox');
    const prevBtn = document.getElementById('prev-app');
    const nextBtn = document.getElementById('next-app');

    let currentIndex = 0;

    function showItem(index) {
        const item = window.appMedia[index];
        if (!item) return;

        currentIndex = index;
        titleEl.textContent = item.title;
        counterEl.textContent = `${index + 1} / ${window.appMedia.length}`;

        let html = '';
        if (item.type === 'video') {
            const url = item.url;
            if (url.includes('youtube.com') || url.includes('youtu.be')) {
                const id = url.includes('v=') ? url.split('v=')[1].split('&')[0] : url.split('/').pop();
                html = `<iframe src="https://www.youtube.com/embed/${id}?autoplay=1" class="w-full h-full" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
            } else if (url.includes('vimeo.com')) {
                const id = url.split('/').pop();
                html = `<iframe src="https://player.vimeo.com/video/${id}?autoplay=1" class="w-full h-full" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
            } else {
                html = `<video src="${url}" class="w-full h-full" controls autoplay></video>`;
            }
        } else {
            html = `<img src="${item.url}" class="max-w-full max-h-full object-contain">`;
        }

        content.innerHTML = html;
        lightbox.style.display = 'flex';
        document.documentElement.style.overflow = 'hidden';
    }

    document.querySelectorAll('.app-item-trigger').forEach(trigger => {
        trigger.addEventListener('click', function() {
            showItem(parseInt(this.dataset.index));
        });
    });

    const closeLightbox = () => {
        lightbox.style.display = 'none';
        content.innerHTML = '';
        document.documentElement.style.overflow = '';
    };

    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
    if (lightbox) lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    if (prevBtn) prevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = window.appMedia.length - 1;
        showItem(newIndex);
    });

    if (nextBtn) nextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        let newIndex = currentIndex + 1;
        if (newIndex >= window.appMedia.length) newIndex = 0;
        showItem(newIndex);
    });

    // Keyboard support
    document.addEventListener('keydown', (e) => {
        if (lightbox && lightbox.style.display === 'flex') {
            if (e.key === 'ArrowLeft') prevBtn.click();
            if (e.key === 'ArrowRight') nextBtn.click();
            if (e.key === 'Escape') closeLightbox();
        }
    });
});
</script>

<?php get_footer(); ?>
