<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Building_Theme
 */

?>

<!-- Footer -->
<footer class="bg-navy-dark pt-20 pb-10 border-t border-white/10" id="contact">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-24 mb-16">
            <!-- Brand Col -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-icons text-primary text-2xl">temple_hindu</span>
                    <span
                        class="font-serif-heading font-bold text-xl tracking-widest text-white uppercase"><?php bloginfo('name'); ?></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Redefining the landscape of luxury real estate development through architectural excellence.
                </p>
                <div class="flex gap-4">
                    <a class="text-gray-400 hover:text-primary transition-colors" href="#"><i
                            class="material-icons text-lg">facebook</i></a>
                    <a class="text-gray-400 hover:text-primary transition-colors" href="#"><i
                            class="material-icons text-lg">camera_alt</i></a>
                    <a class="text-gray-400 hover:text-primary transition-colors" href="#"><i
                            class="material-icons text-lg">alternate_email</i></a>
                </div>
            </div>
            <!-- Navigation Col -->
            <div>
                <h4 class="text-white text-xs uppercase tracking-widest font-semibold mb-6">Company</h4>
                <ul class="space-y-4">
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">About Us</a></li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Our Team</a></li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Careers</a></li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Press</a></li>
                </ul>
            </div>
            <!-- Projects Col -->
            <div>
                <h4 class="text-white text-xs uppercase tracking-widest font-semibold mb-6">Collections</h4>
                <ul class="space-y-4">
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Residential</a>
                    </li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Commercial</a>
                    </li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Hospitality</a>
                    </li>
                    <li><a class="text-gray-400 hover:text-primary transition-colors text-sm" href="#">Sustainable</a>
                    </li>
                </ul>
            </div>
            <!-- Contact Col -->
            <div>
                <h4 class="text-white text-xs uppercase tracking-widest font-semibold mb-6">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-icons text-primary text-sm mt-1">place</span>
                        <span class="text-gray-400 text-sm">1200 Architecture Ave,<br />Beverly Hills, CA 90210</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-primary text-sm">phone</span>
                        <span class="text-gray-400 text-sm">+1 (310) 555-0123</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons text-primary text-sm">email</span>
                        <span class="text-gray-400 text-sm">inquiry@prestige.com</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-xs">
                © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
            <div class="flex gap-6">
                <a class="text-gray-500 hover:text-white text-xs transition-colors" href="#">Privacy Policy</a>
                <a class="text-gray-500 hover:text-white text-xs transition-colors" href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                const icon = menuBtn.querySelector('.material-icons');
                const expanded = !mobileMenu.classList.contains('hidden');
                menuBtn.setAttribute('aria-expanded', expanded);
                icon.textContent = expanded ? 'close' : 'menu';
            });
        }

        // Mobile sub-menu dropdown toggles
        document.querySelectorAll('.mobile-dropdown-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const submenu = btn.nextElementSibling;
                const icon = btn.querySelector('.material-icons');
                if (submenu && submenu.classList.contains('mobile-submenu')) {
                    submenu.classList.toggle('hidden');
                    if (icon) {
                        icon.style.transform = submenu.classList.contains('hidden') ? '' : 'rotate(180deg)';
                    }
                }
            });
        });
    });
</script>

<?php wp_footer(); ?>

</body>

</html>