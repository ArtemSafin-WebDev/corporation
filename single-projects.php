<?php get_header(); ?>



<?php if (have_posts()) : ?>
    <div class="project-single__intro">
        <?php if (has_post_thumbnail()) { ?>
            <div class="project-single__bg">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php } ?>
        <div class="container">
            <h1 class="project-single__title">
                <?php the_title(); ?>
            </h1>
            <div class="breadcrumbs">
                <?php require_once get_theme_file_path('/breadcrumbs.php'); ?>
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            </div>
        </div>

    </div>

    <section class="govsupport-single project-single__info">
        <div class="container">





            <div class="govsupport-single__row">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="govsupport-single__main">
                        <div class="project-single__summary">
                            <ul class="project-single__summary-list">
                                <li class="project-single__summary-list-item">
                                    <h4 class="project-single__summary-key">
                                        Объем инвестиций в проект:
                                    </h4>
                                    <div class="project-single__summary-value">
                                        <?php $field = get_field('project_investments');
                                        echo !empty($field) ? $field : 'Сумма'; ?> млн. руб.
                                    </div>
                                </li>
                                <li class="project-single__summary-list-item">
                                    <h4 class="project-single__summary-key">
                                        Статус:
                                    </h4>
                                    <div class="project-single__summary-value">
                                        <?php
                                        $terms = get_the_terms($post->ID, 'status');

                                        if (is_array($terms)) {
                                            $term_names = array_map(function ($term) {
                                                return $term->name;
                                            }, $terms);

                                            echo implode(', ', $term_names);
                                        } else {
                                            echo 'Неизвестно';
                                        } ?>
                                    </div>
                                </li>
                                <li class="project-single__summary-list-item">
                                    <h4 class="project-single__summary-key">
                                        Создано:
                                    </h4>
                                    <div class="project-single__summary-value">
                                        <?php $field = get_field('project_kolichestvo_sotrudnikov');
                                        echo !empty($field) ? $field : 'Количество'; ?> новых рабочих мест
                                    </div>
                                </li>
                                <li class="project-single__summary-list-item">
                                    <h4 class="project-single__summary-key">
                                        Отрасль:
                                    </h4>
                                    <div class="project-single__summary-value">
                                        <?php
                                        $terms = get_the_terms($post->ID, 'industry');
                                        if (is_array($terms)) {
                                            $term_names = array_map(function ($term) {
                                                return $term->name;
                                            }, $terms);

                                            echo implode(', ', $term_names);
                                        } else {
                                            echo 'Неизвестно';
                                        }
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php if (get_field('project_in_search')) : ?>
                            <div class="project-single__apply-wrapper">
                                <a href="#business" class="project-single__apply-link js-booking js-modal-open">
                                    Подать заявку
                                </a>
                                <p class="project-single__apply-text">
                                    Доступно<br> для инвестирования
                                </p>
                            </div>

                        <?php endif; ?>

                        <div class="project-single__content">
                            <?php the_content(); ?>
                        </div>



                        <?php
                        $images = get_field('project_success_story_gallery');
                        if ($images) : ?>
                            <div class="project-single__gallery">
                                <h2 class="project-single__slider-heading">
                                    Фотогалерея
                                </h2>
                                <div class="project-single__slider js-project-single-slider">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($images as $image) : ?>
                                                <div class="swiper-slide">
                                                    <div class="project-single__slider-card">
                                                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="project-single__slider-card-image">
                                                        <div class="project-single__slider-card-description">
                                                            <?php echo esc_html($image['caption']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <div class="project-single__slider-nav">
                                        <button class="success-stories__nav-controls-btn success-stories__nav-controls-btn--prev" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="false">
                                            <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-left">
                                                <use xlink:href="#slider-arrow-left"></use>
                                            </svg>
                                        </button>
                                        <button class="success-stories__nav-controls-btn success-stories__nav-controls-btn--next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false">
                                            <svg width="20" height="20" aria-hidden="true" class="icon-slider-arrow-right">
                                                <use xlink:href="#slider-arrow-right"></use>
                                            </svg>
                                        </button>
                                        <div class="success-stories__nav-controls-fraction">7/9</div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (get_field('project_in_search')) : ?>
                            <div class="project-single__apply-wrapper">
                                <a href="#business" class="project-single__apply-link js-booking js-modal-open">
                                    Подать заявку
                                </a>
                                <p class="project-single__apply-text">
                                    Доступно<br> для инвестирования
                                </p>
                            </div>

                        <?php endif; ?>



                    </div>
                <?php endwhile; ?>
                <div class="govsupport-single__sidebar">
                    <h2 class="govsupport-single__other-heading">
                        Другие истории успеха
                    </h2>

                    <?php
                    $args = [
                        'post_type' => 'projects',
                        'posts_per_page' => '4',
                        'meta_query' => [

                            [
                                'key' => 'project_has_success_story',
                                'value' => '1'
                            ]
                        ]
                    ];

                    $measures = new WP_Query($args);
                    ?>

                    <?php if ($measures->have_posts()) : ?>
                        <ul class="govsupport-single__other-list">
                            <?php while ($measures->have_posts()) : $measures->the_post(); ?>
                                <li class="govsupport-single__other-list-item">
                                    <a href="<?php the_permalink(); ?>" class="govsupport-single__other-card project-single__card">

                                        <?php the_title(); ?>

                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>

                    <a href="/projects" class="govsupport-single__archive-link project-single__all-cases">Все истории успеха</a>
                </div>
            </div>
        </div>
    </section>
    <div class="container">

    </div>
<?php endif; ?>


<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>