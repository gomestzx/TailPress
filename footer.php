<footer class="text-white py-10 text-black">
    <div class="container mx-auto px-4 lg:px-10 grid grid-cols-1 md:grid-cols-4 gap-8">
        <?php if (is_active_sidebar('footer-1')) : ?>
            <div class="footer-column">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
        <?php endif; ?>
        <?php if (is_active_sidebar('footer-2')) : ?>
            <div class="footer-column">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
        <?php endif; ?>
        <?php if (is_active_sidebar('footer-3')) : ?>
            <div class="footer-column">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
        <?php endif; ?>
        <?php if (is_active_sidebar('footer-4')) : ?>
            <div class="footer-column">
                <?php dynamic_sidebar('footer-4'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="text-center mt-10 text-gray-400">
        <p>&copy; <?php echo date('Y'); ?> - All rights reserved.</p>
        <p>Made by <a target="_blank" href="https://github.com/gomestzx">gomestzx</a></p>
    </div>
</footer>


<?php wp_footer(); ?>
</body>

</html>