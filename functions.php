<?php
function tailnews_register_sidebars()
{
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'tailnews'),
        'id'            => 'primary-sidebar',
        'description'   => __('Add widgets here to appear in the sidebar.', 'tailnews'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-xl font-bold mb-2">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'Footer Widget Area 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-xl font-bold mb-2">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Widget Area 2',
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-xl font-bold mb-2">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Widget Area 3',
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-xl font-bold mb-2">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Widget Area 4',
        'id'            => 'footer-4',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-xl font-bold mb-2">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'tailnews_register_sidebars');

function tailnews_theme_setup()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tailnews'),
    ));
}
add_action('after_setup_theme', 'tailnews_theme_setup');

function tailnews_enqueue_assets()
{
    wp_enqueue_style('tailnews-main-stylesheet', get_stylesheet_uri());

    wp_enqueue_style('tailnews-fonts', 'https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@300;400;500;600;700&family=Lexend+Deca:wght@300;400;500;600;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'tailnews_enqueue_assets');

function tailnews_add_additional_class_on_nav_link($atts, $item, $args)
{
    if ($args->theme_location == 'primary') {
        $atts['class'] = 'text-xl font-darker-grotesque font-semibold';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'tailnews_add_additional_class_on_nav_link', 10, 3);

function customizer_category_colors($wp_customize)
{
    $categories = get_categories(array('hide_empty' => false));

    foreach ($categories as $category) {
        $wp_customize->add_setting("category_bg_color_{$category->term_id}", array(
            'default' => '#CEE1F9',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "category_bg_color_control_{$category->term_id}", array(
            'label' => __("Background Color for {$category->name}"),
            'section' => 'colors',
            'settings' => "category_bg_color_{$category->term_id}",
        )));

        $wp_customize->add_setting("category_text_color_{$category->term_id}", array(
            'default' => '#006FF6',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "category_text_color_control_{$category->term_id}", array(
            'label' => __("Text Color for {$category->name}"),
            'section' => 'colors',
            'settings' => "category_text_color_{$category->term_id}",
        )));
    }
}
add_action('customize_register', 'customizer_category_colors');

function my_theme_enqueue_styles() {
    wp_enqueue_style('main-styles', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
