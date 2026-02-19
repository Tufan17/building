<?php
/**
 * Template Name: Hakkımızda
 *
 * @package Building_Theme
 */

get_header();

// Get settings
$hero_title = get_option('prestige_about_hero_title');
if (!$hero_title)
    $hero_title = prestige_get_default('prestige_about_hero_title');

$hero_desc = get_option('prestige_about_hero_desc');
if (!$hero_desc)
    $hero_desc = prestige_get_default('prestige_about_hero_desc');

$story_title = get_option('prestige_about_story_title');
if (!$story_title)
    $story_title = prestige_get_default('prestige_about_story_title');

$story_content = get_option('prestige_about_story_content');
if (!$story_content)
    $story_content = prestige_get_default('prestige_about_story_content');

$story_image = get_option('prestige_about_story_image');
if (!$story_image)
    $story_image = prestige_get_default('prestige_about_story_image');

$metrics = get_option('prestige_metrics');
if (!$metrics || !is_array($metrics))
    $metrics = prestige_get_default('prestige_metrics');
?>

<main id="primary"
    class="bg-background-light dark:bg-background-dark font-sans text-slate-900 dark:text-slate-100 antialiased selection:bg-primary selection:text-black">
    <!-- Hero Section -->
    <section
        class="relative min-h-[70vh] flex flex-col justify-center items-center overflow-hidden bg-navy-dark px-6 py-24 text-center">
        <div class="absolute inset-0 z-0 opacity-20 bg-cover bg-center"
            style="background-image: url('<?php echo esc_url($story_image); ?>');"></div>
        <div class="absolute inset-0 z-0 bg-gradient-to-b from-navy-dark/80 via-navy-dark/60 to-navy-dark"></div>

        <div class="relative z-10 max-w-4xl space-y-6">
            <span class="inline-block text-primary tracking-[0.2em] text-xs font-bold uppercase mb-2">Kurumsal</span>
            <h1 class="font-display text-5xl md:text-7xl font-light text-white leading-tight tracking-tight">
                <?php echo wp_kses_post($hero_title); ?>
            </h1>
            <div class="h-px w-24 bg-primary mx-auto my-8"></div>
            <p class="text-lg md:text-xl text-slate-300 font-light font-display max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html($hero_desc); ?>
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-24 px-6 md:px-16 lg:px-32 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="space-y-4">
                        <span class="text-primary font-bold uppercase tracking-widest text-xs">Mirasımız</span>
                        <h2 class="text-4xl md:text-5xl font-display text-background-dark leading-tight">
                            <?php echo esc_html($story_title); ?>
                        </h2>
                    </div>
                    <div class="h-1 w-20 bg-primary/20"></div>
                    <p class="text-slate-600 text-lg leading-relaxed font-light">
                        <?php echo nl2br(esc_html($story_content)); ?>
                    </p>
                    <div class="pt-4">
                        <a href="<?php echo esc_url(home_url('/iletisim')); ?>"
                            class="inline-flex items-center gap-2 text-background-dark font-bold uppercase tracking-widest text-sm group">
                            Bize Katılın
                            <span
                                class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-[4/5] overflow-hidden rounded-sm shadow-2xl">
                        <img src="<?php echo esc_url($story_image); ?>" alt="Building Story"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-primary/10 -z-10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Metrics Section -->
    <section class="bg-navy-dark py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <?php if ($metrics):
                    foreach ($metrics as $metric): ?>
                        <div class="space-y-2">
                            <div class="text-primary text-5xl font-display font-light">
                                <?php echo esc_html($metric['value']); ?>
                            </div>
                            <div class="text-slate-400 text-sm uppercase tracking-widest">
                                <?php echo esc_html($metric['label']); ?>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="bg-background-light py-24 px-6 md:px-16 lg:px-32">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-background-dark font-display text-4xl font-light">Değerlerimiz</h2>
                <p class="text-slate-500 max-w-xl mx-auto italic">Karakterimiz, her çivide ve her tasarım kararında
                    kendini gösterir.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $standards = get_option('prestige_standards');
                if (!$standards || !is_array($standards))
                    $standards = prestige_get_default('prestige_standards');

                foreach ($standards as $std):
                    ?>
                    <div
                        class="p-8 bg-white border border-slate-100 hover:border-primary/30 transition-all duration-300 hover:shadow-xl rounded-sm group text-center">
                        <div
                            class="w-16 h-16 bg-off-white rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary/10 transition-colors">
                            <span class="material-symbols-outlined text-3xl text-primary">
                                <?php echo esc_html($std['icon']); ?>
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-background-dark uppercase tracking-widest mb-4">
                            <?php echo esc_html($std['title']); ?>
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-light">
                            <?php echo esc_html($std['desc']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>