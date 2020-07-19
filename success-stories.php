<?php /* Template Name: Истории успеха */ ?>


<?php get_header(); ?>

<section class="page-title">
    <div class="page-title__bg-image-container">
        <?php
        $image = get_field('page_title_bg_image');
        if (!empty($image)) : ?>
            <img class="page-title__bg-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
    </div>
    <div class="container">
        <div class="inner-container">
            <div class="page-title__content">
                <h1 class="page-title__heading">
                    <?php the_title(); ?>
                </h1>
                <div class="breadcrumbs">
                    <?php require_once get_theme_file_path('/breadcrumbs.php'); ?>
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="news-archive">
    <div class="container">
        <div class="inner-container">
            <h2 class="news-archive__heading">
                Истории успеха
            </h2>

            <?php $args = [
                'post_type' => 'projects',
                'posts_per_page' => '-1',
                'meta_query' => [

                    [
                        'key' => 'project_has_success_story',
                        'value' => '1'
                    ]
                ]
            ];

            $news = new WP_Query($args);
            ?>

            <?php if ($news->have_posts()) : ?>
                <ul class="news-archive__list">
                    <?php while ($news->have_posts()) : $news->the_post(); ?>
                        <?php $photo = get_field('project_success_story_representative_photo'); ?>
                        <li class="news-archive__list-item news-archive__list-item--half-width">
                            <div class="success-stories__card">
                                <h5 class="success-stories__card-company">
                                    <?php $field = get_field('project_company_name');
                                    echo !empty($field) ? $field : 'Название компании'; ?>
                                </h5>
                                <div class="success-stories__block-with-photo">
                                    <div class="success-stories__block-with-photo-container">
                                        <?php if (!empty($photo)) : ?>
                                            <img src="<?php echo esc_url($photo['url']); ?>" class="success-stories__block-with-photo-image" alt="<?php echo esc_attr($photo['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="success-stories__block-with-photo-info">
                                        <div class="success-stories__block-with-photo-info-row success-stories__block-with-photo-info-row--ceo">

                                            <?php $field = get_field('project_success_story_representative_name');
                                            echo !empty($field) ? $field : 'ФИО Представителя'; ?>

                                            <span class="role">
                                                <?php $field = get_field('project_success_story_representative_role');
                                                echo !empty($field) ? $field : 'Должность представителя'; ?>
                                            </span>
                                        </div>
                                        <div class="success-stories__block-with-photo-info-row">
                                            <span class="grey">
                                                Объем инвестиций в проект:
                                            </span>
                                            <?php $field = get_field('project_investments');
                                            echo !empty($field) ? $field : 'Сумма'; ?> рублей
                                        </div>
                                        <div class="success-stories__block-with-photo-info-row">
                                            <span class="grey">
                                                Создано:
                                            </span>
                                            <?php $field = get_field('project_kolichestvo_sotrudnikov');
                                            echo !empty($field) ? $field : 'Количество'; ?> новых рабочих мест
                                        </div>
                                        <div class="success-stories__block-with-photo-info-row">
                                            <span class="grey">
                                                Статус:
                                            </span>
                                            <?php
                                            $terms = get_the_terms($post->ID, 'status');

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
                                        <div class="success-stories__block-with-photo-info-row">
                                            <span class="grey">
                                                Отрасль:
                                            </span>
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
                                    </div>
                                </div>
                                <div class="success-stories__card-description">
                                    <?php $field = get_field('project_success_story_quote');
                                    echo !empty($field) ? $field : 'Цитата'; ?>

                                    <a href="<?php the_permalink(); ?>" target="_blank" class="success-stories__card-read-more-link">Читать полностью</a>
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

        </div>
    </div>
</section>




<?php get_footer(); ?>


<?php include get_theme_file_path('/modals.php'); ?>