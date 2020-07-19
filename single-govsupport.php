<?php get_header(); ?>










<?php if (have_posts()) : ?>


    <section class="govsupport-single">
        <div class="container">
            <?php
            $terms = get_the_terms($post->ID, 'support-category'); ?>
            <?php foreach ($terms as $term) : ?>
                <div class="govsupport-single__category-card">

                    <?php
                    $image = get_field('support-category_icon', $term);
                    if (!empty($image)) : ?>
                        <div class="govsupport-single__category-card-icon-container" style="-webkit-mask-image: url(<?php echo esc_url($image['url']); ?>); -mask-image: url(<?php echo esc_url($image['url']); ?>);">
                           
                        </div>
                    <?php endif; ?>
                    <div class="govsupport-single__category-card-name">
                        <?php echo $term->name; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            


            <div class="govsupport-single__row">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="govsupport-single__main">
                        <h1 class="govsupport-single__title">
                            <?php the_title(); ?>
                        </h1>
                        <div class="govsupport-single__content">
                            <?php the_content(); ?>
                        </div>

                        <?php
                        $file = get_field('govsupport_rules');
                        if ($file) : ?>
                            <a target="_blank" class="govsupport-single__file" href="<?php echo $file['url']; ?>">
                                <svg width="20" height="20" aria-hidden="true" class="icon-pdf">
                                    <use xlink:href="#pdf" />
                                </svg>
                                <?php the_title(); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
                <div class="govsupport-single__sidebar">
                    <h2 class="govsupport-single__other-heading">
                        Другие меры в категории
                    </h2>

                    <?php
                    $args = [
                        'post_type' => 'govsupport',
                        'posts_per_page' => '4',
                        'tax_query' => [
                            'taxonomy' => 'support-category',
                            'field' => 'slug',
                            'terms' => $terms[0]->slug,
                            'operator' => 'IN'
                        ]
                    ];

                    $measures = new WP_Query($args);
                    ?>

                    <?php if ($measures->have_posts()) : ?>
                        <ul class="govsupport-single__other-list">
                            <?php while ($measures->have_posts()) : $measures->the_post(); ?>
                                <li class="govsupport-single__other-list-item">
                                    <a href="<?php the_permalink(); ?>" class="govsupport-single__other-card">

                                        <?php the_title(); ?>

                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>
                    <a href="/support#measures" class="govsupport-single__archive-link">Все меры поддержки</a>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
<?php get_footer(); ?>

<?php include get_theme_file_path('/modals.php'); ?>