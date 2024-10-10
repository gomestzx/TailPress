<div class="featured-posts flex overflow-x-auto lg:overflow-hidden space-x-4 lg:space-x-0 mt-4 lg:grid lg:grid-cols-4 gap-4">
    <style>
        .featured-posts::-webkit-scrollbar {
            display: none;
        }

        .featured-posts {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
    </style>
    <?php
    $recent_posts = new WP_Query(array(
        'posts_per_page' => 4,
        'post_status' => 'publish',
    ));
    if ($recent_posts->have_posts()) :
        while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="featured-post flex-shrink-0 w-64 h-44 relative overflow-hidden lg:w-full rounded-lg block">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
                <?php endif; ?>
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-90 flex items-end justify-center">
                    <h3 class="text-white text-lg font-bold text-center p-2 w-full">
                        <span class="text-white no-underline leading-5 font-darker-grotesque text-xl">
                            <?php the_title(); ?>
                        </span>
                    </h3>
                </div>
            </a>
        <?php endwhile;
        wp_reset_postdata();
    else : ?>
        <p class="text-center text-gray-600">Nenhum post encontrado.</p>
    <?php endif; ?>
</div>
