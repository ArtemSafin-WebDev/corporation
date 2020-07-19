<?php get_header(); ?>

<h1 class="page-template-name">
    Шаблон таксономии Типа объекта
</h1>

<?php if (have_posts()) : ?>
    <ul class="posts-list">
        <?php while (have_posts()) : the_post(); ?>
            <li class="posts-list__item">
                <div class="posts-list__card">
                    <h2 class="posts-list__heading">
                        <?php the_title(); ?>
                    </h2>
                    <div class="posts-list__content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else : ?>
    <div class="no-posts">
        Записи отсутствуют
    </div>
<?php endif; ?>

<?php get_footer(); ?>