<?php wp_head(); ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/featured-posts'); ?>

<div class="container mx-auto px-4 lg:px-10 py-8 grid grid-cols-1 md:grid-cols-10 gap-8 overflow-x-hidden">
    <main class="content <?php echo is_active_sidebar('primary-sidebar') ? 'lg:col-span-7' : 'col-span-10'; ?> col-span-10">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if (isset($_GET['s']) && !empty($_GET['s'])) {
            $search_query = sanitize_text_field($_GET['s']);

            $args = array(
                'posts_per_page' => 10, 
                'offset' => ($paged - 1) * 10,
                's' => $search_query,
                'paged' => $paged,
            );
        } else {
            $args = array(
                'posts_per_page' => 10, 
                'offset' => ($paged - 1) * 10 + 4, 
                'paged' => $paged,
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-8 flex flex-col md:flex-row justify-center items-center group relative'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail w-full md:w-1/3 mb-4 md:mb-0 md:mr-4 relative">
                            <?php the_post_thumbnail('medium', ['class' => 'rounded w-full']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="w-full md:w-2/3 relative">
                        <header class="mb-2">
                            <h2 class="leading-6 md:leading-6 text-xl md:text-2xl font-bold group-hover:text-purple-600 transition-colors duration-200 font-darker-grotesque ">
                                <?php the_title(); ?> 
                            </h2>

                            <div class="text-xs mt-2 font-work-sans">
                                <?php
                                $categories = get_the_category();
                                foreach ($categories as $category) {
                                    $category_bg_color = get_theme_mod("category_bg_color_{$category->term_id}", '#CEE1F9');
                                    $category_text_color = get_theme_mod("category_text_color_{$category->term_id}", '#006FF6');

                                    echo '<span class="inline-block px-3 py-1 rounded-full" style="background-color:' . esc_attr($category_bg_color) . '; color:' . esc_attr($category_text_color) . '; position:relative;">';
                                    echo esc_html($category->name) . '</span> ';
                                }
                                ?>
                            </div>
                        </header>
                        <div class="entry-content text-gray-700 line-clamp-4 font-lexend font-light">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-20"></a>
                </article>
            <?php endwhile;

            $pagination_args = array(
                'total' => $query->max_num_pages,
                'mid_size' => 2,
                'prev_text' => '<span class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded">&laquo; Prev</span>',
                'next_text' => '<span class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded">Next &raquo;</span>',
                'type' => 'array',
                'current' => $paged,
                'format' => '?paged=%#%',
                'add_args' => array_filter($_GET),
            );

            $pages = paginate_links($pagination_args);

            if (is_array($pages)) {
                echo '<div class="pagination-list flex flex-wrap space-x-2">';
                foreach ($pages as $page) {
                    if (strpos($page, 'current') !== false) {
                        $page = str_replace('class="page-numbers current"', 'class="inline-block px-4 py-2 bg-purple-600 text-white rounded"', $page);
                    } else {
                        $page = str_replace('class="page-numbers"', 'class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200"', $page);
                    }
                    echo $page;
                }
                echo '</div>';
            }

            wp_reset_postdata();
        else : ?>
            <p class="text-center text-gray-600">Nenhum post encontrado.</p>
        <?php endif; ?>
    </main>
    
    <?php get_sidebar() ?>
</div>

<?php wp_footer();
get_footer(); ?>