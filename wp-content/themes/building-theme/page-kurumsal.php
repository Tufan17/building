<?php
/**
 * Template Name: Kurumsal
 *
 * @package Building_Theme
 */

get_header();

// Get settings
$hero_title = get_option('prestige_corp_hero_title');
if (!$hero_title)
    $hero_title = prestige_get_default('prestige_corp_hero_title');

$hero_desc = get_option('prestige_corp_hero_desc');
if (!$hero_desc)
    $hero_desc = prestige_get_default('prestige_corp_hero_desc');

$profile_content = get_option('prestige_corp_profile');
if (!$profile_content)
    $profile_content = prestige_get_default('prestige_corp_profile');

$policy_content = get_option('prestige_corp_policy');
if (!$policy_content)
    $policy_content = prestige_get_default('prestige_corp_policy');
?>

<main id="primary"
    class="bg-background-light dark:bg-background-dark font-sans text-slate-900 dark:text-slate-100 antialiased selection:bg-primary selection:text-black">
    <!-- Hero Section -->
    <section
        class="relative min-h-[60vh] flex flex-col justify-center items-center overflow-hidden bg-background-dark px-6 py-24 text-center">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
        </div>
        <div class="relative z-10 max-w-4xl space-y-6">
            <span class="inline-block text-primary tracking-[0.2em] text-xs font-bold uppercase mb-2">Şirket
                Profili</span>
            <h1 class="font-display text-5xl md:text-7xl font-light text-white leading-tight tracking-tight">
                <?php echo wp_kses_post($hero_title); ?>
            </h1>
            <div class="h-px w-24 bg-primary mx-auto my-8"></div>
            <p class="text-lg md:text-xl text-slate-400 font-light font-display max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html($hero_desc); ?>
            </p>
        </div>
    </section>

    <!-- Corporate Profile Section -->
    <section class="py-24 px-6 md:px-16 lg:px-32">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <div class="lg:col-span-2 space-y-12">
                    <div class="space-y-6">
                        <h2
                            class="text-4xl font-display text-background-dark font-light border-l-4 border-primary pl-6">
                            Kurumsal Kimlik
                        </h2>
                        <p class="text-slate-600 text-xl leading-relaxed font-light">
                            <?php echo nl2br(esc_html($profile_content)); ?>
                        </p>
                    </div>

                    <div class="space-y-6">
                        <h2
                            class="text-4xl font-display text-background-dark font-light border-l-4 border-primary pl-6">
                            Kalite Politikamız
                        </h2>
                        <p class="text-slate-600 text-lg leading-relaxed font-light">
                            <?php echo nl2br(esc_html($policy_content)); ?>
                        </p>
                    </div>
                </div>

                <div class="space-y-12">
                    <div class="bg-navy-dark p-10 text-white rounded-sm space-y-6">
                        <h3 class="text-primary text-xs font-bold uppercase tracking-widest">Sertifikasyonlar</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 border-b border-white/5 pb-3">
                                <span class="material-symbols-outlined text-primary text-sm">verified</span>
                                <span class="text-sm font-light">ISO 9001:2015</span>
                            </li>
                            <li class="flex items-center gap-3 border-b border-white/5 pb-3">
                                <span class="material-symbols-outlined text-primary text-sm">verified</span>
                                <span class="text-sm font-light">ISO 14001:2015</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary text-sm">verified</span>
                                <span class="text-sm font-light">OHSAS 18001</span>
                            </li>
                        </ul>
                    </div>

                    <div class="border border-slate-200 p-10 space-y-6">
                        <h3 class="text-background-dark text-xs font-bold uppercase tracking-widest">Vizyon & Misyon
                        </h3>
                        <div class="space-y-4">
                            <a href="<?php echo esc_url(home_url('/vizyon')); ?>"
                                class="block text-slate-500 hover:text-primary transition-colors italic">Vizyonumuzu
                                inceleyin &rarr;</a>
                            <a href="<?php echo esc_url(home_url('/misyon')); ?>"
                                class="block text-slate-500 hover:text-primary transition-colors italic">Misyonumuzu
                                inceleyin &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Standards Section (Reuse existing) -->
    <section class="bg-off-white py-24 px-6 md:px-16 lg:px-32">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-background-dark font-display text-4xl font-light mb-4">Uygulama Standartlarımız</h2>
                <div class="h-px w-20 bg-primary/30 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $standards = get_option('prestige_standards');
                if (!$standards || !is_array($standards))
                    $standards = prestige_get_default('prestige_standards');

                foreach ($standards as $std):
                    ?>
                    <div class="flex flex-col gap-4">
                        <span class="material-symbols-outlined text-4xl text-primary/60">
                            <?php echo esc_html($std['icon']); ?>
                        </span>
                        <h4 class="text-background-dark font-bold uppercase tracking-widest text-sm">
                            <?php echo esc_html($std['title']); ?>
                        </h4>
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