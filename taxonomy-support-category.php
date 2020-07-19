<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <section class="support-archive">
      
        <div class="support-archive__bg">


            <?php
            $image = get_field('support-category_image');
            if (!empty($image)) : ?>
                <img class="support-archive__bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            <?php endif; ?>
        </div>
        <div class="container">
            <h2 class="support-archive__heading">
                Меры поддержки:
                <?php
                $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                echo $term->name; 
                ?>
            </h2>
            <div class="support-archive__row">
                <div class="support-archive__sidebar">
                    <?php
                    $support_categories = get_terms([
                        'taxonomy' => 'support-category',
                        'parent' => 0
                    ]);
                    ?>
                    <ul class="support-archive__all-categories-list">
                        <?php foreach ($support_categories as $category) : ?>
                            <li class="support-archive__all-categories-list-item">
                                <a href="<?php echo get_term_link($category); ?>" class="support-archive__all-categories-card <?php if ($term->term_taxonomy_id === $category->term_taxonomy_id) echo "active";?>">
                                    <?php
                                    $image = get_field('support-category_icon', $category);
                                    if (!empty($image)) : ?>
                                        <div class="support-archive__all-categories-card-icon-container">
                                            <img class="support-archive__all-categories-card-icon" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <div class="support-archive__all-categories-card-title">
                                        <?php echo $category->name; ?>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="support-archive__content">
                    <ul class="support-archive__list">
                        <?php while (have_posts()) : the_post(); ?>
                            <li class="support-archive__list-item">
                                <a href="<?php the_permalink(); ?>" class="support-archive__main-card">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>