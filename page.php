<?php get_header(); ?>

<div class="container mx-auto px-4 lg:px-10 py-8">
    <main class="content">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="mb-8">
                        <h1 class="text-3xl font-bold"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content page-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile;
        else : ?>
            <p class="text-center text-gray-600">Nenhum conteúdo encontrado.</p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
