<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/path-to-your-default-og-image.jpg">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/path-to-your-default-twitter-image.jpg">

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Darker+Grotesque:wght@300;400;500;600;700&family=Lexend+Deca:wght@400;700&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&family=Red+Hat+Display:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="bg-white border-b-2 border-gray-200">
        <div class="container lg:px-8 mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <a class="text-xl" href="<?php echo home_url(); ?>">
                    <?php
                    if (has_custom_logo()) {
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

                        if (has_custom_logo()) {
                            echo '<img src="' . esc_url($logo[0]) . '" class="custom-logo w-40" alt="' . get_bloginfo('name') . '">';
                        }
                    } else {
                        bloginfo('name');
                    }
                    ?>
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'flex space-x-4',
                    'container'      => '',
                    'fallback_cb'    => false,
                ));
                ?>
                <form role="search" method="get" class="search-form bg-gray-200 py-2 px-3 rounded-full" action="<?php echo home_url('/'); ?>">
                    <label>
                        <input style="font-family: 'Red Hat Display', sans-serif; font-weight: 300;" type="search" class="search-field bg-gray-200 font-red-hat text-sm focus:outline-none" placeholder="Pesquisar" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit text-gray-600 hover:text-gray-800">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </nav>

            <div class="md:hidden flex items-center">
                <button id="menu-button" class="text-gray-600 focus:outline-none focus:text-gray-800">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="md:hidden bg-white shadow-lg">
        <div class="px-4 py-4 flex justify-end items-center border-b">
            <button id="close-menu-button" class="text-gray-600 focus:outline-none focus:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="px-4 pt-2 pb-4 space-y-2">
            <form role="search" method="get" class="search-form bg-gray-200 py-2 px-4 flex justify-between items-center rounded-full" action="<?php echo home_url('/'); ?>">
                <label>
                    <input style="font-family: 'Red Hat Display', sans-serif; font-weight: 300;" type="search" class="search-field bg-gray-200 font-red-hat text-sm focus:outline-none" placeholder="Pesquisar" value="<?php echo get_search_query(); ?>" name="s" />
                </label>
                <button type="submit" class="search-submit text-gray-600 hover:text-gray-800">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="mt-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'block space-y-4 px-2',
                    'container'      => '',
                    'fallback_cb'    => false,
                ));
                ?>
            </div>
        </nav>
    </div>

    <div id="content" class="site-content container mx-auto px-4 md:px-8">

        <?php wp_footer(); ?>
        <script>
            document.getElementById('menu-button').addEventListener('click', function() {
                var menu = document.getElementById('mobile-menu');
                menu.classList.toggle('open');
            });

            document.getElementById('close-menu-button').addEventListener('click', function() {
                var menu = document.getElementById('mobile-menu');
                menu.classList.remove('open');
            });
        </script>
</body>

</html>
