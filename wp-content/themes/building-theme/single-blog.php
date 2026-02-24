<?php
/**
 * The template for displaying single blog posts
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<main id="primary" class="site-main bg-background-dark text-white font-display antialiased selection:bg-primary selection:text-black">

    <!-- Hero Section -->
    <header class="relative w-full h-[70vh] min-h-[600px] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat scale-105 animate-[pulse_10s_ease-in-out_infinite]"
            style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');">
        </div>
        <!-- Overlays -->
        <div class="absolute inset-0 bg-black/50 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#171512] via-transparent to-black/30"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center text-center px-4 max-w-5xl mx-auto space-y-8">
            <div class="flex items-center gap-4 mb-4 animate-[fadeIn_1s_ease-out_0.5s_both]">
                <span class="h-px w-8 bg-primary"></span>
                <span class="text-primary text-[10px] md:text-xs uppercase tracking-[0.4em] font-bold"><?php echo get_the_date('d F Y'); ?></span>
                <span class="h-px w-8 bg-primary"></span>
            </div>
            <h1 class="font-serif-heading text-4xl md:text-6xl lg:text-7xl text-white font-medium leading-[1.1] tracking-tight mix-blend-overlay opacity-90 animate-[fadeInUp_1s_ease-out_0.2s_both]">
                <?php the_title(); ?>
            </h1>
            <div class="pt-8 animate-[fadeIn_1s_ease-out_1s_both]">
                <div class="w-[1px] h-24 bg-gradient-to-b from-primary to-transparent mx-auto"></div>
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="relative bg-background-light text-background-dark py-24 md:py-32 px-6">
        <div class="max-w-[1440px] mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                <!-- Left Column: Title & Meta -->
                <div class="lg:col-span-4 relative">
                    <div class="sticky top-32">
                        <span class="block w-12 h-[2px] bg-primary mb-8"></span>
                        <h2 class="font-serif-heading text-3xl md:text-5xl font-medium leading-tight text-background-dark mb-8">
                            <?php the_title(); ?>
                        </h2>

                        <div class="flex flex-col gap-6 pt-8 border-t border-black/5">
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] uppercase tracking-widest text-gray-400">Yayınlanma</span>
                                <span class="text-sm font-medium text-background-dark"><?php echo get_the_date(); ?></span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[10px] uppercase tracking-widest text-gray-400">Paylaş</span>
                                <div class="flex gap-4 mt-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="text-gray-400 hover:text-primary transition-colors">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z"/></svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" class="text-gray-400 hover:text-primary transition-colors">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" class="text-gray-400 hover:text-primary transition-colors">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Content -->
                <div class="lg:col-span-8 flex flex-col gap-12">
                    <div class="prose prose-xl max-w-none text-gray-600 font-light leading-relaxed prose-headings:font-serif-heading prose-headings:text-background-dark prose-primary prose-img:rounded-lg prose-img:shadow-2xl">
                        <?php the_content(); ?>
                    </div>

                    <div class="mt-20 pt-10 border-t border-black/5">
                        <a href="<?php echo get_post_type_archive_link('blog'); ?>" class="group inline-flex items-center gap-4 text-[10px] uppercase tracking-[0.3em] text-primary font-bold">
                            <span class="material-icons text-sm transition-transform group-hover:-translate-x-3">west</span>
                            Blog Gezintisine Dön
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Relevant Posts -->
    <section class="bg-background-dark py-32 border-t border-white/5">
        <div class="max-w-[1440px] mx-auto px-6">
            <div class="flex justify-between items-end mb-20">
                <h2 class="font-serif-heading text-4xl text-white">Diğer <span class="italic text-white/80">Yazılar</span></h2>
                <a href="<?php echo get_post_type_archive_link('blog'); ?>" class="text-primary text-[10px] uppercase tracking-widest border-b border-primary/30 pb-2">Hepsini Gör</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <?php
                $next_post = get_next_post();
                $prev_post = get_previous_post();
                $related = array_filter(array($next_post, $prev_post));

                $ridx = 0;
                foreach ($related as $post) : setup_postdata($post); $ridx++; ?>
                    <article class="group relative overflow-hidden rounded-lg aspect-[16/9] bg-navy-dark">
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors z-10"></div>
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover transition-all duration-1000 group-hover:scale-105']); ?>
                        <?php endif; ?>
                        <div class="absolute inset-0 p-10 flex flex-col justify-end z-20">
                            <span class="text-primary text-[10px] uppercase tracking-[0.3em] mb-4"><?php echo get_the_date('d M Y'); ?></span>
                            <h3 class="font-serif-heading text-3xl text-white mb-6 leading-snug group-hover:text-primary transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <a href="<?php the_permalink(); ?>" class="text-white text-[10px] uppercase tracking-widest flex items-center gap-3 group/link">
                                İncele <span class="material-icons text-xs group-hover/link:translate-x-2 transition-transform">east</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

</main>
<?php endwhile; ?>

<?php get_footer(); ?>
