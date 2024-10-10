<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="container mx-auto px-4 lg:px-10 py-8 grid grid-cols-1 md:grid-cols-10 gap-8 overflow-x-hidden">
            <main class="content <?php echo is_active_sidebar('primary-sidebar') ? 'md:col-span-7' : 'md:col-span-10'; ?> col-span-10">
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    <header class="mb-8">
                        <h1 class="text-3xl md:text-4xl font-bold mb-4 font-darker-grotesque"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <div class="post-info flex gap-2 justify-start items-center text-sm text-gray-500">
                                <p> <?php echo get_the_date('d/m/Y'); ?> às <?php echo get_the_time('H:i'); ?></p>
                                <span>&bull;</span>
                                <p>
                                    <?php
                                    $categories = get_the_category();
                                    $separator = ', ';
                                    $output = '';
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'textdomain'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
                                        }
                                        echo trim($output, $separator);
                                    }
                                    ?>
                                </p>
                            </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail mb-8">
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content" style="line-height: 1.6; margin-bottom: 20px;">
                        <?php
                        echo wpautop(apply_filters('the_content', get_the_content()));
                        ?>
                    </div>

                    <nav class="post-navigation mt-10 mb-8">
                        <div class="nav-links flex flex-col md:flex-row justify-between">
                            <div class="previous-post mb-4 md:mb-0">
                                <?php previous_post_link('%link', '&laquo; Previous Post', true); ?>
                            </div>
                            <div class="next-post">
                                <?php next_post_link('%link', 'Next Post &raquo;', true); ?>
                            </div>

                        </div>
                    </nav>

                </article>
            </main>

            <?php if (is_active_sidebar('primary-sidebar')) : ?>
                <aside class="sidebar md:col-span-3 col-span-10 md:pt-10">
                    <?php dynamic_sidebar('primary-sidebar'); ?>
                </aside>
            <?php endif; ?>
        </div>

    <?php endwhile;
else : ?>
    <p class="text-center text-gray-600">Desculpe, nenhum post foi encontrado.</p>
<?php endif;

get_footer();
?>