<?php
/**
 * Template Name: Blog Sayfası
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
                <span class="text-primary tracking-[0.2em] text-xs font-semibold uppercase">Haberler & Dünyamız</span>
                <div class="h-[1px] w-12 bg-primary"></div>
            </div>
            <h1 class="font-serif-heading text-5xl md:text-7xl lg:text-8xl font-normal text-white leading-tight">
                Güncel <span class="italic text-white/90">Yazılar</span>
            </h1>
            <p class="text-gray-400 font-light text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
                Mimari vizyonumuz, sektördeki haberler ve Capital Yaşam'dan son gelişmeler.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="mx-auto max-w-[1440px] px-6 lg:px-12 py-16 lg:py-24">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $blog_query = new WP_Query(array(
            'post_type'      => 'blog',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'post_status'    => 'publish',
        ));

        if ($blog_query->have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-20 lg:gap-y-32">
                <?php $index = 0; while ($blog_query->have_posts()) : $blog_query->the_post(); $index++;
                    $is_offset = ($index % 2 === 0);
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                    <article class="group flex flex-col gap-6 cursor-pointer <?php echo $is_offset ? 'md:mt-24' : ''; ?>">
                        <!-- Thumbnail -->
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="overflow-hidden rounded-lg aspect-[4/3] relative bg-navy-dark">
                                <?php if ($thumb) : ?>
                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" loading="lazy">
                                <?php else : ?>
                                    <div class="w-full h-full flex items-center justify-center text-primary/10">
                                        <span class="material-icons text-7xl">article</span>
                                    </div>
                                <?php endif; ?>

                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors z-10"></div>

                                <!-- Hover Arrow Icon -->
                                <div class="absolute bottom-6 right-6 z-20 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                                    <div class="size-12 rounded-full bg-primary flex items-center justify-center text-background-dark shadow-lg">
                                        <span class="material-icons">arrow_forward</span>
                                    </div>
                                </div>

                                <div class="absolute top-4 left-4 bg-primary text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest rounded-sm shadow-xl z-20">
                                    <?php echo get_the_date('d M Y'); ?>
                                </div>
                            </div>
                        </a>

                        <!-- Content -->
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-start border-b border-white/10 pb-4 mb-2 group-hover:border-primary/50 transition-colors duration-500">
                                <h3 class="font-serif-heading text-3xl md:text-4xl text-white group-hover:text-primary transition-colors">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <span class="text-sm font-mono text-gray-500 pt-2">
                                    <?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>
                                </span>
                            </div>
                            <div class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-2 font-light">
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="h-px w-8 bg-primary/30 group-hover:w-12 transition-all duration-500"></span>
                                <a href="<?php the_permalink(); ?>" class="text-[10px] uppercase tracking-[0.2em] text-primary font-bold">Yazıyı Oku</a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-32 flex justify-center">
                <?php
                echo paginate_links(array(
                    'total'        => $blog_query->max_num_pages,
                    'current'      => $paged,
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'list',
                    'prev_next'    => true,
                    'prev_text'    => '<span class="material-icons">west</span>',
                    'next_text'    => '<span class="material-icons">east</span>',
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
            <div class="text-center py-24">
                <span class="material-icons text-6xl text-gray-600 mb-4 block">edit_note</span>
                <p class="text-gray-500 uppercase tracking-widest text-sm">Henüz blog yazısı eklenmemiş.</p>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </section>
</main>

<?php get_footer(); ?>
